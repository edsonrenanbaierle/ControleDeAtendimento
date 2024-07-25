CREATE DATABASE atendimento;
USE atendimento;

CREATE TABLE patient(
	idPatient VARCHAR(36) PRIMARY KEY DEFAULT (UUID()),
	allergies TEXT,
	cpf VARCHAR(11) NOT NULL,
	name VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	telephone VARCHAR(255) NOT NULL
);

CREATE TABLE doctor(
	idDoctor VARCHAR(36) PRIMARY KEY DEFAULT (UUID()),
	name VARCHAR(255) NOT NULL,
	crm VARCHAR(11) NOT NULL,
	specialization VARCHAR(255) NOT NULL
);

CREATE TABLE service (
    idService VARCHAR(36) PRIMARY KEY DEFAULT (UUID()),
    openingHours DATETIME,
    status ENUM('scheduled', 'completed', 'canceled') NOT NULL,
    idDoctor VARCHAR(255) NOT NULL,
    idPatien VARCHAR(255) NOT NULL,
    FOREIGN KEY (idDoctor) REFERENCES doctor(idDoctor),
    FOREIGN KEY (idPatien) REFERENCES patient(idPatient)
);