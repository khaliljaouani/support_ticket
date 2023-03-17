<?php 
    class User {
        private $db;

        public function __construct(){
            $this->db = new Database;            
        }

        // Register User
        public function register($data){
            // Prepare Query
            $this->db->query('INSERT INTO users (firstname, lastname, email, password, type) VALUES (:firstname, :lastname, :email, :password, :type)');
            
            // Bind Values
            $this->db->bind(':firstname', $data['firstname']);
            $this->db->bind(':lastname', $data['lastname']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':type',  $data['type']);

            //Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Login User 
        public function login($email, $password){
            // Prepare Query
            $this->db->query('SELECT * FROM users WHERE email = :email');
            // Bind Value
            $this->db->bind(':email', $email);

            // Fetch Data
            $row = $this->db->single();

            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        }

        //Find user by email
        public function findUserByEmail($email){
            // Prepare Query
            $this->db->query("SELECT * FROM users WHERE email = :email");
            // Bind Value
            $this->db->bind(':email', $email);

            // Fetch Data
            $this->db->single();
      
            //Check RowCount
            if($this->db->rowCount() > 0){
              return true;
            } else {
              return false;
            }
        }

        //Get user by id
        public function getUserById($id){
            // Prepare Query
            $this->db->query("SELECT * FROM users WHERE id = :id");
            // Bind Value
            $this->db->bind(':id', $id);

            // Fetch Data
            $row = $this->db->single();
      
            return $row;
        }
    }