<?php
session_start();

include_once 'header.php';
require_once 'login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query = "SELECT b.book_id, b.title, GROUP_CONCAT((CONCAT(a.fname,' ', a.lname)) SEPARATOR ', ') AS author_names, s.source_id, s.source_name, s.city, YEAR(ac.`date`) AS `year`
FROM book b NATURAL JOIN book_author NATURAL JOIN author a 
JOIN acquisition ac ON b.book_id=ac.book_id NATURAL JOIN source s
GROUP BY b.book_id
ORDER BY rand()";

$result = $conn->query($query);
if (!$result) die ("Database access failed");
$rows = $result->num_rows;

echo "<div id='table'> 
    <table>
    <tr><th>Title</th><th>Author(s)</th><th>Source</th><th>City</th><th>Year Acquired</th></tr>";
while ($row =$result->fetch_assoc()){
    echo "<tr>";
    echo "<td><a href=\"viewbook.php?id=".$row["book_id"]."\">".$row["title"]."</a></td>";
    echo "<td>".$row["author_names"]."</td>";
    echo "<td>".$row["source_name"]."</td>";
    echo "<td>".$row["city"]."</td>";
    echo "<td>".$row["year"]."</td>";
    echo "</tr>";
}    
echo "</table></div>";

include_once 'footer.php';