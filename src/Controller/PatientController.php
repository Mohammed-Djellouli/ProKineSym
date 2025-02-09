<?php

namespace App\Controller;

use App\Entity\BilanKine;
use App\Entity\Decision;
use App\Entity\Patient;
use App\Form\BilanKineFormType;
use App\Form\DecisionFormType;
use App\Form\PatientFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

final class PatientController extends AbstractController
{
    #[Route('/patient', name: 'app_patient')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser() != null) {
            $patient = new Patient();
            $form = $this->createForm(PatientFormType::class, $patient);
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                if ($form->isValid()) {
                    $patient->setUser($this->getUser());
                    $entityManager->persist($patient);
                    $entityManager->flush();
                    $this->addFlash(
                        'success',
                        'Le Patient est ajouté!'
                    );
                    return $this->redirectToRoute('app_home');
                } else {
                    $this->addFlash(
                        'danger',
                        'Erreur lors de l\'ajout de l\'Patient'
                    );
                }
            }
            return $this->render('patient/index.html.twig', [
                'patientForm' => $form->createView()
            ]);
        }
        return $this->redirectToRoute('app_login');
    }


    #[Route('/patient/delete/{id}', name: 'app_patient_delete', methods: ['POST'])]
    public function delete(int $id, EntityManagerInterface $entityManager,Request $request, CsrfTokenManagerInterface $csrfTokenManager): RedirectResponse
    {
        $user = $this->getUser();
        $patient = $entityManager->getRepository(Patient::class)->find($id);

        // Vérifiez si le patient existe et appartient à l'utilisateur connecté
        if (!$patient || $patient->getUser() !== $user) {
            $this->addFlash('danger', 'Patient introuvable ou non autorisé.');
            return $this->redirectToRoute('app_home');
        }

        $submittedToken = $request->request->get('_token');
        if (!$csrfTokenManager->isTokenValid(new CsrfToken('delete' . $patient->getId(), $submittedToken))) {
            $this->addFlash('danger', 'Action non autorisée.');
            return $this->redirectToRoute('app_home');
        }

        // Supprimez le patient
        $entityManager->remove($patient);
        $entityManager->flush();

        $this->addFlash('success', 'Patient supprimé avec succès.');
        return $this->redirectToRoute('app_home');
    }

    #[Route('/patient/edit/{id}', name: 'app_patient_edit', methods: ['GET', 'POST'])]
    public function edit(int $id,EntityManagerInterface $entityManager,Request $request,CsrfTokenManagerInterface $csrfTokenManager): Response
    {
        $patient = $entityManager->getRepository(Patient::class)->find($id);


        // Vérifiez si le patient existe et appartient à l'utilisateur connecté
        if (!$patient || $patient->getUser() !== $this->getUser()) {
            $this->addFlash('danger', 'Patient introuvable ou non autorisé.');
            return $this->redirectToRoute('app_home');
        }

        // Créez le formulaire avec les données existantes du patient
        $form = $this->createForm(PatientFormType::class, $patient);
        $form->handleRequest($request);


        // Traitez uniquement si la méthode est POST et le formulaire est soumis
        if ($form->isSubmitted() && $form->isValid()) {

            // Vérifiez le token CSRF
            /*$submittedToken = $request->request->get('_token');
            if (!$csrfTokenManager->isTokenValid(new CsrfToken('edit' . $patient->getId(), $submittedToken))) {
                $this->addFlash('danger', 'Action non autorisée.');
                return $this->redirectToRoute('app_home');
            }*/


            $entityManager->flush();
            $this->addFlash('success', 'Le Patient a été modifié avec succès.');
            return $this->redirectToRoute('app_home');
        }

        // Affichez le formulaire pour une méthode GET
        return $this->render('patient/edit.html.twig', [
            'patient' => $patient,
            'editForm' => $form->createView()
        ]);
    }



    #[Route('/patient/bilanKine/{id}', name: 'app_patient_bilanKine', methods: ['GET', 'POST'])]
    public function bilanKine(int $id, EntityManagerInterface $entityManager, Request $request): Response
    {
        $patient = $entityManager->getRepository(Patient::class)->find($id);

        if (!$patient) {
            throw $this->createNotFoundException('Patient introuvable.');
        }

        $bilanKine = $patient->getBilanKine() ?: new BilanKine();
        $bilanKine->setPatientID($patient);

        // Gérer les champs soumis
        if ($request->isMethod('POST')) {
            $data = $request->request->all('bilanKine'); // Fix: Use all() to retrieve the full array
            foreach ($data as $field => $value) {
                $setter = 'set' . ucfirst($field);
                if (method_exists($bilanKine, $setter)) {
                    $bilanKine->$setter($value);
                }
            }

            $entityManager->persist($bilanKine);
            $entityManager->flush();

            $this->addFlash('success', 'Le Bilan Kinésithérapique a été enregistré avec succès.');
            return $this->redirectToRoute('app_patient_bilanKine', ['id' => $id]);
        }

        // Collecter les champs remplis
        $filledFields = [];
        foreach ([
                     'inspection', 'palpation', 'mensuration', 'bilanAlgique', 'bilanArticulaire',
                     'bilanMusculaire', 'bilanNeurologique', 'bilanPsychologique',
                     'bilanFonctionnel', 'testsSpecifiques', 'remarque'
                 ] as $field) {
            $getter = 'get' . ucfirst($field);
            if (method_exists($bilanKine, $getter)) {
                $value = $bilanKine->$getter();
                if (!empty($value)) {
                    $filledFields[$field] = $value;
                }
            }
        }

        return $this->render('patient/bilanKine.html.twig', [
            'patient' => $patient,
            'filledFields' => $filledFields,
        ]);
    }






    #[Route('/patient/decision/{id}', name: 'app_patient_decision', methods: ['GET', 'POST'])]
    public function decision(int $id, EntityManagerInterface $entityManager, Request $request): Response
    {
        $patient = $entityManager->getRepository(Patient::class)->find($id);

        if (!$patient) {
            throw $this->createNotFoundException('Patient introuvable.');
        }

        // Vérifiez si une décision existe déjà, sinon créez-en une
        $decision = $patient->getDecision();
        if (!$decision) {
            $decision = new Decision();
            $patient->setDecision($decision);
            $entityManager->persist($decision);
        }

        $form = $this->createForm(DecisionFormType::class, $decision);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'La décision kinésithérapique a été modifiée.');
        }

        return $this->render('patient/decision.html.twig', [
            'patient' => $patient,
            'dicisionForm' => $form->createView(),
        ]);
    }



}





