<?php
namespace Controllers;

use Models\Participant;

class ParticipantController {
    private $participant;

    public function __construct($db_conn) {
        $this->participant = new Participant($db_conn);
    }

    public function store($post_data) {
        if (isset($_FILES['photo__input']) && $_FILES['photo__input']['error'] == 0) {
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($_FILES['photo__input']['name']);
        
            if (move_uploaded_file($_FILES['photo__input']['tmp_name'], $uploadFile)) {
                $post_data['photo'] = $uploadFile;
            } else {
                $post_data['photo'] = null;
            }
        } else {
            $post_data['photo'] = null;
        }
    
        $result = $this->participant->save($post_data);
        
        if ($result === "Email is already registered.") {
            echo json_encode(['status' => 'error', 'message' => $result]);
            return;
        }
    
        echo json_encode(['status' => 'success']);
    }

    public function show_all_participants() {
        $participants = $this->participant->select_all();
        return $participants;
    }
}
?>