<?php

namespace App\Work;

use App\Work;
use Illuminate\Http\Response;

class HtmlWorkWriter extends WorkWriter {

    public function write()
    {
        $balloon = $this->work->balloon();

        return "<h1>$balloon</h1>";
    }
}