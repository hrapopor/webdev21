<?php
session_start();

include_once 'header.php';
require_once 'login.php';
include_once 'functions.php';

if (isset($_GET['submit'])) {
    if(empty($_GET['submit'])){
        echo "<p>Please fill in the search field!</p>";
    } else{
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) die($conn->connect_error);
        
        $search = sanitizeMySQL($conn, $_GET['search']);
        $query = "SELECT b.*, ba.*, GROUP_CONCAT((CONCAT(a.fname,' ', a.lname)) SEPARATOR ', ') AS author_list, ac.*, s.* FROM book b NATURAL JOIN book_author ba NATURAL JOIN author a JOIN acquisition ac ON b.book_id=ac.book_id NATURAL JOIN `source` s WHERE (a.fname LIKE '%$search%' OR a.lname LIKE '%$search%' OR b.title LIKE '%$search%' OR s.source_name LIKE '%$search%')";
    
    $result = $conn->query($query);
	if (!$result) die($conn->error);
	
	while ($row=$result->fetch_assoc()) {
        $date = $row['date'];
        echo "Results:<br>
        <div id='table'>
        <table>";
		echo "<tr><td>Title</td><td>".$row['title']."</td></tr>";
        echo "<tr><td>Author(s)</td><td>".$row['author_list']."</td></tr>";
        echo "<tr><td>Source</td><td>".$row['source_name'].", ".$row['source_type']."</td></tr>";
        echo "<tr><td>Source Description</td><td>".$row['source_description']."</td></tr>";
        echo "<tr><td>Acquisition Description</td><td>".$row['acquisition_description'].", ".substr($date, 0, 4)."</td></tr></table></div>";
	}}
}



?>

<form method="GET" action="">
    <fieldset>
        <legend>Search</legend>
        Search: <input type="text" name="search" required>
        <p><input type="submit" name="submit" value="Submit"></p>
    </fieldset>
</form>

<?php
include_once 'footer.php';
?>
