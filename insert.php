<?php 
session_start();
$hostname_surachet = "localhost";
$database_surachet = "***";
$username_surachet = "***";
$password_surachet = "***";

$surachet = mysql_pconnect($hostname_surachet, $username_surachet, $password_surachet) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_surachet, $surachet);

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["InsertNewStudent"] == "Yes"){
  $checkboxItems = $_POST;
  unset($checkboxItems['sid']);
  unset($checkboxItems['fname']);
  unset($checkboxItems['lname']);
  unset($checkboxItems['InsertNewStudent']);

  $sid = $_POST['sid'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];

  $sql_insert_student = "insert into tbl_student (SID, fname, lname) values($sid, '$fname', '$lname');";
  $query_insert_student = mysql_db_query($database_surachet, $sql_insert_student)or die(mysql_error());

  foreach(array_keys($checkboxItems) as $value){
    $sql_insert_register = "insert into tbl_register (SID, Subid) values($sid, $value)";
    $query_insert_register = mysql_db_query($database_surachet, $sql_insert_register) or die (mysql_error());
  }
  header("location:/register/");
}

$sql_subject = "select * from tbl_subject";
$query_subject = mysql_query($sql_subject, $surachet) or die(mysql_error());
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Kanit&amp;display=swap" rel="stylesheet">
  <title>ระบบลงทะเบียนนักศึกษา - เพิ่มนักศึกษา</title>
  <style>
    *{
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
              <a class="nav-link active" href="insert.php">เพิ่มนักศึกษา</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="insertsub.php">เพิ่มรายวิชา</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" name="" class="mx-auto" style="max-width: 700px; width: 100%;">
      <h4>เพิ่มนักศึกษา</h4>
      <div class="mt-3">
        <label class="row p-0">
          <span class="col-3">รหัสนักศึกษา</span>
          <input class="col-9 p-0" type="number" name="sid" value="" required>
        </label>
      </div>
      <div>
        <label class="row p-0 mt-3">
          <span class="col-3">ชื่อจริง</span>
          <input class="col-9 p-0" type="text" value="" name="fname" required>
        </label>
      </div>
      <div>
        <label class="row p-0 mt-3">
          <span class="col-3">นามสกุล</span>
          <input class="col-9 p-0" type="text" value="" name="lname" required>
        </label>
      </div>
      <h4 class="mt-3">ลงทะเบียนรายวิชา</h4>
      <div class="mt-3">
        <div>
            <input class="w-100 p-2" type="text" id="filterInput" placeholder="ค้นหาวิชา...">
        </div>
        <div id="group-items" class="d-flex gap-1 flex-wrap mt-3 overflow-scroll border border-dark rounded-2 p-2" style="max-height: 400px; height: auto">
          <?php while($data = mysql_fetch_array($query_subject)) { ?>
          <label class="itemcheckbox border border-dark rounded-2 p-2 d-flex align-items-center gap-1">
            <input type="checkbox" name="<?php echo $data["Subid"] ?>">
            <span><?php echo $data["subjectname"] ?></span>
          </label>
          <?php } ?>
        </div>
      </div>
      <div class="row mt-3">
        <div class="d-flex justify-content-end gap-2 p-0">
          <input type="hidden" name="InsertNewStudent" value="Yes">
          <input class="btn btn-danger" type="reset" value="รีเซ็ต">
          <input class="btn btn-success" type="submit" value="ยืนยัน">
        </div>
      </div>
    </form>
  </div>

  <script>
    const items = document.querySelectorAll('.itemcheckbox');
    const filterInput = document.getElementById('filterInput');

    filterInput.addEventListener('keyup', () => {
      Array.from(items).filter((item) => item.classList.contains('d-none')).forEach((item) => item.classList.remove('d-none'))

      if((filterInput.value).length !== 0){
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