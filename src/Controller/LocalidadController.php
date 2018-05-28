<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Localidad;
use App\Form\LocalidadType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    /**
     * @Route("/localidad")
     */

class LocalidadController extends Controller
{
    /**
     * @Route("/nuevo", name="localidad_nuevo")
     */
    public function index(Request $request)
    {
        $localidad = new Localidad();
        $formu = $this->createForm(LocalidadType::class, $localidad);
        $formu->handleRequest($request);

        if ($formu->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($localidad);

            $em->flush();


            return $this->redirectToRoute('localidad_lista');
          
        }

        return $this->render('localidad/nuevo.html.twig', [
            'formulario' => $formu->createView(),
        ]);
        
    }

    

    


}