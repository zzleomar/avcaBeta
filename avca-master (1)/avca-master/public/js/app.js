$.ajaxSetup({
	headers:{
		'X-CSRF-TOKEN': $('META[name="csrf-token"]').attr('content')
	}
});
function formOperativo(action)
    {
        document.getElementById('formOperativo').action = action;
        document.getElementById('formOperativo').submit();
    }
function cancelarVuelo(action)
    {
        document.getElementById('CancelarVuelo').action = action;
        document.getElementById('CancelarVuelo').submit();
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
    default:
      //alert(pathname);
      break;
  }
});

function soloNum(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
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
    if (tecla==8){
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