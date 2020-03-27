<?php

namespace App\Work;

use App\Work;
use Illuminate\Http\Response;

abstract class WorkWriter {

    protected $work;
    protected $station;

    public function __construct($file = null)
    {
        $this->file = $file;
    }

    public function setWork($work)
    {
        $this->work = $work;
    }

    public function getWork()
    {
        return $this->work;
    }

    public function setStation($station)
    {
        $this->station = $station;
    }

    public function getStation()
    {
        return $this->station;
    }

    abstract public function write($path);
}