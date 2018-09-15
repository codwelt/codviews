<form action="{{route('codviewsagregarcontroller')}}" method="post">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="pagener">Paginación vista general</label>
            @if(isset($datos[0]['paginacion_general']))
                <input type="number" class="form-control" id="pagener" name="paginaciongeneral" placeholder="20"
                       value="{{$datos[0]['paginacion_general']}}">
            @else
                <input type="number" class="form-control" id="pagener" name="paginaciongeneral" placeholder="20"
                       value="20">
            @endif
        </div>
        <div class="form-group col-md-2">
            <label for="pagdeta">Paginación vista detallada</label>
            @if(isset($datos[0]['paginacion_detallados']))
                <input type="number" class="form-control" name="paginaciondetallado" id="pagdeta" placeholder="20"
                       value="{{$datos[0]['paginacion_detallados']}}">
            @else
                <input type="number" class="form-control" name="paginaciondetallado" id="pagdeta" placeholder="20"
                       value="20">
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="filtrosmuestra">Filtros de muestra</label>
        <textarea class="form-control" id="filtrosmuestra" name="filtros"
                  style="width: 100%; height: 10vh;">@if(isset($datos[0]['filtros'])){{implode(",", json_decode($datos[0]['filtros']))}}@endif</textarea>
    </div>
    <input type="submit" class="btn btn-primary" value="Actualizar">

</form>
<button id="actualizar" class="btn btn-primary" style="margin-top:1%;">Actualizar conteo</button>
<script>
    $('#actualizar').click(function () {
        $.ajax({
            url: "/codviews/configuracion/refresh/",
            data: "",
            method: "get",
            success: function (result) {
                alert("Exitoso");
            },

            error: function (result) {
                console.log(result);

            }, beforeSend: function () {
                console.log("Cargando");
            }
        });
    });
</script>