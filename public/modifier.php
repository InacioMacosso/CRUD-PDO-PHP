<?php
include("../connexion.php");
    $id = $_GET['id'];
    $query = 'SELECT * FROM artist inner join disc on artist.artist_id = disc.artist_id where disc_id =:id';
    $result = $connect->prepare($query);
    $result->bindValue(':id', $id, PDO::PARAM_INT);
    $result->execute(); 
    $details = $result->fetch(PDO::FETCH_OBJ);
    $result->closeCursor();

    $liste_artistes = 'SELECT * FROM artist';
    $resulat = $connect->prepare($liste_artistes);
    $resulat->execute(); 
    $liste = $resulat->fetchAll(PDO::FETCH_OBJ);
    $resulat->closeCursor();

    include("modif_script.php");

    ?>
<?php include_once("header.php") ?>

        <div class="row formulaire">
                <!--Début du formulaire-->
            <form  class = " col s12 " action ="modif_script.php" method = "POST" id="contact" enctype="multipart/form-data">
                <h4>Modifier un vinyle</h4>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="id" type="text" class="validate" name="id" value="<?= $details->disc_id ?>" readonly>
                        <label for="id">ID</label>
                        <span class="helper-text" data-error="Ce champs est obligatoire" data-success="Champs valider"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="titre" type="text" class="validate" name="titre" value="<?= isset($_POST['titre']) ? $_POST['titre']: $details->disc_title ?>" required>
                        <label for="titre">Title</label>
                        <span class="helper-text" data-error="Ce champs est obligatoire" data-success="Champs valider"><?= isset($listeErreurs['titre']) ? $listeErreurs['titre'] : '' ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 white-text">
                        <select  class="white-text" name="artist_id" required>
                            <option value="<?= isset($_POST['artist_id']) ? $_POST['artist_id'] :$details->artist_id ?>" selected><?= $details->artist_name ?></option>
                            <?php foreach ($liste as $artist): ?>
                            <option value="<?= $artist->artist_id ?>"><?= $artist->artist_name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label>Artist</label>
                        <span class="helper-text" data-error="Ce champs est obligatoire" data-success="Champs valider"><?= isset($listeErreurs['artist_id']) ? $listeErreurs['artist_id'] : '' ?></span>
                    </div>
                </div>              
                <div class="row">
                    <div class="input-field col s12">
                        <input id="annee" name="annee" type="text" class="datepicker validate" data-length="4" value="<?= isset($_POST['annee']) ? $_POST['annee'] : $details->disc_year ?>" required>
                        <label for="annee">Year</label>
                        <span class="helper-text" data-error="Ce champs est obligatoire" data-success="Champs valider"><?= isset($listeErreurs['annee']) ? $listeErreurs['annee'] : '' ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="genre" type="text" class="" name="genre" value="<?= isset($_POST['genre']) ? $_POST['genre'] : $details->disc_genre ?>" required>
                        <label for="genre">Genre </label>
                        <span class="helper-text" data-error="Ce champs est obligatoire" data-success="Champs valider"><?= isset($listeErreurs['genre']) ? $listeErreurs['genre'] : '' ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="label" type="text" class="" name="label" value="<?= isset($_POST['label']) ? $_POST['label'] : $details->disc_label ?> " required>
                        <label for="label">Label </label>
                        <span class="helper-text" data-error="Ce champs est obligatoire" data-success="Champs valider"><?= isset($listeErreurs['label']) ? $listeErreurs['label'] : '' ?></span>
                    </div>
                </div>    
                <div class="row">
                    <div class="input-field col s12">
                        <input id="price" type="text" class="validate" name="price" value="<?= isset($_POST['price']) ? $_POST['price'] : $details->disc_price ?>" required>
                        <label for="price">Price</label>
                        <span class="helper-text" data-error="Ce champs est obligatoire" data-success="Champs valider"><?= isset($listeErreurs['price']) ? $listeErreurs['price'] : '' ?></span>
                    </div>
                </div>
                <div class="col s6">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span class="black-text">Insérer une photo</span>
                            <input type="file" name="picture" required>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                        <span class="helper-text" data-error="Ce champs est obligatoire" data-success="Champs valider"><?= isset($listeErreurs['picture']) ? $listeErreurs['picture'] : '' ?></span>
                        <span class="info">Au format .gif, .jpg, .jpeg, .pjpeg ou .png</span>
                    </div>
                </div>
                <div class="input-field center-align">
                    <button name="modifier" class="waves-effect yellow waves-light btn black-text" type="submit">Modifier </button>
                    <a name="retour"  class="waves-effect green waves-light btn black-text" href="index.php">Retour</a>
                    
                </div>
            </form>

        </div> 
      
<?php include_once("footer.php");?>