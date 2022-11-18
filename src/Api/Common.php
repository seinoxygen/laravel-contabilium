<?php

namespace SeinOxygen\Contabilium\Api;

class Common extends ApiClient
{
    /**
     * Get countries
     */
    public function Countries()
    {
        return $this->request('api/common/paises');
    }

    /**
     * Get states of the desired country. Only works with Argentina
     */
    public function States($id = 10)
    {
        return $this->request('api/common/provincias', ['idPais' => $id]);
    }

    /**
     * Get cities of the desired state. Only works with Argentina
     */
    public function Cities($id = 2)
    {
        return $this->request('api/common/ciudades', ['idProvincia' => $id]);
    }

    /**
     * Get sectors
     * 
     * @param bool $extended
     */
    public function Sectors($extended = false)
    {
        if($extended){
            return $this->request('api/conceptos/rubros', ['includeChilds' => 'true']);
        }
        return $this->request('api/conceptos/rubros');
    }

    /**
     * Get user information
     */
    public function Me()
    {
        return $this->request('api/usuarios/obtenerinfo');
    }

    /**
     * List all sale conditions
     */
    public function SaleConditions()
    {
        return $this->request('api/usuarios/condicionesVenta');
    }
}
    
    