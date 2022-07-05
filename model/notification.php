<?php include 'server/server.php' ?>
<?php

$query = "UPDATE tblnotif set status = '0' where id = ".$_SESSION['id'];
$result = $conn->query($query);


?>