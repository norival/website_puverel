<?php

namespace App\Service;

use App\Entity\Menu;
use Doctrine\ORM\EntityManagerInterface;

class MenuHelper
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function getMenu(string $name): Menu
    {
        return $this->em->getRepository(Menu::class)->findOneBy(['name' => $name]);
    }
}
