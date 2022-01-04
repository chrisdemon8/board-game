<?php

namespace App\Controller;

use Framework\Controller\AbstractController;

use Framework\Controller\GameController;
use Framework\Controller\QuestionController;
use Framework\Metier\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Framework\Config\Config;



class GetRandomQuestion extends AbstractController
{
    private GameController $gameCont;

    public function __invoke($level): string
    {
      $mail = new PHPMailer(true);

      try {
          // Server settings
          $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = 587;
      
          $mail->Username = Config::get('MAIL'); // YOUR gmail email
          $mail->Password = Config::get('MAIL_PASSWORD'); // YOUR gmail password
      
          // Sender and recipient settings
          $mail->setFrom(Config::get('MAIL'), 'Valou');
          $mail->addAddress('valczi@orange.fr', 'Valou2');
      
          // Setting the email content
          $mail->IsHTML(true);
          $mail->Subject = "Send email using Gmail SMTP and PHPMailer";
          $mail->Body = 'HTML message body. <b>Gmail</b> SMTP email body.';
          $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
      
          $mail->send();
          echo "Email message sent.";
      } catch (Exception $e) {
          echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
      }
        $gameCont=new GameController();

        $user=new User();
        $user->setUsername('admin');
        $user2=new User();
        $user2->setUsername('chris');
        $user3=new User();
        $user3->setUsername('chrisdemon8');
        $users=[];
        array_push($users,$user,$user2,$user3);
        $gameCont->newGame(165411354,$users);
      //  $question=$gameCont->getQuestion($level);
        //$gameCont
       // $answer=$question->getAnswers()[0];
       // $gameCont->responseManual(true);
       // $gameCont->getGame()->addPoints(50,$user2);
        echo '<pre>';
       // print_r($Question);

        print_r($gameCont->getGame());
         return $this->render('testChris.html.twig',[
            'test' => $level,
         ]
        );
    }
}
