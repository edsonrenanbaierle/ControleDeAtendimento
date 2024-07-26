<?php

namespace App\models;

use App\ENUM\Status;
use DateTimeImmutable;

class Service
{
    private ?string $idService;
    private DateTimeImmutable $openingHours;
    private Status $status;
    private string $idDoctor;
    private string $idPatient;

    function __construct(
        string $idService = null,
        DateTimeImmutable $openingHours,
        Status $status,
        string $idDoctor,
        string $idPatient
    )

    {
        $this->setIdService($idService);
        $this->setOpeningHours($openingHours);
        $this->setStatus($status);
        $this->setIdDoctor($idDoctor);
        $this->setIdPatient($idPatient);
    }
  
    public function getIdService() : string
    {
        return $this->idService;
    }

    private function setIdService(string $idService)
    {
        $this->idService = $idService;
    }

    public function getOpeningHours() : DateTimeImmutable
    {
        return $this->openingHours;
    }

    private function setOpeningHours(DateTimeImmutable $openingHours)
    {
        $this->openingHours = $openingHours;
    }

    public function getStatus() : string | Status
    {
        return $this->status;
    }

    private function setStatus(Status $status)
    {
        $this->status = $status;
    }

    public function getIdDoctor() : string
    {
        return $this->idDoctor;
    }

    public function setIdDoctor(string $idDoctor)
    {
        $this->idDoctor = $idDoctor;
    }

    public function getIdPatient() : string
    {
        return $this->idPatient;
    }

    public function setIdPatient(string $idPatient)
    {
        $this->idPatient = $idPatient;
    }
}
