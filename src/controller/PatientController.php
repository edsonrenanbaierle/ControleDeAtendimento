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

    /**
     * @param array [0] is $id
     */
    public function getPatientById(array $id)
    {
        try {
            $patient = PatientDAO::getPatientById($id[0]);
            Response::responseSucess([
                "patient" => $patient
            ], 200);
        } catch (\PdoException $ex) {
            Response::responseError($ex->errorInfo[2], 500);
        } catch (\Exception $ex) {
            Response::responseError($ex->getMessage(), $ex->getCode());
        }
    }

    public function getAllPatients()
    {
        try {
            $patients = PatientDAO::getAllPatients();
            Response::responseSucess([
                "patients" => $patients
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
    public function deletePatientById($id)
    {
        try {
            PatientDAO::deletePatientById($id[0]);
            Response::responseSucess([
                "message" => "sucesso ao excluir o paciente"
            ], 200);
        } catch (\PdoException $ex) {
            Response::responseError($ex->errorInfo[2], 500);
        } catch (\Exception $ex) {
            Response::responseError($ex->getMessage(), $ex->getCode());
        }
    }

    public function updatePatient()
    {
        try {
            $data = Request::requestBody();
            $patient = PatientDAO::updateAllDataPatient(new Patient(
                $data['allergies'],
                $data['cpf'],
                $data['name'],
                $data['email'],
                $data['telephone'],
                $data['idPatient'],
            ));

            Response::responseSucess([
                "message" => "Dados Atualizados com sucesso"
            ], 200);
        } catch (\PdoException $ex) {
            Response::responseError($ex->errorInfo[2], 500);
        } catch (\Exception $ex) {
            Response::responseError($ex->getMessage(), $ex->getCode());
        }
    }
}
