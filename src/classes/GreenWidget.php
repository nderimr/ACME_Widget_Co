<?php
namespace classes;
use classes\Widget;

class GreenWidget implements Widget
{
    private $price = 24.95;
    private $code = 'G01';
    public function getPrice():float
    {
      return $this->price; 
    }
    public function getCode():string
    {
        return $this->code;
    }

}