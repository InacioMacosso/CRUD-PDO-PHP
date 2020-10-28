<?php include("../connexion.php");
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
            <form  class = " col s12 " method = "post" id="contact">
                <h4>Details</h4>
                <div class="row">
                    <div class="input-field col s12 l6">
                        <input id="titre" type="text" name="titre" value="<?= $details->disc_title ?>" readonly>
                        <label for="titre">Title</label>
                    </div>
                    <div class="input-field col s12 l6">
                        <input id="titre" type="text" name="titre" value="<?= $details->artist_name ?>" readonly>
                        <label for="titre">Artiste</label>
                    </div>
                    <div class="input-field col s12 l6">
                        <input id="titre" type="text" name="titre" value="<?= $details->disc_year ?>" readonly>
                        <label for="titre">Year</label>
                    </div>
                    <div class="input-field col s12 l6">
                        <input id="titre" type="text" name="titre" value="<?= $details->disc_genre ?>" readonly>
                        <label for="titre">Genre</label>
                    </div>
                    <div class="input-field col s12 l6">
                        <input id="titre" type="text" name="titre" value="<?= $details->disc_label ?>" readonly>
                        <label for="titre">Label</label>
                    </div>
                    <div class="input-field col s12 l6">
                        <input id="titre" type="text" name="titre" value="<?= $details->disc_price ?>" readonly>
                        <label for="titre">Price</label>
                    </div>
                   
                    <div class="file-field input-field col s12 l6">
                        <p>Picture</p>
                        <img id="picture" src="../pictures/<?= $details->disc_picture ?>" alt="" class="col s12 l6">
                    </div>
                </div>  
                <div class="input-field center-align">
                    <a name="modifier" class="waves-effect yellow waves-light btn black-text" href="modifier.php?id=<?= $details->disc_id?>">Modifier</a>
                    <a name="suprimer" class="waves-effect waves-light btn red" href="suprimer.php?id=<?= $details->disc_id?>">Suprimer</a>
                    <a name="retour"  class="waves-effect green waves-light btn " href="index.php">Retour</a>
                    
                </div>
            </form>

        </div>
<?php include_once("footer.php") ?>