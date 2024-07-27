<?php

namespace App\controller;

use App\DAO\PatientDAO;
use App\http\Request;
use App\http\Response;
use App\models\Patient;

class PatientController
{
    public function createPatient()
    {
        try {
            $data = Request::requestBody();
            $patient = PatientDAO::createPatient(new Patient(
                $data['allergies'],
                $data['cpf'],
                $data['name'],
                $data['email'],
                $data['telephone'],
                null,
            ));

            Response::responseSucess([
                "patient" => $patient->objectToArray(),
                "message" => "Sucesso ao cadastrar o paciente"
            ], 200);
        } catch (\PdoException $ex) {
            Response::responseError($ex->errorInfo[2], 500);
        } catch (\Exception $ex) {
            Response::responseError($ex->getMessage(), $ex->getCode());
        }
    }
}
