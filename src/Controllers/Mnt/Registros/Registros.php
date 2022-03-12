<?php
namespace Controllers\Mnt\Registros;
use Controllers\PublicController;
use Views\Renderer;
/*
CREATE TABLE `1501199901715` (
  `id` BIGINT(8) NOT NULL AUTO_INCREMENT,
  `identidad` varchar(13) NULL ,
  `nombre` VARCHAR(45) NULL,
  `edad` int(2) NULL,
  */
  class Registros extends PublicController
 {
    public function run(): void 
    {
       $viewData = array();
       $viewData["registros"] 
       = \Dao\Mnt\Registros::obtenerTodos();

       Renderer::render('mnt/Registros', $viewData);
    }

}

?>