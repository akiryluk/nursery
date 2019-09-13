<?php
class NurseryRequestModel 
{
    private $id;
    private $referenceNumber;
    private $requestDate;
    private $entryDate;
    private $kidId;
    private $cafNumber;
    private $statusReq;
    private $fileId;

  
    public function __construct(){
        //Default constructor
        //For better readability, all attribut will be set with Setter method
    }

    public function createNurseryRequest(){
        $db = new Database();
        $db -> executeSql(
            "INSERT INTO nursery_request (reference_number, request_date,
            entry_date, kid_id, caf_number, status_req, file_id) 
            values (?,?,?,?,?,?,?)", 
            [$this->referenceNumber, $this->requestDate, $this->entryDate,
            $this->kidId, $this->cafNumber, $this->statusReq, $this->fileId]
        );
    }

    public static function readAllNurseryRequest(){
        $db = new Database();
        $resultSql = $db->query("SELECT * FROM nursery_request");
        $nurseryRequest= [];
        foreach($resultSql as $row){
            $nurseryRequest = new NurseryRequestModel();
            $nurseryRequest->setId($row['id']);
            $nurseryRequest->setReferenceNumber($row['reference_number']);
            $nurseryRequest->setRequestDate($row['request_date']);
            $nurseryRequest->setEntryDate($row['entry_date']);
            $nurseryRequest->setKidId($row['kid_id']);
            $nurseryRequest->setCafNumber($row['caf_number']);
            $nurseryRequest->setStatusReq($row['status_req']);
            $nurseryRequest->setFileId($row['file_id']);

            /*j'ajoute au tableau examples la ligne example*/ 
            array_push($NurseryRequests,$nurseryRequest);
        }

        return $NurseryRequests;
    }

    public static function readAllNurseryRequestByUserId($id){
        $db = new Database();
        //TODO AK: ADD user_id as foreign key into request_nursery table.
        // And add WHERE clause with user_id=id into the following query
        $resultSql = $db->query("SELECT * FROM nursery_request");
        $nurseryRequests= [];
        foreach($resultSql as $row){
            $nurseryRequest = new NurseryRequestModel();
            $nurseryRequest->setId((int)$row['nursery_request_id']);
            $nurseryRequest->setReferenceNumber($row['reference_number']);
            $nurseryRequest->setRequestDate($row['request_date']);
            $nurseryRequest->setEntryDate($row['entry_date']);
            $kidIdAsStr = $row['kid_id'];
            if(!empty($kidIdAsStr)){
                $nurseryRequest->setKidId((int)$row['kid_id']);
            }
            $nurseryRequest->setCafNumber($row['caf_number']);
            $nurseryRequest->setStatusReq($row['status_req']);
            if(!empty($row['file_id'])){
                $nurseryRequest->setFileId((int)$row['file_id']);
            }

            /*j'ajoute au tableau examples la ligne example*/ 
            array_push($nurseryRequests,$nurseryRequest);
        }

        return $nurseryRequests;
    }

    

    public static function readNurseryRequestById($id){
        $db = new Database();
        $singleResultSql = $db->queryOne("SELECT * FROM nursery_request WHERE nursery_request_id = ?", [$id]);

        $nurseryRequest = new NurseryRequestModel();
        $nurseryRequest->setId($singleResultSql['id']);
        $nurseryRequest->setReferenceNumber($singleResultSql['reference_number']);
        $nurseryRequest->setRequestDate($singleResultSql['request_date']);
        $nurseryRequest->setEntryDate($singleResultSql['entry_date']);
        $nurseryRequest->setKidId($singleResultSql['kid_id']);
        $nurseryRequest->setCafNumber($singleResultSql['caf_number']);
        $nurseryRequest->setStatusReq($singleResultSql['status_req']);
        $nurseryRequest->setFileId($singleResultSql['file_id']);

        return $nurseryRequest;
    }

    public static function updateNurseryRequest($anId, $aReferenceNumber, $aRequestDate,
    $aEntryDate, $aKidId, $aCafNumber, $aStatusReq, $aFileId) {
        $db = new Database();
        $db -> executeSql(
            "UPDATE nursery_request SET reference_number = ?, request_date = ?,
            entry_date = ?, kid_id = ?, caf_number = ?,
            status_req = ?, file_id = ?
            WHERE nursery_request_id=?", 
            [$aReferenceNumber, 
            $aRequestDate, 
            $aEntryDate,
            $aKidId,
            $aCafNumber,
            $aStatusReq,
            $aFileId,
            $anId]
        );
    }

    /**
     * Get the value of id
     */ 
    public function getId():int{
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id){
        $this->id = $id;    
    }

    /**
     * Get the value of referenceNumber
     */ 
    public function getReferenceNumber():int {
        return $this->referenceNumber;
    }

    /**
     * Set the value of referenceNumber
     *
     * @return  self
     */ 
    public function setReferenceNumber(int $referenceNumber){
        $this->referenceNumber = $referenceNumber;

        
    }

    /**
     * Get the value of requestDate
     */ 
    public function getRequestDate():string{
        return $this->requestDate;
    }

    /**
     * Set the value of requestDate
     *
     * @return  self
     */ 
    public function setRequestDate(string $requestDate){
        $this->requestDate = $requestDate;

        
    }

    /**
     * Get the value of entryDate
     */ 
    public function getEntryDate():string{
        return $this->entryDate;
    }

    /**
     * Set the value of entryDate
     *
     * @return  self
     */ 
    public function setEntryDate(string $entryDate){
        $this->entryDate = $entryDate;

        
    }

    /**
     * Get the value of kidId
     */ 
    public function getKidId():int{
        return $this->kidId;
    }

    /**
     * Set the value of kidId
     *
     * @return  self
     */ 
    public function setKidId(int $kidId){
        $this->kidId = $kidId;

        
    }

    /**
     * Get the value of cafNumber
     */ 
    public function getCafNumber():int{
        return $this->cafNumber;
    }

    /**
     * Set the value of cafNumber
     *
     * @return  self
     */ 
    public function setCafNumber(int $cafNumber){
        $this->cafNumber = $cafNumber;

        
    }

    /**
     * Get the value of statusReq
     */ 
    public function getStatusReq():string{
        return $this->statusReq;
    }

    /**
     * Set the value of statusReq
     *
     * @return  self
     */ 
    public function setStatusReq(string $statusReq){
        $this->statusReq = $statusReq;

        
    }

    /**
     * Get the value of fileId
     */ 
    public function getFileId():int{
        return $this->fileId;
    }

    /**
     * Set the value of fileId
     *
     * @return  self
     */ 
    public function setFileId(int $fileId){
        $this->fileId = $fileId;

        
    }
}