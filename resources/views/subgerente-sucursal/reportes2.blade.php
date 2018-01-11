@extends('layouts.app')

@section('content')
@include('notifications::flash')

<div class="container py-3">
 

 <div class="card text-center border-info mb-3" style="width: 55rem;">
     <div class="card-body ">
        <h4 class="card-title">Reporte Informacion de Vuelos</h4>
      <br>

    <form>

      
 

         <br>          


          <div class="form-row">


          <div class="form-group col-md-4">
                    <label for="inputPuesto">Seleccione la Fecha</label>
                    <div class="text-center">
            <input type="date" placeholder="introduzca fecha" />
              </div>  
              </div>


              <div class="form-group col-md-4">
                    <label for="inputApellido">Seleciona el tipo de vuelo:</label>
                  <div class="input-group mb-2 mb-sm-0 col-md-12">
                   <div class="input-group-btn">
                  <button type="button" class="btn btn-secondary dropdown-toggle"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Vuelos
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#!">Ejecutando</a>
                     <a class="dropdown-item" href="#!">Abiertos</a>
                    <a class="dropdown-item" href="#!">Cancelados</a>
                  </div>
                </div>
               <input type="text" class="form-control" aria-label="Text input with dropdown button">
              <div class="input-group-addon"><i class="fa fa-plane" aria-hidden="true"></i> </div>
              </div> 
                   
              </div>
                

                 <div class="form-group col-md-4">
                    <label for="inputApellido">Seleciona la Sucursal:</label>
                  <div class="input-group mb-2 mb-sm-0 col-md-12">
                   <div class="input-group-btn">
                  <button type="button" class="btn btn-secondary dropdown-toggle"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sucursal
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#!">Sucre</a>
                     <a class="dropdown-item" href="#!">Anzuategui</a>
                    <a class="dropdown-item" href="#!">Caracas</a>
                  </div>
                </div>
               <input type="text" class="form-control" aria-label="Text input with dropdown button">
              </div> 
                    
              </div>
                
              <!--
              <div class="form-group col-md-4">
                    <label for="inputApellido">Selecione la Sucursal:</label>
                <div class="input-group mb-2 mb-sm-0 col-md-8">
                   <select class="form-control border-0 text-dark font-weight-bold select select-hover" id="">
                  <option class="bg-white">Sucursales</option>
                  <option class="bg-white">Sucre</option>
                  <option class="bg-white">Anzuategui</option>
                  <option class="bg-white">Marzo</option>
                  <option class="bg-white">Abril</option>
                  <option class="bg-white">Mayo</option>
                  <option class="bg-white">Junio</option>
                  <option class="bg-white">Julio</option>
                  <option class="bg-white">Agosto</option>
                  <option class="bg-white">Septiembre</option>
                  <option class="bg-white">Octubre</option>
                  <option class="bg-white">Nobiembre</option>
                  <option class="bg-white">Diciembre</option>
                </select>  
                 </div>    
              </div>  -->
              
          </div>


        <br><br>
                     
      <div class="form-row">
          <div class="form-group col-md-4">
                    <label for="inputPuesto"> Vuelo: </label>
                    <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-plane" aria-hidden="true"></i> </div>
                      <input type="text" readonly="" class="form-control-plaintext  p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="   Puesto ñoña" >
                      </div>
              </div>
              <div class="form-group col-md-4">
                    <label for="inputApellido"> Nº Pasajeros</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-user-o" aria-hidden="true"></i> </div>
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value=" Numero laptop lentaaa">
                  </div>
              </div>


              <div class="form-group col-md-4">
                    <label for="inputApellido"> Nº Boletos Vendidos:</label>
                <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon">  <i class="fa fa-tag" aria-hidden="true"></i> </div> 
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value=" XXXX">
                  </div> 
              </div>   
        
          </div>
  

              <div class="form-row">
                     

              <div class="form-group col-md-4">
                    <label for="inputApellido">Hora del Vuelo:</label>
                <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon">  <i class="fa fa-hourglass-half" aria-hidden="true"></i> </div> 
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value=" XXXX">
                  </div> 
              </div>         
          </div>




            <br><br>
                      <h4>Tripilacion:</h4>
        <br> 

      <div class="form-row">
          <div class="form-group col-md-4">
                    <label for="inputPuesto"> Piloto:</label>
                    <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-user-o" aria-hidden="true"></i> </div>
                      <input type="text" readonly="" class="form-control-plaintext  p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="   Puesto ñoña" >
                      </div>
              </div>
              <div class="form-group col-md-4">
                    <label for="inputApellido"> Copiloto:</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-user-o" aria-hidden="true"></i> </div>
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value=" Numero laptop lentaaa">
                  </div>
              </div>


              <div class="form-group col-md-4">
                    <label for="inputApellido"> Jefe de Cabina:</label>
                <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon">  <i class="fa fa-user-o" aria-hidden="true"></i> </div> 
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value=" XXXX">
                  </div> 
              </div>              
          </div>
  
            <br>

            <div class="form-row">
          <div class="form-group col-md-4">
                    <label for="inputPuesto"> Aeromosa 1º:</label>
                    <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-user-o" aria-hidden="true"></i> </div>
                      <input type="text" readonly="" class="form-control-plaintext  p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="   Puesto ñoña" >
                      </div>
              </div>
              <div class="form-group col-md-4">
                    <label for="inputApellido"> Aeromosa 2º:</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-user-o" aria-hidden="true"></i> </div>
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value=" Numero laptop lentaaa">
                  </div>
              </div>


              <div class="form-group col-md-4">
                    <label for="inputApellido"> Aeromosa 3º:</label>
                <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon">  <i class="fa fa-user-o" aria-hidden="true"></i> </div> 
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value=" XXXX">
                  </div> 
              </div>              
          </div>
            
          <br>               
          <br>
                     
      <div class="form-row">
          <div class="form-group col-md-4">
                    <label for="inputPuesto"> Total de Vuelos: </label>
                    <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-plane" aria-hidden="true"></i> </div>
                      <input type="text" readonly="" class="form-control-plaintext  p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="   Puesto ñoña" >
                      </div>
              </div>
              <div class="form-group col-md-4">
                    <label for="inputApellido"> Total de Pasajeros</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-user-o" aria-hidden="true"></i> </div>
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value=" Numero laptop lentaaa">
                  </div>
              </div>


              <div class="form-group col-md-4">
                    <label for="inputApellido"> Total de Boletos Vendidos:</label>
                <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon">  <i class="fa fa-tag" aria-hidden="true"></i> </div> 
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value=" XXXX">
                  </div> 
              </div>              
          </div>
  
            <br> <br>



                  <div class="form align-items-center">          
                       
              <div class="col-auto">
                 <button type="button" class="btn btn-outline-primary">
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                 Imprimir</button> 

            <button type="button" class="btn btn-outline-success">salir</button>
              </div>
            
          </div> 
         
    </form>
            
      </div>

@endsection
      