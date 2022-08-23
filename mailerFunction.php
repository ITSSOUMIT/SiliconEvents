<?php    
    function mailsomeone($to, $subject, $message){
        include('config.php');
        require 'PHPMailer/PHPMailerAutoload.php';

        $smtpServer = "smtp.gmail.com";
        $email = "notifications.from.soumit@gmail.com";
        $password = "SOUMITdas@29";

        if(strcmp($to, 'all')==0){
            $suquery = "SELECT * FROM adminbase WHERE accessLevel!=0 AND status=1";
            $suresult = $conn->query($suquery);
            while($surow = $suresult->fetch_assoc()){
                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host = $smtpServer;
                $mail->SMTPAuth = true;
                $mail->Username = $email;
                $mail->Password = $password;
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom($email, 'Silicon Report Portal');
                $mail->addAddress($surow['email'], $surow['name']);
                $mail->addReplyTo($email);

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $message;
                $mail->AltBody = $message;

                $mail->send();

                unset($mail);
            }
        }else{

            $adminid = $to;
            echo $adminid;
            $query = "SELECT * FROM adminbase WHERE adminid='$adminid'";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();

            $toEmail = $row['email'];
            $toName = $row['name'];
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = $smtpServer;
            $mail->SMTPAuth = true;
            $mail->Username = $email;
            $mail->Password = $password;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom($email, 'Silicon Report Portal');
            $mail->addAddress($toEmail, $toName);
            $mail->addReplyTo($email);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = $message;

            $mail->send();

            unset($mail);
        }
    }
?>