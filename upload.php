<div>
    <form action="#" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Télécharger des images</legend>
            <div>
                <label for="pictures">Choisi un ou plusieurs fichiers :</label>
                <input type="file" name="picture[]" id="pictures" multiple="multiple">
            </div>
            <div>
                <input type="submit" value="Valider" name="Valider">
            </div>
        </fieldset>
    </form>
</div>
<div>
<?php

    if(!empty($_POST['Valider'])){
        $test = '';
        $testSize = '';
        $tableExt = ['png', 'gif', 'jpg'];
        foreach ($_FILES['picture']['name'] as $key => $value) {
            $fileName = $_FILES["picture"]["name"][$key];
            $fileType = $_FILES["picture"]["type"][$key];
            $fileSize = $_FILES["picture"]["size"][$key];
            $fileTmp = $_FILES["picture"]["tmp_name"][$key];
            $term = substr($fileType, -3);
            if(in_array($term, $tableExt)) {
                $test = true;
                if($fileSize < 1000000){
                    $testSize = 'true';
                    if(($test == 'true') && ($testSize == 'true')){
                        $fileName = uniqid();
                        $moveIsOk = move_uploaded_file($fileTmp, 'uploads/' . $fileName . '.' . $term);
                        echo '<p>Le fichier a bien été téléchargé</p>';
                    }
                }else{
                    echo '<p>Votre fichier dépasse la taille maximale autorisée de 1Mo</p><br>';
                }
            }else{
                $test = 'false';
                echo '<p>Le format de votre fichier n\'est pas autorisé</p><br>';
            }
        }
    }

$imageAff = new FilesystemIterator('uploads/');

foreach($imageAff as $upload){
    echo '<figure>';
    echo '<img src="' . $upload->getPathname() . '" alt=""><br>';
    echo '<figcation>' . $imageAff->getFilename() . '</figcation>';
    echo '</figure>';
}
