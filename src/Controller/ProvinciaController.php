<?php
namespace App\Controller;
use App\Entity\Provincia;
use App\Form\ProvinciaType;
use App\Entity\Localidad;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
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
        $provincia = new Provincia ();
        $formu = $this->createForm(ProvinciaType::class, $provincia);
        $formu->handleRequest($request);
        if ($formu->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($provincia);
            $em->flush();
            
            return $this->redirectToRoute('provincia_lista');
        }
            return $this->render('provincia/nuevo.html.twig', [
            'formulario' => $formu ->createView(),
        ]);
    }
    /**
     * @Route("/lista", name="provincia_lista")
     */
    public function listado()
    {
        $repo = $this->getDoctrine()->getRepository(Provincia::class);
        
        $provincias = $repo->findAll();
        
            return $this->render ('provincia/index.html.twig', [
            'provincias' =>  $provincias,
        ]);
    }
    /**
     * @Route("/detalle/{id}", name="provincia_detalle", requirements={"id"="\d+"})
     */
    public function detalle($id)
    {
        $repo = $this->getDoctrine()->getRepository(Provincia::class);
        
        $provincia = $repo->find($id);
                   
            return $this->render ('provincia/detalle.html.twig', [
            'provincia' =>  $provincia,
        ]);
    }
    /**
     * @Route("/jsonlist", name="provincia_jsonlist")
     */
    public function jsonProvincias()
    {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceHandler(
            function ($object) {
                return $object->getId();
            }
        );
        $serializer = new Serializer(array($normalizer), array($encoder));
        $repo = $this->getDoctrine()->getRepository(Provincia::class);
        $provincias = $repo->findAll();
        $jsonProvincias = $serializer->serialize($provincias, 'json');        
        $respuesta = new Response($jsonProvincias);
        return $respuesta;
    }
}