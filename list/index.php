<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>List of backlinks</title>
	<link rel="stylesheet" href="../assets/css/main.min.css">
</head>
<body>

<?php

$RootDomain = 'https://deep.dpmarketing.sk/';

$conn = new mysqli("mysql80.r1.websupport.sk:3314", "yk4i43mm", "Oo5ajK83p=", "yk4i43mm");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, ig_username, hash, created_at FROM urls";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    ?>
<table>
	<tbody>
		<tr class="strong">
			<td>ID</td>
			<td>Username</td>
			<td>Depp Link</td>
			<td>Created At</td>
		</tr>
		<?php

    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "
			<tr>
				<td>" . $row["id"] . "</td>
				<td>" . $row["ig_username"] . "</td>
				<td class=\"deeplink-wrapper\"><button class=\"copy\">". $RootDomain . $row["hash"] ."</button></td>
				<td>" . $row["created_at"] . "</td>
			</tr>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>
	</tbody>
</table>

<script src="../assets/js/main.js"></script>


</body>
</html>
