<?php

namespace App\controller;

use App\DAO\DoctorDAO;
use App\http\Request;
use App\http\Response;
use App\models\Doctor;

class DoctorController
{
    public function createDoctor()
    {
        try {
            $data = Request::requestBody();
            $doctor = DoctorDAO::createDoctor(new Doctor(
                $data['name'],
                $data['crm'],
                $data['specialization'],
                null,
            ));
            Response::responseSucess([
                "doctor" => $doctor->objectToArray(),
                "message" => "Sucesso ao cadastrar o doutor"
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
    public function getDoctorById(array $id)
    {
        try {
            $doctor = DoctorDAO::getDoctorById($id[0]);
            Response::responseSucess([
                "doctor" => $doctor
            ], 200);
        } catch (\PdoException $ex) {
            Response::responseError($ex->errorInfo[2], 500);
        } catch (\Exception $ex) {
            Response::responseError($ex->getMessage(), $ex->getCode());
        }
    }

    public function getAllDoctors()
    {
        try {
            $doctors = DoctorDAO::getAllDoctors();
            Response::responseSucess([
                "doctors" => $doctors
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
    public function deleteDoctorById($id)
    {
        try {
            DoctorDAO::deleteDoctorById($id[0]);
            Response::responseSucess([
                "message" => "sucesso ao excluir o doutor"
            ], 200);
        } catch (\PdoException $ex) {
            Response::responseError($ex->errorInfo[2], 500);
        } catch (\Exception $ex) {
            Response::responseError($ex->getMessage(), $ex->getCode());
        }
    }

    public function updateAllDataDoctor()
    {
        try {
            $data = Request::requestBody();
            DoctorDAO::updateAllDataDoctor(new Doctor(
                $data['name'],
                $data['crm'],
                $data['specialization'],
                $data['idDoctor'],
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
