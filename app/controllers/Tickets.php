<?php 
    class Tickets extends Controller{
        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }

            $this->ticketModel = $this->model('Ticket');
            $this->userModel = $this->model('User');
            $this->commentModel = $this->model('Ticket_Comment');
        }

        public function index(){
            // Get Tickets
            $tickets = $this->ticketModel->getTickets();
            $ticketsByUser = $this->ticketModel->getTicketsByUser($_SESSION['user_id']);
            $ticketsBySupport = $this->ticketModel->getTicketsBySupport($_SESSION['user_id']);

            $data = [
                'tickets' => $tickets,
                'ticketsByUser' => $ticketsByUser,
                'ticketsBySupport' => $ticketsBySupport
            ];

            $this->view('tickets/index', $data);
        }

        public function closed(){
            // Get Closed Tickets
            $closedTicketsByUser = $this->ticketModel->getClosedTicketsByUser($_SESSION['user_id']);
            $closedTicketsBySupport = $this->ticketModel->getClosedTicketsBySupport($_SESSION['user_id']);

            $data = [
                'closedTicketsByUser' => $closedTicketsByUser,
                'closedTicketsBySupport' => $closedTicketsBySupport
            ];

            $this->view('tickets/closed', $data);
        }

        public function add(){
        if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'user'){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // File Upload
                if(is_uploaded_file($_FILES['attachment']['tmp_name'])){
                    $file_name = $_FILES['attachment']['name'];
                    $file_type = $_FILES['attachment']['type'];
                    $file_size = $_FILES['attachment']['size'];
                    $file_temp = $_FILES['attachment']['tmp_name'];

                    $path = 'uploads/'. $file_name;

                    $file = pathinfo($path);

                    for ($i=1; file_exists($path); $i++){
                        $file_name = $file['filename'].$i.'.'.$file['extension'];
                        $path = 'uploads/'. $file_name;
                    }

                    move_uploaded_file($file_temp, 'uploads/'.$file_name);

                    $data = [
                        'type' => trim($_POST['type']),
                        'category' => trim($_POST['category']),
                        'subject' => trim($_POST['subject']),
                        'description' => trim($_POST['description']),
                        'attachment' => $file_name,
                        'level' => trim($_POST['level']),
                        'user_id' => $_SESSION['user_id'],
                        'status' => 'New',
                        'user_email' => $_SESSION['user_email'],
                        'link' => 'Support Ticket - CRCI',
                        'type_err' => '',
                        'category_err' => '',
                        'subject_err' => '',
                        'description_err' => '',
                        'level_err' => ''
                    ];
                } else {
                    $data = [
                        'type' => trim($_POST['type']),
                        'category' => trim($_POST['category']),
                        'subject' => trim($_POST['subject']),
                        'description' => trim($_POST['description']),
                        'attachment' => null,
                        'level' => trim($_POST['level']),
                        'user_id' => $_SESSION['user_id'],
                        'status' => 'New',
                        'user_email' => $_SESSION['user_email'],
                        'link' => 'Support Ticket - CRCI',
                        'type_err' => '',
                        'category_err' => '',
                        'subject_err' => '',
                        'description_err' => '',
                        'level_err' => ''
                    ];
                }

                // Validate Data
                if(empty($data['type'])){
                    $data['type_err'] = 'Veuillez choisir un type';
                }
                if(empty($data['category'])){
                    $data['category_err'] = 'Veuillez choisir un categorie';
                }
                if(empty($data['subject'])){
                    $data['subject_err'] = 'Veuillez choisir un titre';
                }
                if(empty($data['description'])){
                    $data['description_err'] = 'Veuillez choisir un type description';
                }
                if(empty($data['level'])){
                    $data['level_err'] = 'Veuillez choisir un niveau';
                }

                // Make sure there is no error
                if(empty($data['subject_err']) && empty($data['description_err']) && empty($data['level_err']) && empty($data['type_err']) && empty($data['category_err'])){
                    // Validated
                    if($this->ticketModel->addTicket($data)){
                        // Send email to User and Support Team
                        $this->ticket_mail($data['user_email'],'Nouveau Ticket de '. $_SESSION['user_firstname'].' '.$_SESSION['user_lastname'],'Pour plus de détails, veuillez vérifier '.$data['link'], 'support');
                        $this->ticket_mail($data['user_email'],'Ticket créé avec succès !',"Nous accusons réception de votre tickets. Il sera pris en charge par l'un de nos agents.", 'user');
                        // Alert confirmation message
                        flash('ticket_message', 'Ticket créé avec succès !');
                        redirect('tickets');
                    } else {
                        flash('ticket_message', "Quelque chose s'est mal passé !");
                    }

                } else {
                    // Load view with errors
                    $this->view('tickets/add', $data);
                }

            } else {
                $data = [
                    'type' => '',
                    'category' => '',
                    'subject' => '',
                    'description' => '',
                    'level' => '',
                    'attachment' => ''
                ];
    
                $this->view('tickets/add', $data);
            }

        }else{
            redirect('users/logout');
          }

        }

        public function show($id){
            $ticket = $this->ticketModel->getTicketById($id);
            $user = $this->userModel->getUserById($ticket->user_id);
            $support = $this->userModel->getUserById($ticket->support_id);
            $comment = $this->commentModel->getCommentsById($id);

            $data = [
                'ticket' => $ticket,
                'user' => $user,
                'support' => $support,
                'description' => '',
                'comment' => $comment
            ];

            $this->view('tickets/show', $data);
        }

        public function close($id){
            $this->ticketModel->closeTicketById($id);
            $ticket = $this->ticketModel->getTicketById($id);
            $user = $this->userModel->getUserById($ticket->user_id);
            $support = $this->userModel->getUserById($ticket->support_id);
            $comment = $this->commentModel->getCommentsById($id);

            if($ticket->level == 'Closed'){
                flash('close_message', 'Ticket fermé avec succès !');
            }

            $data = [
                'ticket' => $ticket,
                'user' => $user,
                'support' => $support,
                'description' => '',
                'comment' => $comment
            ];

            redirect('tickets/show/'.$id);
        }

        public function attribute($id){
            $this->ticketModel->attributeTicketById($id, $_SESSION['user_id']);
            $ticket = $this->ticketModel->getTicketById($id);
            $user = $this->userModel->getUserById($ticket->user_id);
            $support = $this->userModel->getUserById($ticket->support_id);
            $comment = $this->commentModel->getCommentsById($id);

            if($ticket->support_id != null){
                flash('attribute_message', 'Ticket attribué avec succès !');
            }

            $data = [
                'ticket' => $ticket,
                'user' => $user,
                'support' => $support,
                'description' => '',
                'comment' => $comment
            ];

            $this->view('tickets/show', $data);
        }

        public function reply($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'user_id' => $_SESSION['user_id'],
                    'ticket_id' => $id,
                    'description' => trim($_POST['description']),
                    'status' => trim($_POST['status']),
                    'description_err' => ''
                ];

                // Validate Data
                if(empty($data['description'])){
                    $data['description_err'] = 'Please enter a description';
                }

                // Make sure there is no error
                if(empty($data['description_err'])){
                    // Validated
                    if($this->commentModel->addTicketComment($data)){
                        $this->ticketModel->updateTicketStatus($id, $data);
                        flash('reply_message', 'Veuillez saisir une description');
                        redirect('tickets/show/'.$id);
                    } else {
                        flash('reply_message', "Quelque chose s'est mal passé !");
                    }

                } else {
                    // Load view with errors
                    $this->view('tickets/show', $data);
                }

            } else {
                $data = [
                    'description' => '',
                    'status' => ''
                ];
    
                $this->view('tickets/show', $data);
            }

        }

        // Php Mailer
        public function ticket_mail($user_email, $email_subject, $email_message, $user_type){
            // creates object
            $mail = new PHPMailer(true); 
            if(isset($_POST['submit']))
            {
                $email      = strip_tags($user_email);
                $subject    = strip_tags($email_subject);    
                $message  = strip_tags($email_message);

                $support_email = $this->ticketModel->getSupportEmails();
                $array_size = sizeof($support_email);
            
                $mail->IsSMTP(); 
                $mail->isHTML(true);
                $mail->SMTPDebug  = 0;                     
                $mail->SMTPAuth   = true;                  
                $mail->SMTPSecure = "ssl";                 
                $mail->Host       = "smtp.gmail.com";      
                $mail->Port        = '465';  

                if($user_type == 'support'){
                    for($i=0; $i < $array_size; $i++){                   
                        $mail->AddAddress($support_email[$i]->email);
                    }; 
                } else {
                    $mail->AddAddress($email);
                }
                        

                $mail->Username   ="sqli.stage.php@gmail.com";  
                $mail->Password   ="stage@sqli";            
                $mail->SetFrom('sqli.stage.php@gmail.com','Support Ticket-SQLi');
                $mail->AddReplyTo("sqli.stage.php@gmail.com","Support Ticket-SQLi");
                $mail->Subject    = $subject;
                $mail->Body    = $message;
                $mail->AltBody    = $message;
                
                if($mail->Send())
                {
                
                    $msg = "Bonjour, Votre courrier a été envoyé avec succès à".$email." ";
                
                }
            } 
        }

    }