<?php

namespace App\DAO;

use App\Db\DbConn;
use App\models\Patient;

class PatientDAO
{
    public static function createPatient(Patient $patient)
    {
        $sql = "INSERT INTO patient (allergies, cpf, name, email, telephone) VALUES (:allergies, :cpf, :name, :email, :telephone)";

        $dbConn = DbConn::coon();
        $stmt = $dbConn->prepare($sql);

        $stmt->bindValue(':allergies', $patient->getAllergies(), \PDO::PARAM_STR);
        $stmt->bindValue(':cpf', $patient->getCpf(), \PDO::PARAM_STR);
        $stmt->bindValue(':name', $patient->getName(), \PDO::PARAM_STR);
        $stmt->bindValue(':email', $patient->getEmail(), \PDO::PARAM_STR);
        $stmt->bindValue(':telephone', $patient->getTelephone(), \PDO::PARAM_STR);

        $stmt->execute();
        $dbConn = null;
        return $patient;
    }
}
