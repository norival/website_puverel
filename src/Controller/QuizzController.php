<?php

namespace App\Controller;

use App\Entity\Quizz;
use App\Repository\QuizzRepository;
use App\Repository\SpeciesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

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
        $quizzId = $this->session->get('quizz_id');

        if ($quizzId) {
            $quizz = $this->quizzRepo->find($quizzId);
        } else {
            $quizz = new Quizz($this->speciesRepository);
            $quizz->init($nSpecies);
        }

        $this->em->persist($quizz);
        $this->em->flush();
        $species = $quizz->getSpeciesList()[$quizz->getCurrentTurn() - 1 ];

        return $this->render('quizz/index.html.twig', [
            'quizz' => $quizz,
            /* 'species' => $quizz->getSpeciesList()[$quizz->getCurrentTurn() - 1 ], */
            /* 'nSpecies' => $quizz->getNSpecies(), */
        ]);
    }
}
