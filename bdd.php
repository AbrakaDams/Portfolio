<?php 

$upValid = true;
// création d'une data_base restaurant si elle n'existe pas.
$db = new PDO('mysql:host=localhost;charset=utf8', 'root', '');
$db->query("create database if not exists site_portfolio");
$db->query("use site_portfolio"); 

/********************************************TABLE USERS ************************************************/

// crée la talbe users si elle n'existe pas.
$sql = $db->exec("CREATE TABLE IF NOT EXISTS `contact` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) NOT NULL , 
    `email` VARCHAR(255) NOT NULL , 
    `content` VARCHAR(255) NOT NULL , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;"
);
if($sql === false){
    die(var_dump($db->errorInfo()));
}