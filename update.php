<?php

require_once('include/db.php');

$id = $_GET['id'];

if (isset($_POST['submit'])) {
    if ($_GET['id']) {
        if (!empty($_POST['ename']) && !empty($_POST['ssn'])) {
            $ename = $_POST['ename'];
            $ssn = $_POST['ssn'];
            $department = $_POST['department'];
            $salary = $_POST['salary'];
            $haddress = $_POST['haddress'];

            global $connectDb;

            $data = [
                'ename' => $ename,
                'ssn' => $ssn,
                'department' => $department,
                'salary' => $salary,
                'haddress' => $haddress,
                'id' => $_GET['id']
            ];

            $sql = "UPDATE employees SET ename=:ename, ssn=:ssn, department=:department, salary=:salary, haddress=:haddress WHERE id=:id";
    
            $sth = $connectDb->prepare($sql);
            $excute = $sth->execute($data);
    
            if ($excute) {
                echo '<script>window.open("view_from_database.php?info=Record was updated successfully.", "_self")</script>';
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
}

global $connectDb;

$sql = "SELECT * FROM employees WHERE id='$id'";

$sth = $connectDb->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/bootstrap.min.css">
    <title>Update Data From Database</title>
</head>
<body>

    <div class="container mt-1">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <?php while ($employee=$sth->fetch()) { ?>
                            <form action="update.php?id=<?php echo $id; ?>" method="POST">
                                <div class="form-group mb-2">
                                    <label for="ename">Employee Name:</label>
                                    <input type="text" name="ename" id="ename" class="form-control" value="<?php echo $employee['ename']; ?>">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="ssn">Social Security Number:</label>
                                    <input type="text" name="ssn" id="ssn" class="form-control" value="<?php echo $employee['ssn']; ?>">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="department">Department:</label>
                                    <input type="text" name="department" id="department" class="form-control" value="<?php echo $employee['department']; ?>">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="salary">Salary:</label>
                                    <input type="text" name="salary" id="salary" class="form-control" value="<?php echo $employee['salary']; ?>">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="haddress">Home Address:</label>
                                    <textarea name="haddress" id="haddress" rows="10" class="form-control"><?php echo $employee['haddress']; ?></textarea>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Submit your record</button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="asset/bootstrap.bundle.min.js"></script>
</body>
</html>
