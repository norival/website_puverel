<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvController extends AbstractController
{
    /**
     * @Route("/cv", name="cv")
     */
    public function index(): Response
    {
        $content = json_decode(file_get_contents('../var/cv.json'), true);

        return $this->render('cv/index.html.twig', [
            'title'  => 'Resume',
            'skills' => $content['Skills'],
            'cursus' => $content['Cursus'],
        ]);
    }
}
