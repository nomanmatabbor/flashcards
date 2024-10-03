<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Add your custom styles here if needed -->
    <style>
        /* Add your custom styles here if needed */
    </style>
</head>

<body class="container mt-5">

<?php
$uploadDirectory = '../images/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form was submitted
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];

        // Check if the file is an actual image
        if (getimagesize($file['tmp_name']) !== false) {
            $uploadPath = $uploadDirectory . basename($file['name']);
            
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                $encodedFilename = str_replace(' ', '%20', basename($file['name']));
                $imageUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/images/' . $encodedFilename;
                
                // Display a pop-up with the complete image URL
                echo "<div id='success-alert' class='alert alert-success alert-dismissible fade show' role='alert'>
                        Image uploaded successfully! Copy the URL:
                        <span id='image-url'>$imageUrl</span>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                        <button id='copy-button' class='btn btn-primary btn-sm ml-2'>Copy Link</button>
                      </div>";
            } else {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Error uploading file.
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>";
            }
        } else {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    Invalid file format. Please upload an image.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>";
        }
    }
}
?>


    <!-- HTML form for file upload -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="file">Choose an image to upload:</label>
            <input type="file" class="form-control-file" name="file" id="file" accept="image/*" required>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Upload Image">
        </div>
    </form>

    <!-- Bootstrap JS and Popper.js (required for Bootstrap components) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <!-- Add Clipboard.js for copying text to clipboard -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

    <script>
        // Initialize Clipboard.js
        var clipboard = new ClipboardJS('#copy-button', {
            target: function (trigger) {
                return document.getElementById('image-url');
            }
        });

        // Show success alert after copying
        clipboard.on('success', function (e) {
            var successAlert = document.getElementById('success-alert');
            successAlert.classList.remove('alert-success');
            successAlert.classList.add('alert-info');
            successAlert.innerHTML =
                "Image URL copied to clipboard! Paste it wherever you need." +
                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                "<span aria-hidden='true'>&times;</span>" +
                "</button>";
        });

        // Show error alert if copying fails
        clipboard.on('error', function (e) {
            console.error('Action:', e.action);
            console.error('Trigger:', e.trigger);
            var errorAlert = document.getElementById('success-alert');
            errorAlert.classList.remove('alert-success');
            errorAlert.classList.add('alert-danger');
            errorAlert.innerHTML =
                "Error copying the image URL. Please copy it manually." +
                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                "<span aria-hidden='true'>&times;</span>" +
                "</button>";
        });
    </script>

</body>

</html>
