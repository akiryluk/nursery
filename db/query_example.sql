--jointure entre la table famille et person
--(le nom de mere et le nom de pere de la meme famille)
SELECT family_id, mother_id, m.lastName, m.person_id AS mother_person_id, father_id, f.lastName, f.person_id  AS father_person_id
FROM `family` 
	INNER JOIN person m ON mother_id= m.person_id 
    INNER JOIN person f ON father_id= f.person_id 