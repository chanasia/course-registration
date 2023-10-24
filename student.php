<?php
session_start();
$hostname_surachet = "localhost";
$database_surachet = "***";
$username_surachet = "***";
$password_surachet = "***";

$surachet = mysql_pconnect($hostname_surachet, $username_surachet, $password_surachet) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_surachet, $surachet);

$sid = $_GET['sid'];
$sql_subname = "SELECT tbl_subject.Subid, tbl_subject.subjectname from tbl_student INNER JOIN tbl_register ON tbl_student.SID = tbl_register.SID INNER JOIN tbl_subject ON tbl_register.Subid = tbl_subject.Subid WHERE tbl_student.SID = " . $sid;
$sql_sname = "select fname, lname from tbl_student where sid = ". $sid;

$query_subname = mysql_query($sql_subname, $surachet) or die(mysql_error());
$query_sname = mysql_query($sql_sname, $surachet) or die(mysql_error());

$fname = "";
$lname = "";

while($data = mysql_fetch_array($query_sname)) { 
  $fname = $data['fname'];
  $lname = $data['lname'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Kanit&amp;display=swap" rel="stylesheet">
  <title>ระบบลงทะเบียนนักศึกษา - รายวิชาของนักศึกษา</title>
  <style>
    *{
      font-family: 'Kanit', sans-serif !important;
    }
  </style>
</head>
<body>
  <div class="container">
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">ระบบลงทะเบียนนักศึกษา</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/register/">รายชื่อนักศึกษา</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="subject.php">รายวิชา</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="insert.php">เพิ่มนักศึกษา</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="insertsub.php">เพิ่มรายวิชา</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="row">
      <div class="col-10">
        <h4>รายวิชาของนักศึกษา</h4>
      </div>
      <div class="col-2 d-flex justify-content-end">
        <a href="/register/" class="text-decoration-none text-black p-2 border border-dark rounded-2">ย้อนกลับ</a>
      </div>
    </div>
  <div class="row mt-3">
    <div class="col-9 d-flex align-items-center">
      <h5><?php echo "ชื่อ " . $fname . " " . $lname . " รหัส " . $sid;?></h5>
    </div>
    <div class="col-3 d-flex justify-content-end gap-2">
      <a href="studentedit.php?sid=<?php echo $sid ?>" style="cursor: pointer;" class="p-2 border border-dark rounded-2 d-flex justify-content-center align-items-center">
        <svg width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg>
      </a>
      <div style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal" class="p-2 border border-dark rounded-2 d-flex justify-content-center align-items-center">
        <svg width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
      </div>
    </div>
  </div>

    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">รหัสวิชา</th>
          <th scope="col">ชื่อวิชา</th>
        </tr>
      </thead>
      <tbody>
      <?php while($data = mysql_fetch_array($query_subname)) { ?>
        <tr>
          <td><?php echo $data['Subid'] ?></td>
          <td><?php echo $data['subjectname']?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <!-- Modal del -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">ระบบลงทะเบียน</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ลบ <?php echo $fname . " " . $lname; ?> ออกจากระบบหรือไม่
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ไม่</button>
          <a href="studentdel.php?sid=<?php echo $sid ?>" type="button" class="btn btn-danger">ยืนยัน</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>
