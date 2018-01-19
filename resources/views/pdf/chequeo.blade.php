<!DOCTYPE html>
<html>
<head>
    <title></title>
  
    <link rel="stylesheet" href="css/bootstrap.css">
    
</head>
<body style="font-size: 10px;">
  <img src="img/banner.jpg" > 
    <h4 class="card-title text-center">Información de Vuelo y Pasajeros</h4>
    <br>
    <h5 class="card-title">Areolinea Alas de Venezuela</h5>
    <h5 class="card-title">Rif 2020345-5</h5>
    <h5 class="card-title">Sucursal {{$sucursal->nombre}}</h5>
    <br>
     <h4>Vuelo:</h4>
      <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" >
              <tr class="bg-white " >
               <th class="border   border-primary border-left-0">Vuelo</th>
               <th class="border  border-primary ">Origen</th>         
               <th class="border  border-primary border-right-0 border-left-0">Destino</th>
              </tr>              
              <tr>
                <td>{{$vuelo->id}}</td>
                <td>{{$vuelo->pierna->ruta->origen->nombre}}</td>
                <td>{{$vuelo->pierna->ruta->destino->nombre}}</td>                          
              </tr>                     
            </table>
           </div>
           <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" >
              <tr class="bg-white " >
               <th class="border   border-primary border-left-0">Fecha</th>
               <th class="border  border-primary ">Hora</th>               
              </tr>             
              <tr>
                <td>{{Carbon::parse($vuelo->salida)->format('d/m')}}</td> 
                <td>{{Carbon::parse($vuelo->salida)->format('h:i')}}</td>                          
              </tr>                
            </table>
           </div>
      <h4>Tripulación:</h4>
       <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" >
              <tr class="bg-white " >
               <th class="border   border-primary border-left-0">Piloto:</th>
               <th class="border  border-primary ">Copiloto</th>         
               <th class="border  border-primary border-right-0 border-left-0">Jefe Cabina</th>
              </tr>              
              <tr>

                @foreach ($vuelo->tripulantes as $tripulante)
                  @if($tripulante->rango == 'Piloto')
                    <td>{{$tripulante->Persona($tripulante->personal_id)->nombres." ".$tripulante->Persona($tripulante->personal_id)->apellidos}}</td>
                  @endif
                @endforeach
               
                  @foreach ($vuelo->tripulantes as $tripulante)
                  @if($tripulante->rango == 'Copiloto')
                    <td>{{$tripulante->Persona($tripulante->personal_id)->nombres." ".$tripulante->Persona($tripulante->personal_id)->apellidos}}</td>
                  @endif
                @endforeach
                
               
                  @foreach ($vuelo->tripulantes as $tripulante)
                  @if($tripulante->rango == 'Jefe de Cabina')
                    <td>{{$tripulante->Persona($tripulante->personal_id)->nombres." ".$tripulante->Persona($tripulante->personal_id)->apellidos}}</td>
                  @endif
                @endforeach
                                         
              </tr>                     
            </table>
           </div>
           <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" >
              <tr class="bg-white " >
               <th class="border   border-primary border-left-0">Aeromosa 1º:</th>
               <th class="border  border-primary ">Aeromosa 2º:</th>         
               <th class="border  border-primary border-right-0 border-left-0">Aeromosa 3º:</th>
              </tr>              
              <tr>
                @foreach ($vuelo->tripulantes as $tripulante)
                  @if($tripulante->rango == 'Sobrecargo')
                    <td>{{$tripulante->Persona($tripulante->personal_id)->nombres." ".$tripulante->Persona($tripulante->personal_id)->apellidos}}</td>
                  @endif
                @endforeach
                 </tr>                     
            </table>

           </div>
          
            <h4>Pasajeros:</h4>
            <br>
            <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" >
              <tr class="bg-white " >
               <th class="border   border-primary border-left-0">Identificacion </th>
               <th class="border  border-primary ">Nombre</th>
               <th class="border  border-primary ">Apellido</th>
               <th class="border  border-primary border-right-0 border-left-0">Abordaje</th>
              </tr>

               @foreach ($vuelo->boletos as $boleto)
                @if($boleto->estado == 'Chequeado')
                  <tr>
                    <td>{{$boleto->pasajero->cedula}}</td>
                    <td>{{$boleto->pasajero->nombres}}</td>
                    <td>{{$boleto->pasajero->apellidos}}</td>
                    <td> 
                      <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">1</span>
                      </label>
                    </td>
                  </tr>
                @endif
                @endforeach
              </table>
            </div>

              
                     
             <h4>Pasajeros de Contingencia:</h4>
            <br> <br>
              
               <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" >
              <tr class="bg-white " >
               <th class="border   border-primary border-left-0">Identificacion </th>
               <th class="border  border-primary ">Nombre</th>
               <th class="border  border-primary ">Apellido</th>
               <th class="border  border-primary border-right-0 border-left-0">Abordaje</th>
              </tr>
              
              <tr>
                <td>2323412</td>
                <td>Carlos</td>
                <td>Escobar</td>
                <td> <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck1">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">1</span>
          </label>
              </td>
                           
              </tr>

                <tr>
                <td>2323412</td>
                <td>Carlos</td>
                <td>Escobar</td>
                <td> <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck1">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">1</span>
          </label>
              </td>
                           
              </tr>
                
            </table>
           </div>
        
        
   
            
      </div>
  </div>   


</html>