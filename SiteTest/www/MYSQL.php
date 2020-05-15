<?php
$mysqli = new mysqli("localhost", "root", "", "mybase");
$mysqli->query("SET NAMES 'uft8'");

$success = $mysqli->query ("INSERT INTO `users` (`login`, `password`, `reg_date`) VALUES ('Vova','".md5("123")."','".time()."')");
echo $success;


for($i =0; $i<10;$i++){
    $mysqli->query ("INSERT INTO `users` (`login`, `password`, `reg_date`) VALUES ('$i','".md5("$i")."','".time()."')");
}

$mysqli->query(" UPDATE `users` SET `reg_date` = '1' WHERE `id` =4");
// $mysqli->query("DELETE FROM `users` WHERE `users`.`id`> 2;");













function printResult($result_set){
while(($row = $result_set->fetch_assoc())!=false){
    print_r($row);
    echo "<br/>";
}
echo "Oameni pe sait sunt :".$result_set->num_rows."<br/>";
}


$result_set = $mysqli->query("SELECT *FROM `users`");
printResult($result_set);
$mysqli->close()

?>