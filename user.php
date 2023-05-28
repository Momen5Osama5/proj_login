<?php
include 'index.php';


?>


<!DOCTYPE html>
<html>
<head>
    <title>Welcome Message</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

.welcome-message {
    text-align: center;
    margin-top: 100px;
}

h1 {
    font-size: 32px;
    color: #333;
}

p {
    font-size: 18px;
    color: #666;
}

</style>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="welcome-message">
        <?php
        
        // Check if form data is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the submitted data
        
            $email = $_POST["email"];

            // Validate the data (you can add more validation checks here)
            if ( !empty($email)) {
                echo "<h1>Welcome</h1>";
                echo "<p>Hello, $email!</p>";
                
            } else {
                echo "<p>Invalid data submitted.</p>";
            }
        } else {
            echo "<p>No data submitted.</p>";
        }
        ?>
        
       
    </div>
    
</body>
</html>