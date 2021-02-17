<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SensibilisationController extends PageController
{
    /**
     * @Route("/sensibilisation", name="sensibilisation")
     */
    public function index(): Response
    {
        $menu = $this->menuHelper->getMenu('main');

        $contents = json_decode(file_get_contents('../var/sensibilisation.json'), true);

        return $this->render('sensibilisation/index.html.twig', [
            'title'    => 'Sensibilisation',
            'contents' => $contents,
            'menu'     => $menu,
        ]);
    }

    /**
     * @Route("/sensibilisation/file/{file}", name="sensibilisation_file")
     */
    public function getFile(string $file): Response
    {
        $contents = json_decode(file_get_contents('../var/sensibilisation.json'), true);

        return $this->render('sensibilisation/index.html.twig', [
            'title'    => 'Sensibilisation',
            'contents' => $contents,
        ]);
    }

    /**
     * @Route("/quizz_feuillus/{nSpecies}", name="quizz_feuillus")
     */
    public function quizzFeuillus(string $nSpecies): Response
    {
        $contents = json_decode(file_get_contents('../var/sensibilisation.json'), true);

        return $this->render('sensibilisation/index.html.twig', [
            'title'    => 'Sensibilisation',
            'contents' => $contents,
        ]);
    }
}
