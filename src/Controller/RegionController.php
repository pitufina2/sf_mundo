<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Region;
use App\Form\RegionType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    /**
     * @Route("/region")
     */

class RegionController extends Controller
{
    /**
     * @Route("/nuevo", name="region_nuevo")
     */
    public function index(Request $request)
    {
        $region = new Region();
        $formu = $this->createForm(RegionType::class, $region);
        $formu->handleRequest($request);

        if ($formu->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($region);

            $em->flush();


            return $this->redirectToRoute('region_lista');
          
        }

        return $this->render('region/nuevo.html.twig', [
            'formulario' => $formu->createView(),
        ]);
        
    }

    /**
     * @Route("/lista", name="region_lista")
     */
    public function listado()
    {

        //$this->cargarDatos();
        $repo = $this->getDoctrine()->getRepository (Region::class);

        $regiones = $repo->findAll();    

     

        return $this->render('region/index.html.twig', [
            'regiones' => $regiones,
             
            
        ]);
    }
}