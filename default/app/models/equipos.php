<?php

/**
 * Backend - KumbiaPHP Backend
 * PHP version 5
 * LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * ERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Modelos
 * @license http://www.gnu.org/licenses/agpl.txt GNU AFFERO GENERAL PUBLIC LICENSE version 3.
 * @author jeensonaguilar84@gmail.com
 */
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

