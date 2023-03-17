<?php
    class Ticket{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getTickets(){
            $this->db->query('SELECT *, 
                              tickets.id as ticketId,
                              users.id as userId,
                              ticket_levels.id as levelId,
                              ticket_levels.level as levelName,
                              tickets.created_at as ticketDate,
                              tickets.type as ticketType,
                              users.type as userType
                              FROM tickets
                              INNER JOIN users
                              ON tickets.user_id = users.id
                              INNER JOIN ticket_levels
                              ON tickets.level = ticket_levels.id
                              WHERE tickets.support_id IS NULL
                              AND tickets.status != :status
                              ORDER BY tickets.level DESC
                              ');
            $this->db->bind(':status', 'Closed');

            $results = $this->db->resultSet();

            return $results;
        }

        public function getTicketsByUser($id){
            $this->db->query('SELECT *, 
                              tickets.id as ticketId,
                              users.id as userId,
                              ticket_levels.id as levelId,
                              ticket_levels.level as levelName,
                              tickets.created_at as ticketDate,
                              tickets.type as ticketType,
                              users.type as userType
                              FROM tickets
                              INNER JOIN users
                              ON tickets.user_id = users.id
                              INNER JOIN ticket_levels
                              ON tickets.level = ticket_levels.id
                              WHERE tickets.user_id = :id
                              AND tickets.status != :status
                              ORDER BY tickets.created_at DESC
                              ');
            $this->db->bind(':id', $id);
            $this->db->bind(':status', "Closed");

            $results = $this->db->resultSet();

            return $results;
        }

        public function getClosedTicketsByUser($id){
            $this->db->query('SELECT *, 
                              tickets.id as ticketId,
                              users.id as userId,
                              ticket_levels.id as levelId,
                              ticket_levels.level as levelName,
                              tickets.created_at as ticketDate,
                              tickets.type as ticketType,
                              users.type as userType
                              FROM tickets
                              INNER JOIN users
                              ON tickets.user_id = users.id
                              INNER JOIN ticket_levels
                              ON tickets.level = ticket_levels.id
                              WHERE tickets.user_id = :id
                              AND tickets.status = :status
                              ORDER BY tickets.created_at DESC
                              ');
            $this->db->bind(':id', $id);
            $this->db->bind(':status', "Closed");

            $results = $this->db->resultSet();

            return $results;
        }

        public function getTicketsBySupport($id){
            $this->db->query('SELECT *, 
                              tickets.id as ticketId,
                              users.id as userId,
                              ticket_levels.id as levelId,
                              ticket_levels.level as levelName,
                              tickets.created_at as ticketDate,
                              tickets.type as ticketType,
                              users.type as userType
                              FROM tickets
                              INNER JOIN users
                              ON tickets.user_id = users.id
                              INNER JOIN ticket_levels
                              ON tickets.level = ticket_levels.id
                              WHERE tickets.support_id = :id
                              AND tickets.status != :status 
                              ORDER BY tickets.created_at DESC
                              ');
            $this->db->bind(':id', $id);
            $this->db->bind(':status', "Closed");

            $results = $this->db->resultSet();

            return $results;
        }

        public function getClosedTicketsBySupport($id){
            $this->db->query('SELECT *, 
                              tickets.id as ticketId,
                              users.id as userId,
                              ticket_levels.id as levelId,
                              ticket_levels.level as levelName,
                              tickets.created_at as ticketDate,
                              tickets.type as ticketType,
                              users.type as userType
                              FROM tickets
                              INNER JOIN users
                              ON tickets.user_id = users.id
                              INNER JOIN ticket_levels
                              ON tickets.level = ticket_levels.id
                              WHERE tickets.support_id = :id
                              AND tickets.status = :status 
                              ORDER BY tickets.created_at DESC
                              ');
            $this->db->bind(':id', $id);
            $this->db->bind(':status', "Closed");

            $results = $this->db->resultSet();

            return $results;
        }

        public function addTicket($data){
            // Prepare query
            $this->db->query('INSERT INTO tickets (type, category, subject, description, attachment, level, user_id, status) VALUES (:type, :category, :subject, :description, :attachment, :level, :user_id, :status)');
            // Bind values
            $this->db->bind(':type', $data['type']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':subject', $data['subject']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':attachment', $data['attachment']);
            $this->db->bind(':level', $data['level']);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':status', $data['status']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getTicketById($id){
            $this->db->query('SELECT *,
                              tickets.id as ticketId,
                              ticket_levels.id as levelId,
                              ticket_levels.level as levelName,
                              tickets.user_id as ticketUser
                              FROM tickets 
                              INNER JOIN ticket_levels
                              ON tickets.level = ticket_levels.id
                              WHERE tickets.id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }

        public function closeTicketById($id){
            // Bind values
            $this->db->query('UPDATE tickets SET status = :status WHERE id = :id');
            $this->db->bind(':id', $id);
            $this->db->bind(':status', 'Closed');

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function attributeTicketById($id, $support_member){
            // Bind values
            $this->db->query('UPDATE tickets SET support_id = :support_id WHERE id = :id');
            $this->db->bind(':id', $id);
            $this->db->bind(':support_id', $support_member);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function updateTicketStatus($id, $data){
            $date = date('Y-m-d H:i:s');

            // Bind values
            $this->db->query('UPDATE tickets SET status = :status, updated_at = :date WHERE id = :id');
            $this->db->bind(':date', $date);
            $this->db->bind(':id', $id);
            $this->db->bind(':status', $data['status']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getSupportEmails(){
            $this->db->query('SELECT email 
                              FROM users
                              WHERE type = :type');
            $this->db->bind(':type', 'support');

            $row = $this->db->resultSet();

            return $row;
        }

         
         public function countSupport(){
            $this->db->query('SELECT count(users.id) as "nbr_support" from Users where type="support"');
            $support = $this->db->single();
            if($support) return $support;
            else return false;
          }

        public function countCollaborateur(){
            $this->db->query('SELECT count(users.id) as "nbr_collaborateur" from Users where type="user"');
            $collaborateur = $this->db->single();
            if($collaborateur) return $collaborateur;
            else return false;
            }

        public function countMesDemandes(){
            $id = $_SESSION['user_id'];
            $this->db->query("SELECT count(users.id) as 'nbr_demande' From tickets,users Where tickets.user_id = users.id AND tickets.type = 'Demande' AND users.id like $id");
                $demande = $this->db->single();
                if($demande) return $demande;
                else return false;
              }
 
        public function countMesIncidents(){
            $id = $_SESSION['user_id'];
            $this->db->query("SELECT count(users.id) as 'nbr_incident' From tickets,users Where tickets.user_id = Users.id AND tickets.type = 'Incident' AND users.id like $id");
            $incident = $this->db->single();
            if($incident) return $incident;
            else return false;
        }
        

        public function countDemandeResolu(){
            $id = $_SESSION['user_id'];
            $this->db->query("SELECT count(users.id) as 'nbr_demande_resolu' From tickets,users Where tickets.support_id = users.id AND tickets.type = 'Request' AND users.id like $id");
            $incident = $this->db->single();
            if($incident) return $incident;
            else return false;
        }

        public function countIncidentResolu(){
            $id = $_SESSION['user_id'];
            $this->db->query("SELECT count(users.id) as 'nbr_incident_resolu' From tickets,users Where tickets.support_id = users.id AND tickets.type = 'Incident' AND users.id like $id");
            $incident = $this->db->single();
            if($incident) return $incident;
            else return false;
        }
        public function getUsersById(){  
            $id = $_SESSION['user_id'];
              $this->db->query("SELECT  id,firstname, lastname, type, email FROM users WHERE id like $id");
              $this->db->bind(":id", $id);
              $row = $this->db->single();
              return $row;

        }
    }