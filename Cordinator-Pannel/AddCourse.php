<?php
include "../Connection/header.php";
require "../Connection/connection.php";

if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $description = $_POST['description'];



    // if ($_FILES['image']['error'] == 4) {
    if ($_FILES['image']['error'] == 4) {

        echo "
    <script>alert('Image not found')</script>";
    } else {

        $imgname = $_FILES['image']['name']; //samsung.jpg
        $tmpname = $_FILES['image']['tmp_name'];
        $size = $_FILES['image']['size']; //44397

        $validExtensions = ["png", "jpg", "jpeg"];
        // samsung.jpg
        $extension = explode(".", $imgname); // ["samsung", "jpg"]
        // print_r($extension);
        $extension = strtolower(end($extension)); //jpg

        if ($size > 1000000) {
            echo "<script>alert('File too large')</script>";
        } elseif (!in_array($extension, $validExtensions)) {
            echo "<script>alert('File type not supported')</script>";
        } else {

            $newimgname = uniqid() . "." . $extension; //4545gh45rt454242.jpg
            // $insert = "INSERT INTO `courses`( `Course_Title`, `Description`, `image`) VALUES ('$name','$description','$newimgname')";
            $insert = "INSERT INTO `courses`( `Course_Title`, `Description`, `image`) VALUES ('$name','$description','$newimgname')";


            $result = mysqli_query($connection, $insert) or die("failed");
            if ($result) {
                move_uploaded_file($tmpname, "images/" . $newimgname);
                echo "<script>alert('Course registered succesfully')</script>";
            }
        }
    }
}

?>

<body>
    <div class="container">
        <h1 class="text-center display-3 fw-semibold">Courses</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <input class="form-control my-3" type="text" name="name" id="name" placeholder="Enter Course Name">
            <input class="form-control my-3" type="text" name="description" id="description" placeholder="Enter Description">
            <input class="form-control my-3" type="file" name="image" id="image" accept=".jpg, .png, .jpeg">
            <input class="form-control my-3 btn btn-success" type="submit" name="submit" value="ADD">
        </form>
    </div>
    <!-- <img src="./images/6561a4bb00981.jpg" alt=""> -->
</body>

</html>