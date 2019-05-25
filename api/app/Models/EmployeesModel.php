<?php

namespace app\Models;

class EmployeesModel extends Models {

  public function getEmployees() {

    $result = $this->db->select('employees', [
        '[><]offices' => 'officeCode',
      ],[
      'employeeNumber',
      'lastName',
      'firstName',
      'extension',
      'email',
      'offices.city',
      'reportsTo',
      'jobTitle'
    ]);

    // !Conexion.
    if (!is_null($this->db->error()[1])) {
      return array('error' => true,'description' => $this->db->error()[2]);
    } else if (empty($result)) { // sin Datos
      return array('notFound' => true, 'description' => 'The result is empty');
    }

    return array(
      'success' => true,
      'description' => 'The employees were found',
      'employees' => $result
    );

  }

  public function insertEmployees($employee) {
    $result = $this->db->insert('employee', [
      'employeeNumber' => $employee['employeeNumber'],
      'lastName' => $employee['lastName'],
      'firstName' => $employee['firstName'],
      'extension' => $employee['extension'],
      'email' => $employee['email'],
      'officeCode' => $employee['officeCode'],
      'reportsTo' => $employee['reportsTo'],
      'jobTitle' => $employee['jobTitle']
    ]);

    if (!is_null($this->db->error()[1])) {
      return array(
        'success' => false,
        'description' => $this->db->error()[2]
      );
    }

    return array(
      'success' => true,
      'description' => 'The employee was inserted'
    );
  }

  public function updateEmployees($employeeNumber, $employee) {
    $result = $this->db->update('employees', [
      'lastName' => $employee['lastName'],
      'firstName' => $employee['firstName'],
      'extension' => $employee['extension'],
      'email' => $employee['email'],
      'officeCode' => $employee['officeCode'],
      'reportsTo' => $employee['reportsTo'],
      'jobTitle' => $employee['jobTitle']
    ], ['employeeNumber' => $employeeNumber]);

    if (!is_null($this->db->error()[1])) {
      return array(
        'success' => false,
        'description' => $this->db->error()[2]
      );
    }

    return array(
      'success' => true,
      'description' => 'The employee was updated'
    );
  }

}

?>