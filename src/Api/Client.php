<?php

namespace SeinOxygen\Contabilium\Api;

class Client extends ApiClient

{
    /**
     * Search for clients
     *
     * @param string $filter 
     * @param int $page 
     * @param int $pageSize
     */
    public function Search(string $filter, int $page = 1, int $pageSize = 0)
    {
        return $this->request('api/clientes/search', array(
            'filtro' => $filter,
            'page' => $page,
            'pageSize' => $pageSize
        ));
    }

    /**
     * Get a client by id
     *
     * @param string $id 
     */
    public function GetById($id){
        return $this->request('api/clientes', array(
            'id' => $id
        ));
    }

    /**
     * Get a client by document_number
     *
     * @param string $document_number
     * @param string $document_type
     */
    public function GetByDoc($document_number, $document_type = 'DNI'){
        return $this->request('api/clientes', array(
            'tipoDoc' => $document_type,
            'nroDoc' => $document_number
        ));
    }

    /**
     * Create a new client
     *
     * @param array $data
     */
    public function Create($data){
        return $this->request('api/clientes', $data, "POST");
    }

    /**
     * Update a client
     *
     * @param array $data
     */
    public function Update($id, $data){
        return $this->request('api/clientes?id='.$id, $data, "PUT");
    }

    /**
     * Delete a client
     *
     * @param string $id
     */
    public function Delete($id){
        return $this->request('api/clientes?id='.$id, null, "DELETE");
    }
}
    
    