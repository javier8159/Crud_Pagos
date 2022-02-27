<?php
namespace Controllers\Mnt\Categorias;

use Controllers\PublicController;
use Views\Renderer;

class Categoria extends PublicController
{
   private $_modeStrings = array(
    "INS" => "Nueva Categoria",
    "UPD" => "Editar %s (%s)",
    "DSP" => "Detalle de %s (%s)",
    "DEL" => "Eliminando %s (%S)"
   );
   private $_catestOptions = array(
       "ACT" => "Activo",
       "INA" => "Inactivo"
   );
   private $_viewData = array(
       "mode"=>"INS",
       "catid"=>0,
       "catnom"=>"",
       "catest"=>"ACT",
       "modeDsc"=>"",
       "readonly"=>false,
       "isInsert"=>false
   );
   private function handlePost()
   {

   }

    public function run(): void
    {
        // si el modo no es uno de los elementos del arreglo
        if (isset($_GET["mode"])) {
         $this->_viewData["mode"] = $_GET["mode"];
        }
        if (isset($_GET["catid"])){
            $this->_viewData = $_GET["catid"];
        }
        if (!isset($this->_modeStrings[$this->_viewData["mode"]])){
            error_log(
           $this->toString()." Mode not valid ".$this->_viewData["mode"],
           0
            );
            \Utilities\Site::redirectToWithMsg(
           'index.php?'
            );
        }
        Renderer::render('mnt/Categoria', $this->_viewData);
    }
}

?>