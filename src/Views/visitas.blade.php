<form action="{{route('CodviewInicio')}}" method="get">
    <input type="text" placeholder="Busqueda ...." name="consulta" class="">
    <input type="submit" value="Buscar">
</form>
<form action="{{route('CodviewInicio')}}" method="get">
    <input type="text" placeholder="Busqueda ...." name="consulta" class="">
    <input type="submit" value="Buscar">
</form>

@if(isset($visitas))
    <div class="contenedortablas">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Ip</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Region</th>
                <th scope="col">Cod</th>
                <th scope="col">region</th>
                <th scope="col">Cod</th>
                <th scope="col">Pais</th>
                <th scope="col">Cod</th>
                <th scope="col">Continente</th>
                <th scope="col">Latitud</th>
                <th scope="col">Longitud</th>
                <th scope="col">Conteo</th>
                <th scope="col">Ultima vez</th>
            </tr>
            </thead>
            <tbody>
            @for($a = 0; $a < count($visitas); $a++)
                <tr>
                    <td>{{$visitas[$a]->ip}}</td>
                    <td>{{$visitas[$a]->ciudad}}</td>
                    <td>{{$visitas[$a]->region}}</td>
                    <td>{{$visitas[$a]->codregion}}</td>
                    <td>{{$visitas[$a]->nomregion}}</td>
                    <td>{{$visitas[$a]->codpais}}</td>
                    <td>{{$visitas[$a]->pais}}</td>
                    <td>{{$visitas[$a]->codcontinente}}</td>
                    <td>{{$visitas[$a]->continente}}</td>
                    <td>{{$visitas[$a]->latitud}}</td>
                    <td>{{$visitas[$a]->longitud}}</td>
                    <td>{{$visitas[$a]->conteo}}</td>
                    <td>{{$visitas[$a]->updated_at}}</td>
                    <td><a href="{{route('CodviewDetalle', ['id' => $visitas[$a]->id])}}">Detalles</a></td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>
@else
    <h1>No hay visitas a la pagina</h1>
@endif
{{ $visitas->links() }}