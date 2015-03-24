<?php
$servername = "localhost";
$username = "root";
$password = "ditt lösenord till databasen";
$dbname = "myDB(databsens namn i.e motionmahpp)";

// array for JSON response
$response = array();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM MyGuests";
$result = $conn->query($sql);

// check for empty result
if ($result->num_rows > 0) 
{
    $response["MyGuests"] = array();
    
    // looping through all the results from sql query
    while($row = $result->fetch_assoc()) 
    {   
        // temp user array
        $myguests = array();

        $myguests["id"] = $row["id"];
        $myguests["firstname"] = $row["firstname"];
        $myguests["lastname"] = $row["lastname"];
        $myguests["email"] = $row["email"];
        $myguests["reg_date"] = $row["reg_date"];  
        

        // push every single result into final response array
        array_push($response["MyGuests"], $myguests);
    }
    
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} 
else
{
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";
 
    // echo no users JSON
    echo json_encode($response);
}

$conn->close();
?>
