<?php

class Equipos extends ActiveRecord {

    protected function initialize() {
        //$this->has_many('paises');
        //$this->_belongs_to('paises');
    }
    
    public function lista_equipos($pagina) {
        $cols = 'equipos.*, p.nombre as paises';
        $joins = 'INNER JOIN paises as p ON p.id = paises_id ';
        //$joins .= 'LEFT JOIN menus as m2 ON m2.id = menus.menus_id ';
        //return $this->paginate("page: $pagina", "columns: $cols", "join: $joins");
        return $this->paginate("page: $pagina","columns: $cols", "join: $joins");
    }
    

}