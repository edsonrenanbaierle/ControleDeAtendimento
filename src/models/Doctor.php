<?php

namespace App\models;

use Exception;

class Doctor
{
    private ?string $idDoctor;
    private string $name;
    private string $crm;
    private string $specialization;  

    function __construct(
        string $idDoctor = null,
        string $name,
        string $crm,
        string $specialization
    )
    {
        $this->setIdDoctor($idDoctor);
        $this->setName($name);
        $this->setCrm($crm);
        $this->setSpecialization($specialization);
    }
    
    public function getIdDoctor() : string
    {
        return $this->idDoctor;
    }

    private function setIdDoctor($idDoctor)
    {
        $this->idDoctor = $idDoctor;
    }

    public function getName() : string
    {
        return $this->name;
    }

    private function setName($name)
    {
        if(strlen($name) < 3) throw new Exception("O nome deve conter mais de 2 caracteres");
        $this->name = $name;
    }

    public function getCrm() : string
    {
        return $this->crm;
    }

    private function setCrm($crm)
    {
        $this->crm = $crm;
    }

    public function getSpecialization() : string
    {
        return $this->specialization;
    }

    private function setSpecialization($specialization)
    {
        $this->specialization = $specialization;
    }
}
