<?php

namespace SeinOxygen\Contabilium\Api;

class Inventory extends ApiClient
{
    /**
     * Get all warehouse
     *
     * @param string $filter 
     * @param string $pageSize
     */
    public function GetWarehouses($filter, $pageSize = 0)
    {
        return $this->request('api/inventarios/getDepositos', array(
            'filtro' => $filter,
            'pageSize' => $pageSize
        ));
    }

    /**
     * Get stock by warehouse
     *
     * @param int $id 
     */
    public function GetWarehouseStock($id){
        return $this->request('api/inventarios/getStockByDeposito', array(
            'id' => $id
        ));
    }

    /**
     * Get a ecommerce stock
     *
     * @param string $integration
     * @param string $code
     */
    public function GetEcommerceStock($integration, $code){
        return $this->request('api/conceptos/getInfoForEcommerce', array(
            'idIntegracion' => $integration,
            'codigo' => $code
        ));
    }

    /**
     * Update stock
     *
     * @param int $id
     * @param int $concept
     * @param int $amount
     */
    public function Update(int $id, int $concept, int $amount){
        return $this->request('api/conceptos', ['id' => $id, 'idConcepto' => $concept, 'cantidad' => $amount], "POST");
    }
}
    
    