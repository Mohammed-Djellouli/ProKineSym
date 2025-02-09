<?php

namespace App\Controller;

use App\Entity\Planning;
use App\Form\PlanningFormType;
use App\Repository\PlanningRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PlanningController extends AbstractController
{
    #[Route('/planning', name: 'app_planning')]
    public function index(PlanningRepository $planningRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            $this->addFlash('danger', 'Veuillez vous connecter pour accéder à votre planning.');
            return $this->redirectToRoute('app_login');
        }

        $events = $planningRepository->findBy(['user' => $user]);

        $formatedEvents = array_map(function ($event) {
            return [
                'id' => $event->getId(),
                'title' => $event->getTitle(),
                'start' => $event->getStart()->format('Y-m-d\TH:i:s'),
                'end' => $event->getEnd()->format('Y-m-d\TH:i:s'),
                'color' => $event->getColor(),
                'description' => $event->getDescription() // Ajoutez la description ici
            ];
        }, $events);

        return $this->render('planning/index.html.twig',[
            'events' => json_encode($formatedEvents),
        ]);
    }

    #[Route('/planning/new', name: 'app_planning_new')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if(!$user){
            $this->addFlash('danger','Veuillez vous connecter pour ajouter un événement.');
            return $this->redirectToRoute('app_login');
        }

        $planning = new Planning();
        $form = $this->createForm(PlanningFormType::class,$planning);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $planning->setUser($user);
            $entityManager->persist($planning);
            $entityManager->flush();

            $this->addFlash('success','Événement ajouté avec succès.');
            return $this->redirectToRoute('app_planning');
        }
        return $this->render('planning/add.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    #[Route('/planning/edit/{id}', name: 'app_planning_edit', methods: ['PUT'])]
    public function edit(?Planning $calendar, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérer et décoder les données JSON
        $donnes = json_decode($request->getContent(), true);
        dump($donnes); // Debugging

        // Vérifiez si toutes les données nécessaires sont présentes
        if (
            isset($donnes['start'], $donnes['end'], $donnes['color'], $donnes['title']) &&
            !empty($donnes['start']) &&
            !empty($donnes['end']) &&
            !empty($donnes['color']) &&
            !empty($donnes['title'])
        ) {
            // Si l'événement n'existe pas, renvoyer une erreur
            if (!$calendar) {
                return new JsonResponse(['message' => 'Événement introuvable'], Response::HTTP_NOT_FOUND);
            }

            // Hydrater l'objet Planning
            $timezone = new \DateTimeZone('Europe/Paris'); // Adaptez selon votre fuseau horaire
            $start = new \DateTime($donnes['start'], new \DateTimeZone('UTC'));
            $start->setTimezone($timezone);
            $calendar->setStart($start);
            $end = new \DateTime($donnes['end'], new \DateTimeZone('UTC'));
            $end->setTimezone($timezone);
            $calendar->setEnd($end);

            $entityManager->persist($calendar);
            $entityManager->flush();

            return new JsonResponse(['message' => 'Événement mis à jour avec succès'], Response::HTTP_OK);
        }

        // Retourner une erreur si les données sont invalides
        return new JsonResponse(['message' => 'Données invalides'], Response::HTTP_BAD_REQUEST);
    }


    #[Route('/planning/delete/{id}', name: 'app_planning_delete', methods: ['DELETE'])]
    public function delete(Planning $calendar, EntityManagerInterface $entityManager): JsonResponse
    {
        // Vérifiez que l'utilisateur est le propriétaire du rendez-vous
        if ($calendar->getUser() !== $this->getUser()) {
            return new JsonResponse(['message' => 'Vous n\'êtes pas autorisé à supprimer ce rendez-vous.'], Response::HTTP_FORBIDDEN);
        }

        // Supprimez le rendez-vous
        $entityManager->remove($calendar);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Rendez-vous supprimé avec succès.'], Response::HTTP_OK);
    }






}
