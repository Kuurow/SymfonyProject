<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyController extends AbstractController
{
    /**
     * @Route("/luckyNumber", name="luckyNumber")
     */
    public function index()
    {
        $number = random_int(0, 100);

        return $this->render('lucky/index.html.twig', [
            'number' => $number,
        ]);
    }
}