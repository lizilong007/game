<?php
namespace common\crawler;

use yii\web\ServerErrorHttpException;

class CrawlerException extends ServerErrorHttpException {

    const CRAWLER_NOT_FOUND_CONTENT =   1000;
    const CRAWLER_NOT_FOUND_RANK =   1001;

    public function __construct($code = 0, $message = null, \Exception $previous = null)
    {
        switch ($code) {
            case CRAWLER_NOT_FOUND_CONTENT :
                $message = 'content not found : ' . $message;
                break;
            case CRAWLER_NOT_FOUND_RANK :
                $message = 'rank not found : ' . $message;
                break;
        }
        parent::__construct($code, $message, $previous);
    }

}

?>