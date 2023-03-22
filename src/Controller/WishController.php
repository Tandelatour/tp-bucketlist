<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\OrderBy;
use Symfony\Component\HttpFoundation\Request;
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

            'souhaits' => $souhaits
        ]);
    }

    #[Route('/detail/{id}', name: 'detail')]
    public function detail(int $id, WishRepository $wishRepository): Response
    {
        //todo recup avec un id en bdd
        $souhait = $wishRepository->find($id);




        return $this->render('wish/detail.html.twig', [
            'souhait' => $souhait

        ]);
    }

    #[Route('/nouveau', name: 'nouveau')]
    public function nouveau( Request $request, EntityManagerInterface $entityManager): Response
    {

        $souhait =new Wish();

        $souhaitForm = $this->createForm(WishType::class, $souhait);
        $souhaitForm->handleRequest($request);

        if ($souhaitForm->isSubmitted() && $souhaitForm->isValid()){
            $souhait->setDateCreation(new \DateTime('now'));

            $entityManager->persist($souhait);
            $entityManager->flush();

            $this->addFlash("success", "Voeux ajouter ! ");
            return $this->redirectToRoute('wish_liste');
        }

//        $souhait->setTitre("manger des nouilles");
//        $souhait->setDescription("trop bon les nouilles");
//        $souhait->setAuteur("Tan");
//        $souhait->setDateCreation(new \DateTime());
//
//        $entityManager->persist($souhait);
//        $entityManager->flush();
//        dump($souhait);



        return $this->render('wish/nouveau.html.twig', [
           // "souhait" => $souhait
            "souhaitForm"=>$souhaitForm

        ]);
    }


}
