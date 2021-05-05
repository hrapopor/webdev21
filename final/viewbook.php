<?php
session_start();


include_once 'header.php';
require_once 'login.php';
require_once 'functions.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_GET['id'])) {
	$id = sanitizeMySQL($conn, $_GET['id']);
	$query = "SELECT b.title, b.ISBN, GROUP_CONCAT((CONCAT(a.fname,' ', a.lname)) SEPARATOR ', ') as authors FROM book b NATURAL JOIN book_author ba NATURAL JOIN author a WHERE book_id='$id' GROUP BY b.book_id, b.ISBN";
	$result = $conn->query($query);
	if (!$result) die ("No Book found.");
	$rows = $result->num_rows;
	if ($rows == 0) {
		echo "No book found.<br>";
	} else {
		while ($row = $result->fetch_assoc()) {
			echo '<h1>Book Information</h1>';
			echo "<p><a href=\"https://www.google.com/search?tbo=p&tbm=bks&q=isbn:".$row["ISBN"]."\">".$row["title"]."</a> by ".$row["authors"];
            
		}
	}
	echo "<p><a href=\"index.php\">Return to homepage</a></p>";
} else {
	echo "No pet id passed";
}

include_once 'footer.php';
?>
