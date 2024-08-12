<?php

require_once 'db.php';
require_once 'util.php';

$db = new Database;
$util = new Util;

// Handle Add New User Ajax Request
if (isset($_POST['add'])) {
  $first_name = $util->testInput($_POST['first_name']);
  $last_name = $util->testInput($_POST['last_name']);
  $birth_date = $util->testInput($_POST['birth_date']);
  $insurance_number = $util->testInput($_POST['insurance_number']);
  $insurance_id_insurance = $util->testInput($_POST['insurance_id_insurance']);

  if ($db->insert($first_name, $last_name, $birth_date, $insurance_number, $insurance_id_insurance)) {
    echo $util->showMessage('success', 'User inserted successfully!');
  } else {
    echo $util->showMessage('danger', 'Something went wrong!');
  }
}

// Handle Fetch All Users Ajax Request
if (isset($_GET['read'])) {
  $users = $db->read();
  $output = '';
  if ($users) {
    foreach ($users as $row) {
      $output .= '<tr>
                      <td>' . $row['idpatients'] . '</td>
                      <td>' . $row['first_name'] . '</td>
                      <td>' . $row['last_name'] . '</td>
                      <td>' . $row['birth_date'] . '</td>
                      <td>' . $row['insurance_number'] . '</td>
                      <td>' . $row['insurance_id_insurance'] . '</td>
                      <td>
                        <a href="#" idpatients="' . $row['idpatients'] . '" class="btn btn-success btn-sm rounded-pill py-0 editLink" data-toggle="modal" data-target="#editUserModal">Edit</a>

                        <a href="#" idpatients="' . $row['idpatients'] . '" class="btn btn-danger btn-sm rounded-pill py-0 deleteLink">Delete</a>
                      </td>
                    </tr>';
    }
    echo $output;
  } else {
    echo '<tr>
              <td colspan="6">No Users Found in the Database!</td>
            </tr>';
  }
}

// Handle Edit User Ajax Request
if (isset($_GET['edit'])) {
  $idpatients = $_GET['idpatients'];

  $user = $db->readOne($idpatients);
  echo json_encode($user);
}

// Handle Update User Ajax Request
if (isset($_POST['update'])) {
  $idpatients = $util->testInput($_POST['idpatients']);
  $first_name = $util->testInput($_POST['first_name']);
  $last_name = $util->testInput($_POST['last_name']);
  $birth_date = $util->testInput($_POST['birth_date']);
  $insurance_number = $util->testInput($_POST['insurance_number']);
  $insurance_id_insurance = $util->testInput($_POST['insurance_id_insurance']);

  if ($db->update($idpatients, $first_name, $last_name, $birth_date, $insurance_number, $insurance_id_insurance)) {
    echo $util->showMessage('success', 'User updated successfully!');
  } else {
    echo $util->showMessage('danger', 'Something went wrong!');
  }
}

// Handle Delete User Ajax Request
if (isset($_GET['delete'])) {
  $idpatients = $_GET['idpatients'];
  if ($db->delete($idpatients)) {
    echo $util->showMessage('info', 'User deleted successfully!');
  } else {
    echo $util->showMessage('danger', 'Something went wrong!');
  }
}
