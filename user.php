<?php
class User
{
    private $conn;
    private $table = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($username, $email, $asal, $password)
    {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (username, email, asal, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $asal, $password);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $error = $stmt->error;
            $stmt->close();
            return $error;
        }
    }

    // LOGIN
    public function login($username, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
}