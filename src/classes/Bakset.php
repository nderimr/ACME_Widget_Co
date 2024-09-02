<?php

namespace classes;

use classes\BlueWidget;
use classes\GreenWidget;
use classes\RedWidget;
use classes\Widget;

try {
    require_once dirname(__DIR__) . '/start.php';
} catch (\Throwable $e) {
    echo "Exception occurred: " . $e->getMessage();
}

class Basket
{
    private array $widgetCodes = [];
    protected float $totalPrice = 0.0;

    public function add(string $widgetCode): void
    {
        $this->widgetCodes[] = $widgetCode;
    }
   
        public function total(): float
    {
        $totalProductsPrice = $this->calculateTotalProductsPrice();
        $totalProductsPrice -= $this->calculateDiscount();
        $shippingPrice = $this->calculateShippingPrice($totalProductsPrice);
        
        $this->totalPrice = $totalProductsPrice + $shippingPrice;

        return $this->totalPrice;
    }

    protected function calculateTotalProductsPrice(): float
    {
        $totalProductsPrice = 0.00;

        foreach ($this->widgetCodes as $widgetCode) {
            $widget = $this->createWidget($widgetCode);
            if ($widget) {
                $totalProductsPrice += $widget->getPrice();
            }
        }

        return $totalProductsPrice;
    }

    protected function createWidget(string $productCode): ?Widget
    {
        return match ($productCode) {
            'R01' => new RedWidget(),
            'G01' => new GreenWidget(),
            'B01' => new BlueWidget(),
            default => null,
        };
    }

    protected function calculateShippingPrice(float $totalProductsPrice): float
    {
        if (empty($this->widgetCodes)) {
            return 0.0;
        }

        return match (true) {
            $totalProductsPrice < 50 => 4.95,
            $totalProductsPrice < 90 => 2.95,
            default => 0.0,
        };
    }

    protected function calculateDiscount(): float
    {
        if (empty($this->widgetCodes)) {
            return 0.00;
        }

        $counts = array_count_values($this->widgetCodes);
        $redWidgetsCount = $counts['R01'] ?? 0;
       
        if ($redWidgetsCount === 0) {
            return 0.0;
        }

        $totalDiscount = 0.00;
        
        $red_widget_discount_counter = (int)($redWidgetsCount/2);
        $totalDiscount += $red_widget_discount_counter * ((new RedWidget())->getPrice() / 2);
        
        return $totalDiscount;

    }

    public function listWidgets(): void
    {
        foreach ($this->widgetCodes as $productCode) {
            echo $productCode . '<br/>';
        }
    }
}
