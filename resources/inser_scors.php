<?php
require_once("config.php");

$date = $_POST["monthly"];
$monthly = date('Y-m', strtotime($date));
$query = query("SELECT * FROM category_name");
confirm($query);
$query2 = query("SELECT * FROM student_name");
confirm($query2);
$query_sb = query("SELECT * FROM tbl_category_sb");
confirm($query_sb);


$result = '';
$result .= '
<table class="table table-striped">
    <thead>
    <tr> ';
while ($row = fetch_array($query)) {
    $result .= '
        <th>' . $row['txt'] . '</th>

     ';
}
while ($row = fetch_array($query_sb)) {

    $result .= '
        <th>' . $row['sb_name'] . '</th>

     ';
}
$result .= '
    </tr>
    </thead>
    <tbody>

    ';
while ($row = fetch_array($query2)) {
    $sdid = $row['student_id'];

    $result .= '
        <tr>
        <td> ' . $row['student_id'] . '</td>
        <td>' . $row['student_name'] . '</td>
        <td> ' . $row['dob'] . '</td>
        <td> ' . $row['sex'] . '</td>
        <td> ' . $row['phone'] . '</td>

     ';

    $tbl_monthly_score = query("SELECT * FROM tbl_monthly_score WHERE student_id= '$sdid' and monthly= '$monthly'");
    confirm($tbl_monthly_score);
    while ($row = fetch_array($tbl_monthly_score)) {
        $sdidd = $row['score'];

        $result .= '
        <td> <span class="labelth" style="background-color: '.show_color_subject($row['sb_id']) .'">' .  $sdidd . '</span></td>

      ';
    }
}

$result .= '
    </tr>
    </tbody>
    </table>
    <hr>
    <div align="center">
      <a class="btn btn-info" href="itemth?editscore&date='.$monthly.'">កែប្រែ</a>
    </div>
    <hr>
    ';


echo $result;
