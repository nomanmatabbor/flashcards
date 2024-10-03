<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Viewer with Bootstrap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <?php
    $folderPath = "../images"; // Update this with the actual path to your images

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $imageName = $_POST["image"];
        $imagePath = $folderPath . '/' . $imageName;

        // Delete the selected image
        if (file_exists($imagePath)) {
            unlink($imagePath);
            echo "<div class='alert alert-success' role='alert'>Image '$imageName' deleted successfully!</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error: Image '$imageName' not found.</div>";
        }
    }

    $images = glob($folderPath . '/*.{png,jpg,jpeg,gif,bmp}', GLOB_BRACE);
    ?>

    <div class="row">
        <div class="col-md-12">
            <?php if (empty($images)): ?>
                <div class='alert alert-warning' role='alert'>No images found in the folder.</div>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($images as $image): ?>
                            <tr>
                                <td>
                                    <img src="<?= $image ?>" class="img-fluid" style="max-width: 200px;" alt="Image">
                                </td>
                                <td>
                                    <form method="post" action="">
                                        <input type="hidden" name="image" value="<?= basename($image) ?>">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
