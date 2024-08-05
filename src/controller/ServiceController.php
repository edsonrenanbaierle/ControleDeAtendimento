<?php

namespace App\controller;

use App\DAO\ServiceDAO;
use App\http\Request;
use App\http\Response;
use App\models\Service;
use DateTimeImmutable;

class ServiceController
{
    public function createService()
    {
        try {
            $data = Request::requestBody();
            $service = ServiceDAO::createService(new Service(
                new DateTimeImmutable($data['openingHours']),
                (int)$data['idDoctor'],
                (int)$data['idPatient'],
                null,
                null
            ));

            Response::responseSucess([
                "servico" => $service->objectToArray(),
                "message" => "Sucesso ao registrar o atendimento"
            ], 200);
        } catch (\PdoException $ex) {
            Response::responseError($ex->getMessage(), 500);
        } catch (\Exception $ex) {
            Response::responseError($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * @param array [0] is $id
     */
    public function getServiceById(array $id)
    {
        try {
            $service = ServiceDAO::getServiceById($id[0]);
            Response::responseSucess([
                "servico" => $service
            ], 200);
        } catch (\PdoException $ex) {
            Response::responseError($ex->errorInfo[2], 500);
        } catch (\Exception $ex) {
            Response::responseError($ex->getMessage(), $ex->getCode());
        }
    }

    public function getAllService()
    {
        try {
            $services = ServiceDAO::getAllService();
            Response::responseSucess([
                "servicos" => $services
            ], 200);
        } catch (\PdoException $ex) {
            Response::responseError($ex->errorInfo[2], 500);
        } catch (\Exception $ex) {
            Response::responseError($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * @param array [0] is $id
     */
    public function updateServiceToCompleted(array $id)
    {
        try {
            $service = ServiceDAO::updateServiceToCompleted($id[0]);
            Response::responseSucess([
                "message" => 'sucesso ao atualizar os status para completo'
            ], 200);
        } catch (\PdoException $ex) {
            Response::responseError($ex->errorInfo[2], 500);
        } catch (\Exception $ex) {
            Response::responseError($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * @param array [0] is $id
     */
    public function updateServiceToCanceled(array $id)
    {
        try {
            $service = ServiceDAO::updateServiceToCanceled($id[0]);
            Response::responseSucess([
                "message" => 'sucesso ao atualizar os status para cancelado'
            ], 200);
        } catch (\PdoException $ex) {
            Response::responseError($ex->errorInfo[2], 500);
        } catch (\Exception $ex) {
            Response::responseError($ex->getMessage(), $ex->getCode());
        }
    }
}
