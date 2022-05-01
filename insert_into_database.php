<?php

require_once('include/db.php');

if (isset($_POST['submit'])) {
    if (!empty($_POST['ename']) && !empty($_POST['ssn'])) {
        $ename = $_POST['ename'];
        $ssn = $_POST['ssn'];
        $department = $_POST['department'];
        $salary = $_POST['salary'];
        $haddress = $_POST['haddress'];
        global $connectDb;
        $sql = "INSERT INTO employees(ename, ssn, department, salary, haddress) VALUES (:ename, :ssn, :department, :salary, :haddress)";

        $sth = $connectDb->prepare($sql);
        $sth->bindValue(':ename', $ename);
        $sth->bindValue(':ssn', $ssn);
        $sth->bindValue(':department', $department);
        $sth->bindValue(':salary', $salary);
        $sth->bindValue(':haddress', $haddress);
        $excute = $sth->execute();

        if ($excute) {
            echo '<div class="container mt-3">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-center align-items-center">
                            <span class="alert alert-success">Record has been added successfully.</span>
                        </div>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo '<div class="container mt-3">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="alert alert-danger">Please add at least Employee name and Social security number.</span>
                    </div>
                </div>
            </div>
        </div>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/bootstrap.min.css">
    <title>Insert Data Into Database</title>
</head>
<body>

    <div class="container mt-1">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <form action="insert_into_database.php" method="POST">
                            <div class="form-group mb-2">
                                <label for="ename">Employee Name:</label>
                                <input type="text" name="ename" id="ename" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label for="ssn">Social Security Number:</label>
                                <input type="text" name="ssn" id="ssn" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label for="department">Department:</label>
                                <input type="text" name="department" id="department" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label for="salary">Salary:</label>
                                <input type="text" name="salary" id="salary" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label for="haddress">Home Address:</label>
                                <textarea name="haddress" id="haddress" rows="10" class="form-control"></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit your record</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="asset/bootstrap.bundle.min.js"></script>
</body>
</html>
