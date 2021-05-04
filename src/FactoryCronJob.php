<?php

namespace dynamikaweb\fakecronjob;

use Yii;

class FactoryCronJob
{
    public static function create($clousure)
    {
        if ($clousure !== NULL) {
            return $clousure;
        }

        return function($name) {
            array_map(
                function($event) use ($name) {
                    if (empty($name) || $event->getSummaryForDisplay() == $name) {
                        $event->run(Yii::$app);
                    }
                },
                Yii::$app->schedule->dueEvents(Yii::$app)
            );
        };
    }
}