<?php
// Connect to the database
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "art_gallery1"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all art from the database
$sql = "SELECT title, artist, description, price, image FROM artworks";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .art-card {
            margin: 15px;
        }
        .art-image {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }
        .card-title {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="artimage.jpeg" class="img" alt="Art Image" style="height: 45px; width: 60px;">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="homepage.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Art</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="addart.php">Add Art</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Add to Cart</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

    <h1 align="center" class="main-heading">All Artworks</h1>
    <div class="container">
        <div class="row" id="artGallery">
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 art-card">';
                    echo '<div class="card">';
                    echo '<img src="' . $row['image'] . '" class="card-img-top art-image" alt="' . $row['title'] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['title'] . '</h5>';
                    echo '<p class="card-text"><strong>Artist:</strong> ' . $row['artist'] . '</p>';
                    echo '<p class="card-text">' . $row['description'] . '</p>';
                    echo '<p class="card-text"><strong>Price:</strong> $' . $row['price'] . '</p>';
                    echo '</div></div></div>';
                }
            } else {
                echo '<p>No artworks found.</p>';
            }
            $conn->close();
            ?>
        </div>
    </div>

    <footer class="text-center bg-dark text-white mt-5">
        <p>&copy; 2024 Online Art Gallery</p>
    </footer>

</body>
</html>

