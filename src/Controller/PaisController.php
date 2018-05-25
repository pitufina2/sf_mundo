<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Pais;
use App\Form\PaisType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    /**
     * @Route("/pais")
     */

class PaisController extends Controller
{
    /**
     * @Route("/nuevo", name="pais_nuevo")
     */
    public function index(Request $request)
    {
        $pais = new Pais();
        $formu = $this->createForm(PaisType::class, $pais);
        $formu->handleRequest($request);

        if ($formu->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($pais);

            $em->flush();


            return $this->redirectToRoute('pais_lista');
          
        }

        return $this->render('pais/nuevo.html.twig', [
            'formulario' => $formu->createView(),
        ]);
        
    }

    /**
     * @Route("/lista", name="pais_lista")
     */
    public function listado()
    {

        //$this->cargarDatos();
        $repo = $this->getDoctrine()->getRepository (Pais::class);

        $paises = $repo->findAll();    

     

        return $this->render('pais/index.html.twig', [
            'paises' => $paises,
             
            
        ]);
    }
}