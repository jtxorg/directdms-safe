<?php
namespace ODM;

class User
{
    public $id;
    public $username;
    public $password;
    public $Email;
    public $twofa_enabled;

    public function __construct($id = null)
    {
        if ($id !== null) {
            $this->id = $id;
            $this->load();
        }
    }

    public function load()
    {
        global $pdo;
        $query = "SELECT * FROM {$GLOBALS['CONFIG']['db_prefix']}user WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(':id' => $this->id));
        $result = $stmt->fetch();
        
        if ($result) {
            $this->username = $result['username'];
            $this->password = $result['password'];
            $this->Email = $result['Email'];
            $this->twofa_enabled = $result['2fa_enabled'];
        }
    }

    public function save()
    {
        global $pdo;
        $query = "UPDATE {$GLOBALS['CONFIG']['db_prefix']}user SET 
                  username = :username,
                  password = :password,
                  Email = :Email,
                  2fa_enabled = :twofa_enabled
                  WHERE id = :id";
        $stmt = $pdo->prepare($query);
        return $stmt->execute(array(
            ':username' => $this->username,
            ':password' => $this->password,
            ':Email' => $this->Email,
            ':twofa_enabled' => $this->twofa_enabled,
            ':id' => $this->id
        ));
    }
} 