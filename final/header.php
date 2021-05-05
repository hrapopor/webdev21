<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Origins of my Library</title>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="library.css" />
</head>
<body>

<header>
    <div class="clearfix">
	<div class="logo">
		<a href="index.php"><img src="images/bookshelf.jpeg" alt="A white bookshelf with many books and a card from the Tate Modern." style="width:200px; height:200px"></a>
	</div>
    <div class="top">
        <h1>Origins of my Library</h1>
        <p>A personalized catalog of books and their acquisition</p>
	    <div class="menu">
        <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="search.php">Search</a></li>
        <li><a href="about.php">About</a></li>
		<?php
			if (isset($_SESSION['username'])) {
            echo "<li><a href=\"addbook.php\">Add Book</a><Li>
            <li><a href=\"signout.php\">Logout</a></li>
            <li>Welcome, ".$_SESSION['username']."</li>";
			} else {
			echo "<li><a href=\"signin.php\">Sign In</a></li>";
			}
		?>
        </ul>
    </div>  
    </div>
    </div>
</header>
<div id="body">
    <br>
