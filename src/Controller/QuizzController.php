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
        private EntityManagerInterface $em,
        private SerializerInterface $serializer
    ) {
        $this->session->start();
    }

    /**
     * @Route("/quizz_feuillus/{nSpecies}", name="quizz")
     */
    public function index(int $nSpecies): Response
    {
        $quizz = $this->getQuizz($nSpecies);

        if ($quizz->isFinished()) {
            $quizz = new Quizz($this->speciesRepository);
            $quizz->init($nSpecies);
        }

        $this->persistQuizz($quizz);

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

            if ($quizz && $quizz->getNSpecies() === $nSpecies) {
                return $quizz;
            }
        }

        $quizz = new Quizz($this->speciesRepository);
        $quizz->init($nSpecies);

        return $quizz;
    }

    private function persistQuizz(Quizz $quizz)
    {
        $this->em->persist($quizz);
        $this->em->flush();

        $this->session->set('quizz_id', $quizz->getId());
        /* dump($_SESSION); */
        /* dump($this->session->get('quizz_id')); */

        return $this;
    }

    /**
     * @Route("/api/quizz/{nSpecies}/result", name="quizz_result", methods="POST")
     */
    public function result(
        Request $request,
        int $nSpecies
    ): JsonResponse
    {
        $quizz  = $this->getQuizz($nSpecies);
        $choice = json_decode((string) $request->getContent(), true)['choice'];
        $result = $quizz->check($choice);

        $this->persistQuizz($quizz);

        $json = $this->serializer->serialize([
            'result'      => $result,
            'choice'      => $this->speciesRepository->find($choice),
            'goodSpecies' => $quizz->getCurrentSpecies(),
        ], 'json', [ 'groups' => [ 'front', 'quizz' ] ] );

        return JsonResponse::fromJsonString($json);
    }

    /**
     * @Route("/api/quizz/{nSpecies}/next", name="quizz_next", methods="GET")
     */
    public function next(
        Request $request,
        int $nSpecies
    ): JsonResponse
    {
        $quizz = $this->getQuizz($nSpecies);
        $quizz->nextTurn();

        $this->persistQuizz($quizz);

        $json = $this->serializer->serialize([
            'quizz' => $quizz,
        ], 'json', [ 'groups' => [ 'front', 'quizz' ] ] );

        return JsonResponse::fromJsonString($json);
    }
}
