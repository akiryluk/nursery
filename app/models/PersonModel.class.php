<?php
class PersonModel 
{
    private $id;
    private $firstName;
    private $lastName;
    private $street;
    private $city;
    private $zipCode;
    private $country;
    private $phone;
    private $birthDate;
    private $birthPlace;
    private $email;
    private $nationality;
    private $securityNumber;
    private $accepted = 0; // 0 en cours d'étude // 1 accepté // 2 refusé
  
    public function __construct(){
        //Default constructor
        //For better readability, all attribut will be set with Setter method
    }
    
    public function createPerson()
    {
        $db = new Database();
        $db -> executeSql(
            "INSERT INTO person (first_name, last_name, street, 
            city, zip_code, country, birthday, birth_place, email, Phone,
            nationality, job_title, company_name, security_number) 
            values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
            [$this->firstName, $this->lastName, $this->street,
            $this->city, $this->zipCode, $this->country, 
            $this->birthDate, $this->birthPlace,
            $this->email,$this->phone, $this->nationality, $this->jobTitle,
            $this->companyName, $this->securityNumber ]
        );
    }
    public static function readAllPerson()
    {
        $db = new Database();
        $resultSql = $db->query("SELECT * FROM person");
        $persons= [];
        foreach($resultSql as $row){
            $person = new PersonModel();
            $person->setId($row['person_id']);
            $person->setFirstName($row['first_name']);
            $person->setLastName($row['last_name']);
            $person->setStreet($row['street']);
            $person->setCity($row['city']);
            $person->setZipCode($row['zip_code']);
            $person->setCountry($row['country']);
            $person->setBirthDate($row['birthday']);
            $person->setBirthPlace($row['birth_place']);
            $person->setEmail($row['email']);
            $person->setPhone($row['phone']);
            $person->setNationality($row['nationality']);
            $person->setJobTitle($row['job_title']);
            $person->setCompanyName($row['company_name']);
            $person->setSecurityNumber($row['security_number']);
            array_push($persons,$person);
        }
        return $persons;
    }
    public static function readPersonById($id){
        $db = new Database();
        $singleResultSql = $db->queryOne("SELECT * FROM person WHERE person_id = ?", [$id]);
            $person = new PersonModel();
            $person->setId($singleResultSql['person_id']);
            $person->setFirstName($singleResultSql['first_name']);
            $person->setLastName($singleResultSql['last_name']);
            $person->setStreet($singleResultSql['street']);
            $person->setCity($singleResultSql['city']);
            $person->setZipCode($singleResultSql['zip_code']);
            $person->setCountry($singleResultSql['country']);
            $person->setBirthDate($singleResultSql['birthday']);
            $person->setBirthPlace($singleResultSql['birth_place']);
            $person->setEmail($singleResultSql['email']);
            $person->setPhone($singleResultSql['phone']);
            $person->setNationality($singleResultSql['nationality']);
            $person->setJobTitle($singleResultSql['job_title']);
            $person->setCompanyName($singleResultSql['company_name']);
            $person->setSecurityNumber($singleResultSql['security_number']);
        
        return $person;
    }
    public static function updatePerson($anId, $afirstName, $alastName, $astreet, $acity,
    $azipCode, $acountry, $abirthDate, $abirthPlace, $aemail, $aphone, $anationality,
    $ajobTitle, $acompanyName, $asecurityNumber) {
        $db = new Database();
        $db -> executeSql(
            "UPDATE person SET first_name = ?, last_name = ?, 
            street = ?, city = ?, zip_code = ?, country = ?,
            birtday = ?, birth_place = ?, email = ?, phone = ?,
            nationality = ?, job_title = ?, company_name = ?, security_number = ?,
            WHERE person_id=?", 
            [$afirstName, $alastName, $astreet, $acity, $azipCode, $acountry, 
            $abirthDate, $abirthPlace, $aemail, $aphone, $antionality, $ajobTitle, 
            $acompanyName, $asecurityNumber, $anId]
        );
    }
   
//TODO ANIA: 1. Ajouter readPersonById et upodatePerson methode  OK
//           2.Typer les getter/setter
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
     * Getter for FirstName
     *
     * @return [type]
     */
    public function getFirstName():string{
        return $this->firstName;
    }
    /**
     * Setter for FirstName
     * @var [type] firstName
     *
     * 
     */
    public function setFirstName(string $firstName){
        $this->firstName = $firstName;
    }
    /**
     * Getter for LastName
     *
     * @return [type]
     */
    public function getLastName():string{
        return $this->lastName;
    }
    /**
     * Setter for LastName
     * @var [type] lastName
     *
     * 
     */
    public function setLastName(string $lastName){
        $this->lastName = $lastName;
    }
    /**
     * Getter for Street
     *
     * @return [type]
     */
    public function getStreet():string{
        return $this->street;
    }
    /**
     * Setter for Street
     * @var [type] street
     *
     * 
     */
    public function setStreet(string $street){
        $this->street = $street;
    }
    /**
     * Getter for City
     *
     * @return [type]
     */
    public function getCity():string{
        return $this->city;
    }
    /**
     * Setter for City
     * @var [type] city
     *
     * 
     */
    public function setCity(string $city){
        $this->city = $city;
    }
    /**
     * Getter for ZipCode
     *
     * @return [type]
     */
    public function getZipCode():string{
        return $this->zipCode;
    }
    /**
     * Setter for ZipCode
     * @var [type] zipCode
     *
     * 
     */
    public function setZipCode($zipCode){
        $this->zipCode = $zipCode;
    }
    /**
     * Getter for Country
     *
     * @return [type]
     */
    public function getCountry()
    {
        return $this->country;
    }
    /**
     * Setter for Country
     * @var [type] country
     *
     * 
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }
    /**
     * Getter for Phone
     *
     * @return [type]
     */
    public function getPhone()
    {
        return $this->phone;
    }
    /**
     * Setter for Phone
     * @var [type] phone
     *
     * 
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
   
    /**
     * Getter for BirthDate
     *
     * @return [type]
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }
    /**
     * Setter for BirthDate
     * @var [type] birthDate
     *
     * 
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }
    /**
     * Getter for BirthPlace
     *
     * @return [type]
     */
    public function getBirthPlace()
    {
        return $this->birthPlace;
    }
    /**
     * Setter for BirthPlace
     * @var [type] birthPlace
     *
     * 
     */
    public function setBirthPlace($birthPlace)
    {
        $this->birthPlace = $birthPlace;
    }
    /**
     * Getter for Email
     *
     * @return [type]
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Setter for Email
     * @var [type] email
     *
     * 
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    /**
     * Getter for Nationality
     *
     * @return [type]
     */
    public function getNationality(): string{
        return $this->nationality;
    }
    /**
     * Setter for Nationality
     * @var [type] nationality
     *
     * 
     */
    public function setNationality(string $nationality){
        $this->nationality = $nationality;
    }
    /**
     * Getter for SecurityNumber
     *
     * @return [type]
     */
    public function getSecurityNumber()
    {
        return $this->securityNumber;
    }
    /**
     * Setter for SecurityNumber
     * @var [type] securityNumber
     *
     * 
     */
    public function setSecurityNumber($securityNumber)
    {
        $this->securityNumber = $securityNumber;
    }
    /**
     * Get the value of accepted
     */ 
    public function getAccepted()
    {
        return $this->accepted;
    }
    /**
     * Set the value of accepted
     *
     * @return  self
     */ 
    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;
        return $this;
    }
}