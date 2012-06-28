<?php

Load::models('equipos');

class EquiposController extends AdminController {
    
     public function index($pagina = 1) {
        try {
            $equipos = new Equipos();
            $this->equipos = $equipos->lista_equipos($pagina);
            //print_r($this->equipos);exit;
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }
    
    public function crear() 
    {
        echo "listo eso lo hace carlos";
    }
    
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