<?php 
  class Pages extends Controller {
      public function __construct(){
        if(!isLoggedIn()){
          redirect('users/login');
        }

        $this->ticketModel = $this->model('Ticket');
      }

      public function index(){
        // Get Unassigned Tickets
        $tickets = $this->ticketModel->getTickets();
        $support = $this->ticketModel->countSupport();
        $collaborateur = $this->ticketModel->countCollaborateur();
        $demande = $this->ticketModel->countMesDemandes();
        $incident = $this->ticketModel->countMesIncidents();
        $demande_resolu = $this->ticketModel->countDemandeResolu();
        $incident_resolu = $this->ticketModel->countIncidentResolu();

        $data = [
          'tickets' => $tickets,
          'support' => $support,
          'collaborateur' => $collaborateur,
          'demande' => $demande,
          'incident' => $incident,
          'demande_resolu' => $demande_resolu,
          'incident_resolu' => $incident_resolu,
          'title' => 'Support Ticket - CRCI'
        ];

        $this->view('pages/index', $data);
      }

      public function profil(){
        $user = $this->ticketModel->getUsersById();
        
        $data = [
          'user' => $user
        ];

        $this->view('pages/profil', $data);
      }
  }