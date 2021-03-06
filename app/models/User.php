<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    //Find user by email
    public function findUserByEmail($email)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email;");

        $this->db->bind(":email", $email);

        $row = $this->db->single();

        //Check row count
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //create user
    public  function create($data)
    {
        $this->db->query("INSERT INTO users (name,email,password) VALUES (:name,:email,:password);");

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Login user
    public function login($email, $password)
    {
        //create query
        $this->db->query('SELECT * FROM users WHERE email = :email;');

        //bind value
        $this->db->bind(':email', $email);

        //get the single row
        $row = $this->db->single();

        //hashed password
        $hashed_password = $row->password;

        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    //Get user by id
    public function getUserById($id)
    {
        try {
            $this->db->query('SELECT * FROM users WHERE id = :id;');

            $this->db->bind(':id', $id);

            $user = $this->db->single();

            return $user;
        } catch (PDOException $pdoe) {
            echo  $pdoe->getMessage();
        }
    }
}
