<?php 
    session_start();
    require 'config.php';

    $query = "SELECT * FROM cars ORDER BY id";
    $result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

<table border="1">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>km</th>
        <th>hp</th>
        <th>edit</th>
        <th>remove</th>
        <th>image</th>
        <th>detail</th>
    </tr>
<?php
    while ($row = mysqli_fetch_array($result))
    {
    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['km'] . "</td><td>" . $row['hp'] . "</td>";
    echo "<td> <a href='edit.php?id=" .$row['id']."'>edit</a> </td>";
    echo "<td> <a href='remove.php?id=" .$row['id']."'>remove</a> </td>";
    echo "<td> <a href='image.php?id=" .$row['id']."'>image</a> </td>";
    echo "<td> <a href='detail.php?id=" .$row['id']."'>detail</a> </td>";
    echo "</tr>";
    }
?>
</table>

<a href="logout.php">logout</a>

</body>
</html>