<?php

namespace App\Controller;


use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class VoteController extends Controller
{

    public function __construct(FactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
         * @Route("/accueil", name="vote_accueil")
     */
    public function index(Request $request)
    {
        $currentRoute = $request->attributes->get('_route');
        $eventNumber = 0;
        $userPhoto = null;
        if ($this->getUser()->getElector() != null) {
            $eventNumber = $this->getUser()->getElector()->getEvent();
            $eventNumber = count($eventNumber);
            $userPhoto = $this->getUser()->getElector()->getPhoto();
            $userId = $this->getUser()->getElector()->getId();
        }

        return $this->render('users/baseUsers.html.twig', [
            'currentRoute' => $currentRoute,
            'eventNumber' => $eventNumber,
            'userPhoto' => $userPhoto,
            'userId' => $userId,

        ]);
    }


}
