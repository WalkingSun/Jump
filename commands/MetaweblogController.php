<?php

namespace app\commands;

use yii\console\Controller;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Yii;
use yii\db\Exception;

class MetaweblogController extends Controller
{

    public function actionIndex(){

        die('success');
    }

}
