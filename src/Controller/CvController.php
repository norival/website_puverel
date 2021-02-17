<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvController extends PageController
{
    /**
     * @Route("/cv", name="cv")
     */
    public function index(): Response
    {
        $menu = $this->menuHelper->getMenu('main');

        $content = json_decode(file_get_contents('../var/cv.json'), true);

        return $this->render('cv/index.html.twig', [
            'title'  => 'Resume',
            'skills' => $content['Skills'],
            'cursus' => $content['Cursus'],
            'menu'   => $menu,
        ]);
    }
}
