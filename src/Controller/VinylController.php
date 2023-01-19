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


        $path = 'C:\xampp\htdocs\symfonyApp\backEndSymfony';
        $file->move($path);

    // Strting work on python processing
//        $python = <<<PYTHON
//    import pandas as pd
//
//    df = pd.DataFrame({$file})
//    result = df.mean()
//    print(result)
//    PYTHON;

        $response->setContent("File uploaded successfully!");

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