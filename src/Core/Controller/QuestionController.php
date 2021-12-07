<?php

namespace Framework\Controller;

use Framework\Controller\AnswerController;
use Framework\Controller\ErrorManager;
use Framework\Metier\Question;
use App\bdd\MyConnection;
use \PDO;

class QuestionController
{
    public ?\PDO $connection;
    public function __construct()
    {
        $this->connection = MyConnection::getInstance();
    }

    public function getQuestionById(int $id): Question
    {
        $request = $this->connection->prepare('SELECT * FROM question WHERE id_question = :id');

        $request->bindValue(':id', $id, PDO::PARAM_INT);

        $request->execute();

        $Question = $request->fetch();
        if ($Question == null)
            ErrorManager::notExist('ID Question');

        $object = Question::Objectify($Question);
        $object->setAnswers($this->getAnswers($object->getIdQuestion()));
        return $object;
    }

    private function getAnswers(int $id_question)
    {
        $AnswerCont = new AnswerController();
        return $AnswerCont->getAnswersByQuestionId($id_question);
    }

    public function getAllQuestions(): array
    {
        $request = $this->connection->prepare('SELECT * FROM question ');
        $request->execute();
        $QuestionsData = $request->fetchAll();
        $Questions = [];

        foreach ($QuestionsData as $QuestionData) {
            $Question = Question::Objectify($QuestionData);
            $Question->setAnswers($this->getAnswers($Question->getIdQuestion()));
            array_push($Questions, $Questions);
        }
        return $Questions;
    }


    public function getAllQuestionsJson(): array
    {
        $request = $this->connection->prepare('SELECT * FROM question ');
        $request->execute();
        $QuestionsData = $request->fetchAll();
        $Questions = [];

        foreach ($QuestionsData as $QuestionData) {
            $Question = Question::Objectify($QuestionData);
            $Question->setAnswers($this->getAnswers($Question->getIdQuestion()));
            array_push($Questions, $Question->jsonSerialize());
        }
        return  $Questions;
    }

    public function countQuestions(): int
    {
        $request = $this->connection->prepare('SELECT COUNT(*) as number FROM question ');
        $request->execute();
        $number = $request->fetch();

        if ($number['number'] > 0)
            return $number['number'];

        return 0;
    }

    public function updateQuestion(Question $Question): void
    {
        $request = $this->connection->prepare('UPDATE question SET label_question = :label,level = :level WHERE id = :id');

        $request->bindValue(':level', $Question->getLevel(), PDO::PARAM_INT);
        $request->bindValue(':label', $Question->getLabelQuestion());
        $request->bindValue(':id', $Question->getIdQuestion());

        $request->execute();
    }


    public function deleteQuestion(int $id_question): void
    {
        $request = $this->connection->prepare('DELETE FROM `answer` WHERE id_question = :id');
        $request->bindValue(':id', $id_question);
        $request->execute();
        
        $request = $this->connection->prepare('DELETE FROM `question` WHERE id_question = :id');
        $request->bindValue(':id', $id_question);
        $request->execute();

        
    }


    public function addQuestion(Question $Question): void
    {
        $messageError = '';

        $request = $this->connection->prepare('SELECT * FROM question WHERE label = :label');
        $request->bindValue(':label', $Question->getLabelQuestion());
        $labelUnique = $request->execute();

        if ($labelUnique != NULL)
            $messageError .= 'ERROR_LABEL';

        if ($messageError == '') {
            //TODO: A testé
            //le 0 est la pour match le nombre d'arguement , il n'est pas mis dans la bdd
            $request = $this->connection->prepare('INSERT INTO question VALUES (0,:label,:level)');

            $request->bindValue(':level', $Question->getLevel(), PDO::PARAM_INT);
            $request->bindValue(':label', $Question->getLabelQuestion());

            $request->execute();
        } else
            ErrorManager::CustomError($messageError);
    }
}
