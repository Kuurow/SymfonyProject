<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController {
    /**
     * @Route("hello")
     */
    public function index()
    {
        $date = date('d / m / Y : ');

        return $this->render('hello/index.html.twig', [
            'date' => $date,
            'message' => "Hello World !",
        ]);
    }
}