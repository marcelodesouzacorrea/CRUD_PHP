<?php
    define('servidor','localhost');
    define('usuario','root');
    define('senha','');
    define('bancoDados','cadastroclientes');

    $mysqli = new mysqli(servidor,usuario,senha,bancoDados);

    if ($mysqli === false) {
        die("ERRO: não conectado." .$mysqli->connect);
    }
?>