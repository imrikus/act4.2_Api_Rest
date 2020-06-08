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
                    'Horoscop' => 'horoscop',
                    'Begudes' => 'begudes'                ]
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
                $response = $client->request('GET', 'http://labs.iam.cat/~a18aleestseg/api-rest/public/api/peliculas/');
                $content_cine = $response->getContent();
                $content_cine = $response->toArray();

                return $this->render('list/index.html.twig', [
                    'form' => $form->createView(),
                    'content_cine' => $content_cine
                ]);
            // API externes
           } else if($tipus_pref == "horoscop") {
                $client = HttpClient::create();
                $response = $client->request('GET', 'http://ohmanda.com/api/horoscope/aquarius');
                $content_horoscop = $response->getContent();
                $content_horoscop = $response->toArray();

                return $this->render('list/index.html.twig', [
                    'form' => $form->createView(),
                    'content_horoscop' => $content_horoscop
                ]);
            } else if ($tipus_pref == "begudes") {
                $client = HttpClient::create();
                $response = $client->request('GET', 'https://www.thecocktaildb.com/api/json/v1/1/search.php?s=margarita');
                $content_begudes= $response->getContent();
                $content_begudes = $response->toArray();

                return $this->render('list/index.html.twig', [
                    'form' => $form->createView(),
                    'content_begudes' => $content_begudes
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