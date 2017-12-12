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
});