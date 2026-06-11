CREATE TABLE Utilisateur
(
    u_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(128) NOT NULL, 
    mdp VARCHAR(255) NOT NULL
);

CREATE TABLE Categorie
(
    c_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(128) NOT NULL
);

CREATE TABLE Ingredient
(
    i_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(128) NOT NULL
);

CREATE TABLE Profil
(
    u_id INTEGER PRIMARY KEY,
    nom VARCHAR(128),
    prenom VARCHAR(128),
    pseudo VARCHAR(128),
    avatar VARCHAR(255),
    bio TEXT,

    FOREIGN KEY(u_id) REFERENCES Utilisateur(u_id)
);

CREATE TABLE Recette
(
    r_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    u_id INTEGER,
    c_id INTEGER,
    titre VARCHAR(128),
    descript TEXT,
    tps_prep INTEGER,
    tps_cuis INTEGER,
    nb_prsn INTEGER,
    diff INTEGER CHECK (diff BETWEEN 1 AND 5),

    FOREIGN KEY(u_id) REFERENCES Utilisateur(u_id),
    FOREIGN KEY(c_id) REFERENCES Categorie(c_id)
);

CREATE TABLE Recette_Ingredient
(
    r_id INTEGER,
    i_id INTEGER,
    quantite INTEGER NOT NULL,
    unite VARCHAR(128) NOT NULL,

    FOREIGN KEY(r_id) REFERENCES Recette(r_id),
    FOREIGN KEY(i_id) REFERENCES Ingredient(i_id),

    PRIMARY KEY (r_id, i_id)
);

CREATE TABLE Etape
(
    r_id INTEGER,
    nb_ordre INTEGER,
    descript TEXT,

    FOREIGN KEY (r_id) REFERENCES Recette(r_id),

    PRIMARY KEY (r_id, nb_ordre)
);

CREATE TABLE Avis
(
    a_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    u_id INTEGER,
    r_id INTEGER,
    note INTEGER CHECK (note BETWEEN 1 AND 5),
    commentaire TEXT,
    datepost DATE,

    FOREIGN KEY(u_id) REFERENCES Utilisateur(u_id),
    FOREIGN KEY(r_id) REFERENCES Recette(r_id)
);