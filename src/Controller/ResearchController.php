<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResearchController extends AbstractController
{
    /**
     * @Route("/research", name="research")
     */
    public function index(): Response
    {
        $content = json_decode(file_get_contents('../var/research.json'), true);

        return $this->render('research/index.html.twig', [
            'title'        => 'Research',
            'contents'     => $content['content'],
            'publications' => $content['publications'],
        ]);
    }
}
