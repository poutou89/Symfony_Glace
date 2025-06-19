<?php

namespace App\Controller;

use App\Repository\GlaceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ListeGlaceController extends AbstractController
{
    #[Route('/liste/glace', name: 'app_liste_glace')]
    public function index(GlaceRepository $repository): Response
    {
        $glaces = $repository->findAll();

        return $this->render('liste_glace/listeglace.html.twig', [
            'glaces' => $glaces,
        ]);
    }
}
