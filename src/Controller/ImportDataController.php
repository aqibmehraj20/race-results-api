<?php

namespace App\Controller;

use App\Entity\Race;
use App\Entity\Result;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/import")
 */
class ImportDataController extends AbstractController
{
    /**
     * @Route("/results")
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function importResults(Request $request): Response
    {
        $file = $request->files->get('file');
        $raceTitle = $request->request->get('raceTitle');
        $raceDate = $request->request->get('raceDate');

        if (!is_null($file) && !is_null($raceTitle) && !is_null($raceDate)) {
            $filePath = $file->getPathname();
            $reader = IOFactory::createReaderForFile($filePath);
            $spreadsheet = $reader->load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();

            $race = new Race();
            $race->setTitle($raceTitle);
            $race->setDate(new \DateTime($raceDate));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($race);

            $results = [];
            $highestRow = $worksheet->getHighestRow();
            for ($row = 2; $row <= $highestRow; ++$row) {
                $fullName = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $distance = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $time = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $ageCategory = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

                if ($distance === 'medium' || $distance === 'long') {
                    $result = new Result();
                    $result->setFullName($fullName);
                    $result->setDistance($distance);
                    $result->setTime($time);
                    $result->setAgeCategory($ageCategory);
                    $result->setRace($race);
                    $entityManager->persist($result);
                    $results[] = $result;
                }
            }

            $entityManager->flush();

            // Calculate the placements and save them to the database
            // ...

            return $this->json(['results' => $results], Response::HTTP_CREATED);
        }

        return $this->json(['error' => 'Invalid request'], Response::HTTP_BAD_REQUEST);
    }
}
