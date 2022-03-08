 <h1>Intento de Pagos </h1>
<hr>
<table>
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Monto</th>
            <th>fecha Vencimiento</th>
            <th>Estado</th>
         <td><a href="index.php?page=mnt.intentopagos.intentopago&mode=INS&ipid=0">Nuevo</a></td>
      </tr>
    </thead>
    <tbody>
    {{foreach intentopagos}}
        <tr>   
            <td scope="row">{{ipid}}</td>
            <td>{{fecha}}</td>
            <td><a href="index.php?page=mnt.intentopagos.intentopago&mode=DSP&ipid={{ipid}}">{{cliente}}</a></td>
            <td>{{monto}}</td>
            <td>{{fecha_vencimiento}}</td>
             <td>{{estado}}</td>
            <td>
                <a href="index.php?page=mnt.intentopagos.intentopago&mode=UPD&ipid={{ipid}}">Editar</a>
                 &nbsp;
                <a href="index.php?page=mnt.intentopagos.intentopago&mode=DEL&ipid={{ipid}}">Eliminar</a>
            </td>
        </tr>
    {{endfor intentopagos}}
    </tbody>
</table>
           