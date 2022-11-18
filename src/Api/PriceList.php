<?php

namespace SeinOxygen\Contabilium\Api;

class PriceList extends ApiClient
{
    /**
     * Cearch for clients
     *
     * @param string $filter 
     * @param string $pageSize
     */
    public function Search()
    {
        return $this->request('api/listasDePrecio/search');
    }

    /**
     * Get a client by id
     *
     * @param int $id 
     * @param int $page
     * @param int $pageSize
     */
    public function GetById(int $id, int $page = 1, int $pageSize = 0){
        return $this->request('api/listasDePrecio/getById', array(
            'id' => $id,
            'page' => $page,
            'pageSize' => $pageSize
        ));
    }
}
    
    