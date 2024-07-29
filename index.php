<?php

include "config/config.php";

$config = new Config();

$res_conn = $config->connect();


// $_GET  => Superglobal Variable => Associative Array => JSON DATA (Key & value pair)
// $_POST  => Superglobal Variable => Associative Array
// $_REQUEST  => Superglobal Variable => Associative Array

// isset() => To check any Varible  => true/false => return bool

$fetch_students_res = $config->fetchAllStudents();


if (isset($_REQUEST['btn_submit'])) {

    $name = $_REQUEST['name'];
    $age = $_REQUEST['age'];
    $course = $_REQUEST['course'];

    $res = $config->insertStudent($name, $age, $course);

    if ($res) {

        echo '<div class="container pt-5"> <div class="col col-8"><div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success !</strong> Record Insetred Successfully...
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div><div><div>';


    } else {
        echo '<div class="container pt-5"> <div class="col col-8"><div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Faield !</strong> Record insertion Faield...
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div><div><div>';
    }
}



if (isset($_REQUEST['btn_delete'])) {

    $id = $_REQUEST['delete_id'];


    $res = $config->deleteStudent($id);

    if ($res) {

        echo '<div class="container pt-5"> <div class="col col-8"><div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success !</strong> Record Deleted Successfully...
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div><div><div>';


    } else {
        echo '<div class="container pt-5"> <div class="col col-8"><div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Faield !</strong> Record Deletion Faield...
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div><div><div>';
    }
}

$result = null;

if (isset($_REQUEST['btn_edit'])) {

    $id = $_REQUEST['update_id'];


    $res = $config->fetchSingleStudent($id);

    $result = mysqli_fetch_assoc($res);

}

if (isset($_REQUEST['btn_update'])) {
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $age = $_REQUEST['age'];
    $course = $_REQUEST['course'];

    $res = $config->updateStudent($name, $age, $course, $id);

    if ($res) {

        echo '<div class="container pt-5"> <div class="col col-8"><div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success !</strong> Record Updated Successfully...
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div><div><div>';


    } else {
        echo '<div class="container pt-5"> <div class="col col-8"><div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Faield !</strong> Record Updation Faield...
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div><div><div>';
    }
}






?>


<!DOCTYPE html>
<html>
    <head>
        <title>Home Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
       <div class="container pt-5">
            <div class="col col-4">
                <h2>Student Insert Data</h2>

                <br>
                <br>

                <form action="" method="POST"> 
                    <input type="hidden" name="id" value="<?php if ($result != null) {
                        echo $result['id'];
                    } ?>">
                    Name: <input type="text"  class="form-control" name="name" value="<?php if ($result != null) {
                        echo $result['name'];
                    } ?>" /> <br /><br />
                    Age: <input type="number" class="form-control"  name="age" value="<?php if ($result != null) {
                        echo $result['age'];
                    } ?>"/> <br /><br />
                    Course: <input type="text" class="form-control"  name="course"  value="<?php if ($result != null) {
                        echo $result['course'];
                    } ?>"/><br /><br />

                    <button name="<?php if ($result == null) {
                        echo "btn_submit";
                    } else {
                        echo "btn_update";
                    } ?>" class="btn <?php if ($result != null) {
                         echo "btn-warning";
                     } else {
                         echo "btn-primary";
                     } ?>"> 
                        <?php if ($result == null) { ?>
                                                        ADD Student 
                        <?php } else { ?> 
                                                        Update Student 
                        <?php } ?> </button>
                </form>

                <br>
                <br>
                <br>

                <table class="table table-hover table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>AGE</th>
                            <th>COURSE</th>
                            <th colspan="2">ACTION</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">

                        <?php while ($result = mysqli_fetch_assoc($fetch_students_res)) { ?>
                                                                                        <tr>
                                                                                            <td><?php echo $result['id'] ?></td>
                                                                                            <td><?php echo $result['name'] ?></td>
                                                                                            <td><?php echo $result['age'] ?></td>
                                                                                            <td><?php echo $result['course'] ?></td>
                                                                                            <form action="" method="POST">
                                                                                                <input type="hidden" name="update_id" value="<?php echo $result['id'] ?>">
                                                                                                <td><button class="btn btn-warning" name="btn_edit">Edit</button></td>
                                                                                            </form>
                                                                                            <form action="" method="POST">
                                                                                                <input type="hidden" name="delete_id" value="<?php echo $result['id'] ?>">
                                                                                                <td><button class="btn btn-danger" name="btn_delete">Delete</button></td> 
                                                                                            </form>
                                                                                        </tr>
 
                        <?php } ?>

                    </tbody>
                </table>
            </div>
       </div>

       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </body>
</html>