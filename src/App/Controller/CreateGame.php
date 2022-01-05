<?php

namespace App\Controller;

use Exception;
use Framework\Controller\AbstractController;
use Framework\Controller\GameController;
use Framework\Controller\UsersController;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as Mexcpetion;
use Framework\Config\Config;
use Framework\Metier\User;

class CreateGame extends AbstractController
{
    public $mailer;
    public function __invoke(): string
    {


        if (!isset($_SESSION["user"]))
            header('Location: /');


        $this->setupMail();

        $content = trim(file_get_contents("php://input"));

        $data = json_decode($content, true);

        $data['success'] = true;

        if ($data['success']) {
            $numberPlayer = $data['jsonData']['numberPlayer'];

            $players = $data['jsonData']['players'];
            $colors = $data['jsonData']['colors'];

            $userArray = [];
            $partyId = $numberPlayer . rand();
            foreach ($players as $key => $value) {
                $userController = new UsersController();
                $user = $userController->getUserByUsername($value);

                $user->setColor($colors[$key]);
                array_push($userArray, $user);
                //$this->sendMailTo($user->getEmail(), $value, $partyId);
            }



            // fonction sendMail et QRCODE pour join la party 

        }



        header('Content-type: application/json');

        try {
            $gameController = new GameController();
            $game = $gameController->newGame($partyId, $userArray);
            $game->setMaster($userArray[0]);
            $response_array['status'] = 'success';
            $response_array['res']['partyId'] = $partyId;
            $response_array['res']['scores'] = $userArray;
            $response_array['res']['players'] = $players;
            $response_array['res']['colors'] = $colors;
            $response_array['res']['game'] = $game->jsonSerialize();
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['exception'] = $e->getMessage();
        }
        return json_encode($response_array);
    }

    public function setupMail()
    {

        $this->mailer = new PHPMailer(true);

        try {
            // Server settings
            //  $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
            $this->mailer->isSMTP();
            $this->mailer->Host = 'smtp.gmail.com';
            $this->mailer->SMTPAuth = true;
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = 587;

            $this->mailer->Username = Config::get('MAIL'); // YOUR gmail email
            $this->mailer->Password = Config::get('MAIL_PASSWORD'); // YOUR gmail password
        } catch (Mexcpetion $e) {
            //   echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function sendMailTo(string $mail, string $receiver, string $msg)
    {
        try {
            // Sender and recipient settings
            $this->mailer->setFrom(Config::get('MAIL'), 'Game Master');
            $this->mailer->addAddress($mail, $receiver);

            // Setting the email content
            $this->mailer->IsHTML(true);
            $this->mailer->Subject = "Your game id";
            $this->mailer->Body = '<h2>Helllo Good Game</h2> <div>' . $msg . '<div>';
            $this->mailer->AltBody = 'Your id : ' . $msg;

            $this->mailer->send();
            //echo "Email message sent.";
        } catch (Mexcpetion $e) {
            echo "Error in sending email. Mailer Error: {$this->mailer->ErrorInfo}";
        }
    }
}
