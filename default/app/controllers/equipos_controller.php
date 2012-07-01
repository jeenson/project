<?php
Load::models('equipos');

class EquiposController extends AdminController {
    
     public function index($pagina = 1) {
        try {
            $equipos = new Equipos();
            
            if (Input::hasPost('filtro')) {
                $filtro =  Input::post('filtro');
                $this->equipos = $equipos->listar($pagina,$filtro);
            }else{
                 $this->equipos = $equipos->listar($pagina);
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }
    
    //Crear y Editar
    public function guardar($id=null)
    {
        try {
            if($id){//editar
                $id = (int) $id;
                $equipos = new Equipos();
                $this->equipos = $equipos->find_first($id);
                if ($this->equipos) {
                    if (Input::hasPost('equipos')) {
                        if ($equipos->update(Input::post('equipos'))) {
                            Flash::valid('El Equipo fué actualizado Exitosamente...!!!');
                            return Router::redirect();
                        } else {
                            Flash::warning('No se Pudieron Guardar los Datos...!!!');
                        }
                    }
                } else {
                    Flash::warning("No existe ningun Equipo");
                    return Router::redirect();
                }
            }else{//crear
                if (Input::hasPost('equipos')) {
                    $equipos = new Equipos(Input::post('equipos'));
                    if ($equipos->save()) {
                        Flash::valid('El Equipo fué agregado Exitosamente...!!!');
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
    
    /*
    public function editar($id)
    {
        try {
            //View::select('crear');
            $id = (int) $id;
            $equipos = new Equipos();
            $this->equipos = $equipos->find_first($id);

            if ($this->equipos) {
                if (Input::hasPost('equipos')) {
                    if ($equipos->update(Input::post('equipos'))) {
                        Flash::valid('El Equipo fué actualizado Exitosamente...!!!');
                        return Router::redirect();
                    } else {
                        Flash::warning('No se Pudieron Guardar los Datos...!!!');
                    }
                }
            } else {
                Flash::warning("No existe ningun Equipo");
                return Router::redirect();
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }*/
    
    
    public function activar($id) {
        try {
            $id = (int) $id;
            $equipos = new Equipos();
            if (!$equipos->find_first($id)) {
                Flash::warning("No existe ningun Equipo");
            } elseif ($equipos->activar()) {
                Flash::valid("El Equipo <b>{$equipos->nombre}</b> Esta ahora <b>Activo</b>...!!!");
            } else {
                Flash::warning("No se Pudo Activar el Equipo <b>{$equipos->nombre}</b>...!!!");
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
        return Router::redirect();
    }

    public function desactivar($id) {
        try {
            $id = (int) $id;
            $equipos = new Equipos();
            if (!$equipos->find_first($id)) {
                Flash::warning("No existe ningun Equipo");
            } elseif ($equipos->desactivar()) {
                Flash::valid("El Equipo <b>{$equipos->nombre}</b> Esta ahora <b>Inactivo</b>...!!!");
            } else {
                Flash::warning("No se Pudo Desactivar el Equipo <b>{$equipos->menu}</b>...!!!");
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
        return Router::redirect();
    }
}
?>