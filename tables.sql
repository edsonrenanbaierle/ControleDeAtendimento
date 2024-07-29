CREATE DATABASE atendimento;
USE atendimento;

CREATE TABLE patient(
	idPatient int PRIMARY KEY AUTO_INCREMENT NOT NULL,
	allergies TEXT,
	cpf VARCHAR(11) UNIQUE NOT NULL,
	name VARCHAR(255) NOT NULL,
	email VARCHAR(255) UNIQUE NOT NULL,
	telephone VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE doctor(
	idDoctor int PRIMARY KEY AUTO_INCREMENT NOT NULL,
	name VARCHAR(255) NOT NULL,
	crm VARCHAR(11) UNIQUE NOT NULL,
	specialization VARCHAR(255) NOT NULL
);

CREATE TABLE service (
    idService int PRIMARY KEY AUTO_INCREMENT NOT NULL,
    openingHours DATETIME NOT NULL,
    status ENUM('scheduled', 'completed', 'canceled') NOT NULL,
    idDoctor INT NOT NULL,
    idPatien INT NOT NULL,
    FOREIGN KEY (idDoctor) REFERENCES doctor(idDoctor),
    FOREIGN KEY (idPatien) REFERENCES patient(idPatient)
);