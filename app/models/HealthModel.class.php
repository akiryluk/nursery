<?php

class HealthModel
{
    private $id;
    private $kidId;
    private $doctorPersId;
    private $fileId;
    private $bornOnTime;
    private $birthHealthIssues;
    private $isAllergy;
    private $allergyDetail;
    private $isDiet;
    private $dietDetail;
    private $isLoseConsciousness;
    private $loseDetail;
    private $isConvulsions;
    private $isBleedingNose;
    private $isSpecialMedecine;
    private $medecineDetail;
    private $isFeverMedecine;
    private $weight;
    private $isHospitalEmergency;
    private $hospitalName;
    private $createAt;

  
    public function __construct(){
        //Default constructor
        //For better readability, all attribut
        // will be set with Setter method
    }


public function createHealth(){
    $db = new Database();
    $db -> executeSql(
        "INSERT INTO health (kid_id, doctor_pers_id, file_id,
        born_on_time, birth_health_issues, is_allergy, 
        allergy_detail, is_diet, diet_detail,
        is_lose_consciousness, lose_detail, is_convulsions,
        is_bleeding_nose, is_special_medecine,
        medecine_detail, is_fever_medecine, weight,
        is_hospital_emergency, hospital_name, create_at) 
        values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
        [$this->kidId, $this->doctorPersId, $this->fileId,
        $this->bornOnTime, $this->birthHealtIssues, $this->isAllergy,
        $this->allergyDetail, $this->isDiet, $this->dietDetail,
        $this->isLoseConsciousness, $this->loseDetail,
        $this->isConvulsions, $this->isBleedingNose,
        $this->isSpecialMedecine, $this->medecineDetail,
        $this->isFeverMedecine, $this->weight,
        $this->isHospitalEmergency, $this->hospitalName, 
        $this->createdAt]
    );
}
public static function readAllHealth(){
    $db = new Database();
    $resultSql = $db->query("SELECT * FROM health");
    $healths= [];
    foreach($resultSql as $row){
        $health = new HealthModel();
        $health->setKidId($row['kid_id']);
        $health->setDoctorPersId($row['doctor_pers_id']);
        $health->setFileId($row['file_id']);
        $health->setBornOnTime($row['born_on_time']);
        $health->setBirthHealthIssues($row['birth_health_issues']);
        $health->setIsAllergy($row['is_allergy']);
        $health->setAllergyDetail($row['allergy_detail']);
        $health->setIsDiet($row['is_diet']);
        $health->setDietDetail($row['diet_detail']);
        $health->setIsLoseConsciousness($row['is_lose_consciousness']);
        $health->setLoseDetail($row['lose_detail']);
        $health->setIsConvulsions($row['is_convulsions']);
        $health->setIsBleedingNose($row['is_bleeding_nose']);
        $health->setIsSpecialMedecine($row['is_special_medecine']);
        $health->setMedecineDetail($row['medecine_detail']);
        $health->setIsFeverMedecine($row['is_fever_medecine']);
        $health->setWeight($row['weight']);
        $health->setIsHospitalEmergency($row['is_hospital_emergency']);
        $health->setHospitalName($row['hospital_name']);
        $health->setCreatedAt($row['created_at']);
        /*j'ajoute au tableau healths la ligne health*/ 
        array_push($healths,$health);
    }

    return $healths;
}

public static function readHealthById($id){
    $db = new Database();
    $singleResultSql = $db->queryOne("SELECT * FROM health WHERE health_id = ?", [$id]);

        $health = new HealthModel();
        $health->setKidId($singleResultSql['kid_id']);
        $health->setDoctorPersId($singleResultSql['doctor_pers_id']);
        $health->setFileId($singleResultSql['file_id']);
        $health->setBornOnTime($singleResultSql['born_on_time']);
        $health->setBirthHealthIssues($singleResultSql['birth_health_issues']);
        $health->setIsAllergy($singleResultSql['is_allergy']);
        $health->setAllergyDetail($singleResultSql['allergy_detail']);
        $health->setIsDiet($singleResultSql['is_diet']);
        $health->setDietDetail($singleResultSql['diet_detail']);
        $health->setIsLoseConsciousness($singleResultSql['is_lose_consciousness']);
        $health->setLoseDetail($singleResultSql['lose_detail']);
        $health->setIsConvulsions($singleResultSql['is_convulsions']);
        $health->setIsBleedingNose($singleResultSql['is_bleeding_nose']);
        $health->setIsSpecialMedecine($singleResultSql['is_special_medecine']);
        $health->setMedecineDetail($singleResultSql['medecine_detail']);
        $health->setIsFeverMedecine($singleResultSql['is_fever_medecine']);
        $health->setWeight($singleResultSql['weight']);
        $health->setIsHospitalEmergency($singleResultSql['is_hospital_emergency']);
        $health->setHospitalName($singleResultSql['hospital_name']);
        $health->setCreatedAt($singleResultSql['created_at']);

    return $health;
}

public static function updateFamily($anId, $aKidId, $aDoctorPersId, $aFileId, 
$aBornOnTime, $aBirthHealthIssues, $aIsAllergy,
$aAllergyDetail, $aIsDIet, $aDietDetail, $aIsLoseConsciousness, $aLoseDetail,
$aIsConvulsions, $aIsBleedingNose, $aIsSpecialMedecine, $aMedecineDetail, 
$aIsFeverMedecine, $aWeight, $aIsHospitalEmergency, $aHospitalName, $aCreatedAt) {
    $db = new Database();
    $db -> executeSql(
        "UPDATE health SET kid_id = ?, doctor_pers_id = ?, file_id = ?, 
        born_on_time = ?, birth_health_issues = ?, is_allergy = ?,
        allergy_detail = ?, is_diet = ?, diet_detail = ?,
        is_convulsions = ?, is_bleeding_nose = ?, is_special_medecine = ?,
        medecine_detail = ?, is_fever_medecine = ?, weight = ?,
        is_hospital_emergency = ?, hospital_name = ?, created_at = ?
        WHERE health_id=?", 
        [$aKidId, 
        $aDoctorPersId,
        $aFileId, 
        $aBornOnTime, 
        $aBirthHealthIssues, 
        $aIsAllergy,
        $aAllergyDetail, 
        $aIsDIet, 
        $aDietDetail, 
        $aIsLoseConsciousness, 
        $aLoseDetail, 
        $aIsConvulsions, 
        $aIsBleedingNose,
        $aIsSpecialMedecine, 
        $aMedecineDetail, 
        $aIsFeverMedecine, 
        $aWeight, 
        $aIsHospitalEmergency, 
        $aHospitalName, 
        $aCreatedAt,
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
     * Get the value of kidId
     */ 
    public function getKidId():long{
        return $this->kidId;
    }

    /**
     * Set the value of kidId
     */ 
    public function setKidId(long $kidId){
        $this->kidId = $kidId;
    }

    /**
     * Get the value of doctorPersId
     */ 
    public function getDoctorPersId():long{
        return $this->doctorPersId;
    }

    /**
     * Set the value of doctorPersId
     */ 
    public function setDoctorPersId(long $doctorPersId){
        $this->doctorPersId = $doctorPersId;
    }

    /**
     * Get the value of fileId
     */ 
    public function getFileId():long{
        return $this->fileId;
    }

    /**
     * Set the value of fileId
     */ 
    public function setFileId(long $fileId){
        $this->fileId = $fileId;
    }

    /**
     * Get the value of bornOnTime
     */ 
    public function getBornOnTime():bool{
        return $this->bornOnTime;
    }

    /**
     * Set the value of bornOnTime
     *
     */ 
    public function setBornOnTime(bool $bornOnTime){
        $this->bornOnTime = $bornOnTime;
    }

    /**
     * Get the value of birthHealthIssues
     */ 
    public function getBirthHealthIssues():bool{
        return $this->birthHealthIssues;
    }

    /**
     * Set the value of birthHealthIssues
     */ 
    public function setBirthHealthIssues(bool $birthHealthIssues){
        $this->birthHealthIssues = $birthHealthIssues;
    }

    /**
     * Get the value of isAllergy
     */ 
    public function getIsAllergy():bool{
        return $this->isAllergy;
    }

    /**
     * Set the value of isAllergy
     */ 
    public function setIsAllergy(bool $isAllergy){
        $this->isAllergy = $isAllergy;
    }

    /**
     * Get the value of allergyDetail
     */ 
    public function getAllergyDetail():string{
        return $this->allergyDetail;
    }

    /**
     * Set the value of allergyDetail
     */ 
    public function setAllergyDetail(string $allergyDetail){
        $this->allergyDetail = $allergyDetail;
    }

    /**
     * Get the value of isDiet
     */ 
    public function getIsDiet():bool{
        return $this->isDiet;
    }

    /**
     * Set the value of isDiet
     *
     */ 
    public function setIsDiet(bool $isDiet){
        $this->isDiet = $isDiet;
    }

    /**
     * Get the value of dietDetail
     */ 
    public function getDietDetail():string{
        return $this->dietDetail;
    }

    /**
     * Set the value of dietDetail
     *
     */ 
    public function setDietDetail(string $dietDetail){
        $this->dietDetail = $dietDetail;
    }

    /**
     * Get the value of isLoseConsciousness
     */ 
    public function getIsLoseConsciousness():bool{
        return $this->isLoseConsciousness;
    }

    /**
     * Set the value of isLoseConsciousness
     *
     */ 
    public function setIsLoseConsciousness(bool $isLoseConsciousness){
        $this->isLoseConsciousness = $isLoseConsciousness;
    }

    /**
     * Get the value of loseDetail
     */ 
    public function getLoseDetail():string{
        return $this->loseDetail;
    }

    /**
     * Set the value of loseDetail
     *
     */ 
    public function setLoseDetail(string $loseDetail){
        $this->loseDetail = $loseDetail;
    }

    /**
     * Get the value of isConvulsions
     */ 
    public function getIsConvulsions():bool{
        return $this->isConvulsions;
    }

    /**
     * Set the value of isConvulsions
     *
     */ 
    public function setIsConvulsions(bool $isConvulsions){
        $this->isConvulsions = $isConvulsions;
    }

    /**
     * Get the value of isBleedingNose
     */ 
    public function getIsBleedingNose():bool{
        return $this->isBleedingNose;
    }

    /**
     * Set the value of isBleedingNose
     *
     */ 
    public function setIsBleedingNose(bool $isBleedingNose){
        $this->isBleedingNose = $isBleedingNose;
    }

    /**
     * Get the value of isSpecialMedecine
     */ 
    public function getIsSpecialMedecine():bool{
        return $this->isSpecialMedecine;
    }

    /**
     * Set the value of isSpecialMedecine
     */ 
    public function setIsSpecialMedecine(bool $isSpecialMedecine) {
        $this->isSpecialMedecine = $isSpecialMedecine;
    }

    /**
     * Get the value of medecineDetail
     */ 
    public function getMedecineDetail():string{
        return $this->medecineDetail;
    }

    /**
     * Set the value of medecineDetail
     */ 
    public function setMedecineDetail(string $medecineDetail){
        $this->medecineDetail = $medecineDetail;
    }

    /**
     * Get the value of isFeverMedecine
     */ 
    public function getIsFeverMedecine():bool{
        return $this->isFeverMedecine;
    }

    /**
     * Set the value of isFeverMedecine
     */ 
    public function setIsFeverMedecine(bool $isFeverMedecine){
        $this->isFeverMedecine = $isFeverMedecine;
    }

    /**
     * Get the value of weight
     */ 
    public function getWeight():int{
        return $this->weight;
    }

    /**
     * Set the value of weight
     */ 
    public function setWeight(int $weight){
        $this->weight = $weight;
    }

    /**
     * Get the value of isHospitalEmergency
     */ 
    public function getIsHospitalEmergency():bool{
        return $this->isHospitalEmergency;
    }

    /**
     * Set the value of isHospitalEmergency
     */ 
    public function setIsHospitalEmergency(bool $isHospitalEmergency){
        $this->isHospitalEmergency = $isHospitalEmergency;
    }

    /**
     * Get the value of hospitalName
     */ 
    public function getHospitalName():string{
        return $this->hospitalName;
    }

    /**
     * Set the value of hospitalName
     */ 
    public function setHospitalName(string $hospitalName){
        $this->hospitalName = $hospitalName;
    }

    /**
     * Get the value of createAt
     */ 
    public function getCreateAt():date{
        return $this->createAt;
    }

    /**
     * Set the value of createAt
     */ 
    public function setCreateAt(date $createAt){
        $this->createAt = $createAt;
    }
}