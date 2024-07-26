<?php

namespace App\models;

use Exception;

class Patient
{
    private ?string $idPatient;
    private string $allergies;
    private string $cpf;
    private string $name;
    private string $email;
    private string $telephone;

    function __construct(
        string $idPatient = null,
        string $allergies,
        string $cpf,
        string $name,
        string $email,
        string $telephone
    ) {
        $this->setIdPatient($idPatient);
        $this->setAllergies($allergies);
        $this->setCpf($cpf);
        $this->setName($name);
        $this->setEmail($email);
        $this->setTelephone($telephone);
    }

    public function getIdPatient() : string
    {
        return $this->idPatient;
    }

    private function setIdPatient(string $idPatient)
    {
        $this->idPatient = $idPatient;
    }

    public function getAllergies() : string
    {
        return $this->allergies;
    }

    private function setAllergies(string $allergies)
    {
        $this->allergies = $allergies;
    }

    public function getCpf() : string
    {
        return $this->cpf;
    }

    private function setCpf(string $cpf)
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        if (strlen($cpf) != 11) {
            throw new Exception("CPF deve conter 11 digitos");
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            throw new Exception("CPF inválido");
        }

        // Faz o calculo para validar o CPF / calculation to validate CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                throw new Exception("CPF inválido");
            }
        }
        $this->cpf = $cpf;
    }

    public function getName() : string
    {
        return $this->name;
    }

    private function setName(string $name)
    {
        if(strlen($name) < 3) throw new Exception("Nome inválido, deve conter mais de 2 letras");
        $this->name = $name;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    private function setEmail(string $email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) throw new Exception("Email Inválido!");
        $this->email = $email;
    }

    public function getTelephone() : string
    { 
        return $this->telephone;
    }

    private function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;
    }
}
