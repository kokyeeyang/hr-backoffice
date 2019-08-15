<?php 

  // public function actionShowCandidateInformation(){
    $candidateName = intval($_GET['query']);

    $sql = 'SELECT ' . 'full_name, id_no, address, contact_no, email_address, date_of_birth, gender, marital_status, nationality ';
    $sql .= 'FROM ' . 'employment_candidate';
    $sql .= 'WHERE ' . 'full_name = ' . '"' . $candidateName . '"';
    $objConnection  = Yii::app()->db;
    $objCommand   = $objConnection->createCommand($sql);
    $arrData    = $objCommand->queryRow();

    if (!empty($arrData['full_name, id_no, address, contact_no, email_address, date_of_birth, gender, job_title, marital_status, nationality'])){
      echo "<table>
      <tr>
      <th>Full name</th>
      <th>ID No</th>
      <th>Address</th>
      <th>Contact No</th>
      <th>Email address</th>
      <th>Date of birth</th>
      <th>Gender</th>
      <th>Job title</th>
      <th>Marital status</th>
      <th>Nationality</th>
      ";
      while ($row = $arrData){
        echo "<tr>";
        echo "<td>" . $row['full_name'] . "</td>";
      }
      echo "</table>";
    } else {
      return 'no data found';
    }
  // }
