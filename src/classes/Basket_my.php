<?php
namespace classes;

 try {
    require_once( dirname(__DIR__, 1).'/start.php');
} catch (\Throwable $e) {
    echo "Exeption uccured: " . $e->getMessage();
}


use classes\BlueWidget;
use classes\GreenWidget;
use classes\RedWidget;


class Basket_my{

    private $product_codes = [];
    protected float $total_price = 0;
    
    public function __construct() {
        
    }

    public function add($widget_code)
    {
        $this->product_codes [] = $widget_code;
    }

    public function total()
    {
        $total_products_price = 0;
        
        foreach($this->product_codes as $product_code){
            switch($product_code)
            {
                case 'R01': 
                    $r_widget = new RedWidget;
                    $total_products_price += $r_widget->getPrice();
                    break;
                case 'G01':
                    $g_widget = new GreenWidget;
                    $total_products_price += $g_widget->getPrice();
                    break;
                case 'B01';         
                     $b_widget = new BlueWidget;
                     $total_products_price += $b_widget->getPrice();
                     break;

            }
        }
        $total_products_price = $total_products_price - $this->calculateDiscount(); 
        $shiping_price = $this->calculateShipingPrice($total_products_price);
        $total_price = $total_products_price + $shiping_price;
        return $total_price;
    }

    protected function calculateShipingPrice($total_products_price):float
    {
        if(count($this->product_codes)==0){
            return 0;
        }
        
        if($total_products_price < 50){
           return 4.95;
        }
        else{ 
         if($total_products_price < 90){
           return 2.95;
         }
           else 
           return 0; 
        }
    }
    protected function calculateDiscount():float
    {
        
        if(count($this->product_codes)==0)
          return 0;
        $total_discount = 0.0;
        $counts = array_count_values($this->product_codes);
        $red_widgets_count = isset($counts['R01'])? $counts['R01']:0; 
        if($red_widgets_count==0)
          return 0;
        $green_widgets_count = isset($counts['G01'])? $counts['G01']:0;
        $blue_widgets_count = isset($counts['B01']) ?$counts['B01']:0;
        if($red_widgets_count>0){
            $counter = ($red_widgets_count < $green_widgets_count) ? $red_widgets_count: $green_widgets_count; 
            $g_widget = new GreenWidget();
            $total_discount += $counter * $g_widget->getPrice()/2;
        }
        if($red_widgets_count>$green_widgets_count){
            $unused_discounts = $red_widgets_count- ($red_widgets_count- $green_widgets_count);
            $unused_discounts = $blue_widgets_count < $unused_discounts ? $blue_widgets_count : $unused_discounts;
            $b_widget = new BlueWidget;
            $total_discount += $unused_discounts * $b_widget->getPrice()/2;
        }
        return $total_discount;
    }
    public function list_widgets(){
        foreach($this->product_codes as $product_code)
        {
            echo $product_code.'<br/>';
        }
    }

}
?>