<?php

namespace App\models;

use App\ENUM\Status;
use DateTimeImmutable;

class Service
{
    private DateTimeImmutable $openingHours;
    private int|string $idDoctor;
    private int|string $idPatient;
    private ?string $idService;
    private ?Status $status;

    function __construct(
        DateTimeImmutable $openingHours,
        int|string $idDoctor,
        int|string $idPatient,
        string $idService = null,
        Status $status = null
    ) {
        $this->setIdService($idService);
        $this->setOpeningHours($openingHours);
        $this->setStatus($status->value);
        $this->setIdDoctor($idDoctor);
        $this->setIdPatient($idPatient);
    }

    public function getIdService(): int|string
    {
        return $this->idService;
    }

    private function setIdService(null|string $idService)
    {
        $this->idService = $idService;
    }

    public function getOpeningHours(): DateTimeImmutable
    {
        return $this->openingHours;
    }

    private function setOpeningHours(DateTimeImmutable $openingHours)
    {
        $this->openingHours = $openingHours;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    private function setStatus(string|null $status)
    {
        $this->status = $status;
    }

    public function getIdDoctor(): int|string
    {
        return $this->idDoctor;
    }

    public function setIdDoctor(int|string $idDoctor)
    {
        $this->idDoctor = $idDoctor;
    }

    public function getIdPatient(): int|string
    {
        return $this->idPatient;
    }

    public function setIdPatient(int|string $idPatient)
    {
        $this->idPatient = $idPatient;
    }

    public function objectToArray()
    {
        return [
            'openingHours' => $this->getOpeningHours(),
            'status' => $this->getStatus(),
            'idDoctor' => $this->getIdDoctor(),
            'idPatient' => $this->getidPatient()
        ];
    }
}
