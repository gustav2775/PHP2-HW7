<?php

namespace app\controllers;
use app\model\repositories\FeedbackRepository;
use app\model\enitities\Feedback;


class FeedbackController extends Controller
{
    

    public function actionFeedback()
    {
        $feedbackItem = (new FeedbackRepository)->getAll(0);

        echo $this->renderLayouts("feedback", [
            "feedback" => $feedbackItem
        ]);
    }
}
