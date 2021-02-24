<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> Rapoport Code Homework 3 </title>
<style> body {font-family: Helvetica;}
    table, th, td {border: 1px solid black; border-collapse: collapse;}
    table {width: 75%;}
    tr:nth-child(even){background-color: #BFBFBF;}
    p {font-weight: bold; font-size: 15px;}
    a:link {color: #5161C5; text-decoration: none;}
    </style>
</head>
<body>
<?php

echo "<h2> Challenge: Booklists </h2>"; 
$books = array();
$books["book1"] = array(
    "Title" => "PHP and MySQL Web Development",
    "Afname" => "Luke",
    "Alname" => "Welling",
    "Pages" => "144",
    "Type" => "Paperback",
    "Price" => "31.63"
);
$books["book2"] = array(
    "Title" => "Web Design with HTML, CSS, JavaScript and jQuery",
    "Afname" => "Jon",
    "Alname" => "Duckett",
    "Pages" => "135",
    "Type" => "Paperback",
    "Price" => "41.23"
);   
$books["book3"] = array(
    "Title" => "PHP Cookbook: Solutions & Examples for PHP Programmers",
    "Afname" => "David",
    "Alname" => "Sklar",
    "Pages" => "14",
    "Type" => "Paperback",
    "Price" => "40.88"
);     
$books["book4"] = array(
    "Title" => "JavaScript and JQuery: Interactive Front-End Web Development",
    "Afname" => "Jon",
    "Alname" => "Duckett",
    "Pages" => "251",
    "Type" => "Paperback",
    "Price" => "22.09"
);
$books["book5"] = array(
    "Title" => "Modern PHP: New Features and Good Practices",
    "Afname" => "Josh",
    "Alname" => "Lockhart",
    "Pages" => "7",
    "Type" => "Paperback",
    "Price" => "28.49"
);    
$books["book6"] = array(
    "Title" => "Programming PHP",
    "Afname" => "Kevin",
    "Alname" => "Tatroe",
    "Pages" => "26",
    "Type" => "Paperback",
    "Price" => "28.96"
);   

echo "<table> 
<tr>
    <th>Title</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Pages</th>
    <th>Type</th>
    <th>Price</th>
</tr>"; // creating the table
$total = Null; //declaring the $total varible so that it can be summed during loops
foreach ($books as $value){
    echo "<tr>"; //rows are created to house each inner array
    foreach($value as $subkey => $subval)
    {
        if ($subkey == "Title"){ // loop through titles and create hyperlink for titles
            echo "<td><a href=\"https://www.google.com/search?q=".urlencode($subval)."\">".$subval."</a></td>";  
        }
        else { //loop through rest of arrays
            echo "<td>".$subval."</td>";
        }
    }
    foreach($value as $subkey => $subval) // another forloop to just put prices in a varible
    {
        if ($subkey == "Price"){
        $total = $total + $subval; // adding up the total
        }
    }
    echo "</tr>";
} 
echo "</table>";
echo "<p>Your Total Price is: \$".$total."</p>"; 


echo "<h2> Challenge: Coin Toss, continued</h2>"; 

function headimage() {
    echo "<img src=\"https://upload.wikimedia.org/wikipedia/commons/2/2e/US_One_Cent_Obv.png\" alt=\"Head of Penny - United States Mint, Public domain, via Wikimedia Commons\" 
    style=\"width:75px;height:75px;\">"; // earlier forgot closing tag and had to add <Br> to make them line up but when closing > was added back it created two breaks
}

function tailimage()
{
    echo "<img src=\"https://upload.wikimedia.org/wikipedia/commons/d/da/US_One_Cent_Rev.png\" alt=\"Tail of Penny - United States Mint, Public domain, via Wikimedia Commons\" 
    style=\"width:75px;height:75px;\">";
}


// create a forloop that creates array and populates it until it reaches at least the number of heads passed through the function
function coinflip($y) { // $y is number of heads in a row
$results = array(); 
$z = 0;
/* for ($x = 0; $x!=$y; $x++) // create array with coinflip result skipping evaluation stage until reaching at least the number passed through the function
{
    $result = mt_rand(0,1); 
    $results[] = $result;
};
// now to start evaluation
$z = 0;
for (end($results); key($results)!==null; prev($results)) // goes through array backwards
{
    $currentElement = current($results); // evaluate each  element in the array using if.else
    if ($currentElement == 0)
    { 
        break; // as soon as it encounters a zero(a tails) - need to flip again and add to the end of the array
    }
    else
    {
        ++$z; // counts how many 1s in a row
    }
  }; */ // Used this block to begin solving the problem
while ($z != $y) //if the number of 1s in a row is not equal to the varible passed through the function, add more to array
{
    $result = mt_rand(0,1); //
    $results[] = $result;
    $z = 0;

    for (end($results); key($results)!==null; prev($results)){
        $currentElement = current($results);
        if ($currentElement == 0)
        { 
            break;
        }
        else
        {
            ++$z; // counts how many 1s in a row
        }
    };
}
foreach ($results as $image){ // final print out of results to get heads
    if ($image==1)
    {
    echo headimage();
    }
    else
    {   
    echo tailimage();
    }
}
if (count($results)==1)
{
    echo "<br><p>It took ".count($results)." flip to get $y heads in a row.</p>";
}
else{
echo "<br><p>It took ".count($results)." flips to get $y heads in a row.</p>"; 
}
}

echo coinflip(1);

?>
</body>
</html>