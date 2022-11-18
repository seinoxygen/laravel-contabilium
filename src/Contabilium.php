<?php

namespace SeinOxygen\Contabilium;

use SeinOxygen\Contabilium\Api\ApiClient;

class Contabilium extends ApiClient
{
    public function Client()
    {
        return new Api\Client();
    }

    public function Invoice()
    {
        return new Api\Invoice();
    }

    public function Provider()
    {
        return new Api\Provider();
    }

    public function Inventory()
    {
        return new Api\Inventory();
    }

    public function PriceList()
    {
        return new Api\PriceList();
    }

    public function Order()
    {
        return new Api\Order();
    }

    public function SalePoint()
    {
        return new Api\SalePoint();
    }

    public function Currency()
    {
        return new Api\Currency();
    }

    public function Common()
    {
        return new Api\Common();
    }
}

