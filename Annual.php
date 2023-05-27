<!DOCTYPE html>
<html>
<body>
<?php
$host = "localhost";
$port = "5432";
$dbname = "iwt";
$user = "postgres";
$password = "Varshu@16";
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}
$name=$_POST["name"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$date=$_POST["eventDate"];
$event=$_POST["eventType"];
$guest=$_POST["guests"];
if($guest>4){
    echo "<html><head><title>Back</title>"
    ,"<h2>Sorry, More than 4 guests are not allowed for a person</h2>"
    ,"<link rel=\"stylesheet\" type=\"text/css\" href=\"style1.css\"></head><body>"
    ,"<a href=\"annual.html\" class=\"btn\">Back to Home</a></body></html>";
}
else{
    $sql = "SELECT * FROM annual WHERE email='$email'";
    $result = pg_query($conn, $sql);
    if (pg_num_rows($result) > 0) {
        echo "<html><head><title>Back</title>"
    ,"<h2>You already registered for the event</h2>"
    ,"<link rel=\"stylesheet\" type=\"text/css\" href=\"style1.css\"></head><body>"
    ,"<a href=\"annual.html\" class=\"btn\">Back to Home</a></body></html>";
    } 
    else {
        $guests=intval($guest);
        // $sql = "INSERT INTO annual VALUES ('$name', '$email', '$phone', '$date', '$event', '$guests')";
        // if (pg_query($conn, $sql)){
            echo "<html><head><title>Booking Confirmation</title>"
            , "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">"
            , "</head><body>"
            , "<div class=\"container\">"
            , "<h1>Congratulations " , $name , "!</h1>"
            , "<h2>Your booking for " , $event , " on " ,$date , " for " , $guests , " guests has been confirmed.</h2>"
            , "<p>We will contact you at " , $email , " or " , $phone , " for further details.</p>"
            , "<a href=\"annual.html\" class=\"btn\">Back to Home</a>"
            , "</div>"
            , "</body></html>"; 
       // }
    }

}
pg_close($conn);
?>