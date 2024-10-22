<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "art_gallery1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    echo "Connected to the database successfully.<br>"; // Debug statement
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Form submitted successfully!<br>";
    
    // Get form data
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle image upload
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";  // Folder to store the images
    $target_file = $target_dir . basename($image);

    // Move the uploaded file to the server
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        echo "File uploaded successfully.<br>"; // Check if file uploaded
        // Insert art details into the database
        $sql = "INSERT INTO artworks (title, artist, description, price, image) VALUES ('$title', '$artist', '$description', '$price', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            echo "Art added successfully";
            header("Location: artpage1.php"); // Redirect to the art page
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error; // Output SQL error
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
$conn->close();
?>
