<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    /**
     * @Route("/image", name="image")
     */
    public function index(): Response
    {
        $Url_image = "https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/Sierpinski_triangle.svg/220px-Sierpinski_triangle.svg.png";
        return $this->render('image/index.html.twig', [
            'controller_name' => 'ImageController',
            'url_image' => $Url_image
        ]);
    }
}
