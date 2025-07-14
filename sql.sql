create database final_project;

use final_project;

CREATE TABLE final_membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    ville VARCHAR(50) NOT NULL,
    image_profil VARCHAR(255) DEFAULT 'default.jpg'
);

CREATE TABLE final_categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE final_objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100) NOT NULL,
    id_categorie INT,
    id_membre INT
);

CREATE TABLE final_images_objet(
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(255) NOT NULL
);

CREATE TABLE final_emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE NOT NULL,
    date_retour DATE
);
--creer 4 user
INSERT INTO
    final_membre (nom, date_naissance, email, mot_de_passe, ville, image_profil)
VALUES
    ('Alice Dupont', '1990-05-15', 'alice@gmail.com', '123','andoharanofotsy','default.png'),
    ('Bob Martin', '1985-08-22', 'bob@gmail.com', '456','tana','default.png'),
    ('Claire Dubois', '1992-12-03', 'claire@gmail.com','tana', '789','default.png'),
    ('Bun Dun', '1992-12-03', 'bun@gmail.com', '711','tana','default.png');
-- Catégories cohérentes
INSERT INTO
    final_categorie_objet (nom_categorie)
VALUES
    ('esthétique'),
    -- 1
    ('bricolage'),
    -- 2
    ('mécanique'),
    -- 3
    ('cuisine');

-- 4
-- Membre 1 (10 objets)
INSERT INTO
    final_objet (nom_objet, id_categorie, id_membre)
VALUES
    ('Tondeuse à gazon', 2, 1),
    ('Perceuse sans fil', 2, 1),
    ('Scie circulaire', 2, 1),
    ('Couteau de cuisine', 4, 1),
    ('Mixeur', 4, 1),
    ('Tapis de yoga', 1, 1),
    ('Chaise de bureau ergonomique', 1, 1),
    ('Étagère murale', 2, 1),
    ('Clé à molette', 2, 1),
    ('Piano numérique', 1, 1);

-- Membre 2 (10 objets)
INSERT INTO
    final_objet (nom_objet, id_categorie, id_membre)
VALUES
    ('Appareil photo instantané', 1, 2),
    ('Vélo de route', 2, 2),
    ('Tente de randonnée', 2, 2),
    ('Table de billard', 3, 2),
    ('Chaise de camping', 3, 2),
    ('Enceinte portable', 1, 2),
    ('Table de pique-nique', 4, 2),
    ('Barbecue à charbon', 2, 2),
    ('Machine à expresso', 4, 2),
    ('Coffret de calligraphie', 1, 2);

-- Membre 3 (10 objets)
INSERT INTO
    final_objet (nom_objet, id_categorie, id_membre)
VALUES
    ('Appareil photo reflex', 1, 3),
    ('Vélo de montagne', 2, 3),
    ('Tente de camping', 2, 3),
    ('Table de ping-pong', 3, 3),
    ('Chaise longue', 3, 3),
    ('Enceinte Bluetooth', 1, 3),
    ('Table de jardin', 4, 3),
    ('Barbecue à gaz', 2, 3),
    ('Coffret de peinture', 1, 3),
    ('Vélo électrique', 2, 3);

-- Membre 4 (10 objets)
INSERT INTO
    final_objet (nom_objet, id_categorie, id_membre)
VALUES
    ('Appareil photo numérique', 1, 4),
    ('Tente de camping familiale', 2, 4),
    ('Table de jeux vidéo', 3, 4),
    ('Chaise de bureau réglable', 3, 4),
    ('Enceinte connectée', 1, 4),
    ('Table de salon', 4, 4),
    ('Barbecue à gaz portable', 2, 4),
    ('Machine à thé', 4, 4),
    ('Coffret de sculpture sur bois', 1, 4),
    ('Machine à café', 4, 4);

--dix emprunts
INSERT INTO
    final_emprunt (id_objet, id_membre, date_emprunt, date_retour)
VALUES
    (1, 1, '2023-10-01', '2023-10-15'),
    (2, 1, '2023-10-05', '2023-10-20'),
    (3, 2, '2023-10-02', '2023-10-16'),
    (4, 2, '2023-10-06', '2023-10-21'),
    (5, 3, '2023-10-03', null),
    (6, 3, '2023-10-07', '2023-10-22'),
    (7, 4, '2023-10-04', '2023-10-18'),
    (8, 4, '2023-10-08', '2023-10-23'),
    (9, 1, '2023-10-09', '2023-10-24'),
    (10, 2, '2023-10-10', null);

--view 
CREATE
OR REPLACE VIEW v_objet_proprietaire_categorie AS
SELECT
    o.id_objet,
    o.nom_objet,
    c.nom_categorie,
    c.id_categorie,
    m.nom AS nom_proprietaire,
    m.id_membre AS id_proprietaire
FROM
    final_objet o
    JOIN final_categorie_objet c ON o.id_categorie = c.id_categorie
    JOIN final_membre m ON o.id_membre = m.id_membre;

--view pour les emprunts
CREATE
OR REPLACE VIEW v_emprunt_objet_membre_categorie AS
SELECT
    e.id_emprunt,
    v.id_objet,
    v.nom_objet,
    v.nom_categorie,
    m.nom AS nom_membre_emprunteur,
    v.nom_proprietaire,
    e.date_emprunt,
    e.date_retour
FROM
    final_emprunt e
    JOIN v_objet_proprietaire_categorie v ON e.id_objet = v.id_objet
    JOIN final_membre m ON e.id_membre = m.id_membre;
--inserer image objet avec nom_image default_objet.jpg pour les 40 objets
INSERT INTO
    final_images_objet (id_objet, nom_image)
SELECT
    id_objet,
    'default_objet.jpg'
FROM
    final_objet;