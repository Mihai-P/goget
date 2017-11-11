<?php
namespace app\extra;

class AppBootstrap implements \yii\base\BootstrapInterface {
    public function bootstrap($app){
        $app->user->on(\yii\web\User::EVENT_AFTER_LOGIN, function($event) use ($app) {
            $app->session->set('authKey', $event->identity->auth_key);
        });
    }
}
