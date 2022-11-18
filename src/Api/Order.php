<?php

namespace SeinOxygen\Contabilium\Api;

class Order extends ApiClient

{
    /**
     * Search for orders
     *
     * @param string $filter 
     * @param int $pageSize
     * @param int $pageSize
     */
    public function Search($fromDate, string $filter = null, int $page = 1)
    {
        return $this->request('api/ordenesVenta/search', array(
            'fechaDesde' => $fromDate,
            'filtro' => $filter,
            'page' => $page
        ));
    }

    /**
     * Get a order by id
     *
     * @param int $id 
     */
    public function GetById(int $id){
        return $this->request('api/ordenesVenta', array(
            'id' => $id
        ));
    }

    /**
     * Create a new order
     *
     * @param array $data
     */
    public function Create($data){
        return $this->request('api/ordenesVenta', $data, "POST");
    }

    /**
     * Cancel an order
     *
     * @param int $id
     */
    public function Cancel(int $id){
        return $this->request('api/ordenesVenta/Cancel?id='.$id, null, "POST");
    }

    /**
     * Create an invoice from an order
     *
     * @param int $id
     */
    public function Emit(int $id){
        return $this->request('api/ordenesventa/emitirFE?id='.$id, null, "POST");
    }
}
    
    