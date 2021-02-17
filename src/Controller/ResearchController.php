<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResearchController extends PageController
{
    /**
     * @Route("/research", name="research")
     */
    public function index(): Response
    {
        $menu = $this->menuHelper->getMenu('main');

        $content = json_decode(file_get_contents('../var/research.json'), true);

        return $this->render('research/index.html.twig', [
            'title'        => 'Research',
            'contents'     => $content['content'],
            'publications' => $content['publications'],
            'menu'         => $menu,
        ]);
    }
}
