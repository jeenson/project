<?php

Load::models('torneos');

class TorneosController extends AdminController {
    
     public function index($pagina = 1) {
        try {
            $torneos = new Torneos();
            $this->torneos = $torneos->listar($pagina);
            
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }
    
    /*
     * Asignar equipos al torneo
     * @param $id Identificación del torneo
     */
    public function asignar($id=null) 
    {
        try{
            if(isset($id)){
                $id = (int) $id;
                $torneos = new Torneos();
                $this->torneos = $torneos->find_first($id);
            }else{
                Flash::warning("No existe ningun Torneo");
                return Router::redirect();
            }
            
        }  catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }
    
    /*
     * listar equipos de acuerdo al pais
     *  
     */
    public function getEquipos(){
        View::template(NULL);
        $this->torneo_id = Input::post('torneo_id');
        Load::model('equipos');
        $equipos = new Equipos();
        $torneos = new Torneos();
        $this->equipos=$equipos->buscarByPais(Input::post('pais_id'));
        $this->checkEquipos = $torneos->buscarEquiposTorneos(Input::post('torneo_id'));
    }
    
    /*
     * guardar o eliminar los equipos del Torneo
     *  
     */
    public function guardarEquipos(){
        View::template(NULL);
        $torneos = new Torneos();
        if(Input::post('tipo')==1){
            if($torneos->guardarEquipo(1,Input::post('equipo_id'),Input::post('torneo_id'))){
                Flash::valid('Datos Actualizados');
            }
        }else{
            if($torneos->guardarEquipo(2,Input::post('equipo_id'),Input::post('torneo_id'))){
                Flash::valid('Datos Actualizados');
            }
        }
        die();
    }
    
    /*
     * Crear y editar un torneo
     * @param $id si es editar
     */
    public function guardar($id=null)
    {
        try {
            if($id){//editar
                $id = (int) $id;
                $torneos = new Torneos();
                $this->torneos = $torneos->find_first($id);
                if ($this->torneos) {
                    if (Input::hasPost('torneos')) {
                        if ($torneos->update(Input::post('torneos'))) {
                            Flash::valid('El Torneo fué actualizado Exitosamente...!!!');
                            return Router::redirect();
                        } else {
                            Flash::warning('No se Pudieron Guardar los Datos...!!!');
                        }
                    }
                } else {
                    Flash::warning("No existe ningun Torneo");
                    return Router::redirect();
                }
            }else{//crear
                if (Input::hasPost('torneos')) {
                    $torneos = new Torneos(Input::post('torneos'));
                    if ($torneos->save()) {
                        Flash::valid('El Torneo fué agregado Exitosamente...!!!');
                        return Router::redirect();
                    } else {
                        Flash::warning('No se Pudieron Guardar los Datos...!!!');
                    }
                }
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }
    
    public function activar($id) {
        try {
            $id = (int) $id;
            $torneos = new Torneos();
            if (!$torneos->find_first($id)) {
                Flash::warning("No existe ningun Torneo");
            } elseif ($torneos->activar()) {
                Flash::valid("El Torneo <b>{$torneos->nombre}</b> Esta ahora <b>Activo</b>...!!!");
            } else {
                Flash::warning("No se Pudo Activar el Torneo <b>{$torneos->nombre}</b>...!!!");
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
        return Router::redirect();
    }

    public function desactivar($id) {
        try {
            $id = (int) $id;
            $torneos = new Torneos();
            if (!$torneos->find_first($id)) {
                Flash::warning("No existe ningun Torneo");
            } elseif ($torneos->desactivar()) {
                Flash::valid("El Torneo <b>{$torneos->nombre}</b> Esta ahora <b>Inactivo</b>...!!!");
            } else {
                Flash::warning("No se Pudo Desactivar el Torneo <b>{$torneos->menu}</b>...!!!");
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
        return Router::redirect();
    }
    
    
}
?>
