<?php

namespace SeinOxygen\Contabilium\Api;

class Product extends ApiClient

{
    /**
     * Search for product/service
     *
     * @param string $filter 
     * @param int $pageSize
     * @param int $pageSize
     */
    public function Search(string $filter = null, int $page = 1, int $pageSize = 0)
    {
        return $this->request('api/conceptos/search', array(
            'filtro' => $filter,
            'page' => $page,
            'pageSize' => $pageSize
        ));
    }

    /**
     * Get a product/service by id
     *
     * @param int $id 
     */
    public function GetById(int $id){
        return $this->request('api/conceptos', array(
            'id' => $id
        ));
    }

    /**
     * Get a product/service by code
     *
     * @param string $code
     */
    public function GetByCode(string $code){
        return $this->request('api/conceptos', array(
            'codigo' => $code
        ));
    }

    /**
     * Create a new product/service
     *
     * @param array $data
     */
    public function Create($data){
        return $this->request('api/conceptos', $data, "POST");
    }

    /**
     * Update a product/service
     *
     * @param int $id
     * @param array $data
     */
    public function Update($id, $data){
        return $this->request('api/conceptos?id='.$id, $data, "PUT");
    }

    /**
     * Delete a product/service
     *
     * @param int $id
     */
    public function Delete(int $id){
        return $this->request('api/conceptos?id='.$id, null, "DELETE");
    }
}
    
    