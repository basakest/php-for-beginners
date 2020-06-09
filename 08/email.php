<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './includes/init.php';
require './includes/header.php';
require './vendor/PHPMailer/src/Exception.php';
require './vendor/PHPMailer/src/PHPMailer.php';
require './vendor/PHPMailer/src/SMTP.php';
$email = "";
$subject = "";
$content = "";
$errors = [];
$sent = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //var_dump($_POST);
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $content = $_POST["content"];
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $errors[] = "The email format is wrong";
    }
    if (empty($subject)) {
        $errors[] = "The subject is empty";
    }
    if (empty($content)) {
        $errors[] = "The content is empty";
    }
    if (empty($errors)) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            //$mail->SMTPDebug = 2;
            $mail->Host = "smtp.qq.com";
            $mail->SMTPAuth = true;
            $mail->Username = "1652759879@qq.com";
            $mail->Password = "remove it from here";
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;
            $mail->CharSet = 'UTF-8';

            $mail->IsHTML(true);
            $mail->setFrom("1652759879@qq.com");
            $mail->addAddress("ab1652759879@gmail.com");
            $mail->addReplyTo($email);
            $mail->Subject = $subject;
            $mail->Body = $content;
            $mail->send();
            $sent = true;
        } catch(Exception $e) {
            $errors[] = $mail->ErrorInfo;
        }
    }
}
?>
<h2>Contact</h2>
<?php if($sent):?>
    <p>Message sent.</p>
<?php else:?>
<?php if(!empty($errors)):?>
    <div>
        <?php foreach($errors as $error):?>
            <p><?=$error;?></p>
        <?php endforeach;?>
    </div>
<?php endif;?>
<form method="post" id="email-form">
    <div class="form-group">
        <label for="email">Your email:</label>
        <input type="email" name="email" id="email" class="form-control" value="<?=htmlspecialchars($email) ;?>">
    </div>
    <div class="form-group">
        <label for="subject">Subject:</label>
        <input type="text" name="subject" id="subject" class="form-control" value="<?=htmlspecialchars($subject);?>">
    </div>
    <div class="form-group">
        <label for="content">Content:</label>
        <textarea name="content" id="content" cols="30" rows="10" class="form-control"><?=htmlspecialchars($content);?></textarea>
    </div>
    <button class="btn btn-primary">submit</button>
</form>
<?php endif;?>
<?php
require './includes/footer.php';
?>