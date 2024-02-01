<?php

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 10000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
            $fileDestination = '../img/'.$fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
            }
            else {
                echo 'Your Image is to big!';
            }
        }
        else {
            echo 'Error Uploading Image!';
        }
    }
    else {
        echo 'Wrong Image Type!';
    }
}

if (isset($_POST['updateListing'])) {
    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 10000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
            $fileDestination = '../img/'.$fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
            }
            else {
                echo 'Your Image is to big!';
            }
        }
        else {
            echo 'Error Uploading Image!';
        }
    }
    else {
        echo 'Wrong Image Type!';
    }
    $fileDestinationNew = 'img/'.$fileNameNew;
}

$fileDestinationNew = 'img/'.$fileNameNew;