<?php

namespace App\DAO;

use App\Db\DbConn;
use App\models\Patient;
use Exception;

class PatientDAO
{
    public static function createPatient(Patient $patient): object
    {
        $sql = 'INSERT INTO patient (allergies, cpf, name, email, telephone) VALUES (:allergies, :cpf, :name, :email, :telephone)';
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

    public static function getPatientById(string $idPatient): object
    {
        $sql = 'SELECT * FROM patient WHERE idPatient = :idPatient';
        $dbConn = DbConn::coon();
        $stmt = $dbConn->prepare($sql);

        $stmt->bindValue(':idPatient', $idPatient, \PDO::PARAM_STR);
        $stmt->execute();

        $dbConn = null;
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function getAllPatient(): array
    {
        $sql = 'SELECT * FROM patient';
        $dbConn = DbConn::coon();
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();

        $dbConn = null;
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function deletePatientById(string $idPatient): void
    {
        $sql = 'DELETE FROM patient WHERE idPatient = :idPatient';
        $dbConn = DbConn::coon();
        $stmt = $dbConn->prepare($sql);

        $stmt->bindValue(':idPatient', $idPatient, \PDO::PARAM_STR);

        $dbConn = null;
        $stmt->execute();
    }

    public static function updateAllDataPatient(Patient $patient): void
    {
        $sql = 'UPDATE patient 
                SET allergies = :allergies, cpf = :cpf, name = :name, email = :email, telephone = :telephone
                WHERE idPatient = :idPatient';
        $dbConn = DbConn::coon();
        $stmt = $dbConn->prepare($sql);

        $stmt->bindValue(':allergies', $patient->getAllergies(), \PDO::PARAM_STR);
        $stmt->bindValue(':cpf', $patient->getCpf(), \PDO::PARAM_STR);
        $stmt->bindValue(':name', $patient->getName(), \PDO::PARAM_STR);
        $stmt->bindValue(':email', $patient->getEmail(), \PDO::PARAM_STR);
        $stmt->bindValue(':telephone', $patient->getTelephone(), \PDO::PARAM_STR);
        $stmt->bindValue(':idPatient', $patient->getIdPatient(), \PDO::PARAM_STR);

        $stmt->execute();

        if($stmt->rowCount() == 0) throw new Exception("Id especificaod não encontrado para atualização");
    }
}
