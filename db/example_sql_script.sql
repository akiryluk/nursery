--jointure entre la table famille et person
--(le nom de mere et le nom de pere de la meme famille)
SELECT family_id, mother_id, m.lastName, m.person_id AS mother_person_id, father_id, f.lastName, f.person_id  AS father_person_id
FROM `family` 
	INNER JOIN person m ON mother_id= m.person_id 
    INNER JOIN person f ON father_id= f.person_id 

CREATE TABLE person 
             ( 
                          person_id                 BIGINT NOT NULL auto_increment, 
                          first_name                VARCHAR(255), 
                          last_name                 VARCHAR(255), 
                          street                    VARCHAR(255), 
                          city                      VARCHAR(255), 
                          zip_code                  VARCHAR(255), 
                          country                   VARCHAR(255), 
                          birthday                  DATE, 
                          birth_place               VARCHAR(255), 
                          email                     VARCHAR(50),
                          phone                     VARCHAR(20),
                          nationality               VARCHAR(255), 
                          job_title                 VARCHAR(255),
                          company_name              VARCHAR(255), 
                          security_number           INT(11), 
                          PRIMARY KEY (person_id) 
             ) 
             engine=innodb;

CREATE TABLE family 
             ( 
                        family_id              BIGINT NOT NULL auto_increment, 
                        /*create_at           DATETIME(6), exemplae d'une colonne avec une date et son type*/ 
                        mother_id              BIGINT, 
                        father_id              BIGINT, 
                        emergency_one_id       BIGINT, 
                        emergency_two_id       BIGINT, 
                        guide_one_id           BIGINT, 
                        guide_two_id           BIGINT, 
                        PRIMARY KEY (family_id) 
             ) 
             engine=innodb;

alter table family add constraint FK_family_person_mother foreign key (mother_id) references person (person_id);
alter table family add constraint FK_family_person_father foreign key (father_id) references person (person_id);
alter table family add constraint FK_family_person_emergency_one foreign key (emergency_one_id) references person (person_id);
alter table family add constraint FK_family_person_emergency_two foreign key (emergency_two_id) references person (person_id);
alter table family add constraint FK_family_person_guide_one foreign key (guide_one_id) references person (person_id);
alter table family add constraint FK_family_person_guide_two foreign key (guide_two_id) references person (person_id);

CREATE TABLE file 
             ( 
                        file_id                       BIGINT NOT NULL auto_increment, 
                        content                       BLOB, 
                        file_name                     VARCHAR(50),   
                        PRIMARY KEY (file_id) 
             ) 
             engine=innodb;

CREATE TABLE kid 
             ( 
                        kid_id                        BIGINT NOT NULL auto_increment, 
                        info_kid_id                   BIGINT, 
                        family_id                     BIGINT,  
                        rank_sibling                  INTEGER,
                        file_id                       BIGINT, 
                        PRIMARY KEY (kid_id) 
             ) 
             engine=innodb;

alter table kid add constraint FK_kid_person foreign key (info_kid_id) references person (person_id);
alter table kid add constraint FK_kid_family foreign key (family_id) references family (family_id);
alter table kid add constraint FK_kid_file foreign key (file_id) references file (file_id);


CREATE TABLE nursery_request 
             ( 
                        nursery_request_id            BIGINT NOT NULL auto_increment, 
                        reference_number              INTEGER, 
                        request_date                  DATETIME(6), 
                        entry_date                    DATE, 
                        kid_id                        BIGINT, 
                        caf_number                    INTEGER,
                        status_req                    VARCHAR(20),
                        file_id                       BIGINT, 
                        PRIMARY KEY (nursery_request_id) 
             ) 
             engine=innodb;

alter table nursery_request add constraint FK_nursery_request_kid foreign key (kid_id) references kid (kid_id);
alter table nursery_request add constraint FK_nursery_request_file foreign key (file_id) references file (file_id);

CREATE TABLE work_place
             ( 
                        work_place_id                 BIGINT NOT NULL auto_increment, 
                        name                          VARCHAR(50),  
                        street                        VARCHAR(255), 
                        city                          VARCHAR(255), 
                        zip_code                      VARCHAR(255), 
                        country                       VARCHAR(255), 
                        director_id                   BIGINT, 
                        PRIMARY KEY (work_place_id) 
             ) 
             engine=innodb;

alter table work_place add constraint FK_work_place_person foreign key (director_id) references person (person_id);

CREATE TABLE health
             ( 
                        health_id                     BIGINT NOT NULL auto_increment, 
                        kid_id                        BIGINT,   
                        doctor_pers_id                BIGINT, 
                        file_id                       BIGINT, 
                        born_on_time                  tinyint(1) DEFAULT 0, 
                        birth_health_issues           tinyint(1) DEFAULT 0, 
                        is_allergy                    tinyint(1) DEFAULT 0,
                        allergy_detail                VARCHAR(3500),
                        is_diet                       tinyint(1) DEFAULT 0,
                        diet_detail                   VARCHAR(3500),
                        is_lose_consciousness         tinyint(1) DEFAULT 0,
                        lose_detail                   VARCHAR(3500),
                        is_convulsions                tinyint(1) DEFAULT 0,
                        is_blidding_nose              tinyint(1) DEFAULT 0,
                        is_special_medecine           tinyint(1) DEFAULT 0,
                        medcine_detail                VARCHAR(3500),
                        is_fever_medecine             tinyint(1) DEFAULT 0,
                        weight                        INTEGER,
                        is_hospital_emergency         tinyint(1) DEFAULT 0,
                        hospital_name                 VARCHAR(60),
                        create_at                     DATETIME(6),
                        PRIMARY KEY (health_id) 
             ) 
             engine=innodb;

alter table health add constraint FK_health_kid foreign key (kid_id) references kid (kid_id);
/* après reference c'est la PK de la table à joindre*/
alter table health add constraint FK_health_person foreign key (doctor_pers_id) references person (person_id);
alter table health add constraint FK_health_file foreign key (file_id) references file (file_id);