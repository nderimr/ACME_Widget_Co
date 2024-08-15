<?php
namespace classes;
use classes\Widget;

class RedWidget implements Widget
{
    private $price = 32.95;
    private $code = 'R01';
    public function getPrice():float
    {
      return $this->price; 
    }
    public function getCode():string
    {
        return $this->code;
    }

}