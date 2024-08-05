<?php

$routes = [
    "POST/patient" => "PatientController@createPatient",
    "GET/patient/{id}" => "PatientController@getPatientById",
    "GET/patients" => "PatientController@getAllPatients",
    "PUT/patient" => "PatientController@updatePatient",
    "DELETE/patient/{id}" => "PatientController@deletePatientById",

    "POST/doctor" => "DoctorController@createDoctor",
    "GET/doctor/{id}" => "DoctorController@getDoctorById",
    "GET/doctors" => "DoctorController@getAllDoctors",
    "PUT/doctor" => "DoctorController@updateAllDataDoctor",
    "DELETE/doctor/{id}" => "DoctorController@deleteDoctorById",

    "POST/service" => "ServiceController@createService",
    "GET/service/{id}" => "ServiceController@getServiceById",
    "GET/services" => "ServiceController@getAllService",
    "PATCH/serviceCompleted/{id}" => "ServiceController@updateServiceToCompleted",
    "PATCH/serviceCanceled/{id}" => "ServiceController@updateServiceToCanceled"
];
