<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d49849.514256368566!2d{{$detalles['longitud']}}!3d{{$detalles['latitud']}}!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2sco!4v1536289645610"
        width="100%" height="500vh" frameborder="0" style="border:0" allowfullscreen></iframe>
<h1>{{$detalles['ip']}}</h1>
<h5>Ciudad {{$detalles['ciudad']}}</h5>
<h5>Region {{$detalles['region']}}</h5>
<h5>Cod. region{{$detalles['codregion']}}</h5>
<h5>Nom. region {{$detalles['nomregion']}}</h5>
<h5>Cod. area {{$detalles['codarea']}}</h5>
<h5>Cod. pais {{$detalles['codpais']}}</h5>
<h5>Pais {{$detalles['pais']}}</h5>
<h5>Cod. continente {{$detalles['codcontinente']}}</h5>
<h5>Continente {{$detalles['continente']}}</h5>
<h5>Latitud {{$detalles['latitud']}}</h5>
<h5>Longitud {{$detalles['longitud']}}</h5>
<h5>Rad. localización {{$detalles['radiolocalizacion']}}</h5>
<h5>Tip. horario {{$detalles['tipohorario']}}</h5>
<h5>Cant. visitas {{$detalles['conteo']}}</h5>
<h5>Prim. visita {{$detalles['created_at']}}</h5>
<h5>Ulti. visita {{$detalles['updated_at']}}</h5>
<h5>Procedencia {{$detalles['procedencia']}}</h5>
<table>
    <tr>
        <td>Fecha</td>
        <td>Url procedencia</td>
        <td>Pag. visitada</td>
        <td>User agente</td>
    </tr>
    @for($a = 0; $a < count($historial); $a++)
        <tr>
            <td>{{$a}}</td>
            <td>{{$historial[$a]->created_at}}</td>
            <td>{{$historial[$a]->urlprocedencia}}</td>
            <td>{{$historial[$a]->url_visita}}</td>
            <td>{{$historial[$a]->user_agent}}</td>
        </tr>
    @endfor
</table>
{{ $historial->links() }}