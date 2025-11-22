<?php
try{
    $pdo = new PDO("mysql:host=localhost;dbname=ecommerce_php","root","php2025");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    

}catch(PDOException $e){
    die("Erreur : ".$e->getMessage());

}

?>