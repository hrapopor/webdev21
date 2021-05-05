<?php
session_start();

include_once 'header.php';
require_once 'login.php';
include_once 'functions.php';



// Check to see if authorized user login using session
if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
}


if (isset($_POST["submit"])) {
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);
    $title = sanitizeMySQL($conn, $_POST['title']);
    $ISBN = sanitizeMySQL($conn, $_POST['ISBN']);
    $year = sanitizeMySQL($conn, $_POST['year']);
    if (empty($_POST['month'])){
        // Default to January because need a valid month for webserver
        $month = '01';
    } else{
        $month = sanitizeMySQL($conn, $_POST['month']);
    }
    if (empty($_POST['day'])){
        // Default to 01 because need a valid date for webserver
        $day = '01';
    } else {
        $month = sanitizeMySQL($conn, $_POST['month']);
    }
    $publication_date = $year."-".$month."-".$day;
    $type = $_POST['type'];
    $query_book = "INSERT INTO `book` VALUES (NULL, \"$title\", \"$ISBN\", \"$publication_date\", \"$type\")";
    $result_book = $conn->query($query_book);
    if(!$result_book) {
        die("Database access failed: ".$conn->error);
    } else {
        // insert success and pull out varible of book ID from db
        $query = "SELECT LAST_INSERT_ID()";
        $result = $conn->query($query);
        $row = $result->fetch_array();
        $book_id = $row[0];
        $message_book = "<p>Successfully added new book titled $title! With Book ID: $book_id </p>";  
    }
    $fname = sanitizeMySQL($conn, $_POST['fname']);
    $lname = sanitizeMySQL($conn, $_POST['lname']);

    $query_author = "INSERT INTO `author` VALUES(NULL, \"$fname\", \"$lname\")";
    $result_author = $conn->query($query_author);
    if(!$result_author){
        die("Database access failed: ".$conn->error);
    } else {
        $query = "SELECT LAST_INSERT_ID()";
        $result = $conn->query($query);
        $row = $result->fetch_array();
        $author_id = $row[0];
        $message_author = "<p>Successfully added new author with ID: $author_id </p>";          
    }
    $query_bookauthor = "INSERT INTO `book_author` VALUES(NULL, \"$book_id\", \"$author_id\",NULL)";
    $result_bookauthor = $conn->query($query_bookauthor);
    if (!$result_bookauthor){
        die("Database access failed: ".$conn->error);
    }
}
?>
<div class='clearfix'>
<div class='addleft'>
<?php 
if (isset($message_book)) echo $message_book."<br>";
if (isset($message_author)) echo $message_author."<br>";
?>
<form method="POST" action="">
    <fieldset>
    <legend>Add a Book</legend>    
    Book Title:*<br><input type="text" name="title" required><br>
    Author First Name:<br><input type="text" name="fname"><br>
    Author Last Name:*<br><input type="text" name="lname" required><br>
    ISBN:*<br><input type="text" name="ISBN" maxlength="13" size="13" required><br>
    Publication Date:*<br><input type="number" name="year" maxlength="4" minlength="4" size="4" placeholder="yyyy" required> <input type="number" name="month" maxlength="2" minlength="2" size="2" max="12" placeholder="mm"> <input type="number" name="day" maxlength="2" minlength="2" size="2" max="31" placeholder="dd"><br>
    Book Type:<br><select name="type" required>
        <option value="HC">Hardcover</option>
        <option value="SC">Softcover</option><br>
    <p><input type="submit" name="submit" value="Submit"></p>
</fieldset>
</form> 
</div>
<div class='addright'>
    <h3>Adding a Book to the database</h3>
    <p class='add'>Use this form fields to enter a book to add to the database. It can be used for books with only one author. If your book has more than one author, please contact database adminstrator: <a href="mailto:hrapopor@pratt.edu">hrapopor@pratt.edu</a> </p>
</div>
</div>
<?php
include_once 'footer.php';
?>