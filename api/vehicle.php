<?php

class Vehicle {
    private $conn;
    private $table_name = "vehicles";

    public $license_plate;
    public $entry_time;
    public $exit_time;
    public $payment_status;
    public $paid_time;
    public $total_amount;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Register vehicle entry
    public function registerEntry() {
        $query = "INSERT INTO " . $this->table_name . " SET license_plate=:license_plate, entry_time=NOW()";
        $stmt = $this->conn->prepare($query);

        $this->license_plate = htmlspecialchars(strip_tags($this->license_plate));

        $stmt->bindParam(":license_plate", $this->license_plate);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Register vehicle exit
    public function registerExit() {
        $query = "UPDATE " . $this->table_name . " 
                  SET exit_time=NOW(), 
                      total_amount=TIMESTAMPDIFF(MINUTE, entry_time, NOW()) * 5 / 60 
                  WHERE license_plate=:license_plate AND exit_time IS NULL";

        $stmt = $this->conn->prepare($query);

        $this->license_plate = htmlspecialchars(strip_tags($this->license_plate));
        $stmt->bindParam(":license_plate", $this->license_plate);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Make a payment
    public function makePayment() {
        $query = "UPDATE " . $this->table_name . " 
                  SET payment_status=1, paid_time=NOW() 
                  WHERE license_plate=:license_plate AND exit_time IS NOT NULL";

        $stmt = $this->conn->prepare($query);

        $this->license_plate = htmlspecialchars(strip_tags($this->license_plate));
        $stmt->bindParam(":license_plate", $this->license_plate);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Check if vehicle can exit
    public function canExit() {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE license_plate=:license_plate AND payment_status=1 
                  AND TIMESTAMPDIFF(MINUTE, paid_time, NOW()) <= 15";

        $stmt = $this->conn->prepare($query);

        $this->license_plate = htmlspecialchars(strip_tags($this->license_plate));
        $stmt->bindParam(":license_plate", $this->license_plate);

        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
?>
