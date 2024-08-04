<?php

namespace App\DAO;

use App\Db\DbConn;
use App\models\Doctor;

class DoctorDAO
{
    public static function createDoctor(Doctor $doctor): object
    {
        $sql = 'INSERT INTO doctor (name, crm, specialization) VALUES (:name, :crm, :specialization)';
        $dbConn = DbConn::coon();
        $stmt = $dbConn->prepare($sql);

        $stmt->bindValue(':name', $doctor->getName(), \PDO::PARAM_STR);
        $stmt->bindValue(':crm', $doctor->getCrm(), \PDO::PARAM_STR);
        $stmt->bindValue(':specialization', $doctor->getSpecialization(), \PDO::PARAM_STR);

        $stmt->execute();
        $dbConn = null;
        return $doctor;
    }

    public static function getDoctorById(string $idDoctor): array
    {
        $sql = 'SELECT * FROM doctor WHERE idDoctor = :idDoctor';
        $dbConn = DbConn::coon();
        $stmt = $dbConn->prepare($sql);

        $stmt->bindValue(':idDoctor', $idDoctor, \PDO::PARAM_STR);
        $stmt->execute();

        $dbConn = null;

        $doctor = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$doctor) throw new \Exception("Id não encontrado", 404);
        return $doctor;
    }

    public static function getAllDoctors(): array
    {
        $sql = 'SELECT * FROM doctor';
        $dbConn = DbConn::coon();
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();

        $dbConn = null;

        $doctors = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (!$doctors) throw new \Exception("Nenhum doutor cadastrado", 404);
        return $doctors;
    }

    public static function deleteDoctorById(string $idDoctor): void
    {
        $sql = 'DELETE FROM doctor WHERE idDoctor = :idDoctor';
        $dbConn = DbConn::coon();
        $stmt = $dbConn->prepare($sql);

        $stmt->bindValue(':idDoctor', $idDoctor, \PDO::PARAM_STR);

        $dbConn = null;
        $stmt->execute();
        if ($stmt->rowCount() == 0) throw new \Exception("Id do doutor não encontrado para remoção", 404);
    }

    public static function updateAllDataDoctor(Doctor $doctor): void
    {
        $sql = 'UPDATE doctor 
                SET name = :name, crm = :crm, specialization = :specialization
                WHERE idDoctor = :idDoctor';
        $dbConn = DbConn::coon();
        $stmt = $dbConn->prepare($sql);

        $stmt->bindValue(':name', $doctor->getName(), \PDO::PARAM_STR);
        $stmt->bindValue(':crm', $doctor->getCrm(), \PDO::PARAM_STR);
        $stmt->bindValue(':specialization', $doctor->getSpecialization(), \PDO::PARAM_STR);
        $stmt->bindValue(':idDoctor', $doctor->getIdDoctor(), \PDO::PARAM_INT);


        $stmt->execute();

        if($stmt->rowCount() == 0) throw new \Exception("Id especificaodo não encontrado ou dados iguais");
    }
}
