<?php

    //=======================================
    // CLASS NAME
    //=======================================
    
class ExampleModel{

    //=======================================
    // ATTRIBUTES
    //=======================================
    
    private $id;//long    ==> mysql ==> BIGINT
    private $lastName;//string  ==> mysql ==> VARCHAR
    private $birthdate;//date  ==> mysql ==> date
    private $created_at;//datetime now = date("Y-m-d H:i:s");   ==> mysql ==> datetime
    private $lastLoginTimaestamp;//timestamp 1970  ==> mysql ==> datetime
    private $admin;//bool  ==> mysql ==> tinybit
    private $fkexampleId;//long ==> mysql ==> long Foreign Key

    //=======================================
    // DEFAULT CONSTRUCTOR
    //=======================================
    
    public function __construct(){
        //Default constructor
        //For better readability, all attribut will be set with Setter method
    }

    //=======================================
    //CRUD METHODS
    //=======================================

    /* ne jamais mettre ID car AI*/

    public function createExample(){
        $db = new Database();
        $db -> executeSql(
            "INSERT INTO example ( last_name, birthday) 
            values (?,?)", 
            [$this->lastName, $this->birthdate,]
        );
    }

    public static function readAllExample(){
        $db = new Database();
        $resultSql = $db->query("SELECT * FROM example");
        $examples= [];
        foreach($resultSql as $row){
            $example = new ExampleModel();
            $example->setId($row['example_id']);
            $example->setLastName($row['last_name']);
            $example->setAdmin($row['admin']);
            $example->setBirthdate($row['birthday']);
            /*j'ajoute au tableau examples la ligne example*/ 
            array_push($examples,$example);
        }

        return $examples;
    }
    
    public static function readExampleById($id){
        $db = new Database();
        $singleResultSql = $db->queryOne("SELECT * FROM example WHERE example_id = ?", [$id]);

        $example = new ExampleModel();
        $example->setId($singleResultSql['example_id']);
        $example->setLastName($singleResultSql['last_name']);
        $example->setAdmin($singleResultSql['admin']);
        $example->setBirthdate($singleResultSql['birthday']);

        return $example;
    }

    public static function updateExample($anId, $aLastName, $aBirthdate) {
        $db = new Database();
        $db -> executeSql(
            "UPDATE example SET last_name = ?, birthday = ? WHERE example_id=?", 
            [$aLastName, $aBirthdate, $anId]
        );
    }


    //=======================================
    // GETTER/SETTER METHODS
    // CTRL + ALT + D ==> AUTO GENERATE GETTER SETTER
    //=======================================
    

    /**
     * Get the value of id
     */ 
    public function getId():long{
        return $this->id;
    }

    /**
     * Set the value of id
     *
     */ 
    public function setId(long $id){
        $this->id = $id;
    }

    /**
     * Get the value of lastName
     */ 
    public function getLastName():string{
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     */ 
    public function setLastName(string $lastName /*controller*/){
        $this->lastName = $lastName;
    }

    /**
     * Get the value of birthdate
     */ 
    public function getBirthdate():date{
        return $this->birthdate;
    }

    /**
     * Set the value of birthdate
     *
     */ 
    public function setBirthdate(date $birthdate){
        $this->birthdate = $birthdate;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at():date{
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     */ 
    public function setCreated_at(date $created_at){
        $this->created_at = $created_at;
    }

    /**
     * Get the value of lastLoginTimaestamp
     */ 
    public function getLastLoginTimaestamp():timestamp{
        return $this->lastLoginTimaestamp;
    }

    /**
     * Set the value of lastLoginTimaestamp
     *
     */ 
    public function setLastLoginTimaestamp(timestamp $lastLoginTimaestamp){
        $this->lastLoginTimaestamp = $lastLoginTimaestamp;
    }

    /**
     * Get the value of admin
     * pour les atributs de type bool les getters seront nomes isAttributname 
     * ici exemple isAdmin 
     */ 
    public function isAdmin():bool{
        return $this->admin;
    }

    /**
     * Set the value of admin
     *
     */ 
    public function setAdmin(bool $admin){
        $this->admin = $admin;
    }
}