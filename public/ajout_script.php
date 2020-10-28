<?php include_once("../connexion.php") ?>


<?php
// déclaration du tableau d'erreur
$listeErreurs = array();
$textPattern = '/^[A-Za-z0-9\-\déèàçùëüïôäâêûîô#&]{1,200}$/';
$yearPatern = '/^[1-2]([0-9]{3})$/';
$pricePattern = '/^[\d]+[.]{1}[\d]{2,}+$/';
$idPatern = '/^[0-9]$/';

if (isset($_POST["ajouter"])) {
    if (!empty($_POST['titre']))
    {
        if (preg_match($textPattern, $_POST['titre']))
        {
            $disc_titre = htmlspecialchars($_POST['titre']);
        }
        else
        {
            $listeErreurs['titre'] = 'Veuillez renseigner un titre valide.';
        }
    }
    else
    {
        $listeErreurs['titre'] = 'Veuillez préciser une référence au produit.';
    }

 // Verification artist_id
    if (!empty($_POST["artist_id"]))
    {
        if (preg_match($idPatern, $_POST["artist_id"]))
        {
            $artist_id = htmlspecialchars($_POST["artist_id"]);
        }
        else
        {
            $listeErreurs["artist_id"] = 'Veuillez renseigner un artist valide.';
        }
    }
    else
    {
        $listeErreurs["artist_id"] = 'Veuillez préciser un artist.';
    }
 // Verification année
    if (!empty($_POST["annee"]))
    { 
        if (preg_match($yearPatern, $_POST["annee"])){
            $disc_year = htmlspecialchars($_POST["annee"]);   
        }
        else
        {
            $listeErreurs["annee"] = 'Veuillez renseigner une année valide.';
        }
    }
    else
    {
        $listeErreurs["annee"] = 'Veuillez préciser une année.';
    }

    // Verification genre
    if (!empty($_POST["genre"]))
    {
        if (preg_match($textPattern, $_POST["genre"]))
        {
            $disc_genre = htmlspecialchars($_POST["genre"]);
        }
        else
        {
            $listeErreurs["genre"] = 'Veuillez renseigner un genre valide.';
        }
    }
    else
    {
        $listeErreurs["genre"] = 'Veuillez préciser le genre.';
    }

    // Verification label
    if (!empty($_POST["label"]))
    {
        if (preg_match($textPattern, $_POST["label"]))
        {
            $disc_label = htmlspecialchars($_POST["label"]);
        }
        else
        {
            $listeErreurs["label"] = 'Veuillez renseigner un label valide.';
        }
    }
    else
    {
        $listeErreurs["label"] = 'Veuillez préciser le label.';
    }

    // Verification price
    if (!empty($_POST["label"]))
    {
        if (preg_match($textPattern, $_POST["price"]))
        {
            $disc_price = htmlspecialchars($_POST["price"]);
        }
        else
        {
            $listeErreurs["price"] = 'Veuillez renseigner un prix valide.';
        }
    }
    else
    {
        $listeErreurs["price"] = 'Veuillez préciser le prix.';
    }

   if ($_FILES['picture']['name'] != '') {
        $typespermis = array('image/gif', 'image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/tiff');// Les extensions autorisée
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $typeFichier = finfo_file($finfo, $_FILES['picture']['tmp_name']);
        finfo_close($finfo);
        if (in_array($typeFichier, $typespermis)) { // Pour verifier si l'extension du fichier existe dans la liste des extensions permis
            $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION); // Pour prendre l'extension du fichier 
            $today= getdate();
            $picture = $disc_titre.$disc_year.$today["seconds"]. '.' .$extension;
            } else {
          // cas où il n'y a pas de fichier d'uploader, dans le cas d'un ajoût de produit
          $listeErreurs['file'] = 'Vous devez joindre une photo valide au produit !';
      }
    }
    if (count($listeErreurs) == 0) {
        $query = 'INSERT INTO `disc` (disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id) VALUE ( :titre, :annee, :picture, :label, :genre, :price, :artist_id)';
        $ajout_disc = $connect->prepare($query);
        $ajout_disc->bindValue(':titre', $disc_titre, PDO::PARAM_STR);
        $ajout_disc->bindValue(':annee', $disc_year, PDO::PARAM_INT);
        $ajout_disc->bindValue(':picture',$picture, PDO::PARAM_STR);
        $ajout_disc->bindValue(':label', $disc_label, PDO::PARAM_STR);
        $ajout_disc->bindValue(':genre', $disc_genre, PDO::PARAM_STR);
        $ajout_disc->bindValue(':price', $disc_price, PDO::PARAM_STR);
        $ajout_disc->bindValue(':artist_id', $artist_id, PDO::PARAM_STR);
        if ($ajout_disc->execute()){
            $stockage = "../pictures/"; 
            $_FILES['picture']['name'] = $connect->lastInsertId();
            $nomNouv = $stockage. $picture;
            chmod($_FILES['picture']['tmp_name'], 0750);
            move_uploaded_file($_FILES['picture']['tmp_name'], $nomNouv);

            header("Location: index.php");
            }
    } else{
        $listeErreurs['error'] = 'Une erreur est survenue lors de l\'insertion du produit dans la base de données.';
  }                             
   
}


   
?>
