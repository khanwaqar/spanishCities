<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $cityName = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 20)]
    private ?string $zipCode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $region1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $region2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $region3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $region4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $state = null;

    #[ORM\Column(nullable: true)]
    private ?int $autoid = null;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?float $longitude = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCityName(): ?string
    {
        return $this->cityName;
    }

    public function setCityName(string $cityName): static
    {
        $this->cityName = $cityName;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): static
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getRegion1(): ?string
    {
        return $this->region1;
    }

    public function setRegion1(?string $region1): static
    {
        $this->region1 = $region1;

        return $this;
    }

    public function getRegion2(): ?string
    {
        return $this->region2;
    }

    public function setRegion2(?string $region2): static
    {
        $this->region2 = $region2;

        return $this;
    }

    public function getRegion3(): ?string
    {
        return $this->region3;
    }

    public function setRegion3(?string $region3): static
    {
        $this->region3 = $region3;

        return $this;
    }

    public function getRegion4(): ?string
    {
        return $this->region4;
    }

    public function setRegion4(?string $region4): static
    {
        $this->region4 = $region4;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getAutoid(): ?int
    {
        return $this->autoid;
    }

    public function setAutoid(?int $autoid): static
    {
        $this->autoid = $autoid;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }
}
