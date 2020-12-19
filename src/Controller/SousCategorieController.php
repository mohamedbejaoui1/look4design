<?php

namespace App\Controller;

use App\Entity\SousCategorie;
use App\Form\SousCategorieType;
use App\Repository\SousCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sous_categories")
 */
class SousCategorieController extends AbstractController
{
    /**
     * @Route("/", name="sous_categorie_index", methods={"GET"})
     */
    public function index(SousCategorieRepository $sousCategorieRepository): Response
    {
        return $this->render('sous_categorie/index.html.twig', [
            'sous_categories' => $sousCategorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="sous_categorie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sousCategorie = new SousCategorie();
        $form = $this->createForm(SousCategorieType::class, $sousCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            $fileName =''.md5(uniqid()).'.'.$file->guessExtension();
            // Move the file to the directory where images are stored
            try {
                $file->move(
                    $this->getParameter('upload_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            // updates the 'image' property to store the PDF file name
            // instead of its contents

            $sousCategorie->setimage($fileName);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sousCategorie);
            $entityManager->flush();

            return $this->redirectToRoute('sous_categorie_index');
        }

        return $this->render('sous_categorie/new.html.twig', [
            'sous_categorie' => $sousCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sous_categorie_show", methods={"GET"})
     */
    public function show(SousCategorie $sousCategorie): Response
    {
        return $this->render('sous_categorie/show.html.twig', [
            'sous_categorie' => $sousCategorie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sous_categorie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SousCategorie $sousCategorie): Response
    {
        $form = $this->createForm(SousCategorieType::class, $sousCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            $fileName =''.md5(uniqid()).'.'.$file->guessExtension();
            // Move the file to the directory where images are stored
            try {
                $file->move(
                    $this->getParameter('upload_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            // updates the 'image' property to store the PDF file name
            // instead of its contents

            $sousCategorie->setimage($fileName);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sousCategorie);
            $entityManager->flush();

            return $this->redirectToRoute('sous_categorie_index');
        }


        return $this->render('sous_categorie/edit.html.twig', [
            'sous_categorie' => $sousCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sous_categorie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SousCategorie $sousCategorie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousCategorie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sousCategorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sous_categorie_index');
    }
}
