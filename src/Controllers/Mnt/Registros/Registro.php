<?php
namespace Controllers\Mnt\Registros;

use Controllers\PublicController;
use Views\Renderer;

class Registro extends PublicController
{
    private $_modeStrings = array(
        "INS" => "Nuevo Registro",
        "UPD" => "Editar Pago de %s (%s)",
        "DSP" => "Detalle de Pago de %s (%s)",
        "DEL" => "Eliminando %s (%s)"
    );
  
    private $_viewData = array(
        "mode" => "INS",
        "ip" => 0,
        "identidad" => "",
        "nombre" => "",
        "edad" => "",
        "modeDsc" => "",
        "readonly" => false,
        "isInsert" => false,
        "crsxToken" => ""
    );
    private function init()
    {
        if (isset($_GET["mode"])) {
            $this->_viewData["mode"] = $_GET["mode"];
        }
        if (isset($_GET["id"])) {
            $this->_viewData["id"] = $_GET["id"];
        }
        if (!isset($this->_modeStrings[$this->_viewData["mode"]])) {
            error_log(
                $this->toString() . " Mode no valido " . $this->_viewData["mode"],
                0
            );
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt.registros.registros',/*cambiar direccion */
                'Sucedio un error al procesar la página.'
            );
        }
        if ($this->_viewData["mode"] !== "INS" && intval($this->_viewData["id"], 10) !== 0) {
            $this->_viewData["mode"] !== "DSP";
        }
    }
    private function handlePost()
    {
        \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);
        if (!(isset($_SESSION["registro_crsxToken"])
            && $_SESSION["registro_crsxToken"] == $this->_viewData["crsxToken"])
            ) {
            unset($_SESSION["registro_crsxToken"]);
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt.registros.registros',     /*cambiar direccion */
                'Ocurrio un error, no se puede procesar el formulario.'
            );
        }


        {
            unset($_SESSION["registro_crsxToken"]);
            switch ($this->_viewData["mode"]) {
                case 'INS':
                    # code...
                    $result = \Dao\Mnt\Registros::nuevaRegistro(
                        $this->_viewData["identidad"],
                        $this->_viewData["nombre"],
                        $this->_viewData["edad"]
                    );
                    if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            'index.php?page=mnt.registros.registros', /*cambiar direccion */
                            "¡Registro guardado satisfactoriamente!"
                        );
                    }
                    break;
                case 'UPD':
                    $result = \Dao\Mnt\Registros::actualizarRegistro(
                       
                        $this->_viewData["identidad"],
                        $this->_viewData["nombre"],
                        $this->_viewData["edad"],
                        $this->_viewData["id"]
                    );
                    if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            'index.php?page=mnt.registros.registros',
                            "¡Registro actualizado satisfactoriamente!"
                        );
                    }
                    break;
                case 'DEL':
                    $result = \Dao\Mnt\Registros::eliminarRegistro(
                        $this->_viewData["id"]
                    );
                    if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            'index.php?page=mnt.registros.registros',
                            "¡Registro eliminada satisfactoriamente!"
                        );
                    }
                    break;
                default:
                    # code...
                    break;
            }
        }
    }
    private function prepareViewData()
    {
        if ($this->_viewData["mode"] == "INS") {
            $this->_viewData["modeDsc"]
                = $this->_modeStrings[$this->_viewData["mode"]];
        } else {
            $tmpRegistros = \Dao\Mnt\Registros::obtenerPorId(
                intval($this->_viewData["id"], 10)
            );
            \Utilities\ArrUtils::mergeFullArrayTo($tmpRegistros, $this->_viewData);
            $this->_viewData["modeDsc"] = sprintf(
                $this->_modeStrings[$this->_viewData["mode"]],
                $this->_viewData["ipid"],
                $this->_viewData["identidad"],
                $this->_viewData["nombre"],
                $this->_viewData["edad"]
            );
        }
        $this->_viewData["crsxToken"] = md5(time() . "registro");
        $_SESSION["registro_crsxToken"] = $this->_viewData["crsxToken"];
    }
    public function run(): void
    {
        $this->init();
        if ($this->isPostBack()) {
            $this->handlePost();
        }
        $this->prepareViewData();
        Renderer::render('mnt/Registro', $this->_viewData);
    }
}