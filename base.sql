CREATE TABLE prefixes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    prefixe VARCHAR(3) NOT NULL UNIQUE,
    libelle VARCHAR(100)
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
INSERT INTO prefixes (prefixe, libelle) VALUES ('033','Opérateur A'), ('037','Opérateur B');
INSERT INTO types_operation (code, libelle) VALUES ('depot','Dépôt'), ('retrait','Retrait'), ('transfert','Transfert');