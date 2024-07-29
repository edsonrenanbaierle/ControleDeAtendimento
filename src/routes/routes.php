<?php

$routes = [
    "POST/patient" => "PatientController@createPatient",
    "GET/patient/{id}" => "PatientController@getPatientById",
    "GET/patients" => "PatientController@getAllPatients",
    "PUT/patient" => "PatientController@updatePatient",
    "DELETE/patient/{id}" => "PatientController@deletePatientById"
];
