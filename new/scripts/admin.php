<?php
    include 'db.php';
    if (isset($_POST['submit'])) {//insert
        $title= $_POST['title'];
        $image= $_POST['image'];
        $price= $_POST['price'];
        $rating= $_POST['rating'];
        // Handle image upload
        $attachment = $_FILES['image'];
        $fileinfo = pathinfo($attachment['name']);
        $fileExtension = strtolower($fileinfo['extension']);

        $maxsize = 10 * 1024 * 1024; // Maximum file size in bytes (10MB in this case)
        if ($attachment['size'] > $maxsize || $attachment['size'] <= 0) {
            echo "File size is too large or too small.";
            exit;
        }

        // Validating allowed extensions
        $allowedExtensions = array("jpeg", "jpg", "png", "gif");
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Invalid file extension.";
            exit;
        }

        //Generate a unique filename
        $filename = uniqid() . '_' . basename($fileinfo['filename']);

        //Move the uploaded file to the desired directory
        $targetDirectory = "../assets/img/";
        $newFilePath = $targetDirectory . $filename;

        if (move_uploaded_file($attachment['tmp_name'], $newFilePath)) {
            //succedd
            $image = $newFilePath;
        } else {
            echo "File upload failed";
        }
        //insert the data into the database
        $stmt = $conn->prepare("INSERT INTO your_table (title, image, price, rating) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $title, $image, $price, $rating);
        if ($stmt->execute()) {
            echo "Data inserted successfully.";
        } else {
            echo "Error inserting data: " . $conn->error;
        }
        $stmt->close();

    } elseif (isset($_POST['delete_row'])) {
        //get id(title) from hidden input field
        $del_title=$_POST['delete_title']
        //delete all data on the row
        $delsql = $conn->prepare("DELETE FROM store WHERE title = ?");
        $delsql->bind_param("s", $del_title);
        $delsql->execute();
        //csrf not implemented due to error.
    }
?>