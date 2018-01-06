$.ajaxSetup({
	headers:{
		'X-CSRF-TOKEN': $('META[name="csrf-token"]').attr('content')
	}
});
function pulsar(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  return (tecla != 13);
}
function formOperativo(action)
    {
        document.getElementById('formOperativo').action = action;
        var nombres=document.getElementById('nombres').value;
        var apellidos=document.getElementById('apellidos').value;
        var direccion=document.getElementById('direccion').value;
        var tlf_movil=document.getElementById('tlf_movil').value;
        var tlf_casa=document.getElementById('tlf_casa').value;        
        if (nombres.length==0) 
        {

          document.getElementById('nombres').setCustomValidity("Debe ingresar el nombre");
          document.getElementById('formOperativo').onsubmit =false;
        }
        else {
          document.getElementById('nombres').setCustomValidity("");
          if (apellidos.length==0) 
          {
            document.getElementById('apellidos').setCustomValidity('Debe ingresar el apellido');
            document.getElementById('formOperativo').onsubmit =false;
          }
          else{
            document.getElementById('apellidos').setCustomValidity('');
            if (direccion.length==0) 
            {
              document.getElementById('direccion').setCustomValidity('Debe ingresar la dirección');
              document.getElementById('formOperativo').onsubmit =false;
            }
            else{
              document.getElementById('direccion').setCustomValidity('');   
              if ((tlf_movil.length==0)&&(tlf_casa.length==0)) 
              {
                document.getElementById('formOperativo').onsubmit =false;
                document.getElementById('tlf_movil').setCustomValidity('Debe ingresar un número de Tlf');
              }
              else {
                document.getElementById('tlf_movil').setCustomValidity('');
              }
            }
          }
          
        }
          document.getElementById('formOperativo').onsubmit =true;
    }
function estadoVuelo(action)
    {
        document.getElementById('FormEstadoVuelo').action = action;
        document.getElementById('FormEstadoVuelo').submit();
    }
  function EliminarRuta(){
        document.getElementById('EliminarRutaForm').submit();
  }

function cancelar(id){
        document.getElementById('vuelo_id').value=id;
        document.getElementById('tituloModal').innerHTML="Vuelo "+id;
}
 //Este evento se genera cuando el popup modal se cierra al pulsar en el aspa, en el boton cerrar o se pincha fuera de el
  $('#myModal_preview_imagen').on('hidden.bs.modal', function () {
      $("."+$("#loader_funcionando").val()).hide();
  });
  $('#myModal_confirmacion_delete').on('hidden.bs.modal', function () {
      $("."+$("#loader_funcionando").val()).hide();
  });

//contenedor info-vuelo
$(document).ready(function(){
  var altura = $(document).height();
  altura=altura-115;
  altura=altura+"px";
  $("#contenedorPersonal").css("min-height",altura);

  //nav
  //
  //
  var pathname = window.location.pathname;
  switch (pathname) {
    case '/taquilla':
      $('#taquilla').addClass('active');
      break;
    case '/taquilla/confirmar-boleto':
      $('#chequeo').addClass('active');
      break;
    case '/sucursal':
      $('#vuelos').addClass('active');
      break;
    case '/sucursal':
      $('#vuelos').addClass('active');
      break;
    case '/gerente-sucursales':
      $('#sucursales').addClass('active');
      break;
    case '/gerente-sucursales/administracion-rutas':
      $('#adminrutas').addClass('active');
      break;
    case '/gerente-sucursales/administracion-aeronaves':
      $('#adminaeronaves').addClass('active');
      break;
    case '/RRHH':
      $('#adminPersonal').addClass('active');
      break;
    case '/RRHH/asistencia':
      $('#adminAsistencia').addClass('active');
      break;
    case '/gerente-RRHH/nomina':
      $('#OpcNomina').addClass('active');
      break;
    case '/gerente-RRHH/tabulador-salarial':
      $('#OpcTabuladorSalarial').addClass('active');
      break;
    case '/gerente-RRHH':
      $('#gerentRRHHIni').addClass('active');
      break;

    default:
      //alert(pathname);
      break;
  }
});

function soloNum(e){

    tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite
    if ((tecla==8)||(tecla==0)){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function soloNumDec(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if ((tecla==8)||(tecla==0)){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9-.]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

jQuery(function ($) {
    var target = $('#target');

    $('.toggle-loading').click(function () {
      if (target.hasClass('loading')) {
        target.loadingOverlay('remove');
      } else {
        target.loadingOverlay();
      };
    });
  });

var num=0;
function doIt(obj)
{
  limite=3; //limite de checks a seleccionar
  if(obj.checked) {
    if ((num+1)>limite){
      obj.checked=false;
      alert("Solo puede seleccionar 3 sobrecargos")
    }
    else{
      num=num+1;
    }

  }
  else{
    num=num-1;
  }
}
function planificarVuelo(action)
{
  var piloto=$('input:radio[name=piloto]:checked').val();
  var copiloto=$('input:radio[name=copiloto]:checked').val();
  var jefac=$('input:radio[name=jefac]:checked').val();
  var aeronave=$('input:radio[name=aeronave]:checked').val();
  if(!piloto){
    document.getElementById('BotonPlanificarVuelo').disabled=false;
    alert("Asigne un piloto al vuelo");
    return false;
  }
  else{
    if(!copiloto){
      document.getElementById('BotonPlanificarVuelo').disabled=false;
      alert("Asigne un copiloto al vuelo");
            return false;

    }
    else{
      if(!jefac){
        document.getElementById('BotonPlanificarVuelo').disabled=false;
        alert("Asigne un jefe de cabina al vuelo");
            return false;

      }
      else{
        if(!aeronave){
            document.getElementById('BotonPlanificarVuelo').disabled=false;
            alert("Asigne una aeronave al vuelo");
            return false;

        }
        else{
          if(num<3){
            document.getElementById('BotonPlanificarVuelo').disabled=false;
            alert("Asigne "+(3-num)+" sobrecargos al vuelo");
            return false;

          }
          else{
            document.getElementById('FormProgramarVuelo').action = action;
            return true;
          }
        }
      }
    }
  }
}

function capturarO(id,clave)
  {
    var nr="origenNR"+clave;
    var nrid="origenid"+clave;
    var datos;
    if(clave=='B'){
      var id2="suO"+id+clave;
      datos=document.getElementById(id2).value;     
    }
    else {
      var id2="suO"+id;
      datos=document.getElementById(id2).innerHTML;     
    }
    document.getElementById(nr).value = datos; 
    document.getElementById(nrid).value = id; 
    
  } 
function capturarD(id,clave)
  {
    var nr="destinoNR"+clave;
    var nrid="destinoid"+clave;
    var datos;
    if(clave=='X'){
      var id2="suD"+id+clave;
      datos=document.getElementById(id2).value;     
    }
    else {
      var id2="suD"+id;
      datos=document.getElementById(id2).innerHTML;     
    }
    document.getElementById(nr).value = datos; 
    document.getElementById(nrid).value = id; 
    
  } 

  function formrutas(){
    var origen=$('#origenNR').val();
    var destino=$('#destinoNR').val();
    var distancia=$('#distanciaNR').val();
    var duracion=$('#duracionNR').val();
    var precio=$('#precioNR').val();

  if(origen.length==0){    
      alert('Debe ingresar el origen');
      document.getElementById('nuevaRutaForm').onsubmit =false;
  }
  else{

    if(destino.length==0){      
      alert('Debe ingresar el destino');
      document.getElementById('nuevaRutaForm').onsubmit =false;
    }
    else{

      if(distancia.length==0){
        document.getElementById('distanciaNR').setCustomValidity('Debe ingresar la distancia');
        document.getElementById('nuevaRutaForm').onsubmit =false;
      }
      else{
        document.getElementById('distanciaNR').setCustomValidity('');
        if(duracion.length==0){
          document.getElementById('duracionNR').setCustomValidity('Debe ingresar la duración');
          document.getElementById('nuevaRutaForm').onsubmit =false;
        }
        else{
          document.getElementById('duracionNR').setCustomValidity('');
          if(precio.length==0){
            document.getElementById('precioNR').setCustomValidity('Debe ingresar el costo');
            document.getElementById('nuevaRutaForm').onsubmit =false;
          }
          else{
            document.getElementById('precioNR').setCustomValidity('');
            return true;
          }
        }
      }
    }
  }
  }

  function formAeronaves(){
    var matricula=$('#matriculaN').val();
    var capacidad=$('#capacidadN').val();
    var modelo=$('#modeloN').val();

    if(matricula.length==0){   
     
      document.getElementById('matriculaN').setCustomValidity('Debe ingresar la matricula');
      document.getElementById('nuevaAeronaveForm').onsubmit =false;
    }
    else{
      document.getElementById('matriculaN').setCustomValidity('');
      if(modelo.length==0){      
        document.getElementById('modeloN').setCustomValidity('Debe ingresar el modelo');
        document.getElementById('nuevaAeronaveForm').onsubmit =false;
      }
      else{
        document.getElementById('modeloN').setCustomValidity('');
        if(capacidad.length==0){
          document.getElementById('capacidadN').setCustomValidity('Debe ingresar la distancia');
          document.getElementById('nuevaAeronaveForm').onsubmit =false;
        }
        else{
          document.getElementById('capacidadN').setCustomValidity('');
              return true;
            }
        }
    }
  }

function EliminarAeronave(){
        document.getElementById('EliminarAeronaveForm').submit();
}