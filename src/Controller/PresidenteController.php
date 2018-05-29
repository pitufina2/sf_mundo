<?php
namespace App\Controller;
use App\Entity\Presidente;
use App\Form\PresidenteType;
use App\Entity\Pais;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
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
        $presidente = new Presidente ();
        $formu = $this->createForm(PresidenteType::class, $presidente);
        $formu->handleRequest($request);
        if ($formu->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($presidente);
            $em->flush();
            
            return $this->redirectToRoute('presidente_lista');
        }
            return $this->render('presidente/nuevo.html.twig', [
            'formulario' => $formu ->createView(),
        ]);
    }
    /**
     * @Route("/lista", name="presidente_lista")
     */
    public function listado()
    {
        $repo = $this->getDoctrine()->getRepository(Presidente::class);
        
        $presidentes = $repo->findAll();
        
            return $this->render ('presidente/index.html.twig', [
            'presidentes' =>  $presidentes,
        ]);
    }
    /**
     * @Route("/detalle/{id}", name="presidente_detalle", requirements={"id"="\d+"})
     */
    public function detalle($id)
    {
        $repo = $this->getDoctrine()->getRepository(Presidente::class);
        
        $presidente = $repo->find($id);
                   
            return $this->render ('presidente/detalle.html.twig', [
            'presidente' =>  $presidente,
        ]);
    }
    /**
     * @Route("/jsonlist", name="presidente_jsonlist")
     */
    public function jsonPresidentes()
    {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceHandler(
            function ($object) {
                return $object->getId();
            }
        );
        $serializer = new Serializer(array($normalizer), array($encoder));
        $repo = $this->getDoctrine()->getRepository(Presidente::class);
        $presidentes = $repo->findAll();
        $jsonPresidentes = $serializer->serialize($presidentes, 'json');        
        $respuesta = new Response($jsonPresidentes);
        return $respuesta;
    }
}