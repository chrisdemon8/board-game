<?php

namespace Framework\Controller;

use Framework\Metier\Answer;
use App\bdd\MyConnection;
use Framework\Controller\ErrorManager;
use \PDO;

class AnswerController extends AbstractControllerBdd
{
    public ?\PDO $connection;

    public function __construct()
    {
        $this->connection = MyConnection::getInstance();
    }

    public function getAnswerByAnswerId(int $id): Answer
    {
        $request = $this->connection->prepare('SELECT * FROM answer WHERE id_answer = :id');

        $request->bindValue(':id', $id, PDO::PARAM_INT);

        $request->execute();

        $Answer = $request->fetch();
        if ($Answer == null)
            ErrorManager::notExist('ID answer');
        return Answer::Objectify($Answer);
    }

    public function getAnswersByQuestionId(int $id): array
    {
        $request = $this->connection->prepare('SELECT * FROM answer WHERE id_question = :id');

        $request->bindValue(':id', $id, PDO::PARAM_INT);

        $request->execute();

        $AnswersData = $request->fetchAll();
        $Answers = [];
        foreach ($AnswersData as $AnswerData) {
            $Answer = Answer::Objectify($AnswerData);
            array_push($Answers, $Answer);
        }

        return $Answers;
    }

    public function getAllAnswer(): array
    {
        $request = $this->connection->prepare('SELECT * FROM answer ');
        $request->execute();
        $AnswersData = $request->fetchAll();
        $Answers = [];
        foreach ($AnswersData as $AnswerData) {
            $Answer = Answer::Objectify($AnswerData);
            array_push($Answers, $Answer);
        }
        return $Answers;
    }

    public function updateAnswer(Answer $Answer): void
    {

        $this->conform($Answer);
        $request = $this->connection->prepare('UPDATE answer SET label_answer = :label,valid = :valid WHERE id_answer = :id');

        $request->bindValue(':id', $Answer->getIdAnswer(), PDO::PARAM_INT);
        $request->bindValue(':label', $Answer->getLabelAnswer());
        $request->bindValue(':valid', $Answer->isValid() == 1 ? 1 : 0, PDO::PARAM_STR);

        $request->execute();
    }

    public function deleteAnswer(int $id_answer): void
    {
        $request = $this->connection->prepare('DELETE FROM `answer` WHERE id_answer = :id');
        $request->bindValue(':id', $id_answer);
        $request->execute();
    }

    public function addAnswer(Answer $Answer): void
    {
        $messageError = '';
        $this->conform($Answer);
        $request = $this->connection->prepare('SELECT COUNT(*) as exist FROM answer WHERE label_answer = :label');
        $request->bindValue(':label', $Answer->getLabelAnswer());
        $labelUnique = $request->execute(); 
        $labelUnique = $request->fetch();


        $request = $this->connection->prepare('SELECT * FROM question WHERE id_question = :id');
        $request->bindValue(':id', $Answer->getIdQuestion());
        $QuestionExist = $request->execute();

        if ($labelUnique['exist'] > 0)
            $messageError .= 'ERROR_LABEL';
        if ($QuestionExist == NULL)
            $messageError .= '/ERROR_ID_QUESTION';

        if ($messageError == '') {
            //TODO: A testé
            //le 0 est la pour match le nombre d'arguement , il n'est pas mis dans la bdd
            $request = $this->connection->prepare('INSERT INTO answer (label_answer, id_question, valid) VALUES (:label_answer,:id_question,:valid)');

            $request->bindValue(':label_answer', $Answer->getLabelAnswer());
            $request->bindValue(':id_question', $Answer->getIdQuestion());
            $request->bindValue(':valid', $Answer->isValid() == 1 ? 1 : 0, PDO::PARAM_STR);

            $request->execute();
        } else
            ErrorManager::CustomError($messageError);
    }
}
