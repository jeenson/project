<?php

class Torneos extends ActiveRecord {

    protected function initialize() {
        //$this->has_many('paises');
        //$this->_belongs_to('paises');
    }
    
    public function listar($pagina , $filtro = NULL) {
        $condiciones = 'TRUE';
        return $this->paginate("page: $pagina", "conditions: $condiciones");
    }
    
    public function guardarEquipo($tipo,$id_equipo,$id_torneo){
        if ($tipo==1){
            $sql="INSERT INTO torneos_equipos (equipos_id,torneos_id) VALUES ($id_equipo,$id_torneo)";
            
        }else{
            $sql="DELETE FROM torneos_equipos  WHERE equipos_id=$id_equipo AND torneos_id=$id_torneo";
        }
        return $this->sql($sql);
    }
    
    public function buscarEquiposTorneos($id_torneo){
        
        $db = Db::factory();
        $datos=$db->find("torneos_equipos" , "torneos_id = '$id_torneo'" , "equipos_id" );
        if($datos){
            foreach ($datos as $d){
                $valor[]=$d['equipos_id'];
            }
            return $valor;
        }
        return array();
    }
    
}