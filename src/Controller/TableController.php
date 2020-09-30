<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\TableChoiceType;

class TableController extends AbstractController
{
    /**
     * @Route("/table", name="table")
     */
    public function index()
    {
        return $this->render('table/index.html.twig', [
            'controller_name' => 'TableController',
        ]);
    }
    /**
     * @Route("/print", name="table_print")
     */
    public function print(Request $req)
    {   
        // dump($req);
        $num = $req->get("n");

        return $this->render('table/print.html.twig', [
            'n' => $num,
        ]);
    }
    /**
     * @Route("/select", name="select")
     */
    public function select(Request $req) 
    {
        $form = $this->createForm(TableChoiceType::class);
        $form->handleRequest($req); // on demande d'analyser la requête

        if ($form->isSubmitted()) { // si le formulaire est envoyé
            $data = $form->getData();
            $ret['n'] = $data['table_number'];
            $response = $this->redirectToRoute('table_print', $ret);

        } 
        else {  // si le formulaire n'est pas envoyé
            $response = $this->render('table/select.html.twig', [
                'formulaire' => $form->createView(),
            ]);
        }
        return $response;
    }
}
