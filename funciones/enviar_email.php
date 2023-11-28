<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';
    require 'conecta.php';

    $email = new PHPMailer(true);

    $email ->isSMTP();
    $email->Host = 'smtp.gmail.com';
    $email->SMTPAuth = true;
    $email->Username = 'dogeway.verify@gmail.com'; //email
    $email->Password = 'ssnd iqaf xyls datw';  //Gmail app pass
    $email->SMTPSecure = 'ssl';
    $email->Port = 465;
    $email->setFrom('dogeway.verify@gmail.com'); //email
    
    //Consulta dependiendo del id que se recibe por el url
    $con = conecta();
    $id = $_GET['id'];
    $sql = "SELECT correo,codigo_verificacion FROM usuario WHERE id='$id'";
    $result = $con->query($sql);
    $row = $result->fetch_array();
    $email->addAddress($row['correo']);

    $email->isHTML(true);

    $email->Subject = 'Validacion de Cuenta';
    $email->Body = "Codigo de verificacion: ".$row['codigo_verificacion'];  

    $email->send();

    header("Location: ../emailConfirmation.php?id=".$id);
    exit();
 ?>