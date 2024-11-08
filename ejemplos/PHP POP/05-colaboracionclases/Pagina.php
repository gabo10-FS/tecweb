<?php
    require_once __DIR__.'/cabecera.php';
    require_once __DIR__.'/cuerpo.php';
    require_once __DIR__.'/pie.php';

    class Pagina{
        private $cabecera;
        private $cuerpo;
        private $pie;

        public function __construct($title, $location,$message ){
            $this->cabecera= new Cabecera($title,$location);
            $this->cuerpo=new Cuerpo();
            $this->pie= new Pie($message);
        }

        public function insertar_cuerpo($text){
            $this->cuerpo->insertar_parrafo($text);
        }
        public function graficar(){
            $this->cabecera->graficar();
            $this->cuerpo->graficar();
            $this->pie->graficar();

        }
    }
?>