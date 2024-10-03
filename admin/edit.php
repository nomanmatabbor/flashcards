<!DOCTYPE html>
<html>
<head>
    <title>Edit Text File</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Text File</h1>

        <?php
        if (isset($_GET['file'])) {
            $filePath = $_GET['file'];

            if (file_exists($filePath) && pathinfo($filePath, PATHINFO_EXTENSION) === 'txt') {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Handle form submission to save the edited content
                    $newContent = $_POST['content'];

                    if (file_put_contents($filePath, $newContent) !== false) {
                        echo '<div class="alert alert-success" role="alert">File content saved successfully.</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Error saving file content.</div>';
                    }
                }

                // Read and display the current content of the text file
                $fileContent = file_get_contents($filePath);
                echo '<form method="POST">';
                echo '<div class="form-group">';
                echo '<label for="content">File Content:</label>';
                echo '<textarea class="form-control" id="content" name="content" rows="10">' . htmlspecialchars($fileContent) . '</textarea>';
                echo '</div>';
                echo '<button type="submit" class="btn btn-primary">Save</button>';
                echo '</form>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Invalid file or file does not exist.</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">No file specified for editing.</div>';
        }
        ?>
        
        <a href="upload_image.php">Upload an image</a> |
        <a href="dashboard.php">Back to Dashboard</a>
        
    </div>

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Prevent the tab key from moving focus
        document.getElementById('content').addEventListener('keydown', function (e) {
            if (e.key === 'Tab') {
                e.preventDefault();
                // Insert a tab character into the text area
                var start = this.selectionStart;
                var end = this.selectionEnd;
                var text = this.value;
                this.value = text.substring(0, start) + '\t' + text.substring(end);
                this.selectionStart = this.selectionEnd = start + 1;
            }
        });
    </script>
</body>
</html>