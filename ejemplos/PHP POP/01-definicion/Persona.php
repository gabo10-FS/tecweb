<?php
class Persona {
    private $nombre;

    public function inicializar($name){
        $this->nombre = $name;
    }
    
    public function mostrar(){
        echo '<h1>'.$this->nombre.'</h1>';
    }
}
?>