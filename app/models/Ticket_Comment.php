<?php
    class Ticket_Comment{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function addTicketComment($data){
            // Prepare query
            $this->db->query('INSERT INTO ticket_comments (user_id, ticket_id, description) VALUES (:user_id, :ticket_id, :description)');
            // Bind values
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':ticket_id', $data['ticket_id']);
            $this->db->bind(':description', $data['description']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getCommentsById($id){
            $this->db->query('SELECT *,
                              users.id as userId,
                              ticket_comments.created_at as commentDate
                              FROM ticket_comments
                              INNER JOIN users
                              ON ticket_comments.user_id = users.id
                              WHERE ticket_comments.ticket_id = :id
                              ORDER BY ticket_comments.created_at ASC
                              ');
            $this->db->bind(':id', $id);

            $results = $this->db->resultSet();

            return $results;
        }
    }
