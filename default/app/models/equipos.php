<?php

class Equipos extends ActiveRecord {

    protected function initialize() {
        //$this->has_many('paises');
        //$this->_belongs_to('paises');
    }
    
    public function listar($pagina , $filtro = NULL) {
        $condiciones = 'TRUE';
        if ($filtro) {
            $condiciones = $this->crear_filtro($filtro);
        }
        $cols = 'equipos.*, p.nombre as paises';
        $joins = 'INNER JOIN paises as p ON p.id = paises_id ';
        return $this->paginate("page: $pagina","columns: $cols", "join: $joins", "conditions: $condiciones");
    }
    
    public function crear_filtro($filtro) {
        $condiciones = array();
        if (!empty($filtro['nombre'])) {
            $condiciones[] = "equipos.nombre LIKE '%{$filtro['nombre']}%'";
        }
        if (!empty($filtro['paises_id'])) {
            $condiciones[] = "equipos.paises_id = '{$filtro['paises_id']}'";
        }
        return sizeof($condiciones) ? join(' AND ', $condiciones) : 'TRUE';
    }
    
    
    

}