<h1>{{modeDsc}}</h1>
<hr>
<section class="container-fluid">
    <form action="index.php?page=mnt.intentopagos.intentopago&mode={{mode}}&ipid={{ipid}}" method="post">
        <input type="hidden" name="crsxToken" value="{{crsxToken}}" />
        {{ifnot isInsert}}
        <fieldset>
            <label for="ipid" class="col-5">ID IntentoPago</label>
            <input class="col-7" name="ipid" id="ipid" placeholder="" value="{{ipid}}" type="text">
        </fieldset>
        {{endifnot isInsert}}
        <fieldset class="row flex-center align-center">
            <label class="col-5" for="cliente">Cliente</label>
            <input type="text" class="col-7" id="cliente" name="cliente" placeholder="" value="{{cliente}}" </fieldset>
            <fieldset class="row flex-center align-center">
               
                <label class="col-5" for="monto">Monto</label>
                <input type="text" class="col-7" id="monto" name="monto" placeholder="" value="{{monto}}" </fieldset>
                <fieldset class="row flex-center align-center">
                    <label class="col-5" for="fecha_vencimiento">Fecha de Vencimiento</label>
                    <input type="date" class="col-7" id="fecha_vencimiento" name="fecha_vencimiento"
                        value="{{fecha_vencimiento}}" </fieldset>
                    <fieldset class="row flex-center align-center">
                        <div class="col-md-4 mb-3">
                            <label class="col-5" for="estado">Estado</label>
                            <select class="col-7" name="estado" id="estado">
                                {{foreach estadoOptions}}
                                <option value="{{value}}" {{selected}}>{{text}}</option>
                                {{endfor estadoOptions}}
                            </select>
                    </fieldset class="row flex-center align-center">
                    <fieldset class="row flex-end align-center">
                        <button type="submit" name="btnConfirmar" class="btn primary">Confirmar</button>
                        &nbsp;<button type="button" id="btnCancelar" class="btn secondary">Cancelar</button>
                        &nbsp;
                    </fieldset>
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", (e) => {
            document.getElementById("btnCancelar").addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                window.location.assign(
                    "index.php?page=mnt.intentopagos.intentopagos"
                );
            });
        });
    </script>
    </div>
    </div>