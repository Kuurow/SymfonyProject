<?php

namespace App\Controller;

use App\Entity\Table;
use App\Form\TableChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        $method = $req->getMethod();

        dump($req);

        if ($method == 'GET') {
            $num = $req->get("n");

            $table = new Table($num);

            dump($table);

            return $this->render('table/print.html.twig', [
                'values' => $table->calcTable(),
                'n' => $num,
                'formMethod' => $method,
            ]);
        }
        else {
            $table_choice = $req->get('table_choice'); // On récupère le tableau associatif
            $num = $table_choice['table_number'];
            $limit = $table_choice['table_limit'];

            return $this->render('table/print.html.twig', [
                'formMethod' => $method,               
            ]);
        }
        
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
            $ret['limit'] = $data['table_limit'];
            $response = $this->redirectToRoute('table_print', $ret);

        } 
        else {  // si le formulaire n'est pas envoyé
            $response = $this->render('table/select.html.twig', [
                'formulaire' => $form->createView(),
            ]);
        }
        return $response;
    }


    /**
     * @Route("/select2", name="select2")
     */
    public function select2(Request $req) 
    {
        $form = $this->createForm(TableChoiceType::class, null, 
            [
                'method' => 'POST',
                'action' => '/print'
            ]
        );
        $form->handleRequest($req); // on demande d'analyser la requête

        if ($form->isSubmitted()) { // si le formulaire est envoyé
            $data = $form->getData();
            $ret['n'] = $data['table_number'];
            $ret['limit'] = $data['table_limit'];
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
