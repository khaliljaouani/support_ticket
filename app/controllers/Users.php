<?php 
    class Users extends Controller{
        public function __construct(){
            $this->userModel = $this->model('User');
        }

        public function register(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'firstname' => trim($_POST['firstname']),
                    'lastname' => trim($_POST['lastname']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'type' => trim($_POST['type']),

                    'firstname_err' => '',
                    'lastname_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'type_err' => ''
                ];

                // Validate Firstname
                if(empty($data['firstname'])){
                    $data['firstname_err'] = "Veuillez saisir le prénom";
                }

                // Validate Lastname
                if(empty($data['lastname'])){
                    $data['lastname_err'] = "Veuillez saisir le nom";
                }

                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = "Veuillez saisir l'email";
                } else{
                    // Check Email
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_err'] = 'Email existe deja.';
                    }
                  }

                // Validate Password
                if(empty($data['password'])){
                    $data['password_err'] = "Veuillez saisir le mot de passe";
                }else if(strlen($data['password']) < 6){
                    $data['password_err'] = "Le mot de passe doit être au moins de 6 caractères";
                }

                 // Validate Confirm-Password
                 if(empty($data['confirm_password'])){
                    $data['confirm_password_err'] = "Please confirm password";
                } else{
                    if($data['password'] != $data['confirm_password']){
                        $data['confirm_password_err'] = "Les mots de passe ne correspondent pas";
                    }
                }
                  // Validate type
                  if(empty($data['type'])){
                    $data['type_err'] = "Please enter type";
                }

                // Make sure there is no error
                if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])&& empty($data['type_err'])){
                    //Validated
                    flash('register_success', 'Registered successfully !! You can login');
                    redirect('users/login');
                    // Hash Password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Register User
                    if($this->userModel->register($data)){
                        
                    } else {
                        flash('register_error', 'Something went wrong');
                    }


                } else {
                    // Load view with errors
                    $this->view('users/register', $data);
                }

            } else {
                // Init Data 

                $data = [
                    'firstname' => '',
                    'lastname' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'type' => '',
                    'firstname_err' => '',
                    'lastname_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'type_err' => '',
                ];


                //Load view
                $this->view('users/register', $data);
            }
        }

        public function login(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => ''
                ];

                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = "Veuillez saisir l'email";
                }

                // Validate Password
                if(empty($data['password'])){
                    $data['password_err'] = "Veuillez saisir le mot de passe";
                }

                // Check for user's email
                if($this->userModel->findUserbyEmail($data['email'])){
                    //User Found
                } else {
                    // User not found
                    $data['email_err'] = 'Utilisateur non trouvé';
                }

                // Make sure there is no error
                if(empty($data['email_err']) && empty($data['password_err'])){
                    //Validated
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                    if($loggedInUser){
                        // Create session
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['password_err'] = 'Mot de passe incorrect';
                        $this->view('users/login', $data);
                    }
                } else {
                    // Load view with errors
                    $this->view('users/login', $data);
                }

            } else{
                // Init Data 

                $data = [
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => ''
                ];


                //Load view
                $this->view('users/login', $data);
            }
        }

        public function createUserSession($user){
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_firstname'] = $user->firstname;
            $_SESSION['user_lastname'] = $user->lastname;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_type'] = $user->type;
            redirect('index');
        }

        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_firstname']);
            unset($_SESSION['user_lastname']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_type']);
            session_destroy();
            redirect('users/login');
        }
    }