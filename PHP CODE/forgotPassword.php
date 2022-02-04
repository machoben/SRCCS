<?php include("includes/config.php");

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style type="text/css"></style>
</head>
<body>

 <?php include 'includes/header.php'; ?>



<div class="container login-container">
    <div class="row">

    <div class="col-md-6 login-form-1">


        <?php 


//require 'vendor/autoload.php';
use \Mailjet\Resources;

    if(isset($_POST['forgotPassword'])){
        $email = $_POST['email'];

        $randomCode=rand(111111,999999);

$sql = "UPDATE users SET verifycode=? WHERE email=?";
$stmt= $dbh->prepare($sql);
$stmt->execute([$randomCode, $email]);

$query = "select * from `users` where `email`=:email";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam('email', $email, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      $theEmail = $row['email'];
$mj = new \Mailjet\Client('f3de44a7ff6936fe90af0813aa697ca7', '34fc0884846ab0f95739c8c7df85529a', true,['version' => 'v3.1']);
$body = [
    'Messages' => [
        [
            'From' => [
                'Email' => "test@alineuwase.xyz",
                'Name' => "Password Verification (study)"
            ],
            'To' => [
                [
                    'Email' => $theEmail,
                    'Name' => $theEmail
                ]
            ],
            'Subject' => "Email verification!",
            'TextPart' => "The code below is your password verification code",
            'HTMLPart' => "<h1>".$row['verifycode']."</h1>"
        ]
    ]
];
$response = $mj->post(Resources::$Email, ['body' => $body]);
$response->success() && var_dump($response->getData());

echo "<script>alert('Verification email Sent')</script>";


    }
?>
                    <h3>Forgot Password</h3>
                    <div id="forget" style="width: 400px;">
                        <form method="POST">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Your Email *" name="email" value="" required />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" name="forgotPassword" value="Send Verification code" />
                        </div>
                    </form>
                    </div>
                </div>
    <div class="col-md-6 login-form-2">
        <?php 
        

        if (isset($_POST['changePassword'])) {
        
        $vcode = $_POST['code'];
        $passwordi = $_POST['password'];
        $hashedPasswordi = md5($passwordi);
        $confirmPasswordi = $_POST['confirmPassword'];

        if($passwordi != $confirmPasswordi)
        {
            echo "<div class='alert alert-danger' role='alert'>Passowrds must match</div>";
        }
        
        if(strlen($passwordi) < 6)
        {
           echo "<div class='alert alert-danger' role='alert'>Passowrd must be 6 character's long</div>";
        }
        
        if(!preg_match("#[0-9]+#", $passwordi))
        {
            echo "<div class='alert alert-danger' role='alert'>Passowrd must include a number</div>";;
        }
        
        if(!preg_match("#[a-z]+#", $passwordi))
        {
            echo "<div class='alert alert-danger' role='alert'>Passowrd must include a lowercase letter</div>";
        }
        if(!preg_match("#\W+#", $passwordi))
        {
            echo "<div class='alert alert-danger' role='alert'>Passowrd must include a special character</div>";
        }

        if( !preg_match("#[A-Z]+#", $passwordi ) ) {
            echo "<div class='alert alert-danger' role='alert'>Passowrd must include an UPPERCASE LETTER</div>";
        }

        $query3 = "select * from `users` where `verifycode`=:code";
      $stmt = $db->prepare($query3);
      $stmt->bindParam('code', $vcode, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($count > 0) {

        $sql3 = "UPDATE users SET password=? WHERE verifycode=?";
        $stmt= $db->prepare($sql3);
        $stmt->execute([$hashedPasswordi, $vcode]);

        echo "<script>
        alert('Password changed successful');
        window.location = 'index.php'
        </script>";
      }else{
        echo "<script>
        alert('Wrong Verification Code');
        window.location = 'index.php'
        </script>";
      }
        }

         ?>
        
        
    </div>
    </div>
</div>


        <script src="index.js"></script>      
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>