<?php

namespace App\DAO;

use App\Db\DbConn;
use App\ENUM\Status;
use App\models\Service;

class ServiceDAO
{
    public static function createService(Service $service): object
    {
        $sql = 'INSERT INTO service (openingHours, status, idDoctor, idPatient) VALUES (:openingHours, :status, :idDoctor, :idPatient)';
        $dbConn = DbConn::coon();
        $stmt = $dbConn->prepare($sql);

        $openingHours = $service->getOpeningHours()->format('Y-m-d H:i:s');
        $stmt->bindValue(':openingHours', $openingHours);
        $stmt->bindValue(':status', Status::SCHEDULED->value);
        $stmt->bindValue(':idDoctor', $service->getIdDoctor(), \PDO::PARAM_INT);
        $stmt->bindValue(':idPatient', $service->getIdPatient(), \PDO::PARAM_INT);

        $stmt->execute();
        $dbConn = null;
        return $service;
    }

    public static function getServiceById(string $idService): array
    {
        $sql = 'SELECT * FROM service WHERE idService = :idService';
        $dbConn = DbConn::coon();
        $stmt = $dbConn->prepare($sql);

        $stmt->bindValue(':idService', $idService, \PDO::PARAM_STR);
        $stmt->execute();

        $dbConn = null;

        $service = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$service) throw new \Exception("Id não encontrado", 404);
        return $service;
    }

    public static function getAllService(): array
    {
        $sql = 'SELECT * FROM service';
        $dbConn = DbConn::coon();
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();

        $dbConn = null;

        $services = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (!$services) throw new \Exception("Nenhum servico cadastrado", 404);
        return $services;
    }

    public static function updateServiceToCompleted(int $idService): void
    {
        $sql = 'UPDATE service
                SET status = :status
                WHERE idService = :idService';

        $dbConn = DbConn::coon();
        $stmt = $dbConn->prepare($sql);

        $stmt->bindValue(':status', Status::COMPLETED->value, \PDO::PARAM_STR);
        $stmt->bindValue(':idService', $idService, \PDO::PARAM_INT);
        $dbConn = null;

        $stmt->execute();

        if ($stmt->rowCount() == 0) throw new \Exception("Id especificaodo não encontrado ou dados iguais");
    }

    public static function updateServiceToCanceled(int $idService): void
    {
        $sql = 'UPDATE service
                SET status = :status
                WHERE idService = :idService';

        $dbConn = DbConn::coon();
        $stmt = $dbConn->prepare($sql);

        $stmt->bindValue(':status', Status::CANCELED->value, \PDO::PARAM_STR);
        $stmt->bindValue(':idService', $idService, \PDO::PARAM_INT);
        $dbConn = null;

        $stmt->execute();
        if ($stmt->rowCount() == 0) throw new \Exception("Id especificaodo não encontrado ou dados iguais");
    }
}
