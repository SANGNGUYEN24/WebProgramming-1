<?php

require_once './conectCollection.php';
require_once '../models/question.model.php';

// Query all questions in the appropriate quiz when the user enter quiz Id
// @param quizId
// @return array[QuestionModel]

function getQuizQuestions($quizId){
    // Query
    global $questionCollection;
    $result = $questionCollection->find(["quizId" => $quizId]);

    $questionArray = array();
    foreach ($result as $document) {

    $question = new QuestionModel(
        $document['quizId'],
        $document['questionId'],
        $document['content'],
        $document['content'],
        $document['option2'],
        $document['option3'],
        $document['option4'],
    );

    $questionArray[] = $question;
}
    // print_r($questionArray[0]);
    return $questionArray;
}


