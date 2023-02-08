<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations\QueryParam;

class FosRestController extends AbstractController
{



    /**
     * @Route("/resthome", name="default")
     */
    public function index()
    {
        return new Response('Hello World!');
    }


    /**
     * @Route("/api/tests", methods={"POST"})
     */
    public function getTests(Request $request) : Response
    {
        $response = new Response();


        $file = $request->files->get('file');
        $variables = json_decode($request->request->get('vars'),true);
        $testName = $request->request->get('test');


        if ($file->getClientMimeType() !== 'text/csv') {
            throw new \Exception('Invalid file type');
        }


        $file->move(realpath(__DIR__ . '/../sets/'), $file->getClientOriginalName());


//     Working on python processing


        $median_path  =realpath(__DIR__ . '/../scripts/median.py');
        $anova_path  =realpath(__DIR__ . '/../scripts/anova.py');
        $shapiro_path  =realpath(__DIR__ . '/../scripts/shapiro.py');
        $spearman_path  =realpath(__DIR__ . '/../scripts/spearman.py');

        $python_script  = $median_path;

        switch ($testName){
            case "ANOVA" :
                $python_script = $anova_path;
                break;
            case "Median" :
                $python_script = $median_path;
                break;
            case "Spearman" :
                $python_script = $spearman_path;
                break;
            case "Shapiro" :
                $python_script = $shapiro_path;
                break;
            default:
                $python_script = $anova_path;
        }

        $vars_string = implode(" ",$variables);
        $command = "python  $python_script $vars_string";
        exec($command, $output, $return_var);

        // $response->setContent(json_encode($output));
        $response->setContent(json_encode($output));

        // for Json data we set the type of header content like that :

        $response->headers->set('Content-Type', 'application/json');

        // Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');

        // Or a predefined website
        //$response->headers->set('Access-Control-Allow-Origin', 'https://mid.net/');

        // we can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');

        return $response;
    }



//    #[Route('/fos/rest', name: 'app_fos_rest')]
//    public function index2(): Response
//    {
//        return $this->render('fos_rest/index.html.twig', [
//            'controller_name' => 'FosRestController',
//        ]);
//    }


}
