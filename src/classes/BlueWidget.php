<?php
namespace classes;
use classes\Widget;

class BlueWidget implements Widget
{
    private $price = 7.95;
    private $code = 'B01';
    public function getPrice():float
    {
      return $this->price; 
    }
    public function getCode():string
    {
        return $this->code;
    }
}