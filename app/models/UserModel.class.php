<?php

class UserModel
{
    private $id;
    private $nom;
    private $prenom;
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
        string $nom, 
        string $prenom, 
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
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->birthdate = $birthdate;
        $this->address = $address;
        $this->city = $city;
        $this->zipcode = $zipcode;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this ->country = $country;
        $this ->admin = $admin;

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
            [$this-> prenom, $this->nom, $this->email, $this->password, $this->address,
            $this->city, $this->zipcode, $this->country, $this->phone, $this->created_at]
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
        $user = new UserModel($user['FirstName'],$user['LastName'],$user['Email'],$user['Password'],$user['BirthDate'],$user['Address'],$user['City'],$user['ZipCode'],$user['Phone'],$user['Admin'],$user['Country'],$user['CreationTimestamp'],$user['LastLoginTimestamp'],$user['Id']);
        return $user;
    }


    public function editLastLogin()
    {
        $db = new Database();
        $db -> executeSql(
            "UPDATE user SET LastLoginTimestamp = ?", 
            [date("Y-m-d H:i:s")]
        );
    }

    public static function getUserByEmail($email)
    {
        $db = new Database();
        $result = $db->queryOne("SELECT * FROM user WHERE Email = ?", [$email]);
        $user = new UserModel($result['FirstName'],$result['LastName'],$result['Email'],$result['Password'],$result['BirthDate'],$result['Address'],$result['City'],$result['ZipCode'],$result['Phone'],$result['Admin'],$result['Country'],$result['CreationTimestamp'],$result['LastLoginTimestamp'],$result['Id']);
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
}