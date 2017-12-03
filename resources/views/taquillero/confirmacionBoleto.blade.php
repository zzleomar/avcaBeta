@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4 offset-md-4">            
            <h4 class="form-title text-center">Chequeo de boleto</h4>
            <div class="card">
                <div class="card-body">            
                    <form class="visible" action="/taquilla/confirmar-boleto" accept-charset="utf-8" method="POST">                     
                     <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
                       <label for="codigo">Código de Boleto</label>
                        <div class="input-group">
                            <div class="input-group-addon">Nro.</div>
                            <input type="text" name="codigo"class="form-control" id="codigo" placeholder="" value="{{ old('codigo-boleto') }}" required>
                        </div>                  
                        <label for="peso-equipaje">Peso del equipaje</label>      
                        <div class="input-group">
                            <input type="text" name="peso"class="form-control" id="peso" placeholder="" value="{{ old('peso-equipaje') }}" required><div class="input-group-addon">Kg</div>
                        </div>
                        <div>
                            <label for="costo">Costo del sobrepeso</label>
                            <div class="input-group">
                                <div class="input-group-addon">Nro.</div>
                                <input type="text" name="costo"class="form-control" id="costo" placeholder=""  value="{{ old('costo') }}" required>
                            </div> 
                        </div>  
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-lg btn-block" value="CONFIRMAR">
                        </div>                        
                          
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection