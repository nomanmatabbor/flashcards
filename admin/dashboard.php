<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Memorizer Flash Cards</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="uploadFile">Select a .txt File</label>
                <input type="file" class="form-control-file" id="uploadFile" name="uploadFile" accept=".txt">
            </div>
            <button type="submit" class="btn btn-primary" name="submitUpload">Upload</button>
        </form>
        <a href="add_new.php">Write a txt file</a>
        <a href="delete_images.php">Delete images</a>
    </div>

    <?php
    $folderPath = '../flashcards'; // Replace with the path to your folder

    // Handle file upload
    if (isset($_POST['submitUpload'])) {
        $uploadFilePath = $folderPath . '/' . basename($_FILES['uploadFile']['name']);
        $fileType = pathinfo($uploadFilePath, PATHINFO_EXTENSION);

        if (!empty($_FILES['uploadFile']['name']) && $fileType === 'txt') {
            if (move_uploaded_file($_FILES['uploadFile']['tmp_name'], $uploadFilePath)) {
                echo '<div class="alert alert-success" role="alert">File uploaded successfully.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error uploading the file.</div>';
            }
        } else {
            echo '<div class="alert alert-warning" role="alert">Please select a valid .txt file to upload.</div>';
        }
    }

    if (is_dir($folderPath)) {
        $files = scandir($folderPath);
        $txtFiles = array();

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'txt') {
                $txtFiles[] = $file;
            }
        }

        if (!empty($txtFiles)) {
            echo '<div class="container mt-5">';
            echo '<h1>List of Text Files</h1>';
            echo '<ul class="list-group">';

            foreach ($txtFiles as $txtFile) {
                // Generate a link to view the text file in index.php with the folder name
                echo '<li class="list-group-item">';
                echo '<a href="/flashcards.php?file=flashcards' . urlencode("/$txtFile") . '">' . $txtFile . '</a>';
                // Add an "Edit" link to the file
                echo ' <a href="edit.php?file=' . urlencode("$folderPath/$txtFile") . '">Edit</a>';
                // Add a "Delete" link to the file
                echo ' <a href="delete.php?file=' . urlencode("$folderPath/$txtFile") . '">Delete</a>';
                echo '</li>';
            }

            echo '</ul>';
            echo '</div>';
        } else {
            echo '<div class="container mt-5">No text files found in the folder.</div>';
        }
    } else {
        echo '<div class="container mt-5">The folder does not exist.</div>';
    }

    // Handle file deletion
    if (isset($_GET['file'])) {
        $fileToDelete = urldecode($_GET['file']);
        $filePath = $folderPath . '/' . $fileToDelete;

        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                echo '<div class="alert alert-success" role="alert">File deleted successfully.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error deleting the file.</div>';
            }
        } else {
            echo '<div class="alert alert-warning" role="alert">File not found.</div>';
        }
    }
    ?>

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
