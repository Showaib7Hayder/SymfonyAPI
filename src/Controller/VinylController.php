<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VinylController extends AbstractController {

    #[Route('/home')]
    public function homePage(){
    die('Here is the home Page !');
    }

    #[Route('/info')]
    public function info(Request $request) : Response
    {
        $response = new Response();

//      $name = $request->request->get('name');

        $file = $request->files->get('file');


//        $path = '.\backEndSymfony';
//        $file->move($path);

//     Working on python processing


        $script_path  =realpath(__DIR__ . '/../scripts/pyscript.py');
        $command = "python  $script_path";
        exec($command, $output, $return_var);

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

}