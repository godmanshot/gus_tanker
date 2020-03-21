<?php

namespace App\Work;

use App\Work;
use Illuminate\Http\Response;

abstract class WorkWriter {

    protected $work;
    protected $station;

    // public function __construct($station = false, $work = false)
    // {
    //     $this->station = $station;
    //     $this->work = $work;
    // }

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

    abstract public function write();
}