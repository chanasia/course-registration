<?php
$hostname_surachet = "localhost";
$database_surachet = "***";
$username_surachet = "***";
$password_surachet = "***";

$surachet = mysql_pconnect($hostname_surachet, $username_surachet, $password_surachet) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_surachet, $surachet);

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["InsertNewSubject"] == "Yes"){
  $subid = $_POST["subid"];
  $subjectname = $_POST["subjectname"];

  $sql = "insert into tbl_subject (subid, subjectname) values($subid, '$subjectname')";
  $dbquery = mysql_db_query($database_surachet, $sql)or die(mysql_error());

  header("location:/register/subject.php");
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
  <title>ระบบลงทะเบียนนักศึกษา - เพิ่มรายวิชา</title>
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
              <a class="nav-link active" href="insertsub.php">เพิ่มรายวิชา</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="mt-3 mx-auto" style="max-width: 700px; width: 100%;">
      <h4>เพิ่มรายวิชา</h4>
    </div>

    <form class="mt-3 mx-auto" style="max-width: 700px; width: 100%;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="" method="POST"  name="">
      <div>
        <label class="row p-0">
          <span class="col-3">รหัสวิชา</span>
          <input class="col-9 p-0" type="number" name="subid" required>
        </label>
      </div>
      <div>
        <label class="row mt-3">
          <span class="col-3">ชื่อวิชา</span>
          <input class="col-9 p-0" type="text" name="subjectname" required>
        </label>
      </div>
      <div class="row mt-3">
        <div class="d-flex justify-content-end gap-2 p-0">
          <input type="hidden" name="InsertNewSubject" value="Yes">
          <input class="btn btn-danger" type="reset" value="รีเซ็ต">
          <input class="btn btn-success" type="submit" value="ยืนยัน">
        </div>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>