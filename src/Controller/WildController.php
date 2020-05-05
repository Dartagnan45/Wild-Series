<?php
// src/Controller/WildController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WildController extends AbstractController
{
    /**
     * @Route("/wild", name="wild_index")
     */
    public function index(): Response
    {
        return $this->render('wild/index.html.twig', [
            'website' => 'Wild Séries',
        ]);
    }

    /**
     * @Route("wild/show/{slug<[a-zA-Z0-9- -_-]+>}", name="wild_show")
     */
    public function show(?string $slug = null, ?string $error = null): Response
    {
        if (preg_match('#\_#', $slug)) {
            return $this->redirectToRoute('wild_error');
        } elseif (!$slug) {
            $error = "Aucune série sélectionnée, veuillez choisir une série";
        }
        return $this->render('wild/show.html.twig', [
            'slug' => ucwords(str_replace(['-'], ' ', $slug)),
            'error' => $error
        ]);
    }


    /**
     * @Route("wild/error", name="wild_error")
     */
    public function error(): Response
    {
        return $this->render('wild/404.html.twig');
    }
}
