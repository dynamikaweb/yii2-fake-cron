<?php

namespace dynamikaweb\fakecronjob;

use Closure;
use Yii;

class FakeCronJob extends \yii\base\Component
{
    public $clousure = null;

    public $cache_time = 60;

    public $cache_name = "dynamikaweb-fake-cronjob-";

    public function init()
    {
        parent::init();
        $this->clousure = FactoryCronJob::create($this->clousure);
    }

    public function update($name = null)
    {
        if(!Yii::$app->cache->exists("{$this->cache_name}{$name}") && !Yii::$app->cache->exists($this->cache_name)) {
            Yii::$app->cache->set("{$this->cache_name}{$name}", true, $this->cache_time);
            call_user_func($this->clousure, $name);
        }
    }
}