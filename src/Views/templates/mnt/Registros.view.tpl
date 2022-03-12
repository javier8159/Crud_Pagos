<h1>Registros</h1>
<hr>
  <table>
    <thead>
      <tr>
        <td>Código</td>
        <td>identidad</td>
        <td>nombre</td>
        <td>edad</td>
        <td><a href="index.php?page=mnt.registros.
        registro&mode=INS&id=0">Nuevo</a></td>
      </tr>
    </thead>
    <tbody>
      {{foreach registros}}
        <tr>
          <td>{{id}}</td>
          <td><a href="index.php?page=mnt.registros.registro&mode=DSP&id={{id}}">{{identidad}}</a></td>
          <td>{{nombre}}</td>
          <td>{{edad}}</td>
          <td>
            <a href="index.php?page=mnt.registros.registro&mode=UPD&id={{id}}">Editar</a>
          &nbsp;
          <a href="index.php?page=mnt.registros.registro&mode=DEL&id={{id}}">Eliminar</a>
         </td>
          </tr>
      {{endfor registros}}
    </tbody>
</table>