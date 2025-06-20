<?php

namespace App\Controller;

use App\Entity\Glace;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class DeleteglaceController extends AbstractController
{
    #[Route('/deleteglace/{id}', name: 'app_deleteglace')]
    public function delete(Glace $glace, Request $request, EntityManagerInterface $entityManager): Response
    {
        if($this->isCsrfTokenValid("SUP".$glace->getId(),$request->get('_token'))) {
            $entityManager->remove($glace);
            $entityManager->flush();
            $this->addFlash("success","La suppression a été effectuée");
            return $this->redirectToRoute('app_liste_glace');
        }
        return $this->render('deleteglace/deleteglace.html.twig', [
            'controller_name' => 'DeleteglaceController',
        ]);
    }
}
