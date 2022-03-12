<h1>{{modeDsc}}</h1>
<hr>
<section class="container-m">
  <form action="index.php?page=mnt.registros.registro&mode={{mode}}&id={{id}}" method="post">
    <input type="hidden" name="crsxToken" value="{{crsxToken}}" />
    
    {{ifnot isInsert}}

    <fieldset class="row flex-center align-center">
      <label for="catid" class="col-5">Codigo</label>
      <input class="col-7" id="id" name="cid" value="{{id}}" placeholder="" type="text">
    </fieldset>

    {{endifnot isInsert}}

    <fieldset class="row flex-center align-center">
      <label class="col-5 for=" identidad">Identidad</label>
      <input class="col-7" id="identidad" name="identidad" value="{{identidad}}" placeholder="" type="text">
    </fieldset>
    <fieldset class="row flex-center align-center">
      <label class="col-5 for=" nombre">Nombre</label>
      <input class="col-7" id="nombre" name="nombre" value="{{nombre}}" placeholder="" type="text">
    </fieldset> 

    <fieldset class="row flex-center align-center">
      <label class="col-5 for=" edad">Edad</label>
      <input class="col-7" id="edad" name="edad" value="{{edad}}" placeholder="" type="text">
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
        location.assign(
          "index.php?page=mnt.registros.registros"
        );
      });
    });
  </script>
 
