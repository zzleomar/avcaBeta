@extends('layouts.app')

@section('content')
@include('notifications::flash')
<div class="container py-3">
 

 <div class="card text-center border-info mb-3" style="width: 60rem;">
     <div class="card-body ">
        <h4 class="card-title">Reporte Ingresos de Vuelos</h4>
      <br>

    <form>

      
 

         <br>          


          <div class="form-row">


          <div class="form-group col-md-4">
                    <label for="inputPuesto">Seleccione la Fecha Inicial</label>
                    <div class="text-center">
            <input type="date" placeholder="introduzca fecha" />
              </div>  
              </div>

          <div class="form-group col-md-4">
                    <label for="inputPuesto">Seleccione la Fecha Final</label>
                    <div class="text-center">
            <input type="date" placeholder="introduzca fecha" />
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
      <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" >
              <tr class="bg-white " >
               <th class="border  border-primary border-left-0">
               Sucursal           
                </th>
              <th class="border  border-primary">Nombre vuelo</th>
               <th class="border  border-primary ">hora</th>
               <th class="border  border-primary ">Pasajeros</th>
               <th class="border  border-primary">Boletos vendidos</th>
               <th class="border  border-primary">Boletos Reservados</th>
              <th class="border  border-primary border-right-0 border-left-0">Ingreso</th>
              

              </tr>
              <tr>
                <td>Maiquetía</td>
                <td>21/10/2017</td>
                <td>12</td>
                <td>2000</td>
                <td>habilitado</td>
                <td>habilitado</td>
                <td>$$$$</td>       
                              
              </tr>
              <tr>
                <td>Maiquetía</td>
                <td>21/10/2017</td>
                <td>12</td>
                <td>2000</td>
                <td>habilitado</td>
                <td>habilitado</td>
                <td>$$$$</td>       
                             
              </tr>
              <tr>
                <td>Maiquetía</td>
                <td>21/10/2017</td>
                <td>12</td>
                <td>2000</td>
                <td>habilitado</td>
                <td>habilitado</td>
                <td>$$$$$</td>       
                           
              </tr>
              <tr>
                <td>Maiquetía</td>
                <td>21/10/2017</td>
                <td>12</td>
                <td>2000</td>
                <td>habilitado</td>
                <td>habilitado</td>
                <td>$$$$$</td>       
                            
              </tr>              
            </table>
          <br>

          </div>
                     
      <div class="form-row">
          <div class="form-group col-md-4">
                    <label for="inputPuesto"> Total de Vuelos: </label>
                    <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-plane" aria-hidden="true"></i> </div>
                      <input type="text" readonly="" class="form-control-plaintext  p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="   Puesto ñoña" >
                      </div>
              </div>
              
              <div class="form-group col-md-4">
                    <label for="inputApellido"> Total de Boletos Vendidos:</label>
                <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon">  <i class="fa fa-tag" aria-hidden="true"></i> </div> 
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value=" XXXX">
                  </div> 
              </div>  

                <div class="form-group col-md-4">
                    <label for="inputApellido"> Total de Ingresos</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-money" aria-hidden="true"></i> </div>
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value=" Numero laptop lentaaa">
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
  </div>   



  </div>



</div>


@endsection
