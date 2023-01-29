<?php
require_once('database.php');
// Get the product data
$emp_id = filter_input(INPUT_POST, 'emp_id', FILTER_VALIDATE_INT);
$fname = filter_input(INPUT_POST, 'fname');
$lname = filter_input(INPUT_POST, 'lname');
$salary = filter_input(INPUT_POST, 'salary', FILTER_VALIDATE_FLOAT);

$query = 'SELECT * FROM Employees
          ORDER BY empid';
$statement = $db->prepare($query);
$statement->execute();
$employees = $statement->fetchAll();
$statement->closeCursor();

$queryInsert = 'INSERT INTO Employees
               (empid, fname, lname, salary)
               VALUES
                  (:emp_id, :fname, :lname, :salary)';
$statement1 = $db->prepare($queryInsert);
$statement1->bindValue(':emp_id', $emp_id);
$statement1->bindValue(':fname', $fname);
$statement1->bindValue(':lname', $lname);
$statement1->bindValue(':salary', $salary);
//$statement1->execute();
//$statement1->closeCursor();

  
    //include('index.php');

?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Employee</title>
    <link rel="stylesheet" href="main.css">
</head>

<!-- the body section -->
<body>
   

    <main>
        <h1>Add Employee</h1>
        <form action="add_employee.php" method="post" id="add_employee_form">

            <label>Employees:</label>
            

            <label>ID:</label>
            <input type="text" name="empid"><br>

            <label>First Name:</label>
            <input type="text" name="fname"><br>

            <label>Last Name:</label>
            <input type="text" name="lname"><br>
            
            <label>Salary:</label>
            <input type="text" name="salary"><br>

            <label>&nbsp;</label>
            <input type="submit" value="Add Employee"><br>
        </form>
        <p><a href="index.php">View Employee List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Employee, Inc.</p>
    </footer>
</body>
</html>