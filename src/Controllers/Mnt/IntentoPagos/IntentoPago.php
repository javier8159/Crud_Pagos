<?php
namespace Controllers\Mnt\IntentoPagos;

use Controllers\PublicController;
use Views\Renderer;

class IntentoPago extends PublicController
{
    private $_modeStrings = array(
        "INS" => "Nueva Pago",
        "UPD" => "Editar Pago de %s (%s)",
        "DSP" => "Detalle de Pago de %s (%s)",
        "DEL" => "Eliminando %s (%s)"
    );
    private $_estOptions = array(
        "ENV" => "Enviado",
        "PAG" => "Pagado",
        "CAN" => "Cancelado",
        "ERR" => "Error"
    );
    private $_viewData = array(
        "mode" => "INS",
        "ipid" => 0,
        "cliente" => "",
        "monto" => "",
        "fecha_vencimiento" => "",
        "estado" => "ENV",
        "modeDsc" => "",
        "readonly" => false,
        "isInsert" => false,
        "estadoOptions" => [],
        "crsxToken" => ""
    );
    private function init()
    {
        if (isset($_GET["mode"])) {
            $this->_viewData["mode"] = $_GET["mode"];
        }
        if (isset($_GET["ipid"])) {
            $this->_viewData["ipid"] = $_GET["ipid"];
        }
        if (!isset($this->_modeStrings[$this->_viewData["mode"]])) {
            error_log(
                $this->toString() . " Mode no valido " . $this->_viewData["mode"],
                0
            );
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt.intentopagos.intentopagos',/*cambiar direccion */
                'Sucedio un error al procesar la página.'
            );
        }
        if ($this->_viewData["mode"] !== "INS" && intval($this->_viewData["ipid"], 10) !== 0) {
            $this->_viewData["mode"] !== "DSP";
        }
    }
    private function handlePost()
    {
        \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);
        if (!(isset($_SESSION["intentopago_crsxToken"])
            && $_SESSION["intentoPago_crsxToken"] == $this->_viewData["crsxToken"])
            ) {
            unset($_SESSION["intentopago_crsxToken"]);
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt.intentopagos.intentopagos',     /*cambiar direccion */
                'Ocurrio un error, no se puede procesar el formulario.'
            );
        }


        $this->_viewData["ipid"] = intval($this->_viewData["ipid"], 10);
        if (!\Utilities\Validators::isMatch(
            $this->_viewData["estado"],
            "/^(ENV)|(PAG)|(CAN)|(ERR)$/"
        )
        ) {
            $this->_viewData["errors"][] = "Pago debe ser ENV,PAG,CAN o ERR";
        }

        if (isset($this->_viewData["errors"]) && count($this->_viewData["errors"]) > 0) {

        } else {
            unset($_SESSION["intentopago_crsxToken"]);
            switch ($this->_viewData["mode"]) {
                case 'INS':
                    # code...
                    $result = \Dao\Mnt\Pagos::nuevoPago(
                        $this->_viewData["cliente"],
                        $this->_viewData["monto"],
                        $this->_viewData["fecha_vencimiento"],
                        $this->_viewData["estado"]
                    );
                    if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            'index.php?page=mnt.intentopagos.intentopagos', /*cambiar direccion */
                            "¡Pago guardado satisfactoriamente!"
                        );
                    }
                    break;
                case 'UPD':
                    $result = \Dao\Mnt\Pagos::actualizarPago(
                       
                        $this->_viewData["cliente"],
                        $this->_viewData["monto"],
                        $this->_viewData["fecha_vencimiento"],
                        $this->_viewData["estado"],
                        $this->_viewData["ipid"]
                    );
                    if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            'index.php?page=mnt.intentopagos.intentopagos',
                            "¡Pago actualizado satisfactoriamente!"
                        );
                    }
                    break;
                case 'DEL':
                    $result = \Dao\Mnt\Pagos::eliminarPago(
                        $this->_viewData["ipid"]
                    );
                    if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            'index.php?page=mnt.intentopagos.intentopagos',
                            "¡Pago eliminada satisfactoriamente!"
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
            $tmpPagos = \Dao\Mnt\Pagos::obtenerPoripId(
                intval($this->_viewData["ipid"], 10)
            );
            \Utilities\ArrUtils::mergeFullArrayTo($tmpPagos, $this->_viewData);
            $this->_viewData["modeDsc"] = sprintf(
                $this->_modeStrings[$this->_viewData["mode"]],
                $this->_viewData["cliente"],
                $this->_viewData["ipid"],
                $this->_viewData["monto"],
                $this->_viewData["fecha_vencimiento"],
                $this->_viewData["estado"]
            );
        }
        $this->_viewData["estadoOptions"]
            = \Utilities\ArrUtils::toOptionsArray(
                $this->_estOptions,
                'value',
                'text',
                'selected',
                $this->_viewData['estado']
            );
        $this->_viewData["crsxToken"] = md5(time() . "intentopago");
        $_SESSION["intentopago_crsxToken"] = $this->_viewData["crsxToken"];
    }
    public function run(): void
    {
        $this->init();
        if ($this->isPostBack()) {
            $this->handlePost();
        }
        $this->prepareViewData();
        Renderer::render('mnt/IntentoPago', $this->_viewData);
    }
}