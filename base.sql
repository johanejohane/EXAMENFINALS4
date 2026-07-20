CREATE TABLE operateurs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE prefixes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    prefixe VARCHAR(3) NOT NULL UNIQUE,
    libelle VARCHAR(100),
    operateur_id INTEGER NOT NULL,
    FOREIGN KEY (operateur_id) REFERENCES operateurs(id)
);

CREATE TABLE types_operation (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    code VARCHAR(20) NOT NULL,       -- 'depot' | 'retrait' | 'transfert'
    libelle VARCHAR(100)
);

CREATE TABLE baremes_frais (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    type_operation_id INTEGER NOT NULL,
    montant_min DECIMAL(15,2) NOT NULL,
    montant_max DECIMAL(15,2),
    frais DECIMAL(15,2) NOT NULL,
    frais_type VARCHAR(10) DEFAULT 'fixe',
    FOREIGN KEY (type_operation_id) REFERENCES types_operation(id)
);

-- tables partagées avec le binôme :
CREATE TABLE clients (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    numero VARCHAR(15) NOT NULL UNIQUE,
    nom VARCHAR(100),
    solde DECIMAL(15,2) DEFAULT 0
);

CREATE TABLE transactions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    type_operation_id INTEGER NOT NULL,
    client_source_id INTEGER,
    client_destination_id INTEGER,
    montant DECIMAL(15,2) NOT NULL,
    frais DECIMAL(15,2) NOT NULL,
    date_operation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (type_operation_id) REFERENCES types_operation(id),
    FOREIGN KEY (client_source_id) REFERENCES clients(id),
    FOREIGN KEY (client_destination_id) REFERENCES clients(id)
);

-- données de départ
INSERT INTO operateurs (nom) VALUES
('Orange'),
('Yas'),
('Autre opÃ©rateur');

INSERT INTO prefixes (prefixe, libelle, operateur_id) VALUES
('033','Orange', 1),
('037','Orange', 1),
('032','Yas', 2),
('031','Autre opÃ©rateur', 3);
INSERT INTO types_operation (code, libelle) VALUES ('depot','Dépôt'), ('retrait','Retrait'), ('transfert','Transfert');

-- RETRAIT (type_operation_id = 2)
-- Sous 50 000 Ar : frais fixe de 500 Ar
-- Au-dessus de 50 000 Ar : frais de 1% du montant
INSERT INTO baremes_frais (type_operation_id, montant_min, montant_max, frais, frais_type)
VALUES
(2, 0,     50000, 500, 'fixe'),
(2, 50001, NULL,  1,   'pourcentage');

-- TRANSFERT (type_operation_id = 3)
-- Frais fixe de 200 Ar quel que soit le montant
INSERT INTO baremes_frais (type_operation_id, montant_min, montant_max, frais, frais_type)
VALUES
(3, 0, NULL, 200, 'fixe');

INSERT INTO clients (numero, nom, solde) VALUES
('0331234567', 'Test Rakoto', 100000),
('0371234567', 'Test Rabe', 50000);
