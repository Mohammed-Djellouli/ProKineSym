<?php

namespace App\Controller;

use App\Entity\Patient;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PdfController extends AbstractController
{
    #[Route('/pdf/decision/{id}', name: 'app_pdf_decision', methods: ['GET'])]
    public function generateDecisionPdf(int $id, EntityManagerInterface $entityManager): Response
    {
        // Fetch patient and decision data
        $patient = $entityManager->getRepository(Patient::class)->find($id);
        if (!$patient) {
            throw $this->createNotFoundException('Patient not found');
        }

        // Retrieve decision and patient data
        $ficheDecision = $patient->getDecision();
        $decisionData = [
            'dossier' => $id,
            'nom' => $patient->getNom(),
            'prenom' => $patient->getPrenom(),
            'date' => (new \DateTime())->format('d-m-Y'),
        ];
//
//        return $this->render('pdf/index.html.twig', [
//            'ficheDecision' => $ficheDecision,
//            'decisionData' => $decisionData,
//        ]);

        // Render the HTML content using Twig
        $html = $this->renderView('pdf/index.html.twig', [
            'ficheDecision' => $ficheDecision,
            'decisionData' => $decisionData,
        ]);

        // Configure DomPDF
        $options = new Options();
        $options->set('defaultFont', 'Arial'); // Set default font
        $dompdf = new Dompdf($options);

        // Load the HTML and generate the PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait'); // A4 size and portrait orientation
        $dompdf->render();

        // Return the PDF as a response
        return new Response(
            $dompdf->output(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="decision.pdf"',
            ]
        );
    }

    #[Route('/pdf/bilan/{id}', name: 'app_pdf_bilan', methods: ['GET'])]
    public function generateBilanPdf(int $id, EntityManagerInterface $entityManager): Response
    {
        // Fetch patient and decision data
        $patient = $entityManager->getRepository(Patient::class)->find($id);
        if (!$patient) {
            throw $this->createNotFoundException('Patient not found');
        }

        // Retrieve decision and patient data
        $bilanKine = $patient->getBilanKine();
        $infoPatient = [
            'dossier' => $id,
            'nom' => $patient->getNom(),
            'prenom' => $patient->getPrenom(),
            'date' => (new \DateTime())->format('d-m-Y'),
        ];
//
//        return $this->render('pdf/index.html.twig', [
//            'ficheDecision' => $ficheDecision,
//            'decisionData' => $decisionData,
//        ]);

        // Render the HTML content using Twig
        $html = $this->renderView('pdf/bilan.html.twig', [
            'ficheDecision' => $bilanKine,
            'decisionData' => $infoPatient,
        ]);

        // Configure DomPDF
        $options = new Options();
        $options->set('defaultFont', 'Arial'); // Set default font
        $dompdf = new Dompdf($options);

        // Load the HTML and generate the PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait'); // A4 size and portrait orientation
        $dompdf->render();

        // Return the PDF as a response
        return new Response(
            $dompdf->output(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="decision.pdf"',
            ]
        );
    }
}
