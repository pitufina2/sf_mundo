<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Presidente;
use App\Form\PresidenteType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    /**
     * @Route("/presidente")
     */

class PresidenteController extends Controller
{
    /**
     * @Route("/nuevo", name="presidente_nuevo")
     */
    public function index(Request $request)
    {
        $presidente = new Presidente();
        $formu = $this->createForm(PresidenteType::class, $presidente);
        $formu->handleRequest($request);

        if ($formu->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($presidente);

            $em->flush();


            return $this->redirectToRoute('presidente_lista');
          
        }

        return $this->render('presidente/nuevo.html.twig', [
            'formulario' => $formu->createView(),
        ]);
        
    }

    /**
     * @Route("/lista", name="presidente_lista")
     */
    public function listado()
    {

        //$this->cargarDatos();
        $repo = $this->getDoctrine()->getRepository (Presidente::class);

        $presidentes = $repo->findAll();    

     

        return $this->render('presidente/index.html.twig', [
            'presidentes' => $presidentes,
             
            
        ]);
    }
}