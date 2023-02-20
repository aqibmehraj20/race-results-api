<?php

namespace App\Controller;

use App\Entity\RaceResult;
use App\Form\RaceResultCsvType;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use League\Csv\Statement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * @Route("/race")
 */
class RaceResultController extends AbstractController
{
    private $entityManager;
    private $formFactory;

    public function __construct(EntityManagerInterface $entityManager, FormFactoryInterface $formFactory)
    {
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
    }

    /**
     * @Route("/raceimport", methods={"POST"})
     * @throws \League\Csv\Exception
     */
    public function import(Request $request, EntityManagerInterface $entityManager): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $form = $this->createForm(RaceResultCsvType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $csvFile = $form->get('csvFile')->getData();
            $csvReader = Reader::createFromPath($csvFile->getPathname());
            $csvReader->setHeaderOffset(0);

            $stmt = (new Statement())->offset(0);
            $records = $stmt->process($csvReader);

            foreach ($records as $record) {
                $raceResult = new RaceResult();
                $raceResult->setFullName($record['fullName']);
                $raceResult->setDistance($record['distance']);
                $raceResult->setTime($record['time']);
                $raceResult->setAgeCategory($record['ageCategory']);

                $entityManager->persist($raceResult);
            }

            $entityManager->flush();

            return $this->json([
                'message' => 'Imported CSV file successfully',
            ]);
        }

        return $this->json([
            'errors' => (string) $form->getErrors(true, false),
        ]);
    }
}
