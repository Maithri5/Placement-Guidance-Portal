<?php
include "notesdb.php";

if(!isset($_GET['year'])){
    die("Year not found");
}

$year_id = $_GET['year'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Branches</title>
  <link rel="stylesheet" href="globalstyle.css">
</head>
<body>

<h1>Select Branch</h1>

<?php
$result = mysqli_query($conn, "SELECT * FROM branches WHERE year_id=$year_id");

while($row = mysqli_fetch_assoc($result)){
?>
  <a href="subjects.php?branch=<?php echo $row['branch_id']; ?>">
    <?php echo $row['branch_name']; ?>
  </a><br>
<?php } ?>

</body>
</html>