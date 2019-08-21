<?php


class ParentModel extends PersonprincipalModel
{
    private $jobTitle;
    private $companyName;
    private $gender;
    private $id_kid;

    /**
     * Get the value of jobTitle
     */ 
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * Set the value of jobTitle
     *
     * @return  self
     */ 
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * Get the value of companyName
     */ 
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set the value of companyName
     *
     * @return  self
     */ 
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of id_kid
     */ 
    public function getId_kid()
    {
        return $this->id_kid;
    }

    /**
     * Set the value of id_kid
     *
     * @return  self
     */ 
    public function setId_kid($id_kid)
    {
        $this->id_kid = $id_kid;

        return $this;
    }
}