<div class="row">
    <div class="col-12">
      <!-- Horizontal Form -->
       <!-- <div class="card mb-4">-->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h2 class="m-0 font-weight-bold text-primary"><i class="fa fa-user"></i> Empleado [{{$empleado->nombre}}]</h2>
            </div>

            <div id="editInfo" class="alert alert-info" role="alert">
                Los campos con asterisco(*) son requeridos
            </div>

            <div id="get_errors" style="display: none"></div>

            <div class="card-body">                
                {!! Form::model($empleado, ['id' => 'editForm', 'route' => ['empleado.update', $empleado->id], 'class' => '', 'method' => 'PUT', 'files' => false]) !!}            
                    {{ csrf_field() }}
                    {!! Form::hidden('id', $empleado->id) !!}
                    <div class="form-group row">
                        <label for="nombre_" class="col-sm-3 col-form-label">Nombre completo *</label>
                        <div class="col-sm-9">
                            {!! Form::text('nombre', old('name'), ['id' => 'nombre_', 'placeholder' => 'Nombre comple del empleado',  'class' => 'form-control']) !!}                           
                            <div class="text-danger" id="error_nombre"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email_" class="col-sm-3 col-form-label">Correo electrónico *</label>
                        <div class="col-sm-9">
                            {!! Form::text('email', old('email'), ['id' => 'email_', 'placeholder' => 'Correo comple del empleado',  'class' => 'form-control']) !!}
                            <div class="text-danger" id="error_email"></div>
                        </div>
                    </div>

                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-3 pt-0">Sexo *</legend>
                            <div class="col-sm-9">
                                <div class="custom-control custom-radio">
                                    {!! Form::radio('sexo', 'M', true, ['id'=>'sexo1_', 'class' => 'custom-control-input']) !!}                                   
                                    <label class="custom-control-label" for="sexo1_">Masculino</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    {!! Form::radio('sexo', 'F', true, ['id'=>'sexo2_', 'class' => 'custom-control-input']) !!}                                   
                                    <label class="custom-control-label" for="sexo2_">Femenino</label>
                                </div>
                                <div class="text-danger" id="error_sexo"></div>
                            </div>
                            
                        </div>
                    </fieldset>

                    <div class="form-group row">
                        <label for="area_id_" class="col-sm-3 col-form-label">Área * </label>
                        <div class="col-sm-9">
                            {!! Form::select('area_id', $areas, $empleado->area_id, ['id'=>'area_id_', 'class'=>'form-control form-control-lg  mb-3']) !!}
                            <div class="text-danger" id="error_area_id"></div>
                        </div>
                        
                    </div>

                    <div class="form-group row">
                        <label for="descripcion_" class="col-sm-3 col-form-label">Descripción *</label> 
                        <div class="col-sm-9">
                            {!! Form::textArea('descripcion', old('descripcion'), ['id' => 'descripcion_', 'class'=>'form-control', 'placeholder' => 'Descripción de la experiencia del empleado', 'rows' => '3']) !!}
                            <div class="text-danger" id="error_descripcion"></div>
                        </div>
                    </div>


                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-3 pt-0">Roles *</legend>
                            <div class="col-sm-9">
                                @foreach ($roles as $key => $value)                                    
                                    <div class="custom-control custom-checkbox">
                                        {!! Form::checkbox('roles[]', $key, ( in_array($value, $roles_select) ) ? 'checked' : '', ['id'=>'roles'.$key.'_', 'class' => 'custom-control-input']) !!}
                                        <label class="custom-control-label" for="roles{{$key}}_">{{$value}}</label>
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
                {!! Form::close() !!}
            </div>
        <!--</div>-->
    </div>
</div>

<script>
    $('#editInfo').show(1000);

    setTimeout(function(){
        $('#editInfo').hide(1000)
    }, 5000);

    $('#editForm').submit(function(e){
        e.preventDefault();     
        v1_form_edit('editForm', 'POST', 'update', null, 'modal', 'data_table');
    });
</Script>