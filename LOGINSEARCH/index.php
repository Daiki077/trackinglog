<?php require_once 'core/dbonfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<?php if (!isset($_SESSION['Username'])) {
	header("Location: login.php");
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<style>
   body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: black; 
            color: white; 
            text-align: center; 
   }
        h1, h2 {
            margin: 20px 0;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"] {
            width: 80%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #218838; 
        }

        a {
            color: #007bff;
            text-decoration: none;
            margin: 0 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #1a1a1a; 
        }

        th, td {
            padding: 10px;
            border: 1px solid #444; 
            text-align: left;
            color: white;
        }

        th {
            background-color: #333;
        }

        tr:nth-child(even) {
            background-color: #222; 
        }

        tr:hover {
            background-color: #444; 
        }
</style>
<?php if (isset($_SESSION['message'])) { ?>
    <h1 style="color: green; text-align: center; background-color: ghostwhite; border-style: solid;">    
        <?php echo $_SESSION['message']; ?>
    </h1>
<?php } unset($_SESSION['message']); ?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET">
    <input type="text" name="searchInput" placeholder="Search here">
    <input type="submit" name="searchBtn">

    <h1 >USER:<?php echo $_SESSION['Username']; ?></h1>
</form>
<a href="index.php">Clear search query</a>
<a href="insert.php">Insert query here</a>
<a href = "auditlog.php">Audit logs </a>
<a href="?logout=true">Log out</a>
<table>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Position</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Home Address</th>
        <th>Nationality</th>
        <th>Date Added</th>
        <th>Edit / Delete</th>
    </tr>

<?php 
if (!isset($_GET['searchBtn'])) {
    $getallappli = getallappli($pdo);
    foreach ($getallappli as $row) { ?>
        <tr>
        <td><?php echo $row['job_id']; ?></td>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
            <td><?php echo $row['position']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['home_address']; ?></td>
            <td><?php echo $row['nationality']; ?></td>
            <td><?php echo $row['date_added']; ?></td>
            <td>
                <a href="edit.php?job_id=<?php echo $row['job_id']; ?>">Edit</a>
                <a href="delete.php?job_id=<?php echo $row['job_id']; ?>">Delete</a>
            </td>
        </tr>
    <?php }
} else {
    $searchforappli = searchforappli($pdo, $_GET['searchInput']);
    foreach ($searchforappli as $row) { ?>
        <tr>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
            <td><?php echo $row['position']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['home_address']; ?></td>
            <td><?php echo $row['nationality']; ?></td>
            <td><?php echo $row['date_added']; ?></td>
            <td>
                <a href="edit.php?job_id=<?php echo $row['job_id']; ?>">Edit</a>
                <a href="delete.php?job_id=<?php echo $row['job_id']; ?>">Delete</a>
            </td>
        </tr>
    <?php }
} ?>
</table>
</body>
</html>