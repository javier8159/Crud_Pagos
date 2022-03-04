<?php
namespace Controllers\Mnt\IntentosPago;
use Controllers\PublicController;
use Views\Renderer;
/*
CREATE TABLE `nw202201`.`intentopagos` (
  `ipid` BIGINT(8) NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cliente` VARCHAR(120) NULL,
  `monto` DECIMAL(10,2) NULL,
  `fecha_vencimiento` DATE NULL,
  `estado` CHAR(3) NULL DEFAULT 'ENV',
  PRIMARY KEY (`ipid`));
*/

class IntentoPagos extends PublicController{

    public function run(): void
    {
        $viewData = arraY();
        $viewData["intentopagos"] 
        = \Dao\Mnt\Pagos::obtenerTodos();

        Renderer::render('mnt/IntentoPagos',$viewData);
    } 

}

?>