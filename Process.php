<?php
    $ServerName="localhost";
    $Username="root";
    $password="";
    $dbname="testdb";

    $conn = new mysqli($ServerName,$Username,$password,$dbname);

    if(isset($_POST["Email"]) && !empty($_POST["Name"]) && !empty($_POST["ContactReason"]) && !empty($_POST["Message"])) {
        $Name = $_POST["Name"];
        $Email = $_POST["Email"];
        $ContactReason = $_POST["ContactReason"];
        $Message = $_POST["Message"];
    }

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO form_info(Name, Email, Contact_Reason, Message)
        VALUES ('$Name', '$Email', '$ContactReason', '$Message')";

    if(mysqli_query($conn,$sql)){
        echo "<style> body{background-color : azure}</style>";
        echo "<h3>Thanks you " . $Name . ". We will process your message Immediately.</h3>";
        echo "<p>Here is what you sent us:<br></p>"; 
        echo "<p>Name: " . $Name . "<br>Email: " . $Email . "<br><br>
            Reason for contacting us: " . $ContactReason . "<br>
            Your message to us: " . $Message . "<br>";
        echo "<style> #indented { text-indent: 20px } </style>";
        echo "<div id=\"indented\"><a href=\"3rd Page.html\">Back to form</a></div>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

    //This won't work on a local server.
    if(isset($_POST["SendEmail"])){
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            echo $emailErr;     
        } else {
            $subject = "Thank you! We value your input.";
            $msg = "Thank you " . $Name . ". We will process your message Immediately. \r\n \r\n Here is what you have sent in: \r\nEmail: "
                . $Email . "\r\nYour concern: " . $ContactReason . "\r\nYour message to us: " . $Message 
                . "\r\n\r\n We will look into your concerns and work to remedy any and all issues you have with the site.
                \r\nWe at Domino inc value our viewer's ideas for improvement. Thank you for sharing yours!"; 
            //mail($Email,"Thank you!", $msg);
            //This could be uncommented if we weren't on a local server.
        }
    }   
?>