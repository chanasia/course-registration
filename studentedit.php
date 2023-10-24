<?php
session_start();
$hostname_surachet = "localhost";
$database_surachet = "***";
$username_surachet = "***";
$password_surachet = "***";

$surachet = mysql_pconnect($hostname_surachet, $username_surachet, $password_surachet) or trigger_error(mysql_error(), E_USER_ERROR);
mysql_select_db($database_surachet, $surachet);

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["EditStudent"] == "Yes"){
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $sid = $_POST['sid'];

  $sql_student_update = "UPDATE tbl_student SET fname='$fname', lname='$lname' WHERE sid='$sid'";
  $query_student_update =  mysql_db_query($database_surachet, $sql_student_update) or die(mysql_error());

  $sql_register_delete = "delete from tbl_register where sid = " . $sid;
  $query_student_update =  mysql_db_query($database_surachet, $sql_register_delete) or die(mysql_error());

  $checkboxItems = $_POST;
  unset($checkboxItems['sid']);
  unset($checkboxItems['fname']);
  unset($checkboxItems['lname']);
  unset($checkboxItems['EditStudent']);

  foreach(array_keys($checkboxItems) as $value){
    $sql_insert_register = "insert into tbl_register (SID, Subid) values($sid, $value)";
    $query_insert_register = mysql_db_query($database_surachet, $sql_insert_register) or die (mysql_error());
  }

  header("location:/register/student.php?sid=$sid");
}

$sid = $_GET['sid'];

$sql_subject = "select * from tbl_subject";
$query_subject = mysql_query($sql_subject, $surachet) or die(mysql_error());

$sql_student = "select fname, lname from tbl_student where sid = ". $sid;;
$query_student = mysql_query($sql_student, $surachet) or die(mysql_error());

$fname = "";
$lname = "";

while($data = mysql_fetch_array($query_student)) { 
  $fname = $data['fname'];
  $lname = $data['lname'];
}

$sql_register = "select subid from `tbl_register` where sid = $sid";
$query_register = mysql_query($sql_register, $surachet) or die(mysql_error());

$item_checked = array();

while ($row = mysql_fetch_array($query_register)) {
  $item_checked[] = $row['subid'];
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
  <title>ระบบลงทะเบียนนักศึกษา - แก้ไขนักศึกษา</title>
  <style>
    * {
      font-family: 'Kanit', sans-serif !important;
    }
  </style>
</head>

<body>
  <div class="container p-0">
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

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="" class="mx-auto" style="max-width: 700px; width: 100%;">
      <div class="row mt-3 mx-auto p-0" style="max-width: 700px; width: 100%;">
        <div class="col-10 p-0 d-flex align-items-center">
          <h4 class="m-0">แก้ไขนักศึกษา</h4>
        </div>
        <div class="col-2 d-flex justify-content-end p-0">
          <a href="/register/student.php?sid=<?php echo $sid ?>" class="text-decoration-none text-black p-2 border border-dark rounded-2">ย้อนกลับ</a>
        </div>
      </div>
      <div class="mt-3">
        <label class="row p-0">
          <span class="col-3">รหัสนักศึกษา</span>
          <input class="col-9 p-0" type="number" name="sid" value="<?php echo $sid ?>" required readonly>
        </label>
      </div>
      <div>
        <label class="row p-0 mt-3">
          <span class="col-3">ชื่อจริง</span>
          <input class="col-9 p-0" type="text" value="<?php echo $fname ?>" name="fname" required>
        </label>
      </div>
      <div>
        <label class="row p-0 mt-3">
          <span class="col-3">นามสกุล</span>
          <input class="col-9 p-0" type="text" value="<?php echo $lname ?>" name="lname" required>
        </label>
      </div>
      <h4 class="mt-3">ลงทะเบียนรายวิชา</h4>
      <div class="mt-3">
        <div>
          <input class="w-100 p-2" type="text" id="filterInput" placeholder="ค้นหาวิชา...">
        </div>
        <div id="group-items" class="d-flex gap-1 flex-wrap mt-3 overflow-scroll border border-dark rounded-2 p-2" style="max-height: 400px; height: auto">
          <?php while ($data = mysql_fetch_array($query_subject)) { ?>
            <label class="itemcheckbox border border-dark rounded-2 p-2 d-flex align-items-center gap-1">
              <input type="checkbox" name="<?php echo $data["Subid"] ?>" <?php if(in_array($data['Subid'], $item_checked)) { echo "checked"; } ?>>
              <span><?php echo $data["subjectname"] ?></span>
            </label>
          <?php } ?>
        </div>
      </div>
      <div class="row mt-3">
        <div class="d-flex justify-content-end gap-2 p-0">
          <input type="hidden" name="EditStudent" value="Yes">
          <input class="btn btn-danger" type="reset" value="รีเซ็ต">
          <input class="btn btn-success" type="submit" value="ยืนยัน">
        </div>
      </div>
    </form>
  </div>

  </div>
  <script>
    const items = document.querySelectorAll('.itemcheckbox');
    const filterInput = document.getElementById('filterInput');

    filterInput.addEventListener('keyup', () => {
      Array.from(items).filter((item) => item.classList.contains('d-none')).forEach((item) => item.classList.remove('d-none'))

      if ((filterInput.value).length !== 0) {
        const filteredItems = Array.from(items).filter(item => !(item.textContent.includes(filterInput.value)));
        filteredItems.forEach((item) => {
          item.classList.add("d-none")
        })
      }
    })
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>