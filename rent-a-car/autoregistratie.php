<?php

include 'core/init.php';
include 'includes/overall/header.php';
$msg = "";


// If upload button is clicked ...
if (isset($_POST['upload'])) {
    $uploadOk = 1;
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "core/database/car_images/" . $filename;
    $connect = connect_to_database();
    $merk = $_POST['merk'];
    $model = $_POST['model'];
    $imageFileType = strtolower(pathinfo($folder, PATHINFO_EXTENSION));
    $required_fields = array('prijsperdag', 'kenteken', 'model', 'merk', 'type', 'kleur');

    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $required_fields) === true || empty($filename)) {
            $errors[] = 'Fields marked with an * are required';
            break 1;
        }
    }

    if (empty($errors) === true) {
        if (kentekencheck($_POST['kenteken']) === true) {
            $errors[] = 'sorrie het kenteken \'' . $_POST['kenteken'] . '\' is already taken';
        }
        if (file_exists($folder)) {
            $errors[] = "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $errors[] = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($tempname, $folder)) {
                //$sql = "INSERT INTO auto (img_location, merk, model) VALUES ('$folder', '$merk', '$model')";
                //mysqli_query($connect, $sql);
                $errors[] = "The file " . htmlspecialchars(basename($_FILES["uploadfile"]["name"])) . " has been uploaded.";
                $register_data = array(
                    'kenteken' => $_POST['kenteken'],
                    'merk' => $_POST['merk'],
                    'type' => $_POST['type'],
                    'model' => $_POST['model'],
                    'prijsperdag' => $_POST['prijsperdag'],
                    'kleur' => $_POST['kleur'],
                    'img_location' => $folder
                );
                register_car($register_data);
            } else {
                $errors[] = "Sorry, there was an error uploading your file.";
            }
        }
        $result = mysqli_query($connect, "SELECT * FROM auto where img_location = '$folder'");
        while ($data = mysqli_fetch_array($result)) {
            ?>
            <img src="<?php echo $data['img_location']; ?>" style="height: 100px; width: 100px">
            <?php
        }
    }
}
?>
<h1>Nieuwe auto registreren</h1>
<p><?php echo output_errors($errors) ?></p>

<form method="POST" action="" enctype="multipart/form-data">
    auto prijs per dag*<br>
    <input type="text" name="prijsperdag"> <br> <br>
    auto kleur*<br>
    <input type="text" name="kleur"> <br> <br>
    auto type*<br>
    <input type="text" name="type"> <br> <br>
    auto kenteken*<br>
    <input type="text" name="kenteken"> <br> <br>
    auto merk*<br>
    <select id="cars" name="merk">
        <option value="volvo">Volvo</option>
        <option value="saab">Saab</option>
        <option value="fiat">Fiat</option>
        <option value="audi">Audi</option>
        <option value="audi">Mazda</option>
        <option value="audi">volkswagen</option>
        <option value="audi">KIA</option>
        <option value="audi">Opel</option>
        <option value="audi">Ford</option>
    </select> <br> <br>
    auto model*<br>
    <input type="text" name="model"> <br><br>
    Foto van de auto*: <br>
    <input type="file" name="uploadfile"/> <br>
    <br>
    <div>
        <button type="submit" name="upload" class="button">
            Indienen
        </button>
    </div>
</form>
<?php
include 'includes/overall/footer.php'; ?>
