@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 costo-center">            
            <h4 class="text-center subtituloM">Chequeo de boleto</h4>
            <div class="card">
                <div class="card-body">            
                    <form class="visible" action="/taquilla/confirmar-boleto" accept-charset="utf-8" method="POST">                     
                     <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
                     <div class="form-group row">
                        <label for="cedula" class="col-sm-2 col-form-label">Pasajero:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="cedula" placeholder="Introdusca Nro. de cédula ó Pasaporte">
                        </div>
                      </div>
        <div id="ajax-datos-boleto"> <!-- PARA EL AJAX-->

            <div class="form-group row mx-2">
                <div class="col">
                  <label for="staticEmail" class="col col-form-label">Funalito de tal Tuky</label>
                </div>
              </div>
            <div id="datosBoleto">
                <div class="conteneauxLchex"><label for="staticEmail">Vuelo:</label>
                <label class="auxLchex" id="staticEmail" >AS3224M</label></div>
                <div class="conteneauxLchex"><label for="staticEmail">Ruta:</label>
                <label class="auxLchex" id="staticEmail" >Cumaná ---> Caracas</label></div>
               <div class="conteneauxLchex"> <label for="staticEmail">Nro. Boleto:</label>
                <label class="auxLchex">123</label></div>
               <div class="conteneauxLchex"> <label for="staticEmail">Asiento:</label>
                <label class="auxLchex">12</label></div>
               <div class="conteneauxLchex"> <label for="staticEmail">Salida:</label>
                <label class="auxLchex">11-12-2017 08:00:00</label></div>

            </div>
            <br><hr>
                <h4 class="text-center subtituloM">Datos del Equipaje</h4><hr><br>
            <div class="contenerdorDE">
               <div class="form-row marginLeft margenInferior">
                    <label for="codigo" class="col-5" style="text-align: left; margin-top: 10px;">Cantidad de Equipaje</label>
                    <div class="form-row marginLeft col-4">
                        <input type="text" name="codigo" class="form-control" id="codigo" placeholder="" value="{{ old('codigo-boleto') }}" required style="margin-left: 6px;">
                    </div>
                </div>
                <div class="form-row marginLeft input-group margenInferior">
                    <label for="codigo" class="col-5" style="text-align: left; margin-top: 10px;">Peso Total</label>
                    <div class="form-row marginLeft col-5">
                        <input type="text" name="peso" class="form-control" id="peso" placeholder="" value="{{ old('peso-equipaje') }}" required><div class="input-group-addon">Kg</div>
                    </div>
                </div>
                <div class="form-row marginLeft input-group margenInferior">
                    <label for="codigo" class="col-5" style="text-align: left; margin-top: 10px;">Costo del sobrepeso</label>
                    <div class="form-row marginLeft col-5">
                            <input type="text" name="costo" class="form-control" id="costo" placeholder=""  value="{{ old('costo') }}" required>
                            <div class="input-group-addon">Bs</div>
                    </div>
                </div>
                

            </div>
    
            <div class="row mx-4">
                <input type="submit" class="btn btn-primary btn-lg btn-block my-2 " value="CONFIRMAR">
            </div>
        

        </div>
            </form></div>  
    </div></div>
</div>

@endsection