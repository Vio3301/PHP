<?php
session_start();
if(isset($_POST["send"])){
    $from = htmlspecialchars ($_POST["from"]);
    $to = htmlspecialchars($_POST["to"]);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);
    $_SESSION["from"] =  $from;
    $_SESSION["to"] =  $to;
    $_SESSION["subject"] =  $subject;
    $_SESSION["message"] =  $message;
    $error_from = "";
    $error_to = "";
    $error_subject = "";
    $error_message = "";
    $error = false;
    if($from == "" || !preg_match ("/@/", $from)){
        $error_from = "Nui corect";
        $error = true;
    }
    if($to == "" || !preg_match ("/@/", $to)){
        $error_to = "Nui corect";
        $error = true;
    }
    if(strlen($subject) == 0){
        $error_subject = "Introdu ceva";
        $error = true;
    }
    if(strlen($message) == 0){
        $error_message = "Introdu ceva";
        $error = true;
    }
    if(!$error){
        $subject = "=?uft-8?B?".base64_encode($subject)."?=";
        $headers = "From: $from\r\n Reply-to: $from\r\rContent-type: text/plain; charset=uft-8\r\n";
        mail($to,$subject,$message,$headers);
        header ("Location: success.php?send=1");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>

<body>
    <h2>Forma</h2>
    <form name="feedback" action="" method="post">
        <label>De la cine :</label>
        <input type="text" name="from" value="<?php  echo $_SESSION["from"]?>"><br />
        <span style="color: red"><?php echo $error_from?></span><br />
        <br />
        <label>Cui :</label>
        <input type="text" name="to" value="<?php  echo $_SESSION["to"]?>"><br />
        <span style="color: red"><?php echo $error_to?></span><br />
        <br />
        <label>Tema :</label>
        <input type="text" name="subject" value="<?php  echo $_SESSION["subject"]?>"><br />
        <span style="color: red"><?php echo $error_subject?></span><br />
        <br />
        <label>Mesaj:</label> <br />
        <textarea name="message" id="" cols="30" rows="10" ><?php  echo $_SESSION["message"]?></textarea><br />
        <span style="color: red"><?php echo $error_message?></span><br />
        <input type="submit" name="send" value="Trimite">
    </form>
</body>

</html>