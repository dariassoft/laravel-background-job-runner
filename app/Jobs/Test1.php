<?php

namespace App\Jobs;


class Test1
{
    public function play(array $parameters)
    {
        $str_params = implode($parameters);
        echo "Executed: Test1.play({$str_params})";
    }
}
