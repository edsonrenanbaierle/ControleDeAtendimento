CREATE DATABASE atendimento;
USE atendimento;

CREATE TABLE patient(
	idPatient INT PRIMARY KEY AUTO_INCREMENT,
	allergies TEXT,
	cpf VARCHAR(11) NOT NULL,
	name VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	telephone VARCHAR(255) NOT NULL
);

CREATE TABLE doctor(
	idDoctor INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	crm VARCHAR(11) NOT NULL,
	specialization VARCHAR(255) NOT NULL
);

CREATE TABLE service (
    idService INT PRIMARY KEY AUTO_INCREMENT,
    openingHours DATETIME,
    status ENUM('scheduled', 'completed', 'canceled') NOT NULL,
    idDoctor INT NOT NULL,
    idPatien INT NOT NULL,
    FOREIGN KEY (idDoctor) REFERENCES doctor(idDoctor),
    FOREIGN KEY (idPatien) REFERENCES patient(idPatient)
);