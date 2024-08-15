
<?php
require_once '../src/start.php';

use classes\Basket as Basket;
use classes\RedWidget as RedWidget;
use classes\GreenWidget as GreenWidget;
use classes\BlueWidget as BlueWidget;

    $red_widget = new RedWidget;
    $blue_widget = new BlueWidget;
    $green_widget = new GreenWidget;
    session_set_cookie_params(86400);
    session_start();
    if( !isset(  $_SESSION['basket']) ) {
        
        $basket = new Basket;
        $_SESSION['basket'] = serialize($basket);
    }
    

?>
<!DOCTYPE HTML>

<html>
    <head>
         <link rel="stylesheet" href="assets/style.css">
         
         <!-- jquery CDN  -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <BODY>
       <h2>Widgets</h2>
       <div>Total price: <span id="total_price"><?php echo (unserialize($_SESSION['basket']))->total();?></span> </div> 
         <button id="clear_basket" >Clear basket</button>   
       <h3>Delevery price</h3>
       <ul>
            <li> Orders $0-$49.95 - $4.95</li>
            <li> Orders $50-$89.99 - $2.95</li>
            <li> Orders $0-$49.99 - free</li>
       </ul>
        <h3>Special offer</h3>
          <p><b>Buy one red widget and get second one free</b></p>
        <div class="widget">
            <img src="images/red_widget.jpg" class="img_widget">
            <br/>
            <span>Price: $</span><span id="red_widget_price"> <?php echo $red_widget->getPrice()?> </span>
            <br/> 
            <input type="hidden" id="red_widget_code" value="<?php echo $red_widget->getCode()?>" />
            <button id="RedWidgetBtn" >Add to basket</button> 
        </div>
        <div class="widget">
            <img src="images/green_calendar.png" class="img_widget">
            <br/>
            <span>Price: $</span><span id="green_widget_price"><?php echo $green_widget->getPrice()?></span>
            <br/>
            <input type="hidden" id="green_widget_code" value="<?php echo $green_widget->getCode()?>" />
            <button id="GreenWidgetBtn" >Add to basket</button> 
        </div>
        <div class="widget">
            <img src="images/blue_calendar.png" class="img_widget">
            <br/>
            <span>Price:$</span> <span id="green_widget_price"><?php echo $blue_widget->getPrice()?> </span>
            <br>
            <input type="hidden" id="blue_widget_code" value="<?php echo $blue_widget->getCode()?>" />
            <button id="BlueWidgetBtn" >Add to basket</button> 
        </div>
    </BODY>
 
 <script> 
 
    $(document).ready(function(){
        $('#RedWidgetBtn').click(function(e){
        e.preventDefault();
        var rw = $('#red_widget_code').val();
        var  widget_code = { 'widget_code' :rw};
        $.ajax({
            url: '../src/actions/addToBasket.php',
            method:'post',
            data:widget_code,
            success:function(data){
                $('#total_price').text(data);
        }
        });
        });

    $('#GreenWidgetBtn').click(function(e){
        e.preventDefault();
        var rw =$('#green_widget_code').val();
        var  widget_code={ 'widget_code' :rw};
        $.ajax({
            url: '../src/actions/addToBasket.php',
            method:'post',
            data:widget_code,
            success:function(data){
                $('#total_price').text(data);
        }
        });
        });

    $('#BlueWidgetBtn').click(function(e){
        e.preventDefault();
        var rw =$('#blue_widget_code').val();
        var  widget_code={ 'widget_code' :rw};
        $.ajax({
            url: '../src/actions/addToBasket.php',
            method:'post',
            data:widget_code,
            success:function(data){
                $('#total_price').text(data);
        }
        });
        });
        
        $('#clear_basket').click(function(e){
        e.preventDefault();
       
        $.ajax({
            url: '../src/actions/clean_session.php',
            method:'post',
            
            success:function(data){
                $('#total_price').text(0);
        }
        });
        });
    
    });




</script>
</html>