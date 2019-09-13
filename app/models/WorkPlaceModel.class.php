<?php

class WorkPlaceModel
{
    private $id;
    private $name;
    private $street;
    private $city;
    private $zipCode;
    private $country;
    private $directorId;
  
    public function __construct(){
        //Default constructor
        //For better readability, all attribut
        // will be set with Setter method
    }
    public function createWorkPlace(){
        $db = new Database();
        $db -> executeSql(
            "INSERT INTO workPlace (name, street,
            city, zip_code, country, director_id) 
            values (?,?,?,?,?,?)", 
            [$this->name, $this->street,
            $this->city, $this->zipCode,
            $this->country, $this->directorId]
        );
    }

    public static function readWorkPlace(){
        $db = new Database();
        $resultSql = $db->query("SELECT * FROM workPlace");
        $workPlaces= [];
        foreach($resultSql as $row){
            $workPlace = new WorkPlaceModel();
            $workPlace->setName($row['name']);
            $workPlace->setStreet($row['street']);
            $workPlace->setCity($row['city']);
            $workPlace->setZipCode($row['zip_code']);
            $workPlace->setCountry($row['country']);
            $workPlace->setDirectorId($row['director_id']);
            /*j'ajoute au tableau examplesworkPlaces la ligne workplace*/ 
            array_push($workPlaces,$workPlace);
        }

        return $workPlaces;
    }

    public static function readWorkPlaceById($id){
        $db = new Database();
        $singleResultSql = $db->queryOne("SELECT * FROM workPlace WHERE workPlace_id = ?", [$id]);

        $workPlace = new WorkPlaceModel();
        $workPlace->setName($singleResultSql['name']);
        $workPlace->setStreet($singleResultSql['street']);
        $workPlace->setCity($singleResultSql['city']);
        $workPlace->setZipCode($singleResultSql['zip_codey']);
        $workPlace->setCountry($singleResultSql['country']);
        $workPlace->setDirectorId($singleResultSql['director_id']);

        return $workPlace;
    }

    public static function updateWorkPlace($anId, $aName, $aStreet, $aCity, 
    $aZipCode, $aCountry, $aDirectorId) {
        $db = new Database();
        $db -> executeSql(
            "UPDATE workPlace SET name = ?, street = ?, city = ?,
            zip_code = ?, country = ?, director_id = ?,
            WHERE workPlace_id=?", 
            [$aName, $aStreet, $aCity, $aZipCode, $aCountry, $aDirectorId, $anId]
        );
    }

    
    //=======================================
    // GETTER/SETTER METHODS
    // CTRL + ALT + D ==> AUTO GENERATE GETTER SETTER
    //=======================================


    /**
     * Get the value of id
     */ 
    public function getId():int{
        return $this->id;
    }

    /**
     * Set the value of id
     *
     */ 
    public function setId(int $id){
        $this->id = $id;
    }

    /**
     * Get the value of name
     */ 
    public function getName():string{
        return $this->name;
    }

    /**
     * Set the value of name
     *
     */ 
    public function setName(string $name){
        $this->name = $name;
    }

    /**
     * Get the value of street
     */ 
    public function getStreet():string{
        return $this->street;
    }

    /**
     * Set the value of street
     *
     */ 
    public function setStreet(string $street){
        $this->street = $street;
    }

    /**
     * Get the value of city
     */ 
    public function getCity():string{
        return $this->city;
    }

    /**
     * Set the value of city
     *
     */ 
    public function setCity(string $city){
        $this->city = $city;
    }

    /**
     * Get the value of zipCode
     */ 
    public function getZipCode():string{
        return $this->zipCode;
    }

    /**
     * Set the value of zipCode
     *
     */ 
    public function setZipCode(string $zipCode){
        $this->zipCode = $zipCode;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry():string{
        return $this->country;
    }

    /**
     * Set the value of country
     *
     */ 
    public function setCountry(string $country){
        $this->country = $country;
    }

    /**
     * Get the value of directorId
     */ 
    public function getDirectorId():int{
        return $this->directorId;
    }

    /**
     * Set the value of directorId
     *
     */ 
    public function setDirectorId(int $directorId){
        $this->directorId = $directorId;
    }
}