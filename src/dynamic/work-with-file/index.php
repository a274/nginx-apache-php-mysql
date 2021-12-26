<?php
session_start();

include_once 'save.php';
if (isset($_POST['submit'])) {
    $file = './uploaded_files/' . $_POST['select'];
    download_file($file);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP File Upload</title>
    </head>
    <body>
        <?php
        if (isset($_SESSION['message']) && $_SESSION['message']) {
            printf('<b>%s</b>', $_SESSION['message']);
            unset($_SESSION['message']);
        }
        ?>
        <form method="POST" action="upload.php" enctype="multipart/form-data">
            <div>
                <span>Upload a File:</span>
                <input type="file" name="uploadedFile" />
            </div>

            <input type="submit" name="uploadBtn" value="Upload" />
        </form>
        <br><br><hr><br>
        <form method="POST" action="index.php">
            <?php
            $dir = './uploaded_files/'; // Папка с изображениями
            $files = scandir($dir); // Берём всё содержимое директории
            for ($i = 2; $i < count($files); $i++) { // Перебираем все файлы
                echo "<input type=\"radio\" name=\"select\" value=\"$files[$i]\">$files[$i]<br>";
            }
            ?>

            <input type="reset" value="Clear the form">
            <input type="submit" value="Download" name="submit">
        </form>
    </body>
</html>



