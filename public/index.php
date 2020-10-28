<?php include_once("../connexion.php") ?>
<?php 
    $requete = $connect->query("SELECT * FROM artist inner join disc on artist.artist_id = disc.artist_id");
    $tableau = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<?php include_once("header.php") ?>
        <div class="row">
            <div class=" col s6"><h4>Liste des disques</h4></div>
            <div class=" col s6"><a href="ajout.php" class= "waves-effect waves-light btn-small right ajout" >Ajouter</a></div>
        </div>
        <div class="row">
            <?php foreach ($tableau as $artist): ?>
                <div class=" col s12 l6" style="text-align: center;">
                    <div class="card horizontal small">
                        <div class="card-image card-image-horizontal">
                            <a href="details.php?id=<?= $artist->disc_id?>">
                                <img src="../pictures/<?= $artist->disc_picture ?>" alt="Image du disc">
                            </a>
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <p class="light left"><strong><?= $artist->disc_title ?></strong></p> <br>
                                <p class="left"><?= $artist->artist_name ?></p> <br>
                                <p class="left"><strong>Label:</strong> <?= $artist->disc_label ?></p> <br>
                                <p class="left"><strong>Year: </strong><?= $artist->disc_year ?></p> <br>
                                <p class="left"><strong>Genre:</strong> <?= $artist->disc_genre ?></p>
                            </div>
                        </div>
                        <a href="details.php?id=<?= $artist->disc_id?>" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add_circle</i></a>
                    </div>
            </div>
            <?php endforeach; ?>
        </div>
        
<?php include_once("footer.php")?>
