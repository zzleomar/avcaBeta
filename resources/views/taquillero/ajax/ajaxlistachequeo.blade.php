 
<h4 class="card-title">Informacion de Vuelo y Pasajeros</h4>
  <br>
    
    <h5 class="card-title">Sucursal {{$sucursal->nombre}}</h5>
    <br>

  <form action="{{URL::to('/taquilla/listaimprimir')}}" method="POST">
     {{ csrf_field() }}
    <div class="form-row">
      <div class="form-group col-md-12">
        <label for="exampleSelect1">Vuelo</label>
          <select class="form-control" id="seleccionarvuelo" onchange="auxseleccionar()">
            <option selected> Seleccione una opcion valida</option>
            @foreach ($vuelos as $vuelo)
             <option value="{{$vuelo->id}}"> {{$vuelo->pierna->ruta->destino->nombre }}</option>
            @endforeach
           
          </select>
          <input type="hidden" name="idvuelo" id="idvuelo">
      </div>
             

                   

        
          </div>
        
        

         <div class="form align-items-center">          
            
              <div class="col-auto">
                 <button type="submit" class="btn btn-outline-primary" value="enviar">
                  <i class="fa fa-file-pdf-o" aria-hidden="true"  ></i>
                 Imprimir</button> 

            <button type="button" class="btn btn-outline-success" >salir</button>
              </div>
            </div>
          </form>

<script type="text/javascript"> 


 
      function listaimprimir(){
        aler("hola");
        var x = document.getElementById("idvuelo").value;
        var url="{{ URL::to('/taquilla/listaimprimir')}}/"+x;

         

          $.get(url,function(data){ 
            $('#contenidolista').empty().html(data);
          });
      }
      function auxseleccionar(){
        var x = document.getElementById("seleccionarvuelo").value;
        document.getElementById("idvuelo").value = x;
        
      }


   

      </script>


