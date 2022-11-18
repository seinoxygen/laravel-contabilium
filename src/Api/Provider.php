<?php

namespace SeinOxygen\Contabilium\Api;

class Provider extends ApiClient

{
    /**
     * Search for providers
     *
     * @param string $filter 
     * @param int $pageSize
     */
    public function Search(string $filter, int $pageSize = 0)
    {
        return $this->request('api/clientes/search', array(
            'filtro' => $filter,
            'pageSize' => $pageSize
        ));
    }

    /**
     * Get a provider by id
     *
     * @param int $id 
     */
    public function GetById(int $id){
        return $this->request('api/clientes', array(
            'id' => $id
        ));
    }
}
    
    