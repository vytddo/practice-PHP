<?php
require_once('database.php');

// Get category ID
if (!isset($emp_id)) {
    $emp_id = filter_input(INPUT_GET, 'emp_id', FILTER_VALIDATE_INT);
    if ($emp_id == NULL || $emp_id == FALSE) {
        $emp_id = 1;
    }
}

$query = 'SELECT * FROM Employees
          ORDER BY empid';
$statement = $db->prepare($query);
$statement->execute();
$employees = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Employee</title>
    <link rel="stylesheet" href="main.css" />
</head>

<!-- the body section -->
<body>

<main>
    <h1>Employee List</h1>

    <aside>
        <p><a href="index.php">View Employees</a></p>
        <p><a href="delete_employee.php">Delete Employees</a></p>
        <p><a href="add_employee.php">Add Employees</a></p>

    </aside>

    <section>
        <table>
            <tr>
                <th>Employee ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th class="right">Salary</th>
                <th>&nbsp;</th>
            </tr>

            <?php foreach ($employees as $employee) : ?>
            <tr>
                <td><?php echo $employee['empid']; ?></td>
                <td><?php echo $employee['fname']; ?></td>
                <td><?php echo $employee['lname']; ?></td>
                <td class="right"><?php echo $employee['salary']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
              
    </section>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> My Employee, Inc.</p>
</footer>
</body>
</html>