<?php
class KidModel 
{
    private $id;
    private $infoKidId;//Person_id
    private $familyId;
    private $rankSibling;
    private $fileId;
  
    public function __construct(){
        /*Default constructor
        *For better readability, all attribut 
        will be set with Setter method */
    }
    public function createKid(){
        $db = new Database();
        $newId = $db -> executeSql(
            "INSERT INTO kid (info_kid_id, family_id,
            rank_sibling, file_id) 
            values (?,?,?,?)", 
            [$this->infoKidId, $this->familyId,
            $this->rankSibling, $this->fileId]
        );
        return $newId;
    }

    public static function readAllKid(){
        $db = new Database();
        $resultSql = $db->query("SELECT * FROM kid");
        $kids= [];
        foreach($resultSql as $row){
            $kid = new KidModel();
            $kid->setId($row['kid_id']);
            $kid->setInfoKidId($row['info_kid__id']);
            $kid->setFamilyId($row['family_id']);
            $kid->setRankSibling($row['rank_sibling']);
            $kid->setFileId($row['file_id']);
            /*j'ajoute au tableau examples la ligne example*/ 
            array_push($kids,$kid);
        }

        return $kids;
    }

    public static function readKidById($id){
        $db = new Database();
        $singleResultSql = $db->queryOne("SELECT * FROM kid WHERE kid_id = ?", [$id]);

         $kid = new KidModel();
         $kid->setId($singleResultSql['kid_id']);
         $kid->setInfoKidId($singleResultSql['info_kid_id']);
         $kid->setFamilyId($singleResultSql['family_id']);
         $kid->setRankSibling($singleResultSql['rank_sibling']);
         $kid->setFileId($singleResultSql['file_id']);

        return  $kid;
    }
    public static function updateKid($anId, $aMotherId, $aFatherId, $aEmergencyOneId, $aEmergencyTwoId, $aGuideOneId, $aGuideTwoId) {
        $db = new Database();
        $db -> executeSql(
            "UPDATE family SET info_kid_id = ?, family_id = ?, 
            rank_sibling = ?, file_id = ?
            WHERE kid_id=?", 
            [$aInfoKidId,
            $aFamilyId,
            $aRankSibling,
            $aFileId,
            $anId
            ]
        );

    }

    //=======================================
    // GETTER/SETTER METHODS
    // CTRL + ALT + D ==> AUTO GENERATE GETTER SETTER
    //=======================================
    
    /**
     * Get the value of id
     */ 

    public function getId():?int{
        return $this->id;
    }

    /**
     * Set the value of id
     *
     */ 
    public function setId(?int $id){
        $this->id = $id;
    }
    

    /**
     * Get the value of infoKidId
     */ 
    public function getInfoKidId():?int{
        return $this->infoKidId;
    }

    /**
     * Set the value of infoKidId
     *
     */ 
    public function setInfoKidId(?int $infoKidId){
        $this->infoKidId = $infoKidId;
    }

    /**
     * Get the value of familyId
     */ 
    public function getFamilyId():?int{
        return $this->familyId;
    }

    /**
     * Set the value of familyId
     *
     */ 
    public function setFamilyId(?int $familyId){
        $this->familyId = $familyId;
    }

    /**
     * Get the value of rankSibling
     */ 
    public function getRankSibling():?int{
        return $this->rankSibling;
    }

    /**
     * Set the value of rankSibling
     *
     */ 
    public function setRankSibling(?int $rankSibling){
        $this->rankSibling = $rankSibling;
    }

    /**
     * Get the value of fileId
     */ 
    public function getFileId():?int{
        return $this->fileId;
    }

    /**
     * Set the value of fileId
     *
     */ 
    public function setFileId(?int $fileId){
        $this->fileId = $fileId;
    }
}
