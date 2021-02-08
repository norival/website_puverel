<?php

namespace App\Controller;

use App\Entity\Quizz;
use App\Repository\QuizzRepository;
use App\Repository\SpeciesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class QuizzController extends AbstractController
{
    public function __construct(
        private SpeciesRepository $speciesRepository,
        private SessionInterface $session,
        private QuizzRepository $quizzRepo,
        private EntityManagerInterface $em
    ) {
    }

    /**
     * @Route("/quizz_feuillus/{nSpecies}", name="quizz")
     */
    public function index($nSpecies): Response
    {
        $quizz = $this->getQuizz($nSpecies);

        $this->em->persist($quizz);
        $this->em->flush();
        $species = $quizz->getSpeciesList()[$quizz->getCurrentTurn() - 1 ];

        return $this->render('quizz/index.html.twig', [
            'title' => "Quizz feuillus : {$quizz->getNSpecies()} espèces",
            'quizz' => $quizz,
        ]);
    }

    private function getQuizz(int $nSpecies): Quizz
    {
        $quizzId = $this->session->get('quizz_id');

        if ($quizzId) {
            $quizz = $this->quizzRepo->find($quizzId);

            return $quizz;
        }

        $quizz = new Quizz($this->speciesRepository);
        $quizz->init($nSpecies);

        return $quizz;
    }

    /**
     * @Route("/api/quizz/{nSpecies}/result", name="quizz_result", methods="POST")
     */
    public function result(
        Request $request,
        int $nSpecies
    ): JsonResponse {
        $quizz = $this->getQuizz($nSpecies);

        $this->em->persist($quizz);
        $this->em->flush();

        $choice = json_decode((string) $request->getContent(), true)['choice'];

        return $this->json([
            'result'      => $quizz->check($choice),
            'choice'      => $this->speciesRepository->find($choice),
            'goodSpecies' => $quizz->getCurrentSpecies(),
        ]);
    }

    /**
     * @Route("/api/quizz/{nSpecies}/next", name="quizz_next", methods="GET")
     */
    public function next(
        Request $request,
        int $nSpecies
    ): JsonResponse {
        $quizz = $this->getQuizz($nSpecies);
        $quizz->setChoices();

        $this->em->persist($quizz);
        $this->em->flush();
        dump($quizz);

        return $this->json([
            'quizz' => $quizz,
        ]);
    }
}
