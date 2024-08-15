<?php
use PHPUnit\Framework\TestCase;
use classes\Basket;
class TotalPriceTest extends TestCase{

    public function test1()
    {
        $widget_codes = ['R01','G01'];
        $basket  = new Basket;
        foreach($widget_codes as $widget_code){
            $basket->add($widget_code);
         }
         $this->assertTrue($basket->total()-60.85<0.1);
    }

    public function test2()
    {
        $widget_codes = ['B01','G01'];
        $basket  = new Basket;
        foreach($widget_codes as $widget_code){
            $basket->add($widget_code);
         }
         $this->assertTrue($basket->total()-37.85<0.1);
    }

    public function test3()
    {
        $widget_codes = ['R01','R01'];
        $basket  = new Basket;
        foreach($widget_codes as $widget_code){
            $basket->add($widget_code);
         }
         $this->assertTrue($basket->total()-54.37<0.1);
    }

    public function test4()
    {
        $widget_codes = ['B01','B01','R01','R01','R01'];
        $basket  = new Basket;
        foreach($widget_codes as $widget_code){
            $basket->add($widget_code);
         }
         $this->assertTrue($basket->total()-98.27<0.1);
    }

    public function test5()
    {
        $widget_codes = ['B01','B01','R01','R01','R01','G01','G01','R01','B01','R01']; //R-5,G-2,B-2
        $basket  = new Basket;
        foreach($widget_codes as $widget_code){
            $basket->add($widget_code);
         }
         $this->assertTrue($basket->total()-230<0.1);
    }

    public function test6()
    {
        $widget_codes = ['B01','B01','R01','R01','R01','G01','G01','R01','B01','R01','B01','G01']; //R-5,G-3,B-3
        $basket  = new Basket;
        foreach($widget_codes as $widget_code){
            $basket->add($widget_code);
         }
         $this->assertTrue($basket->total()-263<0.1);
    }

    public function test7()
    {
        $widget_codes = ['B01','B01','R01','R01','R01','G01','G01','R01','B01','R01','B01','G01','R01','R01','R01','G01']; //R-8,G-4,B-3
        $basket  = new Basket;
        foreach($widget_codes as $widget_code){
            $basket->add($widget_code);
         }
         $this->assertTrue($basket->total()-387<0.1);
    }

}