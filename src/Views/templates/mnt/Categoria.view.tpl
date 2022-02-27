<h1>Trabajando con Categoria</h1>
<hr>
<section class="container-m">
<form action="index.php?page=mnt.categorias.categoria" method=post">
{{if isInsert}}
  <fieldset class="row flex-center align-center">
  <label for="catid" class="col-5">Codigo</label>
  <input class="col-7" id="catid" name="catid" value="{{catid}}" placeholder="" type="text">
  </fieldset>
{{end isInsert}}
  <fieldset class="row flex-center align-center">
  <label class="col-5 for="catnom">Categoria</label>
  <input class="col-7"  id="catnom" name="catnom" value="{{catnom}}" placeholder="" type="text">
  </fieldset>

  <fieldset class="row flex-center align-center">
  <label class="col-5 for="catest">Estado</label>
 <select class="col-7"  name="catest" id="catest">
 {{catestOptions}}
 </select>
  </fieldset class="row flex-center align-center">
  <fieldset class="row flex-end align-center">
    <button type="submit" name="btnConfirmar" class="btn primary">Confirmar</button>
  &nbsp;<button type="button" id="btnCancelar" class="btn secondary">Cancelar</button>
  &nbsp;
  </fieldset>
</form>
  </section>
  <script>
  /* */
  document.addEventListener("DOMContentLoaded", (e)=>{
  document.getElementById("btnCancelar").addEventListener('click', (e)=>{
       e.preventDefault();
       e.stopPropagation();
       location.assign("index.php?page=mnt.categorias.categorias");
  })
  });
  </script>

  