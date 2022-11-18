<?php

namespace SeinOxygen\Contabilium\Api;

class Invoice extends ApiClient

{
    /**
     * Search for invoices
     *
     * @param string $fromDate
     * @param string $toDate
     * @param string $filter 
     * @param int $page
     */
    public function Search($fromDate, $toDate, string $filter = null, int $page = 0)
    {
        return $this->request('api/comprobantes/search', array(
            'filtro' => $filter,
            'fechaDesde' => $fromDate,
            'fechaHasta' => $toDate,
            'page' => $page
        ));
    }

    /**
     * Get a invoice by id
     *
     * @param int $id 
     */
    public function GetById(int $id){
        return $this->request('api/comprobantes', array(
            'id' => $id
        ));
    }

    /**
     * Get a invoice by document_number
     *
     * @param int $id
     */
    public function Emit(int $id){
        return $this->request('api/comprobantes/emitirFE', array(
            'id' => $id
        ));
    }

    /**
     * Get invoice pdf
     * 
     * @param int $id
     */
    public function GetPdf(int $id){
        return $this->request('api/comprobantes/obtenerPdf', array(
            'id' => $id
        ));
    }

    /**
     * Create a new invoice
     *
     * @param array $data
     */
    public function Create(array $data){
        return $this->request('api/comprobantes/crear', $data, "POST");
    }

    /**
     * Create a new invoice
     *
     * @param array $data
     */
    public function EmitPaid(array $data){
        return $this->request('api/comprobantes/emitirFECobrada', $data, "POST");
    }

    /**
     * Update a invoice
     *
     * @param int $id
     * @param array $data
     */
    public function Update(int $id, array $data){
        return $this->request('api/comprobantes?id='.$id, $data, "PUT");
    }

    /**
     * Delete a invoice
     *
     * @param int $id
     */
    public function Delete(int $id){
        return $this->request('api/comprobantes?id='.$id, null, "DELETE");
    }
}
    
    