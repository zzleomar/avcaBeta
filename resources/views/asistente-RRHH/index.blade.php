@extends('layouts.app')

@section('content')
@include('notifications::flash')

<div id="targetL" class="py-3">
    @if(Auth::user()->tipo!='Gerente de RRHH')
      <h4 class="card-title" style="font-weight: 600;">Sucursal {{ $sucursal->nombre }}</h4>
    @endif

 
<div id="AccordionAdminPersonal" data-children=".item" style="font-weight: 600;">

<a data-toggle="collapse" data-parent="#AccordionAdminPersonal" href="#AccordionAdminPersonal2" aria-expanded="false" aria-controls="AccordionAdminPersonal2"><button type="button" class="btn btn2 btn-outline-success" data-toggle="modal" data-target="#NuevaRutaModal" style="margin: 10px;  float: right;">
  Mostrar Nomina
</button></a>
<a data-toggle="collapse" data-parent="#AccordionAdminPersonal" href="#AccordionAdminPersonal1" aria-expanded="true" aria-controls="AccordionAdminPersonal1"><button type="button" class="btn btn2 btn-outline-success" data-toggle="modal" data-target="#NuevaRutaModal" style="margin: 10px;  float: right;">
  Datos del Personal
</button></a>
  <hr style="clear: both;">
<div class="item">
    <div id="AccordionAdminPersonal1" class="collapse show" role="tabpanel">

<table class="table">
      <thead class="thead-light">
        <tr align="center">
          <th>ADMINISTRACIÓN DE PERSONAL</th>
        </tr>
      </thead>
    </table>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NuevaEmpleadoModal" style="margin-bottom: 20px;  float: left;">
              Agregar Empleado
            </button>

<div class="divtablaAux">
<table class="table table-responsive-md table-hover text-center tablaAux">

    <thead class="thead-light">
      <tr>
        <th class="ThCenter">.</th>
        <th class="ThCenter">Empleado</th>
        <th class="ThCenter">
        	<div class="text-center" style="display: flex;">
		        <div class="input-group-btn" style="margin: auto;">
		          <button type="button" class="btn btn-secondary dropdown-toggle"
		                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown"> Cargo
		          </button>
		          <div class="dropdown-menu">
                @foreach($cargos as $cargo)
                <a class="dropdown-item" href="{{ (URL::to('/gerencia/RRHH')).'?cargo='.$cargo->cargo }}">{{ $cargo->cargo }}</a>
                @endforeach
                <a class="dropdown-item" href="{{ (URL::to('/gerencia/RRHH')) }}">Todos</a>
		          </div>
		        </div>
		    </div>
        </th>
    @if(Auth::user()->tipo=='Gerente de RRHH')

        <th class="ThCenter">
        	<div class="text-center" style="display: flex;">
		        <div class="input-group-btn" style="margin: auto;">
		          <button type="button" class="btn btn-secondary dropdown-toggle"
		                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown">Sucursal
		          </button>
		          <div class="dropdown-menu">
                @foreach($sucursales as $sucursal2)
		            <a class="dropdown-item" href="{{ (URL::to('/gerencia/RRHH')).'?sucursal='.$sucursal2->id }}">{{ $sucursal2->nombre }}</a>
                @endforeach
                <a class="dropdown-item" href="{{ (URL::to('/gerencia/RRHH')) }}"></a>
		          </div>
		        </div>
		    </div>
        </th>
      @endif
        
        <th></th>
        
      </tr>
    </thead>
    @php

		$size=sizeof($empleados);
		for($i=0;$i<$size; $i++){
    @endphp
    <tbody>
        <td>{{ $empleados[$i]->cedula }}</td>     
        <td>{{ $empleados[$i]->apellidos." ".$empleados[$i]->nombres }}</td>
        @if(is_null($empleados[$i]->cargo))
        	<td>{{ $empleados[$i]->rango }}</td>
          <td>Central</td>
            @php
            $titulo=$empleados[$i]->rango." ".$empleados[$i]->apellidos." ".$empleados[$i]->nombres;
            @endphp
        @else
          @php
            $titulo=$empleados[$i]->cargo." ".$empleados[$i]->apellidos." ".$empleados[$i]->nombres;
            @endphp
        	<td>{{ $empleados[$i]->cargo }}</td>
    @if(Auth::user()->tipo=='Gerente de RRHH')

          <td>{{ $empleados[$i]->sucursal }}</td>
    @endif
        @endif
        
       <td>
            <div class="d-flex flex-row">
              <div class="p-2">
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#ModalModificarEmpleado" onclick="ajaxModificarEmpleado('{{ $empleados[$i]->personal_id }}','{{ $titulo }}')">Modificar</button>
              </div>
              <div class="p-2">
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#ModalEliminarEmpleado" onclick="ConfirmarEliminarEmpleado('{{ $empleados[$i]->personal_id }}','{{ $titulo }}')">Eliminar</button>
              </div>
            </div>
       </td>
   
    </tbody>
    @php }
    @endphp
  </table>
</div><br></div></div>
<div class="item">
  <div id="AccordionAdminPersonal2" class="collapse" role="tabpanel">
    <table class="table">
      <thead class="thead-light">
        <tr align="center">
          <th>CONTROL DE NÓMINA</th>
        </tr>
      </thead>
    </table>
    <div class="form-row">    
        <div class="form-group col-md-2">
          <label class="custom-control custom-radio">Actual
              <input type="radio" class="custom-control-input" id="actualNomina" name="reporte" value="1" onclick="seleccion()" checked><span class="custom-control-indicator"></span>
          </label>
        </div>
        <div class="form-group col-md-2">
          <label class="custom-control custom-radio">Otra
              <input type="radio" class="custom-control-input" id="otraNomina" name="reporte" value="2"  onclick="seleccion()"><span class="custom-control-indicator"></span>
          </label>
        </div>
        <div class="form-group col-md-2 oculto" id="opcNominaSelect" style="margin-top: 3px;">
            <select name="nomina" class="opcTipo form-control-lg" id="opcnomina" required>
                <option value="0">Seleccione Fecha</option>
                <option value="idnomina" >Enero 2018</option>
                <option value="idnomina" >Diciembre 2017</option>
                <option value="idnomina" >Noviembre 2017</option>
            </select>
          </div>
        <div class="form-group col-md-2" style="margin-top: 3px;">
          @php
          $urlN=URL::to('/gerencia/RRHH/nomina/generar/1');
          $urlN2=URL::to('/gerencia/RRHH/nomina/generar/2');
          @endphp
          @if(Auth::user()->tipo!='Gerente de RRHH')
            <button type="button" class="btn btn-lg btn-success" onclick="Fomrnomina('{{ $urlN }}')">Mostrar</button>
          @else
            <button type="button" class="btn btn-lg btn-success" onclick="Fomrnomina('{{ $urlN2 }}')">Mostrar</button>
          @endif
        </div>
        </div>
      </div>
      <div id="ajax-nomina">
        
      </div>
      </div> 
  </div>
</div>

<!-- Button trigger modal -->
            
    
  <!----- MODALS ----------------------------------------->
<!------------------------ MODALS ---------------------->
 
			@include('asistente-RRHH.modalsPersonal')

<!------------------------------------- MODALS --------->
<!-------------- MODALS -------------------------------->
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
  var altura = $(document).height();
  altura=altura-380;
  altura=altura+"px";
  $(".divtablaAux").css("min-height",altura);
  //REINICIO DE VARIABLES PARA EVITAR ERRORES POR LA CACHE
  //
  
        document.getElementById('cedula').value='';
        document.getElementById('nombres').value='';
        document.getElementById('apellidos').value='';
         document.getElementById('direccion').value='';
         document.getElementById('tlf_movil').value='';
         document.getElementById('tlf_casa').value='';        
         document.getElementById('fechaEntrada').value='';        
         document.getElementById('sucursalN').value='';        
         document.getElementById('tipoCid22').value='0';
         document.getElementById('tipoCid2').value='0';
         document.getElementById('horarioN').value=''; 
         document.getElementById('licencia').value='';
         var radio3=$('input:radio[name=reporte]:checked').val();
         if(radio3==2){
            $("#opcNominaSelect").show();
         }


});

function seleccion(){
  var radio3=$('input:radio[name=reporte]:checked').val();
  if(radio3==2){
      $("#opcNominaSelect").show();
  }
  else {
      $("#opcNominaSelect").hide();
  }

}
  function ConfirmarEliminarEmpleado(id,nombre){
    //alert(id);
        document.getElementById('empleado_id').value=id;
        document.getElementById('tituloModalEliEmpleado').innerHTML=nombre;
  }

  function datosSP(id,nombre){
        var identificador=nombre+"id";
        var identificador2=nombre+"N";
        var identificador3=nombre+"T"+id;
        var titulo=document.getElementById(identificador3).innerHTML;
        document.getElementById(identificador).value=id;
        document.getElementById(identificador2).value=titulo;
        if(nombre=='cargo'){
          var identificador4=nombre+"N2";
          document.getElementById(identificador4).value=titulo;
        }
  }
  function helpCollapse(id){
    if(id==1){
      id2=2;
    }
    else{
      id2=1;
    }
    var ident='#AccordionInfoPersonal'+id;
    var ident2='#AccordionInfoPersonal'+id2;
    if($(ident).is(':hidden')){
      $(ident).collapse('show');
      if(!($(ident2).is(':hidden'))){
        $(ident2).collapse('hide');
      }
    }
  }
  function FormEmpleado(action, otro,opc){
        var tipoCid2="tipoCid2"+opc;
        var  tipoCid="tipoCid"+opc;
        var cedula=document.getElementById('cedula').value;
        var nombres=document.getElementById('nombres').value;
        var apellidos=document.getElementById('apellidos').value;
        var direccion=document.getElementById('direccion').value;
        var tlf_movil=document.getElementById('tlf_movil').value;
        var tlf_casa=document.getElementById('tlf_casa').value;        
        var fechaEntrada=document.getElementById('fechaEntrada').value;        
        var sucursalN=document.getElementById('sucursalN').value;        
        var tipo=document.getElementById(tipoCid2).value;
        var tipo2=document.getElementById(tipoCid).value;
        var horarioN=document.getElementById('horarioN').value; 
        var licencia=document.getElementById('licencia').value; 
        if(cedula.length==0){
          $('#AccordionInfoPersonal2').collapse('hide');
          $('#AccordionInfoPersonal1').collapse('show');
          document.getElementById('cedula').setCustomValidity("Debe ingresar la identificación del empleado");
          return false;
        } 
        else {  
          document.getElementById('cedula').setCustomValidity("");             
        if (nombres.length==0) 
        {
          $('#AccordionInfoPersonal2').collapse('hide');
          $('#AccordionInfoPersonal1').collapse('show');
          document.getElementById('nombres').setCustomValidity("Debe ingresar el nombre");
          return false;
        }
        else {
          document.getElementById('nombres').setCustomValidity("");
          if (apellidos.length==0) 
          {
            $('#AccordionInfoPersonal2').collapse('hide');
            $('#AccordionInfoPersonal1').collapse('show');
            document.getElementById('apellidos').setCustomValidity('Debe ingresar el apellido');
            return false;
          }
          else{
            document.getElementById('apellidos').setCustomValidity('');
            if (direccion.length==0) 
            {
              $('#AccordionInfoPersonal2').collapse('hide');
              $('#AccordionInfoPersonal1').collapse('show');
              document.getElementById('direccion').setCustomValidity('Debe ingresar la dirección');
              return false;
            }
            else{
              document.getElementById('direccion').setCustomValidity('');   
              if ((tlf_movil.length==0)&&(tlf_casa.length==0)) 
              {
                $('#AccordionInfoPersonal2').collapse('hide');
                $('#AccordionInfoPersonal1').collapse('show');
                document.getElementById('tlf_movil').setCustomValidity('Debe ingresar un número de Tlf');
                return false;
              }
              else {
                document.getElementById('tlf_movil').setCustomValidity('');
                if (fechaEntrada.length==0){
                  $('#AccordionInfoPersonal1').collapse('hide');
                  $('#AccordionInfoPersonal2').collapse('show');
                  if(otro!=1)
                    alert('Debe ingresar la fecha de ingreso');
                  return false;
                }
                else{
                    if ((tipo.length==0)||(tipo=='0')){
                      $('#AccordionInfoPersonal1').collapse('hide');
                      $('#AccordionInfoPersonal2').collapse('show');
                      if(otro!=1){
                        alert('Debe seleccionar el cargo que ejerce');
                      }
                      return false;
                    }
                  else{
                      if(tipo2!=2){
                          if (sucursalN.length==0){
                              $('#AccordionInfoPersonal1').collapse('hide');
                              $('#AccordionInfoPersonal2').collapse('show');
                              if(otro!=1){
                                alert('Debe seleccionar la sucursal donde labora');
                              }
                              return false;
                            }
                          else {
                            if (horarioN.length==0){
                              $('#AccordionInfoPersonal1').collapse('hide');
                              $('#AccordionInfoPersonal2').collapse('show');
                              if(otro!=1){
                                alert('Debe seleccionar el horario en el cual labora');
                              }
                              return false;
                            }
                            else{
                                if(opc==2){
                                  document.getElementById('nuevaEmpleadoForm').action = action;
                                }
                                else {
                                  document.getElementById('ModificarEmpleadoForm').action = action;
                                }
                                return true;
                            }
                            
                          }
                        
                      }
                    else {
                      if (licencia.length==0){
                          $('#AccordionInfoPersonal1').collapse('hide');
                          $('#AccordionInfoPersonal2').collapse('show');
                          if(otro!=1){
                            alert('Debe ingresar No aplica en caso de no poseer licencia');
                          }
                          return false;
                        }
                        else{
                          if(opc==2){
                            document.getElementById('nuevaEmpleadoForm').action = action;
                          }
                          else {
                            document.getElementById('ModificarEmpleadoForm').action = action;
                          }
                          return true;
                        }
                    }
                  }
                }
              }
            }
          }
        }      
        }

  }
  function cargoEleccion(opc){
    var tipoCid2="tipoCid2"+opc;
    document.getElementById(tipoCid2).value='1';
  }

  function tipoCargo(tipo,opc){
    var tipoCid2="tipoCid2"+opc;
    var tipoCid="tipoCid"+opc;
    document.getElementById(tipoCid2).value='0';
    var opcTripulante='#opcTripulante'+opc;
    var opcAdministrativo='#opcAdministrativo'+opc;
    var opcOperativo='#opcOperativo'+opc;
    var CdatosEmpleado='#CdatosEmpleado'+opc;
    switch (tipo) {
      case '1':
            $(opcTripulante).hide();
            $(opcAdministrativo).hide();
            $(opcOperativo).show();
            $(CdatosEmpleado).show();
        break;
      case '2':
            $(opcAdministrativo).hide();
            $(opcOperativo).hide();
            $(opcTripulante).show();
            $(CdatosEmpleado).hide();
        break;
      case '3':
            $(opcTripulante).hide();
            $(opcOperativo).hide();
            $(opcAdministrativo).show();
            $(CdatosEmpleado).show();
        break;
    }
    document.getElementById(tipoCid).value=tipo;
  }

  function ajaxModificarEmpleado(id,nombre){
    document.getElementById('TituloModalModificarPersonal').innerHTML=nombre;
    var targetL = $('#cargandoAux');
    targetL.loadingOverlay();
    var url="{{ URL::to('/gerencia/RRHH/administracion-empleados/ajaxModificar') }}/"+id;
    alert(url);
      $.get(url,function(data){ 
        $('#ModalAjaxModificarEmpleado').empty().html(data);
        targetL.loadingOverlay('remove');
      }); 
    
  }

  
</script>
@endsection