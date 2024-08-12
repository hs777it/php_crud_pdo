<?php

require_once 'config.php';

class Database extends Config
{
  // Insert User Into Database
  public function insert($first_name, $last_name, $birth_date, $insurance_id_insurance)
  {
    $sql = 'INSERT INTO patients (first_name, last_name, birth_date, insurance_number, insurance_id_insurance) VALUES (:first_name, :last_name, :birth_date,
    :insurance_number, :insurance_id_insurance)';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
      'first_name' => $first_name,
      'last_name' => $last_name,
      'birth_date' => $birth_date,
      'insurance_number' => $insurance_number,
      'insurance_id_insurance' => $insurance_id_insurance
    ]);
    return true;
  }

  // Fetch All Users From Database
  public function read()
  {
    $sql = 'SELECT * FROM patients ORDER BY idpatients DESC';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }

  // Fetch Single User From Database
  public function readOne($idpatients)
  {
    $sql = 'SELECT * FROM patients WHERE idpatients = :idpatients';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['idpatients' => $idpatients]);
    $result = $stmt->fetch();
    return $result;
  }

  // Update Single User
  public function update($idpatients, $first_name, $last_name, $birth_date, $insurance_number, $insurance_id_insurance)
  {
    $sql = 'UPDATE patients SET first_name = :first_name, last_name = :last_name, birth_date = :birth_date, insurance_number = :insurance_number, insurance_id_insurance = :insurance_id_insurance WHERE idpatients = :idpatients';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
      'first_name' => $first_name,
      'last_name' => $last_name,
      'birth_date' => $birth_date,
      'insurance_number' => $insurance_number,
      'insurance_id_insurance' => $insurance_id_insurance,
      'idpatients' => $idpatients
    ]);

    return true;
  }

  // Delete User From Database
  public function delete($idpatients)
  {
    $sql = 'DELETE FROM patients WHERE idpatients = :idpatients';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['idpatients' => $idpatients]);
    return true;
  }
}
