<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\OrderBy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/wish', name: 'wish_')]
class WishController extends AbstractController
{
    #[Route('/liste', name: 'liste')]
    public function liste(WishRepository $wishRepository): Response
    {
        // Sur la page de liste d'idées, affichez le titre de toutes les idées publiées,
        // de la plus récente à la plus ancienne. En cliquant sur une idée,
        // l'utilisateur doit être mené à la page de détail de  celle-ci.
        //Dans  Twig,  vous  aurez  besoin  des  2  arguments  de  la  fonction  path()  pour générer ces liens.

    $souhaits = $wishRepository->findBy([],['dateCreation'=>'Desc']);



        return $this->render('wish/list.html.twig', [
            'controller_name' => 'WishController',
            'souhaits' => $souhaits
        ]);
    }

    #[Route('/detail/{id}', name: 'detail')]
    public function detail(int $id): Response
    {
        //todo recup avec un id en bdd

        //afficher



        return $this->render('wish/detail.html.twig', [

        ]);
    }

    #[Route('/nouveau', name: 'nouveau')]
    public function nouveau(EntityManagerInterface $entityManager): Response
    {
        $souhait =new Wish();
        $souhait->setTitre("manger des nouilles");
        $souhait->setDescription("trop bon les nouilles");
        $souhait->setAuteur("Tan");
        $souhait->setDateCreation(new \DateTime());

        $entityManager->persist($souhait);
        $entityManager->flush();
        dump($souhait);



        return $this->render('wish/nouveau.html.twig', [
            "souhait" => $souhait

        ]);
    }


}
