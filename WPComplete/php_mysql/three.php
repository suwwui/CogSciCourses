<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "courses";

$connect = mysqli_connect($host, $user, $pass, $db);
if (!$connect) { //check connection
    die("Could not connect to database");
}
$code = "";
$subject = "";
$credit = "";
$status = "";
$success = "";
$error = "";

if(isset($_GET['op'])){
    $op = $_GET['op'];
} else{
    $op = "";
}
if($op == 'delete'){
    $id = $_GET['id'];
    $sql1 = "delete from y2s1 where id = '$id'";
    $q1 = mysqli_query($connect, $sql1);
    if($q1){
        $success = "Data has been deleted successfully";
    }else{
        $error = "Failed to delete data";
    }
}

if($op == 'edit'){
    $id = $_GET['id'];
    $sql1 = "select * from y2s1 where id = '$id'";
    $q1 = mysqli_query($connect, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $code = $r1['code'];
    $subject = $r1['subject'];
    $credit = $r1['credit'];
    $status = $r1['status'];

    if($code == ''){
        $error = "Data could not be found";
    }

}
if (isset($_POST['save'])) { // to create new data
    $code = $_POST['code'];
    $subject = $_POST['subject'];
    $credit = $_POST['credit'];
    $status = $_POST['status'];

    if ($code && $subject && $credit && $status) {
        if($op == 'edit'){ //update data
            $sql1 = "update y2s1 set code = '$code', subject = '$subject', credit = '$credit', status = '$status' where id = '$id'";
            $q1 = mysqli_query($connect, $sql1);
            if($q1){
                $success = "Data has been updated successfully";
            }else{
                $error = "Data update failed";
            }
        } else { //insert
            $sql1 = "insert into y2s1(code,subject,credit,status) values('$code','$subject','$credit','$status')";
        $q1 = mysqli_query($connect, $sql1);
        if ($q1) {
            $success = "Successfully inserted new data";
        } else {
            $error = "Failed to insert new data";
        }
    }
        
} else {
    $error = "Please insert all of the data";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px
        }
    </style>
</head>

<body>
    <!-- Start: Component NavBar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../assets/unimasidentity.png" alt="" width=auto height="60" class="me-2">
                <strong>CSCOS</strong> Course Offer System <strong>(CSCOS)</strong>
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav" id="navbarNavDarkDropdown">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../pages/homepage.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../pages/about.html">About</a>
              </li>
            </ul>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Courses
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                  <li><a class="dropdown-item" href="../pages/year1.html">Year 1</a></li>
                  <li><a class="dropdown-item" href="../pages/year2.html">Year 2</a></li>
                  <li><a class="dropdown-item" href="../pages/year3.html">Year 3</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End: Component NavBar -->

    <div class="mx-auto">
       <figure class="text-center mt-3"> 
          <h3>Year 2 - Semester 1</h3>
          <p>Please enter courses offered this year</p>
       </figure>
       <a class="btn btn-primary" href="../pages/year2.html" role="button">Back</a>
        <!-- to insert data -->
        <div class="card">
            <div class="card-header">
                Add New Course
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=three.php"); // 5 seconds
                }
                ?>
                <?php
                if ($success) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success ?>
                    </div>
                <?php
                    header("refresh:5;url=three.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="code" class="col-sm-2-col-form-label">Course Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="code" name="code" value="<?php echo $code ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="subject" class="col-sm-2-col-form-label">Subject Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $subject ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="credit" class="col-sm-2-col-form-label">Credit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="credit" name="credit" value="<?php echo $credit ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="status" class="col-sm-2-col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="status" id="status">
                                <option value=""> Select Status</option>
                                <option value="KT" <?php if ($status == "KT") echo "selected" ?>>KT</option>
                                <option value="KU" <?php if ($status == "KU") echo "selected" ?>>KU</option>
                                <option value="KE" <?php if ($status == "KE") echo "selected" ?>>KE</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="save" value="Save Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- to view data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Course Data
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Course Code</th>
                            <th scope="col">Subject Name</th>
                            <th scope="col">Credit</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2 = "select * from y2s1 order by id desc";
                        $q2 = mysqli_query($connect, $sql2);
                        $count = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['id'];
                            $code = $r2['code'];
                            $subject = $r2['subject'];
                            $credit = $r2['credit'];
                            $status = $r2['status'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $count++ ?></th>
                                <td scope="row"><?php echo $code ?></td>
                                <td scope="row"><?php echo $subject ?></td>
                                <td scope="row"><?php echo $credit ?></td>
                                <td scope="row"><?php echo $status ?></td>
                                <td scope="row">
                                    <a href="three.php?op=edit&id=<?php echo $id?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="three.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Are you sure you want to delete this data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                    
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

</html>