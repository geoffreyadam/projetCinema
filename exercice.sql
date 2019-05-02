
/* -> rajouter un film (1 point) */
INSERT INTO movie VALUES (50, 'nomDuFilm', 'descriptionDuFilm', 60, 'lienImage')

/* -> récupérer tous les noms de films (1 point ) */
SELECT title FROM movie

/*-> récupérer les utilisateurs sans doublons ( 1 point )*/
SELECT DISTINCT name FROM user

/*-> supprimer un film ( 1 point )*/
DELETE FROM movie
WHERE title = 'nomDuFilm'

/*-> mise à jour du nom d'un film ( 1 point )*/
UPDATE movie
SET title = 'nouveauNom'
WHERE title = 'nomDuFilm'

/*-> liste des films triés par le nom ( 1 point )*/
SELECT title
FROM movie
ORDER BY title ASC

/*-> liste des films sortis entre 2018 et 2019 ( 1 points )*/
SELECT *
FROM screening
WHERE date BETWEEN '2018-01-01' AND '2019-01-01'

/*-> liste des utilisateurs avec un email gmail ( 1 point )*/
SELECT *
FROM user
WHERE email LIKE '%gmail.com'

/*-> rajouter le champ pseudonyme à la table utilisateur ( 1 point )*/
ALTER TABLE user
ADD pseudonyme VARCHAR(255)

/*-> récupérer les films sorties il y a deux ans et avec le nom qui commence par un "l" (1 point)*/
SELECT *
FROM screening
WHERE date < DATE_SUB(NOW(), INTERVAL 2 YEAR) AND room LIKE 'R%'


/*Créer une requête d'exemple pour chaque commande ci-dessous :*/

/*-> HAVING ( 2 point )*/
SELECT runtime
FROM movie
GROUP BY title
HAVING MAX(runtime)<110

/*-> Sous-requête ( 2 points )*/
SELECT *
FROM screening
WHERE room_id = (
  SELECT id
  FROM room
  LIMIT 1
)
/*-> Left Join ( 2 points )*/
SELECT *
FROM screening
LEFT JOIN reservation ON screening.id = reservation.screening_id

/*-> Right Join ( 2 points )*/
SELECT *
FROM user
RIGHT JOIN reservation ON user.id = reservation.user_id

/*-> Full Join  ( 2 point )*/

SELECT *
FROM screening
FULL JOIN reservation ON screening.id = reservation.screening_id