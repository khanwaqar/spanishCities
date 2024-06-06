<?php

namespace App\Controller;

use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LocationController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getZipByCity(Request $request): JsonResponse
    {
        if ($request->isMethod('POST')) {
            $data = json_decode($request->getContent(), true);
            $cityName = $data['city'] ?? null;
        } else {
            $cityName = $request->query->get('city');
        }

        if (!$cityName) {
            return new JsonResponse(['error' => 'City name is required'], 400);
        }

        $city = $this->entityManager->getRepository(Location::class)->findOneBy(['cityName' => $cityName]);

        if (!$city) {
            return new JsonResponse(['error' => 'City not found'], 404);
        }

        $zipCode = $city->getZipCode();
        if(strlen($zipCode) < 5) { // Change the condition to check if it's less than 5
            // Pad the ZIP code with '0' characters at the beginning to make it 5 characters long
            $zipCode = str_pad($zipCode, 5, '0', STR_PAD_LEFT);
        }

        return new JsonResponse([
            'city' => $cityName, 
            'zip' => $zipCode,
            'latitude' => $city->getLatitude(),
            'longitude' => $city->getLongitude()
        
        ]);
    }

    public function getCityByZip(Request $request): JsonResponse
    {
        if ($request->isMethod('POST')) {
            $data = json_decode($request->getContent(), true);
            $zipCode = $data['zip'] ?? null;
        } else {
            $zipCode = $request->query->get('zip');
        }
        

        if (!$zipCode) {
            return new JsonResponse(['error' => 'Zip code is required'], 400);
        }

        if ($zipCode[0] === '0') {
            $zipCode = substr($zipCode, 1); // Remove the first character
        }

        $city = $this->entityManager->getRepository(Location::class)->findOneBy(['zipCode' => $zipCode]);

        if (!$city) {
            return new JsonResponse(['error' => 'Zip code not found'], 404);
        }
        
        $zipCode = $city->getZipCode();
        if(strlen($zipCode) < 5) { // Change the condition to check if it's less than 5
            // Pad the ZIP code with '0' characters at the beginning to make it 5 characters long
            $zipCode = str_pad($zipCode, 5, '0', STR_PAD_LEFT);
        }

        return new JsonResponse([
            'zip' => $zipCode, 
            'city' => $city->getCityName(),
            'latitude' => $city->getLatitude(),
            'longitude' => $city->getLongitude()
        ]);
    }
}
