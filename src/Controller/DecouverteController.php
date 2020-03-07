<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DecouverteController extends AbstractController
{
    /**
     * @Route("/decouverte", name="decouverte.index")
     */
    public function index()
    {
        return $this->render('decouverte/index.html.twig', [
            'controller_name' => 'DecouverteController',
        ]);
    }
}
