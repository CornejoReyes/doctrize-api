<?php

namespace App;


class Response
{
    public $code;
    public $msg;
    public $exception;
    public $rows;

    public function __construct(){
        $code = 500;
        $msg = '';
        $exception = '';
        $rows = [];
    }
}
