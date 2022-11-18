<?php

namespace SeinOxygen\Contabilium\Api;

class SalePoint extends ApiClient
{
    /**
     * List all currencies
     *
     * @param string $filter 
     * @param string $pageSize
     */
    public function Search()
    {
        return $this->request('api/puntosdeventa/search');
    }
}
    
    