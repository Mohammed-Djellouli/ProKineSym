<?php

namespace App\Controller;

use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $user = $this->getUser();
        if($user){
            $patients = $user->getPatient();
            return $this->render('home/index.html.twig', [
                'patients' => $patients,
            ]);
        }
        return $this->render('home/index.html.twig',[
            'patients' => null,
        ]);

    }
}
