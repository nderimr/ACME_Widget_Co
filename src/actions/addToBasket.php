<?php
  namespace actions;
      try {
        require_once('../start.php');
    } catch (\Throwable $e) {
      echo "Exeption thrown: " . $e->getMessage();
    }

    use classes\Basket as Basket;

    session_start();
    if( !isset( $_SESSION['basket'] ) ) {
        $basket = new Basket;
        $_SESSION['basket'] = serialize($basket);
    }
   
    
    $basket = clone unserialize($_SESSION['basket']);
    $widget_code = $_POST['widget_code']; 
    if(isset($_SESSION['basket']))
    {
            $basket->add($widget_code);
            $total_price = $basket->total();
            $_SESSION['basket'] = serialize($basket);  
            echo  $total_price;
    }
 
