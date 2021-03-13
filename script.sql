CREATE TABLE ei2_utilisateurs(
   id                   INT AUTO_INCREMENT PRIMARY KEY,
   login                VARCHAR(50),
   pass                 VARCHAR(255),
   derniere_connexion   DATETIME,
   droits               VARCHAR(50)
)

