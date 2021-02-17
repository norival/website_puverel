<?php

namespace App\Controller;

use App\Service\MenuHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class PageController extends AbstractController
{
    public function __construct(protected MenuHelper $menuHelper)
    {
    }
}
