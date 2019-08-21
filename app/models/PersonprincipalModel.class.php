<?php 

abstract class PersonprincipalModel{
    
    protected $id;
    protected $firstName;
    protected $lastName;
    protected $street;
    protected $city;
    protected $zipCode;
    protected $country;
    protected $phone;

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

}