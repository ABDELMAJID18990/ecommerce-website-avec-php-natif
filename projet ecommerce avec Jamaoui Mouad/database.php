<?php
try{


    $host = "mysql-shopecommerce.alwaysdata.net"; 
    $dbname = "shopecommerce_db"; 
    $user = "shopecommerce"; 
    $password = "admin-php-2025";


    $pdo = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    

}catch(PDOException $e){
    die("Erreur de connexion : ".$e->getMessage());

}

?>