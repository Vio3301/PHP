<?php
session_start();
if($_GET["send"]==1){
    echo "Ati trimis cu succes mesajul la emailu ".$_SESSION["to"];

}

?>