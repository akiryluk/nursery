<?php

class FamilyModel
{
    private $id;
    private $motherId;
    private $fatherId;
    private $emergencyOneId;
    private $emergencyTwoId;
    private $guideOneId;
    private $guideTwoId;
  
    public function __construct(){
        //Default constructor
        //For better readability, all attribut
        // will be set with Setter method
    }

    public function createFamily(){
        $db = new Database();
        $newId = $db -> executeSql(
            "INSERT INTO family (mother_id, father_id,
            emergency_one_id, emergency_two_id,
            guide_one_id,guide_two_id) 
            values (?,?,?,?,?,?)", 
            [$this->motherId, $this->fatherId,
            $this->emergencyOneId, $this->emergencyTwoId,
            $this->guideOneId, $this->guideTwoId]
        );
        return $newId;
    }
    public static function readAllFamily(){
        $db = new Database();
        $resultSql = $db->query("SELECT * FROM family");
        $families= [];
        foreach($resultSql as $row){
            $family = new FamilyModel();
            $family->setMotherId($row['mother_id']);
            $family->setFatherId($row['father_id']);
            $family->setEmergencyOneId($row['emergency_one_id']);
            $family->setEmergencyTwoId($row['emergency_two_id']);
            $family->setGuideOneId($row['guide_one_id']);
            $family->setGuideTwoId($row['guide_two_id']);
            /*j'ajoute au tableau examples la ligne example*/ 
            array_push($families,$family);
        }

        return $families;
    }

    public static function readFamilyById($id){
        $db = new Database();
        $singleResultSql = $db->queryOne("SELECT * FROM family WHERE family_id = ?", [$id]);

        $family = new FamilyModel();
        $family->setMotherId($singleResultSql['mother_id']);
        $family->setFatherId($singleResultSql['father_id']);
        $family->setEmergencyOneId($singleResultSql['emergency_one_id']);
        $family->setEmergencyTwoId($singleResultSql['emergency_two_id']);
        $family->setGuideOneId($singleResultSql['guide_one_id']);
        $family->setGuideTwoId($singleResultSql['guide_two_id']);

        return $family;
    }

    public static function updateFamily($anId, $aMotherId, $aFatherId, $aEmergencyOneId, $aEmergencyTwoId, $aGuideOneId, $aGuideTwoId) {
        $db = new Database();
        $db -> executeSql(
            "UPDATE family SET mother_id = ?, father_id = ?, emergency_one_id = ?, 
            emergency_two_id = ?, guide_one_id = ?, guide_two_id = ? 
            WHERE family_id=?", 
            [$aMotherId,
            $aFatherId,
            $aEmergencyOneId,
            $aEmergencyTwoId,
            $aGuideOneId,
            $aGuideTwoId,
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
     * Getter for MotherId
     */
    public function getMotherId():?int
    {
        return $this->motherId;
    }

    /**
     * Setter for MotherId
     */
    public function setMotherId(?int $motherId)
    {
        $this->motherId = $motherId;

    }


    /**
     * Getter for FatherId
     */
    public function getFatherId():?int
    {
        return $this->fatherId;
    }

    /**
     * Setter for FatherId
     */
    public function setFatherId(?int $fatherId)
    {
        $this->fatherId = $fatherId;

    }

    /**
     * Getter for EmergencyOneId
     */
    public function getEmergencyOneId():?int
    {
        return $this->emergencyOneId;
    }

    /**
     * Setter for EmergencyOneId
     */
    public function setEmergencyOneId(?int $emergencyOneId)
    {
        $this->emergencyOneId = $emergencyOneId;

    }


    /**
     * Getter for EmergencyTwoId
     *]
     */
    public function getEmergencyTwoId():?int
    {
        return $this->emergencyTwoId;
    }

    /**
     * Setter for EmergencyTwoId
     */
    public function setEmergencyTwoId(?int $emergencyTwoId)
    {
        $this->emergencyTwoId = $emergencyTwoId;

    }

    /**
     * Getter for GuideOneId
     *
     */
    public function getGuideOneId():?int
    {
        return $this->guideOneId;
    }

    /**
     * Setter for GuideOneId
     *
     */
    public function setGuideOneId(?int $guideOneId)
    {
        $this->guideOneId = $guideOneId;

    }

    /**
     * Getter for GuideTwoId
     *
     */
    public function getGuideTwoId():?int
    {
        return $this->guideTwoId;
    }

    /**
     * Setter for GuideTwoId
     *
     */
    public function setGuideTwoId(?int $guideTwoId)
    {
        $this->guideTwoId = $guideTwoId;

    }

}
