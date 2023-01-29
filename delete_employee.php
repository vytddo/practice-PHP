<?php
require_once('database.php');

// Get IDs
$emp_id = filter_input(INPUT_POST, 'emp_id', FILTER_VALIDATE_INT);

// Delete the product from the database
if ($emp_id != FALSE) {
    $query = 'DELETE FROM Employees
              WHERE empid = :emp_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':emp_id', $emp_id);
    $success = $statement->execute();
    $statement->closeCursor();    
}

$query = 'SELECT * FROM Employees
          ORDER BY empid';
$statement = $db->prepare($query);
$statement->execute();
$employees = $statement->fetchAll();
$statement->closeCursor();
//include('index.php');
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
                <td><form action="delete_employee.php" method="post">
                    <input type="hidden" name="emp_id"
                           value="<?php echo $employee['empid']; ?>">
                    <input type="submit" value="Delete">
                    </form>
                </td>
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