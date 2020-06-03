<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Preferencia;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpClient\HttpClient;


class ListController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function index(Request $request)
    {
        $pref = new Preferencia();
        $content = array();

        $form = $this->createFormBuilder($pref)
            ->add('tipus', ChoiceType::class, [
                'choices' =>[
                    'Cine' => 'cine',
                    'Llibres' => 'llibres',
                    'Música' => 'musica'                ]
            ])
            ->add('localitzacio', ChoiceType::class, [
                'choices' =>[
                    'Barcelona' => 'barcelona',
                    'Madrid' => 'madrid',
                    'València' => 'valencia',
                    'Bilbao' => 'bilbao',
                ]
            ])       
            ->add('save', SubmitType::class, array('label' => 'Enviar'))
            ->getForm();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $tipus_pref = $form['tipus']->getData();
            $localitzacio_pref = $form['localitzacio']->getData();
            
            if($tipus_pref == "cine") {
                // API de cine creada por nosotros 
                $client = HttpClient::create();
                $response = $client->request('GET', 'http://127.0.0.1:39261/api/pelis');
                $content_cine = $response->getContent();
                $content_cine = $response->toArray();

                return $this->render('list/index.html.twig', [
                    'form' => $form->createView(),
                    'content_cine' => $content_cine
                ]);
            // API externas
           } else if($tipus_pref == "llibres") {
                $client = HttpClient::create();
                $response = $client->request('GET', 'https://www.etnassoft.com/api/v1/get/?id=589&callback=?');
                $content_llibres = $response->getContent();
                $content_llibres = $response->toArray();

                return $this->render('list/index.html.twig', [
                    'form' => $form->createView(),
                    'content_llibres' => $content_llibres
                ]);
            } else if ($tipus_pref == "musica") {
                $client = HttpClient::create();
                $response = $client->request('GET', 'https://deezerdevs-deezer.p.rapidapi.com/search?q=eminem', [
                    'headers' => [
                        "x-rapidapi-host" => "deezerdevs-deezer.p.rapidapi.com",
                        "x-rapidapi-key" => "ac81091c7fmsh3487d369d1749f9p16ab36jsn00ff3337a5b3"
                    ]]);
                $content_musica = $response->getContent();
                $content_musica = $response->toArray();

                return $this->render('list/index.html.twig', [
                    'form' => $form->createView(),
                    'content_musica' => $content_musica
                ]);
            }   
            
            // Desa preferències si hi està amb login
            if($this->getUser()){
                $user = $this->getUser();
                $user->setOciPreferit($tipus_pref);
                $user->setLocalitzacioPreferida($localitzacio_pref);

                // Desa
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
            }
        }

        return $this->render('list/index.html.twig', [
            'form' => $form->createView(),
            'content' => $content
        ]);
    }
}