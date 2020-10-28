<?php
    try {
        $urer = 'root';
        $pass= '';
        $dns = 'mysql:host=localhost; dbname=record';
        $connect = new PDO($dns, $urer, $pass);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br>";
        die();
    }
?>