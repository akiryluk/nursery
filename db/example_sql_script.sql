--jointure entre la table famille et person
--(le nom de mere et le nom de pere de la meme famille)
SELECT family_id, mother_id, m.lastName, m.person_id AS mother_person_id, father_id, f.lastName, f.person_id  AS father_person_id
FROM `family` 
	INNER JOIN person m ON mother_id= m.person_id 
    INNER JOIN person f ON father_id= f.person_id 

CREATE TABLE person 
             ( 
                          person_id        BIGINT NOT NULL auto_increment, 
                          first_name        varchar(255), 
                          last_name         varchar(255), 
                          street            VARCHAR(255), 
                          city             VARCHAR(255), 
                          zip_code         VARCHAR(255), 
                          country          VARCHAR(255), 
                          birthday           DATE, 
                          birth_place      VARCHAR(255), 
                          email              varchar(50),
                          phone               varchar(20),
                          nationality          VARCHAR(255), 
                          job_title          VARCHAR(255),
                          company_name          VARCHAR(255), 
                          security_number          INT(11), 
                          PRIMARY KEY (person_id) 
             ) 
             engine=innodb;

CREATE TABLE family 
             ( 
                          family_id        BIGINT NOT NULL auto_increment, 
                          /*create_dat         DATETIME(6), exemplae d'une colonne avec une date et son type*/ 
                          mother_id       BIGINT, 
                          father_id       BIGINT, 
                        emergency_one_id       BIGINT, 
                        emergency_two_id       BIGINT, 
                        guide_one_id       BIGINT, 
                        guide_two_id       BIGINT, 
                          PRIMARY KEY (family_id) 
             ) 
             engine=innodb;

alter table family add constraint FK_family_person_mother foreign key (mother_id) references person (person_id);
alter table family add constraint FK_family_person_father foreign key (father_id) references person (person_id);
alter table family add constraint FK_family_person_emergency_one foreign key (emergency_one_id) references person (person_id);
alter table family add constraint FK_family_person_emergency_two foreign key (emergency_two_id) references person (person_id);
alter table family add constraint FK_family_person_guide_one foreign key (guide_one_id) references person (person_id);
alter table family add constraint FK_family_person_guide_two foreign key (guide_two_id) references person (person_id);