<?php

namespace App\Helpers;

class Generator
{
    public static function SurveyCodeGenerate($model, $col_name, $count, $prefix)
    {
        $data = $model::orderBy('surveyID', 'desc')->first();

        if (!$data) {
            $zeroes_count = 4;
            $last_number = 1;
        } else {
            $last_number = (int)$data->$col_name + 1;
            $zeroes_count = $count - strlen($last_number);
        }

        $zeros = "";
        for ($i = 0; $i < $zeroes_count; $i++) {
            $zeros .= "0";
        }

        return $prefix . '-' . $zeros . $last_number;
    }
}
