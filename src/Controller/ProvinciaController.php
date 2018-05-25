<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Provincia;
use App\Form\ProvinciaType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    /**
     * @Route("/provincia")
     */

class ProvinciaController extends Controller
{
    /**
     * @Route("/nuevo", name="provincia_nuevo")
     */
    public function index(Request $request)
    {
        $provincia = new Provincia();
        $formu = $this->createForm(ProvinciaType::class, $provincia);
        $formu->handleRequest($request);

        if ($formu->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($provincia);

            $em->flush();


            return $this->redirectToRoute('provincia_lista');
          
        }

        return $this->render('provincia/nuevo.html.twig', [
            'formulario' => $formu->createView(),
        ]);
        
    }

    /**
     * @Route("/lista", name="provincia_lista")
     */
    public function listado()
    {

        //$this->cargarDatos();
        $repo = $this->getDoctrine()->getRepository (Provincia::class);

        $provincias = $repo->findAll();    

     

        return $this->render('provincia/index.html.twig', [
            'provincias' => $provincias,
             
            
        ]);
    }
}