
<?php include_once("../connexion.php");
include("ajout_script.php");
?>

<?php 
    $requete = $connect->prepare("SELECT * FROM artist inner join disc on artist.artist_id = disc.artist_id");
    $requete->execute();
    $tableau = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<?php include_once("header.php") ?>

        <div class="row formulaire">
                <!--Début du formulaire-->
            <form  class = " col s12 " action = "ajout_script.php" method = "post" id="contact" enctype="multipart/form-data" name="contact">
                <h4>Ajouter un vinyle</h4>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="titre" type="text" class="validate" name="titre" required>
                        <label for="titre">Title</label>
                        <span class="helper-text" data-error="Ce champs est obligatoire" data-success="Champs valider"><?= isset($listeErreurs['titre']) ? $listeErreurs['titre'] : '' ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 white-text">
                        <select  class="white-text" name="artist_id" required>
                            <option value="" disabled selected>Veuillez sélectionner l'artiste</option>
                            <?php foreach ($tableau as $artist): ?>
                            <option value="<?= $artist->artist_id ?>"><?= $artist->artist_name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label>Artist</label>
                    </div>
                </div>              
                <div class="row">
                    <div class="input-field col s12">
                        <input id="annee" name="annee" type="text" class="datepicker validate" data-length="4" required>
                        <label for="annee">Year</label>
                        <span class="helper-text" data-error="Ce champs est obligatoire" data-success="Champs valider"><?= isset($listeErreurs['annee']) ? $listeErreurs['annee'] : '' ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="genre" type="text" class="" name="genre" required>
                        <label for="genre">Genre </label>
                        <span><?= isset($listeErreurs['genre']) ? $listeErreurs['genre'] : '' ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="label" type="text" class="" name="label" required>
                        <label for="label">Label </label>
                        <span><?= isset($listeErreurs['label']) ? $listeErreurs['label'] : '' ?></span>
                    </div>
                </div>    
                <div class="row">
                    <div class="input-field col s12">
                        <input id="price" type="text" class="validate" data-length="4" name="price" required>
                        <label for="price">Price</label>
                        <span class="helper-text" data-error="Ce champs est obligatoire" data-success="Champs valider"></span>
                    </div>
                </div>
                <div class="file-field input-field">
                    <div class="btn">
                        <span class="black-text">Ajouter une image</span>
                        <input name="picture" type="file" required>
                    </div>
                    <div class="file-path-wrapper">
                        <input id="picture" name="picture" class="file-path validate" type="text">
                    </div>
                    <span class="info">Au format .gif, .jpg, .jpeg, .pjpeg ou .png</span>
                    <span class="error" id="errorFile"><?= isset($listeErreurs['file']) ? $listeErreurs['file'] : '' ?></span>
                </div>
                <div class="input-field center-align">
                    <button name="ajouter" class="waves-effect waves-light btn black-text" type="submit">Ajouter</button>
                    <a name="retour"  class="waves-effect green waves-light btn black-text" href="index.php">Retour</a>
                    
                </div>
            </form>

        </div> 
      
<?php include_once("footer.php")?>
