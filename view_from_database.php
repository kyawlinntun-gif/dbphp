<?php

require_once('include/db.php');

global $connectDb;

$sql = "SELECT * FROM employees";

$sth = $connectDb->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/bootstrap.min.css">
    <title>View Data From Database</title>
</head>

<body>

    <?php
    if (@$_GET['info']) {
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
    ?>

    <?php
    if (isset($_GET['searchButton'])) {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $sql = "SELECT * FROM employees WHERE ename LIKE :search";
            $sth = $connectDb->prepare($sql);
            $sth->bindValue(':search', '%' . $search . '%');
            $sth->execute();
        }
    }
    ?>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="d-flex" action="view_from_database.php" method="GET">
                            <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="search">
                            <button class="btn btn-outline-success" type="submit" name="searchButton">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h1><a href="view_from_database.php" class="text-decoration-none text-black">Employees Table</a></h1>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Employee Name</th>
                                    <th>Social Security Number</th>
                                    <th>Department</th>
                                    <th>Salary</th>
                                    <th>Home Address</th>
                                    <th colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($employee = $sth->fetch()) { ?>
                                    <tr>
                                        <td><?php echo $employee['id']; ?></td>
                                        <td><?php echo $employee['ename']; ?></td>
                                        <td><?php echo $employee['ssn']; ?></td>
                                        <td><?php echo $employee['department']; ?></td>
                                        <td><?php echo $employee['salary']; ?></td>
                                        <td><?php echo $employee['haddress']; ?></td>
                                        <td><a href="update.php?id=<?php echo $employee['id']; ?>" class="btn btn-success">Update</a></td>
                                        <td><a href="delete.php?id=<?php echo $employee['id']; ?>" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="asset/bootstrap.bundle.min.js"></script>
</body>

</html>
