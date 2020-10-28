<?php
include("../connexion.php");
    $id = $_GET['id'];
    $query = 'SELECT * FROM artist inner join disc on artist.artist_id = disc.artist_id where disc_id =:id';
    $result = $connect->prepare($query);
    $result->bindValue(':id', $id, PDO::PARAM_INT);
    $result->execute(); 
    $details = $result->fetch(PDO::FETCH_OBJ);
    $result->closeCursor();
    ?>
<?php include_once("header.php") ?>
        <div class="row formulaire">
                <!--Début du formulaire-->
            <form  class = " col s12 " action ="suprim_script.php" method = "GET" id="contact" enctype="multipart/form-data">
                <h4>Modifier un vinyle</h4>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="titre" type="text" class="validate" name="titre" value="<?= $details->disc_title ?>" readonly>
                        <label for="titre">Title</label>
                        <span class="helper-text" data-error="Ce champs est obligatoire" data-success="Champs valider"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 white-text">
                        <select  class="white-text" name="artist_id" readonly>
                            <option value="" disabled selected><?= $details->artist_name ?></option>
                            <?php foreach ($liste as $artist): ?>
                            <option value="<?= $artist->artist_id ?>"><?= $artist->artist_name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label>Artist</label>
                    </div>
                </div>              
                <div class="row">
                    <div class="input-field col s12">
                        <input id="annee" name="annee" type="text" class="datepicker validate" data-length="4" value="<?= $details->disc_year ?>">
                        <label for="annee">Year</label>
                        <span class="helper-text" data-error="Ce champs est obligatoire" data-success="Champs valider"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="genre" type="text" class="" name="genre" value="<?= $details->disc_genre ?>">
                        <label for="genre">Genre </label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="label" type="text" class="" name="label" value="<?= $details->disc_label ?>">
                        <label for="label">Label </label>
                    </div>
                </div>    
                <div class="row">
                    <div class="input-field col s12">
                        <input id="price" type="number" class="validate" data-length="4" name="price" value="<?= $details->disc_price ?>" readonly>
                        <label for="price">Price</label>
                        <span class="helper-text" data-error="Ce champs est obligatoire" data-success="Champs valider"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="file-field input-field col s12 l6">
                        <div class="btn">
                            <span>File</span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <label for="pictue">Picture </label>
                            <input id="picture" name="picture" class="file-path validate" type="text">
                        </div>
                        <img id="picture" src="../pictures/<?= $details->disc_picture ?>" alt="Image du disc" class="col s12 l6">
                    </div>  
                </div>
                <div class="input-field center-align">
                    <a name="suprimer" class="waves-effect waves-light btn red" href="suprim_script.php?id=<?= $details->disc_id?>">Suprimer</a>
                    <a name="retour"  class="waves-effect green waves-light btn black-text" href="index.php">Retour</a>
                    
                </div>
            </form>

        </div> 
      
<?php include_once("footer.php") ?>
