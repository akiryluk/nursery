<?php

class UserModel
{
    private $id;
    private $lastName;
    private $firstName;
    private $birthdate;
    private $address;
    private $city;
    private $zipcode;
    private $phone;
    private $email;
    private $password;
    private $country;
    private $created_at;
    private $lastLoginTimaestamp;
    private $admin;

  
    public function __construct(
        string $lastName, 
        string $firstName, 
        string $birthdate, 
        string $address, 
        string $city, 
        string $zipcode, 
        string $phone, 
        string $email, 
        string $password, 
        string $country, 
        bool $admin, 
        $created_at = null, 
        $lastLoginTimaestamp = null, 
        $id = null
        )
    {
        if ($id)
        {
            $this->id = $id;
        }
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->birthdate = $birthdate;
        $this->address = $address;
        $this->city = $city;
        $this->zipcode = $zipcode;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
        $this->country = $country;
        $this->admin = $admin;

        if($created_at)
        {
            $this->created_at = $created_at;
        }else{
            $this->created_at = date("Y-m-d H:i:s");
        }

        if($lastLoginTimaestamp)
        {
            $this->lastLoginTimaestamp = $lastLoginTimaestamp;
        }

    }
    public function createUser()
    {

        $db = new Database();
        $db -> executeSql(
            "INSERT INTO user (FirstName, LastName, Email, Password, Address, 
            City, ZipCode, Country, Phone, CreationTimestamp) values (?,?,?,?,?,?,?,?,?,?)", 
            [$this->firstName, $this->lastName, $this->email, $this->password, $this->address,
            $this->city, $this->zipcode, $this->country, $this->phone, $this->created_at]
        );
    }

    public static function saveUser($id, $lastName, $firstName, $address, $city,
    $zipcode, $phone, $email)
    {
        $db = new Database();
        $db -> executeSql(
            "UPDATE user SET LastName = ?, FirstName = ?, Address = ?, City = ?, ZipCode = ?, Phone = ?,
            Email =? WHERE id=?", 
            [$lastName, $firstName, $address, $city,
            $zipcode, $phone, $email, $id]
        );
    }


    public static function getAllUsers()
    {
        $db = new Database();
        $result = $db->query("SELECT * FROM user");
        $users= [];
        foreach($result as $user)
        {
            $users[]= new UserModel($user['FirstName'],$user['LastName'],$user['Email'],$user['Password'],$user['BirthDate'],$user['Address'],$user['City'],$user['ZipCode'],$user['Phone'],$user['Admin'],$user['Country'],$user['CreationTimestamp'],$user['LastLoginTimestamp'],$user['Id']);
        }

        return $users;
    }
    
    public static function getUserById($id)
    {
        $db = new Database();
        $result = $db->queryOne("SELECT * FROM user WHERE Id = ?", [$id]);
        $user = new UserModel($result['LastName'],$result['FirstName'],$result['BirthDate'],$result['Address'],$result['City'],$result['ZipCode'],
        $result['Phone'],$result['Email'],$result['Password'],$result['Country'],$result['Admin'],$result['CreationTimestamp'],$result['LastLoginTimestamp'],$result['Id']);
        return $user;
    }


    public function editLastLogin()
    {
        $db = new Database();
        $db -> executeSql(
            "UPDATE user SET LastLoginTimestamp = ? WHERE id = ?", 
            [date("Y-m-d H:i:s"), $this->id]
        );
    }

    public static function getUserByEmail($email)
    {
        $db = new Database();
        $result = $db->queryOne("SELECT * FROM user WHERE Email = ?", [$email]);
        $user = new UserModel($result['LastName'],$result['FirstName'],
                                $result['BirthDate'],$result['Address'],
                                $result['City'],$result['ZipCode'],$result['Phone'],
                                $result['Email'],$result['Password'],
                                $result['Country'],$result['Admin'],$result['CreationTimestamp'],
                                $result['LastLoginTimestamp'],$result['Id']);
        return $user;
    }

    // function edit user 

    
 

    // public static function getUsers()
    // {
    //     $db = new Database();
    //     $result = $db->query("SELECT * FROM user");
    //     $users = [];
    //     foreach($result as $user)
    //     {
    //         $users[] = new UserModel($user['FirstName'], $user['LastName'], $user['Email'], 
    //         $user['Password'], $user['BirthDate'], $user['Address'],
    //         $user['City'], $user['ZipCode'], $user['Country'], $user['Phone'], $user['CreationTimestamp'],
    //         $user['LastLoginTimestamp'], $user['Admin']);
    //     }
    //     return $users;
    // }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of lastName
     */ 
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */ 
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of firstName
     */ 
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */ 
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of birthdate
     */ 
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set the value of birthdate
     *
     * @return  self
     */ 
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of zipcode
     */ 
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set the value of zipcode
     *
     * @return  self
     */ 
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of lastLoginTimaestamp
     */ 
    public function getLastLoginTimaestamp()
    {
        return $this->lastLoginTimaestamp;
    }

    /**
     * Set the value of lastLoginTimaestamp
     *
     * @return  self
     */ 
    public function setLastLoginTimaestamp($lastLoginTimaestamp)
    {
        $this->lastLoginTimaestamp = $lastLoginTimaestamp;

        return $this;
    }

    /**
     * Get the value of admin
     */ 
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set the value of admin
     *
     * @return  self
     */ 
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }
}