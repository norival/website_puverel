<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use App\Entity\MenuItem;
use App\Entity\Species;
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


        /***********************************************************************
         * Species fixtures
         */
        // HETRE
        $species = new Species();
        $species->setGenus('Fagus');
        $species->setSpecies('sylvatica');
        $species->setCommonName('hêtre');
        $species->setFilePath('hetre_feuille.png');
        $species->setQuizz(5);
        $manager->persist($species);

        // BOULEAU
        $species = new Species();
        $species->setGenus('Betula');
        $species->setSpecies('pendula');
        $species->setCommonName('bouleau');
        $species->setFilePath('bouleau_feuille1.png');
        $species->setQuizz(5);
        $manager->persist($species);

        // Erable
        $species = new Species();
        $species->setGenus('Acer');
        $species->setSpecies('pseudoplatanus');
        $species->setCommonName('érable');
        $species->setFilePath('erablecha_feuille.png');
        $species->setQuizz(5);
        $manager->persist($species);

        // CHENE
        $species = new Species();
        $species->setGenus('Quercus');
        $species->setSpecies('pubescens');
        $species->setCommonName('chêne pubescent');
        $species->setFilePath('chenep_feuille_fruit.png');
        $species->setQuizz(5);
        $manager->persist($species);

        // CHARME
        $species = new Species();
        $species->setGenus('Carpinus');
        $species->setSpecies('caroliniana');
        $species->setCommonName('charme');
        $species->setFilePath('charme_feuille.png');
        $species->setQuizz(5);
        $manager->persist($species);

        // Tilleul
        $species = new Species();
        $species->setGenus('Tillia');
        $species->setSpecies('cordata');
        $species->setCommonName('tilleul');
        $species->setFilePath('tilleul_feuille.png');
        $species->setQuizz(10);
        $manager->persist($species);

        // CHATAIGNER
        $species = new Species();
        $species->setGenus('Castanea');
        $species->setSpecies('sativa');
        $species->setCommonName('chataîgner');
        $species->setFilePath('chataignier_feuille.png');
        $species->setQuizz(10);
        $manager->persist($species);

        // FRENE
        $species = new Species();
        $species->setGenus('Fraxinus');
        $species->setSpecies('excelsior');
        $species->setCommonName('frêne');
        $species->setFilePath('frene_feuille.png');
        $species->setQuizz(10);
        $manager->persist($species);

        // MARRONNIER
        $species = new Species();
        $species->setGenus('Aesculus');
        $species->setSpecies('hippocastanum');
        $species->setCommonName('marronnier');
        $species->setFilePath('marronnier_feuille.png');
        $species->setQuizz(10);
        $manager->persist($species);

        // Tremble
        $species = new Species();
        $species->setGenus('Populus');
        $species->setSpecies('tremula');
        $species->setCommonName('tremble');
        $species->setFilePath('tremble_feuille.png');
        $species->setQuizz(10);
        $manager->persist($species);

        // NOISETIER
        $species = new Species();
        $species->setGenus('Coryllus');
        $species->setSpecies('avelana');
        $species->setCommonName('noisetier');
        $species->setFilePath('noisetier_feuille.png');
        $species->setQuizz(15);
        $manager->persist($species);

        // ROBINIER
        $species = new Species();
        $species->setGenus('Robinia');
        $species->setSpecies('pseudo-accacia');
        $species->setCommonName('robinier');
        $species->setFilePath('robinier_feuille.png');
        $species->setQuizz(15);
        $manager->persist($species);

        // CORNOUILLER
        $species = new Species();
        $species->setGenus('Cornus');
        $species->setSpecies('mas');
        $species->setCommonName('cornouiller');
        $species->setFilePath('cornouiller_feuille.png');
        $species->setQuizz(15);
        $manager->persist($species);

        // Platane
        $species = new Species();
        $species->setGenus('Platanus');
        $species->setSpecies('orientalis');
        $species->setCommonName('platane');
        $species->setFilePath('platane_feuille.png');
        $species->setQuizz(15);
        $manager->persist($species);

        // Aulne
        $species = new Species();
        $species->setGenus('Alnus');
        $species->setSpecies('alba');
        $species->setCommonName('aulne glutineux');
        $species->setFilePath('aulne_feuille.png');
        $species->setQuizz(15);
        $manager->persist($species);

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
