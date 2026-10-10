<?php
include "notesdb.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Years</title>
  <link rel="stylesheet" href="globalstyle.css" />
</head>
<body>

<h1>Select Year</h1>

<?php
$result = mysqli_query($conn, "SELECT * FROM years");

while($row = mysqli_fetch_assoc($result)){
?>
  <a href="branches.php?year=<?php echo $row['year_id']; ?>">
    <?php echo $row['year_name']; ?>
  </a><br>
<?php } ?>

</body>
</html>