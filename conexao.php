<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$db = "db_shopping_cart";

$mysqli = new mysqli($host,$usuario,$senha,$db);

if ($mysqli->connect_error)
    echo "Falha na conexão: (".$mysqli->connect_error.")".$mysqli->connect_error;

