<?php

namespace Models;

class Participant {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    public function save($data) {
        if ($this->emailExists($data['email'])) {
            return "Email is already registered.";
        }
        $photo = empty($data['photo']) ? null : $data['photo'];

        $query = "INSERT INTO participants 
                  (first_name, last_name, birthdate, report_subject, country, phone, email, company, position, about, photo) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sssssssssss", 
            $data['first_name'], 
            $data['last_name'], 
            $data['birthdate'], 
            $data['report_subject'], 
            $data['country'], 
            $data['phone'], 
            $data['email'], 
            $data['company'], 
            $data['position'], 
            $data['about'], 
            $photo
        );

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function select_all() {
        $query = "SELECT CONCAT(first_name, ' ', last_name) AS full_name, birthdate, report_subject, country, phone, email, company, position, about, photo FROM participants";
        $result = $this->conn->query($query);
    
        $participants = [];
        while ($row = $result->fetch_assoc()) {
            $participants[] = $row;
        }
    
        return $participants;
    }

    private function emailExists($email) {
        $query = "SELECT * FROM participants WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }
}
?>