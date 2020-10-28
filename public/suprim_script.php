<?php
    $id = $_GET['id'];
   include("../connexion.php");
       $cmd = $connect->prepare('DELETE FROM disc where disc_id =:id');
       $cmd->bindValue(':id', $id, PDO::PARAM_INT);
       if($cmd->execute()) {
        header("Location: index.php");
       } else {
        echo '<p>Problème</p>';
       };
       $cmd->closeCursor();

?>