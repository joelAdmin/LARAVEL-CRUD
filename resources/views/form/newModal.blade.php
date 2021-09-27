<div class="row">
    <div class="col-12">
      <!-- Horizontal Form -->
       <!-- <div class="card mb-4">-->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h2 class="m-0 font-weight-bold text-primary">Crear Empleado </h2>  <a href="/viewTableEmpleado" class="btn btn-info"><i class="fa fa-list"></i> Listar Empleados</a>
            </div>

            <div class="alert alert-info" role="alert">
                Los campos con asterisco(*) son requeridos
            </div>

            <div id="get_errors" style="display: none"></div>

            <div class="card-body">
                <!--<form id="newForm" name="new" class="form-content"  method="POST" >   -->
                {!! Form::open(['url' => '/new', 'id' => 'newForm', 'class' => 'form-horizontal', 'method' => 'POST', 'files' => false]) !!}             
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="nombre" class="col-sm-3 col-form-label">Nombre completo *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nombre" name="nombre" onblur="validarQuery(this.id)" placeholder="Nombre comple del empleado">
                            <div class="text-danger" id="error_nombre"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Correo electrónico *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Nombre comple del empleado">
                            <div class="text-danger" id="error_email"></div>
                        </div>
                    </div>

                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-3 pt-0">Sexo *</legend>
                            <div class="col-sm-9">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="sexo1" name="sexo" value="M" class="custom-control-input">
                                    <label class="custom-control-label" for="sexo1">Masculino</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="sexo2" name="sexo" value="F" class="custom-control-input">
                                    <label class="custom-control-label" for="sexo2">Femenino</label>
                                </div>
                                <div class="text-danger" id="error_sexo"></div>
                            </div>
                            
                        </div>
                    </fieldset>

                    <div class="form-group row">
                        <label for="area_id" class="col-sm-3 col-form-label">Área *</label>
                        <div class="col-sm-9">
                            <select id="area_id" name="area_id" class="form-control form-control-lg  mb-3">
                                @foreach ($areas as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach                               
                            </select>
                            <div class="text-danger" id="error_area_id"></div>
                        </div>
                        
                    </div>

                    <div class="form-group row">
                        <label for="descripcion" class="col-sm-3 col-form-label">Descripción *</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Descripción de la experiencia del empleado" rows="3"></textarea>
                            <div class="text-danger" id="error_descripcion"></div>
                        </div>
                    </div>


                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-3 pt-0">Roles *</legend>
                            <div class="col-sm-9">
                                @foreach ($roles as $key => $value)                                    
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="roles{{$key}}" name="roles[]" value="{{$key}}" class="custom-control-input" >
                                        <label class="custom-control-label" for="roles{{$key}}">{{$value}}</label>
                                    </div>
                                @endforeach
                                <div class="text-danger" id="error_roles"></div>
                            </div>
                            
                        </div>
                    </fieldset>

                    <div class="form-group row">
                        <div class="row">
                            <div class="col-sm-9">
                                <button type="submit" class="save btn btn-lg btn-info">Guardar  </button>
                            </div>
                        </div>
                    </div>
                <!--</form>-->
                {!! Form::close() !!}
            </div>
        <!--</div>-->
    </div>
</div>
<script>
    $('#newForm').submit(function(e){
        e.preventDefault();  
        v1_form('newForm', 'POST', 'new', null, 'newModal', 'data_table');
    });
</script>
 