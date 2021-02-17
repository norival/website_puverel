<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use App\Entity\MenuItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * ProdFixtures
 *
 * Fixtures that must be loaded in production environment. Contain the initial
 * set of data needed for the app to run.
 *
 * @author Xavier Laviron
 * @see Fixture
 */
class ProdFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        /***********************************************************************
         * Menu fixtures
         */
        $mainMenu = new Menu();
        $mainMenu->setName('main');

        $menuItem = new MenuItem();
        $menuItem->setPath('/');
        $menuItem->addMenu($mainMenu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setPath('/cv');
        $menuItem->addMenu($mainMenu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setPath('/research');
        $menuItem->addMenu($mainMenu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setPath('/sensibilisation');
        $menuItem->addMenu($mainMenu);
        $manager->persist($menuItem);

        $manager->persist($mainMenu);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public static function getGroups(): array
    {
        return ['prod'];
    }
}
