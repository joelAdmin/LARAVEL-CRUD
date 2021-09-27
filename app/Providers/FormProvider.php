<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Collective\Html\FormBuilder as Form;

class FormProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Form::macro('submit_', function ($etiqueta, $arreglo=array()){
              
            $comp = '<button type="submit" id="'.$arreglo['id'].'" class="'.$arreglo['class'].'">';
            if (isset($arreglo['fa']) && !empty($arreglo['fa'])){$comp .= '<i class="'.$arreglo['fa'].'"> </i> ';}

            $comp.= ''.$etiqueta.'</button>';
            return $comp;
        });

        Form::macro('textPlus_', function ($id, $name, $label, $icono=null, $placeholder, $help, $require, $errors, $size=array()){
         
            $id_str = substr(''.$id.'',0,-1);
            $name_str = substr(''.$name.'',0,-2);
            $id_ = substr(''.$id.'',0,-2);
            $comp = '<div class="field_wrapper_'.$id_.'  col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name)) 
            {
               $comp .='<div id="div_'.$id.'" class="input-group has-error has-feedback ">';
            }else {
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback ">';
            }
            if($icono<>null)
            {
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
            $comp .= Form::text($name, old($name), ['id' => $id, 'placeholder' => ''.$placeholder.'', 'title' => ''.$help.'', 'class' => 'form-control']);
            $comp .= Form::hidden('count_'.$name_str.'', 0, ['id' => 'count_'.$id_.'']);
            $comp .= '<span class="input-group-btn"><a href="javascript:void(0);" class="btn btn-primary add_button_'.$name_str.'" title="Add field"><i class="fa fa-plus"></i></a></span>';
            
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($id_).'</span>';
            $comp .= '</div>';
            $comp .= '
            <script>
                $(document).ready(function(){
                    var maxField = '.$size[2].';
                    var addButton = $(".add_button_'.$id_.'");
                    var wrapper = $(".field_wrapper_'.$id_.'");  
                    var hidde = $("#count_'.$id_.'");       
                    var x = 0; 
                    $(addButton).click(function(){ 
                        if(x < maxField){
                            x++; 
                            var j = x+1;
                            var fieldHTML   = \'<label id="label_'.$id_str.'\'+x+\'">'.$label.' \'+j+\' </label>\';
                            fieldHTML += \'<div id="div_'.$id_str.'\'+x+\'" class="input-group ">\'; 
                            
                            fieldHTML += \'<span class="input-group-addon"><i class="'.$icono.'"></i></span>\';
                            fieldHTML += \'<input type="text" title="'.$help.'" placeholder="'.$placeholder.'" name="'.$name.'" id="'.$id_str.'\'+x+\'" class="form-control">\';
                            fieldHTML += \'<div class="input-group-btn">\';
                            fieldHTML += \'<a href="javascript:void(0);" class=" btn btn-danger remove_button" title="remove field"><i class="fa fa-minus"></i></a>\';
                            fieldHTML += \'</div></div></div>\';
                            fieldHTML += \'<span id="span_'.$id_str.'\'+x+\'" class="help-block has-error" style="color:#a94442;"></span>\';
                            fieldHTML += \'<div id="br_'.$id_str.'\'+x+\'"></div>\';
                            
                            $(wrapper).append(fieldHTML);
                            $(hidde).val(x);
                        }
                    });
                    $(wrapper).on("click", ".remove_button", function(e){ 
                        e.preventDefault();
                        $("#div_'.$id_str.'"+x).remove();
                        $("#span_'.$id_str.'"+x).remove();
                        $("#label_'.$id_str.'"+x).remove();
                        $("#br_'.$id_str.'"+x).remove();
                        x--;
                        $(hidde).val(x);
                    });
                });
            </script>';
            return $comp;
        });

        Form::macro('textPluss_', function ($id, $name, $label, $icono=null, $placeholder, $help, $require, $errors, $size=array()){
         
            $id_str = substr(''.$id.'',0,-1);
            $name_str = substr(''.$name.'',0,-2);
            $id_ = substr(''.$id.'',0,-2);
            $comp = '<div class="field_wrapper_'.$id_.'  col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name)) 
            {
               $comp .='<div id="div_'.$id.'" class="input-group has-error has-feedback ">';
            }else {
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback ">';
            }
            if($icono<>null)
            {
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
            $comp .= Form::text($name, old($name), ['id' => $id, 'placeholder' => ''.$placeholder.'', 'title' => ''.$help.'', 'class' => 'form-control']);
            $comp .= Form::hidden('count_'.$name_str.'', 0, ['id' => 'count_'.$id_.'']);
           // $comp .= '<span class="input-group-btn"><a href="javascript:void(0);" class="btn btn-primary add_button_'.$name_str.'" id="add_button_'.$name_str.'" title="Add field"><i class="fa fa-plus"></i></a></span>';
            
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($id_).'</span>';
            $comp .= '</div>';
            /*
            $comp .= '
            <script>
                $(document).ready(function(){
                    var maxField = '.$size[2].';
                    var addButton = $(".add_button_'.$id_.'");
                    var wrapper = $(".field_wrapper_'.$id_.'");  
                    var hidde = $("#count_'.$id_.'");       
                    var x = 0; 
                    $(addButton).click(function(){ 
                        
                        if(x < maxField){
                            x++; 
                            var j = x+1;
                            var fieldHTML   = \'<label id="label_'.$id_str.'\'+x+\'">'.$label.' \'+j+\' </label>\';
                            fieldHTML += \'<div id="div_'.$id_str.'\'+x+\'" class="input-group ">\'; 
                            
                            fieldHTML += \'<span class="input-group-addon"><i class="'.$icono.'"></i></span>\';
                            fieldHTML += \'<input type="text" title="'.$help.'" placeholder="'.$placeholder.'" name="'.$name.'" id="'.$id_str.'\'+x+\'" class="form-control">\';
                            fieldHTML += \'<div class="input-group-btn">\';
                            fieldHTML += \'<a href="javascript:void(0);" class=" btn btn-danger remove_button" title="remove field"><i class="fa fa-minus"></i></a>\';
                            fieldHTML += \'</div></div></div>\';
                            fieldHTML += \'<span id="span_'.$id_str.'\'+x+\'" class="help-block has-error" style="color:#a94442;"></span>\';
                            fieldHTML += \'<div id="br_'.$id_str.'\'+x+\'"></div>\';
                            
                            $(wrapper).append(fieldHTML);
                            $(hidde).val(x);
                        }
                    });
                    $(wrapper).on("click", ".remove_button", function(e){ 
                        e.preventDefault();
                        $("#div_'.$id_str.'"+x).remove();
                        $("#span_'.$id_str.'"+x).remove();
                        $("#label_'.$id_str.'"+x).remove();
                        $("#br_'.$id_str.'"+x).remove();
                        x--;
                        $(hidde).val(x);
                    });
                });
            </script>';*/
            return $comp;
        });

        Form::macro('textBtn_', function ($id, $name, $label, $icono=null, $placeholder, $help, $require, $errors, $size=array(), $btn_fa=null, $btn_val='Nuevo'){
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name))
            {
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback ">';
            }else {
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback ">';
            }
                //$comp .= Form::label($name, $label, ['for' => "email", 'class' => 'col-md-'.$size[0].' control-label']);
                
                
               // $comp .= '<div class="col-md-'.$size[1].'">';
               if($icono<>null){
                    $comp .= '<span id="fa_'.$id.'" class="input-group-addon"><i id="div_'.$id.'" class="'.$icono.'"></i></span>';
                }
                $comp .= Form::text($name, old($name), ['id' => $id, 'placeholder' => ''.$placeholder.'', 'title' => ''.$help.'', 'class' => 'form-control']);
                $comp .= '<span class="input-group-btn"><a href="javascript:void(0);" id="add_button_'.$id.'" class="btn btn-primary add_button_'.$id.'" title="Agregar nuevo"><i class="'.$btn_fa.'"></i> '.$btn_val.'</a></span>';

                $comp .= '</div>';
                $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span>';
               
            $comp .= '</div>';
            return $comp;
        });

        Form::macro('textArea_', function ($id, $name, $label, $icono=null, $placeholder, $help, $require, $errors, $size=array(2,6,3)){
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name)){
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback ">';
            }else{
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback ">';
            }
            

            if($icono<>null){
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
            $comp .= Form::textArea($name, old($name), ['id' => $id, 'placeholder' => ''.$placeholder.'', 'title' => ''.$help.'', 'class' => 'form-control', 'rows' => $size[2]]);

            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span></div>';
            return $comp;
        });

        Form::macro('textArea_v4_ck', function ($id, $name, $label, $icono=null, $placeholder, $help, $require, $errors, $size=array(2,6,3)){
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name)){
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback ">';
            }else{
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback ">';
            }
           
            if($icono<>null){
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
            $comp .='<div style="border:1px;" contenteditable="true" id="ck_'.$id.'">';
            $comp .= Form::textArea($name, old($name), ['id' => $id, 'placeholder' => ''.$placeholder.'', 'title' => ''.$help.'', 'class' => 'form-control', 'cols'=>'6', 'rows' => $size[2]]);
            $comp .= '</div>';
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span></div>';
            $comp .= '<script>
                        $(function () 
                        {                            
                           CKEDITOR.editorConfig = function( config ) {
                                
                                //config.extraPlugins="confighelper"; 
                                config.placeholder = "Type here...";
                                config.toolbarCanCollapse = false;
                                config.toolbarGroups = [
                                    
                                    { name: "clipboard", groups: [ "clipboard", "undo" ] }
                                    
                                ];
                            };
                            CKEDITOR.replace("'.$id.'");                           
                        });
                    </script>';
            return $comp;
        });

        Form::macro('textArea_ck', function ($id, $name, $label, $icono=null, $placeholder, $help, $require, $errors, $size=array(2,6,3)){
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name)){
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback ">';
            }else{
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback ">';
            }
           
            if($icono<>null){
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
            
            $comp .= Form::textArea($name, old($name), ['id' => $id, 'placeholder' => ''.$placeholder.'', 'title' => ''.$help.'', 'class' => 'form-control',  'rows' => $size[2]]);
           
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span></div>';
            $comp .= ' <style>
                            .ck-editor__editable_inline {
                                min-height: 120px;                                
                            }                  
                        </style>
                        <script>                        
                        $(function () 
                        {
                            ClassicEditor
                                .create( document.querySelector("#'.$id.'"), {
                                    // toolbar: [ "heading", "|", "bold", "italic", "link" ],
                                    language: "es",
                                } )
                                .then( editor => {
                                    window.editor = editor;
                                } )
                                .catch( err => {
                                    console.error( err.stack );
                                } );
                               
                        });
                    </script>';
            return $comp;
        });

        Form::macro('textArea__', function ($id, $name, $label, $value=null, $icono=null, $placeholder, $help, $require, $errors, $size=array(2,6,3)){
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name)){
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback ">';
            }else{
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback ">';
            }
            

            if($icono<>null){
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
            if($value<>null){
                $comp .= Form::textArea($name, $value, ['id' => $id, 'placeholder' => ''.$placeholder.'', 'title' => ''.$help.'', 'class' => 'form-control', 'rows' => $size[2]]);
            }else{
                $comp .= Form::textArea($name, old($name), ['id' => $id, 'placeholder' => ''.$placeholder.'', 'title' => ''.$help.'', 'class' => 'form-control', 'rows' => $size[2]]);
            }
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span></div>';
            return $comp;
        });

        Form::macro('search_', function ($id, $name, $data=array(), $errors, $size=array()){

            if($errors->first($name)) 
            {
                $comp = '<div id="div_'.$id.'" class="input-group has-error has-feedback col-md-'.$size[1].'">';
            }else 
            {
                $comp = '<div id="div_'.$id.'" class="input-group  has-feedback col-md-'.$size[1].'">';
            }
            $comp .= '<div class="input-group-btn">';
            $comp .= '<button type="button" class="btn btn-primary dropdown-toggle" aria-expanded="false">
                            <i class="fa fa-search"></i>
                        </button>';
            /*
            $comp .= '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="fa fa-caret-down"></span>
                        </button>';
            $comp  .= '<ul class="dropdown-menu">';
            foreach($data as $key=>$value)
            {
                $comp .= ' <li><a href="#"> <input type="checkbox" class="checkboxs" value="'.$key.'" name="option_search[]"> '.$value.'</a></li>';
            }
            $comp .='<li class="divider"></li>
            <li><a href="#"> <input type="checkbox" id="selectall" value="" name="selectall">Todo</a></li>
            </ul>';
            */
            $comp .= '</div>';

            $comp .= Form::text($name, old($name), ['id' => $id, 'placeholder' => 'Ingresar busqueda', 'title' => 'Por favor ingresar la busqueda.', 'class' => 'form-control']);

            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span>';

            $comp .= ' <script>$("#selectall").on("click", function() {
                $(".checkboxs").attr("checked", this.checked);
              });</script>';
            return $comp;
        });

        Form::macro('inputmask_', function ($id, $name, $label, $icono=null, $placeholder, $help, $require, $errors, $size=array(), $format){
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name)) {
               
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback ">';
            }else {
                
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback ">';
            }
            

            if($icono<>null){
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
            $comp .= Form::text($name, old($name), ['id' => $id, 'placeholder' => ''.$placeholder.'', 'title' => ''.$help.'', 'class' => 'form-control']);
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span></div>';
            $comp .= '<script>
                            $(function () {
                                $("#'.$id.'").inputmask("'.$format.'",{ numericInput: true })
                            })
                      </script>';
            return $comp;
        });

        Form::macro('mask_', function ($id, $name, $label, $icono=null, $placeholder, $help, $require, $errors, $size=array(), $format){
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name)) {
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback ">';
            }else {
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback ">';
            }

            if($icono<>null){
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
            $comp .= Form::text($name, old($name), ['id' => $id, 'title' => ''.$help.'', 'class' => 'form-control']);
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span></div>';
            $comp .= '<script>
                            $(function () {
                                $("#'.$id.'").mask("'.$format.'", {reverse: true, placeholder: "'.$placeholder.'"});
                            });
                      </script>';
            return $comp;
        });

        /** codigo de daniel cordoba analizar **/
        Form::macro('checkbox_style', function($id, $name, $value=null, $activo){
            $html = Form::checkbox($name, $value, $activo, ['id' => $id, "class" => "onoffswitch-checkbox"]);
            return $html;
        });

        
        Form::macro('text_', function ($id, $name, $label, $icono=null, $placeholder, $help, $require, $errors, $size=array()){
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name))
            {
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback ">';
            }else {
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback ">';
            }
                //$comp .= Form::label($name, $label, ['for' => "email", 'class' => 'col-md-'.$size[0].' control-label']);
                
                
               // $comp .= '<div class="col-md-'.$size[1].'">';
               if($icono<>null){
                    $comp .= '<span id="fa_'.$id.'"  class="input-group-addon"><i id="div_'.$id.'" class="'.$icono.'"></i></span>';
                }
                $comp .= Form::text($name, old($name), ['id' => $id, 'placeholder' => ''.$placeholder.'', 'title' => ''.$help.'', 'class' => 'form-control']);
                
                $comp .= '</div>';
                $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span>';
               
            $comp .= '</div>';
            return $comp;
        });

        Form::macro('colorpicker_', function ($id, $name, $label, $icono=null, $placeholder, $help, $require, $errors, $size=array()){
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name))
            {
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback ">';
            }else {
                
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback ">';
            }
                
               if($icono<>null){
                    $comp .= '<span id="fa_'.$id.'" class="input-group-addon"><i id="div_'.$id.'" class="'.$icono.'"></i></span>';
                }
                $comp .= Form::text($name, old($name), ['id' => $id, 'placeholder' => ''.$placeholder.'', 'title' => ''.$help.'', 'class' => 'form-control my-colorpicker1 colorpicker-element']);
                
                $comp .= '</div>';
                $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span><br>';
               
            $comp .= '</div>';
            $comp .= '<script>
                            $(function () {
                                $("#'.$id.'").colorpicker();
                            });
                      </script>';
            return $comp;
        });

        
        Form::macro('filePlus_', function ($id, $name, $label, $icono=null, $placeholder, $help, $require, $errors, $size=array()){
            $id_str = substr(''.$id.'',0,-1);
            $name_str = substr(''.$name.'',0,-2);
            $id_ = substr(''.$id.'',0,-2);
            //dd($id_str);
            if($errors->first($name)) 
            {
                $comp = '<div class="field_wrapper_'.$id_.'"><div id="div_'.$id.'" class="input-group has-error has-feedback col-md-'.$size[1].'">';
            }else 
            {
                $comp = '<div class="field_wrapper_'.$id_.'"><div id="div_'.$id.'" class="input-group  has-feedback col-md-'.$size[1].'">';
            }
                //$comp .= Form::label($name, $label, ['for' => "email", 'class' => 'col-md-'.$size[0].' control-label']);
               
                
               // $comp .= '<div class="col-md-'.$size[1].'">';
               if($icono<>null)
                {
                    $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
                }
                $comp .= Form::file($name, ['id' => $id, 'placeholder' => ''.$placeholder.'', 'title' => ''.$help.'', 'class' => 'form-control']);
                $comp .= Form::hidden('count_'.$name_str.'', 0, ['id' => 'count_'.$id_.'']);
                $comp .= '<span class="input-group-addon"><a href="javascript:void(0);" class="add_button_'.$id_.'" title="remove field"><i class="fa fa-plus"></i></a></span>';
            
                $comp .= '</div>';
                $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($id).'</span>';
                $comp .= '</div>';
                $comp .= '
                <script>
                $(document).ready(function(){
                    var maxField = '.$size[2].';
                    var addButton = $(".add_button_'.$id_.'");
                    var wrapper = $(".field_wrapper_'.$id_.'");  
                    var hidde = $("#count_'.$id_.'");      
                    var x = 0; 
                    $(addButton).click(function(){ 
                        if(x < maxField){
                            x++; 
                            var fieldHTML = \'<div id="div_'.$id_str.'\'+x+\'" class="input-group col-md-'.$size[1].'">\'; 
                            fieldHTML += \'<span class="input-group-addon"><i class="'.$icono.'"></i></span>\';
                            fieldHTML += \'<input type="file" title="'.$help.'" placeholder="'.$placeholder.'" name="'.$name.'" id="'.$id_str.'\'+x+\'" class="form-control">\';
                            fieldHTML += \'<div class="input-group-addon">\';
                            fieldHTML += \'<a href="javascript:void(0);" class="remove_button" title="remove field"><i class="fa fa-minus"></i></a>\';
                            fieldHTML += \'</div></div></div>\';
                            fieldHTML += \'<span id="span_'.$id_str.'\'+x+\'" class="help-block has-error" style="color:#a94442;"></span>\';
                            fieldHTML += \'<div id="br_'.$id_str.'\'+x+\'"><br/></div>\';
                            
                            $(wrapper).append(fieldHTML);
                            $(hidde).val(x);
                        }
                    });
                    $(wrapper).on("click", ".remove_button", function(e){ 
                        e.preventDefault();
                        $("#div_'.$id_str.'"+x).remove();
                        $("#span_'.$id_str.'"+x).remove();
                        $("#br_'.$id_str.'"+x).remove();
                        x--;
                        $(hidde).val(x);
                    });
                });
                </script>';
                return $comp;
        });
        
        Form::macro('filePlus_paraelminar', function ($id, $name, $label, $icono=null, $placeholder, $help, $require, $errors, $size=array()){
            $id_str = substr(''.$id.'',0,-1);
            $name_str = substr(''.$name.'',0,-2);        
            
            if($errors->first($name)) 
            {
                $comp = '<div class="field_wrapper_'.$name_str.'"><div id="div_'.$id.'" class="input-group has-error has-feedback col-md-'.$size[1].'">';
            }else 
            {
                $comp = '<div class="field_wrapper_'.$name_str.'"><div id="div_'.$id.'" class="input-group  has-feedback col-md-'.$size[1].'">';
            }
            if($label<>null)
            {
                $comp .= '<label for="email" class="col-md-'.$size[0].' control-label">'.$label.'';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';}$comp .= '</label>';
            }
            if($icono<>null)
            {
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
              
            $comp .= Form::file($name, ['id' =>$id, 'placeholder' => ''.$placeholder.'', 'title' => ''.$help.'', 'class' => 'form-control']);
            $comp .= Form::hidden('count_'.$name_str.'', 0, ['id' => 'count_'.$name_str.'']);
            $comp .= '<span class="input-group-addon"><a href="javascript:void(0);" class="add_button_'.$name_str.'" title="Add field"><i class="fa fa-plus"></i></a></span>';
            
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span>';
            $comp .= '</div>';
            $comp .= '
            <script>
            $(document).ready(function(){
                var maxField = '.$size[2].';
                var addButton = $(".add_button_'.$name_str.'");
                var wrapper = $(".field_wrapper_'.$name_str.'");       
                var hidde = $("#count_'.$name_str.'");       
                var x = 0; 
                $(addButton).click(function(){ 
                    if(x < maxField){
                        x++; 
                        var fieldHTML = \'<div id="div_'.$id_str.'\'+x+\'" class="input-group col-md-'.$size[1].'">\'; 
                        fieldHTML += \'<span class="input-group-addon"><i class="'.$icono.'"></i></span>\';
                        fieldHTML += \'<input type="file" title="'.$help.'" placeholder="'.$placeholder.'" name="'.$name.'" id="'.$id_str.'\'+x+\'" class="form-control">\';
                        fieldHTML += \'<div class="input-group-addon">\';
                        fieldHTML += \'<a href="javascript:void(0);" class="remove_button" title="Add field"><i class="fa fa-minus"></i></a>\';
                        fieldHTML += \'</div></div></div>\';
                        fieldHTML += \'<span id="span_'.$id_str.'\'+x+\'" class="help-block has-error" style="color:#a94442;"></span>\';
                        fieldHTML += \'<div id="br_'.$id_str.'\'+x+\'"><br/></div>\';
                        
                        $(hidde).val(x);
                        $(wrapper).append(fieldHTML);
                    }
                });
                $(wrapper).on("click", ".remove_button", function(e){ 
                    e.preventDefault();
                    $("#div_'.$id_str.'"+x).remove();
                    $("#span_'.$id_str.'"+x).remove();
                    $("#br_'.$id_str.'"+x).remove();
                    x--;
                    $(hidde).val(x--);
                });
            });
            </script>';
            return $comp;
        });

        Form::macro('file_', function ($id, $name, $label, $icono=null, $placeholder, $help, $require, $errors, $size=array(), $image=null){
            $comp = '';
            if($image)
            {
              if($image=='default')
              {
                $comp .= '<div class="row">
                    <div class="col-md-3  text-center"> </div>
                        <div class="col-md-6"> 
                            <a href="#" class="thumbnail text-center">
                            <div class="" id="lista_imagenes'.$id.'"> 
                                <img alt="100%x180" data-src="holder.js/100%x180" class="img-thumbnail" style="height: 150px; width: 100%; display: block;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTcxIiBoZWlnaHQ9IjE4MCIgdmlld0JveD0iMCAwIDE3MSAxODAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MTgwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTZhZGMyODRiNzAgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNmFkYzI4NGI3MCI+PHJlY3Qgd2lkdGg9IjE3MSIgaGVpZ2h0PSIxODAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI1OSIgeT0iOTQuNSI+MTcxeDE4MDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true">
                            </div>
                            </a> 
                        </div>  
                        <div class="col-md-3  text-center"></div>    
                        <br>
                 </div>';                
              }else 
              {
                $comp .= '
                <div class="row">
                    <div class="col-md-3  text-center"> </div>
                        <div class="col-md-6  text-center"> 
                            <a href="#" class="thumbnail text-center">
                            <div id="lista_imagenes'.$id.'"> 
                                <img alt="100%x180" data-src="holder.js/100%x180" class="img-thumbnail" style="height: 150px; width: 100%; display: block;" src="'.$image.'" data-holder-rendered="true">
                            </div>
                            </a> 
                        </div>  
                        <div class="col-md-3  text-center"></div>  
                        <br>
                </div>';
              }

              $comp .= '
              <script>
                function archivo_'.$id.'(evt) {
                  var files = evt.target.files; // FileList object

                  // Obtenemos la imagen del campo "file".
                  for (var i = 0, f; f = files[i]; i++) {
                    //Solo admitimos imágenes.
                    if (!f.type.match(\'image.*\')) {
                        continue;
                    }

                    var reader = new FileReader();

                    reader.onload = (function(theFile) {
                        return function(e) {
                          // Insertamos la imagen
                         document.getElementById("lista_imagenes'.$id.'").innerHTML = [\'<img style="height: 150px; width: 100%; display: block;" class="thumb" src="\', e.target.result,\'" title="\', escape(theFile.name), \'"/>\'].join(\'\');
                        };
                    })(f);

                    reader.readAsDataURL(f);
                  }
                }
                document.getElementById("'.$id.'").addEventListener("change", archivo_'.$id.', true);
              </script>';
            }

            if($errors->first($name)) 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback col-md-'.$size[1].'">';
            }else 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback col-md-'.$size[1].'">';
            }
            if($label<>null)
            {
                $comp .= '<label for="email" class="col-md-'.$size[0].' control-label">'.$label.'';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';}$comp .= '</label>';
            }
            if($icono<>null)
            {
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }

            $comp .= Form::file($name, ['id' =>$id, 'placeholder' => ''.$placeholder.'', 'title' => ''.$help.'', 'class' => 'form-control']);
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span>';

            return $comp;
        });

        Form::macro('password_', function ($id, $name, $label, $icono=null, $placeholder, $help, $require, $errors, $size=array()){

            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}

            if($errors->first($name)){              
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback ">';
            }else {            
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback ">';
            }
                
               // $comp .= '<div class="col-md-'.$size[1].'">';
               if($icono<>null){
                    $comp .= '<span id="div_'.$id.'" class="input-group-addon"><i id="div_'.$id.'" class="'.$icono.'"></i></span>';
                }
                $comp .=  Form::password($name, ['id' => $id,  'placeholder' => ''.$placeholder.'', 'title' => ''.$help.'', 'class' => 'form-control']);
               /* if($icono<>null){
                    $comp .= '<span class="'.$icono.' form-control-feedback"></span>';
                }*/
                $comp .= '</div>';
                $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span><br>';
               
            $comp .= '<br></div>';
            return $comp;
        });
        
        Form::macro('selectMultiple_', function ($id, $name, $label, $icono=null, $placeholder=null, $help, $data, $selected=null, $require, $errors, $size=array()){
            if($errors->first($name)) 
            {
                $comp = '<div id="div_'.$id.'" class="input-group has-error has-feedback col-md-'.$size[1].'">';
            }else 
            {
                $comp = '<div id="div_'.$id.'" class="input-group  has-feedback col-md-'.$size[1].'">';
            }
           // $comp .= '<label for="email" class="col-md-'.$size[0].' control-label">'.$label.'';if($require == 1) {$comp .=  '<b style="color:red;"></b>';}$comp .= '</label>';

            if($icono<>null)
            {
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
            $comp .= Form::select($name, $data, $selected, ['id' => $id, 'multiple' => true, 'placeholder' => $placeholder, 'title' => ''.$help.'', 'class' => 'form-control']);

            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block" style="color:#a94442;">'.$errors->first($id).'</span>';
            return $comp;
        });

        Form::macro('select2_', function ($id, $name, $label, $icono=null, $placeholder=null, $help, $data, $selected=null, $require, $errors, $size=array(), $multiple, $plus=false){
            
            $pos = strpos($name, '[]');
            if($pos === false){
                $name_str = $name;
            }else{
                $name_str = substr(''.$name.'',0,-2);
            }
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name)) 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback">';
            }else 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback">';
            }
           // $comp .= '<label for="email" class="col-md-'.$size[0].' control-label">'.$label.'';if($require == 1) {$comp .=  '<b style="color:red;"></b>';}$comp .= '</label>';

            if($icono<>null)
            {
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
            $data['']= '';
            $comp .= Form::select($name, $data, $selected, ['id' => $id, 'data-placeholder' => $placeholder, 'multiple' => $multiple, 'title' => $help, 'class' => 'form-control select2 select2-hidden-accessible']);
            if($plus==true)
            {
                $comp .= '<span class="input-group-btn"><a href="#" class="btn btn-primary" id="btn_add_'.$id.'" title="remove field"><i class="fa fa-plus"></i></a></span>';
            }
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span>';
            $comp .= '</div>';
            $comp .= '
            <script>                
                $("#'.$id.'").select2({
                    width:"100%"

                });
            </script>';
            return $comp;
        });

        Form::macro('select2_v1', function ($id, $name, $label, $icono=null, $placeholder=null, $help, $data, $selected=null, $require, $errors, $size=array(), $readonly, $multiple, $plus=false){
            
            $pos = strpos($name, '[]');
            if($pos === false){
                $name_str = $name;
            }else{
                $name_str = substr(''.$name.'',0,-2);
            }
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name)) 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback">';
            }else 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback">';
            }
           // $comp .= '<label for="email" class="col-md-'.$size[0].' control-label">'.$label.'';if($require == 1) {$comp .=  '<b style="color:red;"></b>';}$comp .= '</label>';

            if($icono<>null)
            {
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
            $data['']= '';
            $comp .= Form::select($name, $data, $selected, ['id' => $id, 'data-placeholder' => $placeholder, 'multiple' => $multiple, 'title' => $help, 'class' => 'form-control select2 select2-hidden-accessible', 'readonly' => $readonly]);
            if($plus==true)
            {
                $comp .= '<span class="input-group-btn"><a href="#" class="btn btn-primary" id="btn_add_'.$id.'" title="remove field"><i class="fa fa-plus"></i></a></span>';
            }
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span>';
            $comp .= '</div>';
            $comp .= '
            <script>                
                $("#'.$id.'").select2({
                    width:"100%"

                });
            </script>';
            return $comp;
        });

        Form::macro('select_v1', function ($id, $name, $label, $icono=null, $placeholder=null, $help, $data, $selected=null, $require, $errors, $size=array(), $readonly, $plus=false){
            
            $pos = strpos($name, '[]');
            if($pos === false){
                $name_str = $name;
            }else{
                $name_str = substr(''.$name.'',0,-2);
            }
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name)) 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback">';
            }else 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback">';
            }
           
            if($icono<>null)
            {
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
            $comp .= Form::select($name, $data, $selected, ['id' => $id, 'placeholder' => $placeholder, 'title' => ''.$help.'', 'class' => 'form-control  select_'.$name_str .'', 'readonly' => $readonly]);
            if($plus==true)
            {
                $comp .= '<span class="input-group-btn"><a href="#" class="btn btn-primary" id="btn_add_'.$id.'" title="nuevo"><i class="fa fa-plus"></i></a></span>';
            
            }
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span>';
            $comp .= '</div>';
            return $comp;
        });

        Form::macro('select_', function ($id, $name, $label, $icono=null, $placeholder=null, $help, $data, $selected=null, $require, $errors, $size=array(), $plus=false){
            
            $pos = strpos($name, '[]');
            if($pos === false){
                $name_str = $name;
            }else{
                $name_str = substr(''.$name.'',0,-2);
            }
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name)) 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback">';
            }else 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback">';
            }
           
            if($icono<>null)
            {
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
            $comp .= Form::select($name, $data, $selected, ['id' => $id, 'placeholder' => $placeholder, 'title' => ''.$help.'', 'class' => 'form-control  select_'.$name_str .'']);
            if($plus==true)
            {
                $comp .= '<span class="input-group-btn"><a href="#" class="btn btn-primary" id="btn_add_'.$id.'" title="nuevo"><i class="fa fa-plus"></i></a></span>';
            
            }
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span>';
            $comp .= '</div>';
            return $comp;
        });

        Form::macro('buscardorVentas_', function ($id, $name, $label, $icono=null, $placeholder=null, $help, $data, $selected=null, $require, $errors, $size=array(), $multiple, $plus=false){
            
            $pos = strpos($name, '[]');
            if($pos === false){
                $name_str = $name;
            }else{
                $name_str = substr(''.$name.'',0,-2);
            }
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name)) 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback">';
            }else 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback">';
            }
              // $comp .= '<label for="email" class="col-md-'.$size[0].' control-label">'.$label.'';if($require == 1) {$comp .=  '<b style="color:red;"></b>';}$comp .= '</label>';

            if($icono<>null)
            {
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
            $comp .= Form::select($name, $data, $selected, ['id' => $id, 'data-placeholder' => $placeholder, 'multiple' => $multiple, 'title' => $help, 'class' => 'form-control select2 select2-hidden-accessible']);
            if($plus==true)
            {
                $comp .= '<span class="input-group-btn"><a href="#" class="btn btn-lg btn-primary" id="btn_add_'.$id.'" title="nuevo"><i class="fa fa-plus"></i></a></span>';
            
            }
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span>';
            $comp .= '</div>';
            $comp .= '<script>
                        $("#'.$id.'").select2({
                            width:"100%"
                          });
                     </script>';
            return $comp;
        });

        Form::macro('select2LG_', function ($id, $name, $label, $icono=null, $placeholder=null, $help, $data, $selected=null, $require, $errors, $size=array(), $multiple, $plus=false){
            
            $pos = strpos($name, '[]');
            if($pos === false){
                $name_str = $name;
            }else{
                $name_str = substr(''.$name.'',0,-2);
            }
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name)) 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback">';
            }else 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback">';
            }
           // $comp .= '<label for="email" class="col-md-'.$size[0].' control-label">'.$label.'';if($require == 1) {$comp .=  '<b style="color:red;"></b>';}$comp .= '</label>';

            if($icono<>null)
            {
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
            $comp .= Form::select($name, $data, $selected, ['id' => $id, 'data-placeholder' => $placeholder, 'multiple' => $multiple, 'title' => $help, 'class' => 'form-control select2 select2-hidden-accessible']);
            if($plus==true)
            {
                $comp .= '<span class="input-group-btn"><a href="#" class="btn btn-lg btn-primary" id="btn_add_'.$id.'" title="nuevo"><i class="fa fa-plus"></i></a></span>';
            
            }
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span>';
            $comp .= '</div>';
            $comp .= '<script>
                        $("#'.$id.'").select2({
                            width:"100%"
                          });
                     </script>';
            return $comp;
        });

        Form::macro('new_select2', function ($id, $name, $label, $icono=null, $placeholder=null, $help, $data, $selected=null, $require, $errors, $size=array(), $multiple, $plus=false){
            
            $pos = strpos($name, '[]');
            if($pos === false){
                $name_str = $name;
            }else{
                $name_str = substr(''.$name.'',0,-2);
            }
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name)) 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group input-group has-error has-feedback">';
            }else 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group input-group has-feedback">';
            }
           // $comp .= '<label for="email" class="col-md-'.$size[0].' control-label">'.$label.'';if($require == 1) {$comp .=  '<b style="color:red;"></b>';}$comp .= '</label>';

            if($icono<>null)
            {
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
            }
            $comp .= Form::select($name, $data, $selected, ['id' => $id, 'data-placeholder' => $placeholder, 'multiple' => $multiple, 'title' => $help, 'class' => 'form-control']);
            if($plus==true)
            {
                $comp .= '<span class="input-group-addon"><a href="#" class="" id="btn_add_'.$id.'" title="remove field"><i class="fa fa-plus"></i></a></span>';
            
            }
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span>';
            $comp .= '</div>';
           
            return $comp;
        });

        Form::macro('radio_', function ($id, $name, $label, $help, $data, $require, $errors, $size=array()){
            if($errors->first($name)) 
            {
                $comp = '<div class="col-md-'.$size[1].'">';
                $comp .= '<div id="div_'.$id.'" class="form-group has-error has-feedback">';
            }else 
            {
                $comp = '<div class="col-md-'.$size[1].'">';
                $comp .= '<div id="div_'.$id.'" class="form-group">';
            }
                // $comp .= Form::label($name, $label, ['for' => "email", 'class' => 'col-md-'.$size[0].' control-label']);
            $comp .= '<label for="email" class="">'.$label.'';if($require == 1) {$comp .=  '<b style="color:red;"></b>';}$comp .= '</label>';
            $comp .= '<div class="col-md-'.$size[1].'">';
            //$comp .= Form::radio($name, $data, true, ['title' => ''.$help.'', 'class' => 'form-control']);
            $i=0;
            foreach ($data as $key => $value) 
            {
                $i++;
                $comp .= Form::radio($name, $key, false, ['id' => $i.'_'.$id, 'title' => ''.$help.'']).$value.'<br>';
            }
            /*
            if($errors->first($name))
            {
                $comp .= '<span id="span_'.$id.'" class="help-block">'.$errors->first($name).'</span>';
            }*/
                $comp .= '<span id="span_'.$id.'" class="help-block">'.$errors->first($name).'</span>';
                $comp .= '</div></div></div>';
                return $comp;
        });

        Form::macro('switch_', function ($id, $name, $label, $class, $id_switch, $size=array()){
            $comp = '<div class="col-md-'.$size[1].' name="'.$name.'">';
            $comp .= '<div id="'.$id.'" class="input-group">';
            $comp .= '<label>'.$label.'</label>';
            $comp .= '<div class="'.$class.'" id="'.$id_switch.'">';
            $comp .= '<input type="checkbox" class="checkbox" style="margin-top: 20px;" value="1" onclick="(this.value=\'0\')">';
            $comp .= '<div class="knobs"><span></span></div><div class="layer"></div>';
            $comp .= '</div></div><br/>';
            $comp .= '</div>';
            // $comp .= '<script> function(){
            //     $(this).val("1");
            // }, 
            // function(){
            //     $(this).val("0");
            // }
            // </script>';

            return $comp;
        });

        Form::macro('switch2_', function ($id, $name, $label, $class, $id_switch, $size=array()){
            $comp  = '<div class="col-md-'.$size[1].' name="'.$name.'">';
            $comp .= '<div id="'.$id.'" class="input-group">';
            $comp .= '<label>'.$label.'</label>';
            $comp .= '<div class="'.$class.'" id="'.$id_switch.'">';
            $comp .= '<input type="checkbox" name="'.$name.'" class="checkbox swith" style="margin-top: 20px;" value="1">';
            $comp .= '<div class="knobs"><span></span></div><div class="layer"></div>';
            $comp .= '</div></div><br/>';
            $comp .= '</div>';
            $comp .= '<script>'; 
            $comp .= '$(".swith").on("click", function(){
                        if(parseInt($(this).val())==1){                            
                            $(this).val(0);
                        }else{
                            $(this).val(1);
                        }
                    });'; 
            $comp .= '</script>';

            return $comp;
        });

        Form::macro('simple_switch_', function ($id, $name, $label=array(), $class, $size=array()){
            //switch-input, switch-left-right, switch-flat, switch-yes-no, switch-slide, switch-light
           
            $comp = '<div class="col-md-'.$size[1].' name="'.$name.'">';
            $comp .= '<div id="'.$id.'" class="input-group">';
            $comp .= '<label>'.$label[0].'</label>';
                       
            $comp .= '<label class="switch switch-'.$class.'"><input id="'.$id.'" name="'.$name.'" class="switch-input switch_'.$id.'"  value="0" type="checkbox" /><span class="switch-label" data-on="'.$label[1].'" data-off="'.$label[2].'"></span> <span class="switch-handle"></span> </label>';
           
            $comp .= '</div><br/>';
            $comp .= '</div>';

            $comp .= '<script>'; 
            $comp .= '$(".switch_'.$id.'").on("click", function(){
                        if(parseInt($(this).val())==1){                            
                            $(this).val(0);
                        }else{
                            $(this).val(1);
                        }
                    });'; 
            $comp .= '</script>';
            
            return $comp;
        });

        Form::macro('date_', function ($id, $name, $label, $icono=null, $placeholder, $title, $data, $require, $errors, $size=array()){
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name)) 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback ">';
            }else 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback ">';
            }

            if($icono<>null)
            {
                $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
                // $comp .= '<span class="input-group-addon"><i class="'.$icono.'"></i></span>';
                $comp .= '<input id="'.$id.'" class="form-control" onfocus="(this.type=\'date\')" onblur="(this.type=\'text\')" placeholder="'.$placeholder.'" title="'.$title.'" name="'.$name.'" value="'.$data.'">';
            }
            // $comp .= Form::date($name, old($name), ['type' => 'text', 'class' => 'form-control', 'onfocus' => '(this.type=\'date\')', 'onblur' =>'(this.type=\'text\')', 'placeholder' => ''.$placeholder.'', 'title' => ''.$title.'', 'name' => ''.$name.'', 'id' => ''.$id.'']);

            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).' </span>';

            $comp .= '</div>';
            return $comp;
        });

        Form::macro('daterangepicker_', function ($id, $name, $label, $icono=null, $placeholder, $help, $require, $errors, $size=array(), $plus=array()){
            $comp = '<div class="col-md-'.$size[1].'">';
            if($label<>null){$comp .= '<label>';if($require == 1) {$comp .=  '<b style="color:red;"> *</b>';} $comp .= ''.$label.'</label>';}
            if($errors->first($name))
            {
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback ">';
            }else {
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback ">';
            }
                //$comp .= Form::label($name, $label, ['for' => "email", 'class' => 'col-md-'.$size[0].' control-label']);
                
                
               // $comp .= '<div class="col-md-'.$size[1].'">';
               if($icono<>null){
                    $comp .= '<span id="fa_'.$id.'"  class="input-group-addon"><i id="div_'.$id.'" class="'.$icono.'"></i></span>';
                }
                $comp .= Form::text($name, old($name), ['id' => $id, 'placeholder' => ''.$placeholder.'', 'title' => ''.$help.'', 'class' => 'form-control pull-right']);
                if($plus['bandera']==true)
                {
                    $comp .= '<span class="input-group-btn"><a href="#" class="btn '.$plus['color'].'" id="btn_'.$id.'" title="'.$plus['titulo'].'"><i class="'.$plus['fa'].'"></i></a></span>';
            
                }
                $comp .= '</div>';
                $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span>';
               
            $comp .= '</div>';
            $comp .= '<script>'; 
            $comp .= '$(function () {
                            $("#'.$id.'").daterangepicker({
                                "locale": {
                                    "format": "YYYY-MM-DD",
                                    "separator": " - ",
                                    "applyLabel": "Guardar",
                                    "cancelLabel": "Cancelar",
                                    "fromLabel": "Desde",
                                    "toLabel": "Hasta",
                                    "customRangeLabel": "Personalizar",
                                    "daysOfWeek": [
                                        "Do",
                                        "Lu",
                                        "Ma",
                                        "Mi",
                                        "Ju",
                                        "Vi",
                                        "Sa"
                                    ],
                                    "monthNames": [
                                        "Enero",
                                        "Febrero",
                                        "Marzo",
                                        "Abril",
                                        "Mayo",
                                        "Junio",
                                        "Julio",
                                        "Agosto",
                                        "Setiembre",
                                        "Octubre",
                                        "Noviembre",
                                        "Diciembre"
                                    ],
                                    "firstDay": 1
                                },
                               /* "startDate": "20-01-01",
                                "endDate": "2016-01-07",*/
                                "opens": "center"
                            });
                        });'; 
            $comp .= '</script>';
            return $comp;
        });

        Form::macro('select_radio_', function ($id, $name, $label, $icono=null, $placeholder=null, $help, $data_list, $selected=null, $require, $errors, $size=array(), $id_option, $name_option, $data){
            $pos = strpos($name, '[]');
            if($pos === false){
                $name_str = $name;
            }else{
                $name_str = substr(''.$name.'',0,-2);
            }
            if($errors->first($name) OR $errors->first($name_option)) 
            {
                $comp = '<div id="div_'.$id.'" class="input-group has-error has-feedback col-md-'.$size[1].'">';
            }else 
            {
                $comp = '<div id="div_'.$id.'" class="input-group  has-feedback col-md-'.$size[1].'">';
            }
            $comp .= '<div class="input-group-btn">';
            $comp .= '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="fa fa-caret-down"></span>
                        </button>';
            $comp  .= '<ul class="dropdown-menu">';
            foreach($data as $key=>$value)
            {
                $comp .= ' <li><a href="#"> <input type="radio" id="'.$id_option.'" class="checkboxs" value="'.$key.'" name="'.$name_option.'"> '.$value.'</a></li>';
            }
            $comp .='</ul>';
            $comp .= '</div>';

            //$comp .= Form::text($name, old($name), ['id' => $id, 'placeholder' => 'Ingresar busqueda', 'title' => 'Por favor ingresar la busqueda.', 'class' => 'form-control']);
            $comp .= Form::select($name, $data_list, $selected, ['id' => $id, 'placeholder' => $placeholder, 'title' => ''.$help.'', 'class' => 'form-control  select_'.$name_str .'']);
            $comp .= '</div>';
            $comp .= '<span id="span_'.$id.'" class="help-block has-error" style="color:#a94442;">'.$errors->first($name).'</span>';

            $comp .= ' <script>
                            $("#selectall").on("click", function() 
                            {
                                $(".checkboxs").attr("checked", this.checked);
                            });
                        </script>';
            return $comp;
        });

        Form::macro('switch_css_', function($id, $name, $title, $data, $valor, $errors, $size=array())
        {
            
           $comp = '
            <style type="text/css">
                            .onoffswitch'.$id.' {
                        position: relative; width: 104px;
                        -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
                        }
                        .onoffswitch'.$id.'-checkbox {
                        display: none;
                        }
                        .onoffswitch'.$id.'-label {
                        display: block; overflow: hidden; cursor: pointer;
                        border: 2px solid #F2E4E4; border-radius: 20px;
                        }
                        .onoffswitch'.$id.'-inner {
                        display: block; width: 200%; margin-left: -100%;
                        transition: margin 0.3s ease-in 0s;
                        }
                        .onoffswitch'.$id.'-inner:before, .onoffswitch'.$id.'-inner:after {
                        display: block; float: left; width: 50%; height: 28px; padding: 0; line-height: 28px;
                        font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
                        box-sizing: border-box;
                        }
                        .onoffswitch'.$id.'-inner:before {
                        content: "'.$data[1].'";
                        padding-left: 10px;
                        background-color: #00A65A; color: #FFFFFF;
                        }
                        .onoffswitch'.$id.'-inner:after {
                        content: "'.$data[0].'";
                        padding-right: 10px;
                        background-color: #DD4B39; color: #FFFFFF;
                        text-align: right;
                        }
                        .onoffswitch'.$id.'-switch {
                        display: block; width: 25px; margin: 1.5px;
                        background: #FFFFFF;
                        position: absolute; top: 0; bottom: 0;
                        right: 72px;
                        border: 2px solid #F2E4E4; border-radius: 20px;
                        transition: all 0.3s ease-in 0s; 
                        }
                        .onoffswitch'.$id.'-checkbox:checked + .onoffswitch'.$id.'-label .onoffswitch'.$id.'-inner {
                        margin-left: 0;
                        }
                        .onoffswitch'.$id.'-checkbox:checked + .onoffswitch'.$id.'-label .onoffswitch'.$id.'-switch {
                        right: 0px; 
                        }
            </style>'; 
            if($errors->first($name)) 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group has-error has-feedback col-md-'.$size[1].'">';
            }else 
            {
                $comp .= '<div id="div_'.$id.'" class="input-group  has-feedback col-md-'.$size[1].'">';
            }
            $comp .= '<div class="col-md-'.$size[1].'">';
           
            $comp .= '<div class="onoffswitch'.$id.'" id="mostrar_'.$id.'">
                            <input type="checkbox" name="'.$name.'" value="1" class="onoffswitch'.$id.'-checkbox" title="'.$title.'" id="'.$id.'" data-id="" data-num="" checked>
                            <label class="onoffswitch'.$id.'-label" for="'.$id.'">
                                <span class="onoffswitch'.$id.'-inner"></span>
                                <span class="onoffswitch'.$id.'-switch"></span>
                            </label>
                        </div>';
            $comp .= '<span id="span_'.$id.'" class="help-block">'.$errors->first($name).'</span>';
            $comp .= '</div>
                </div>';
            $comp .= '<script>             
                        $(function(e){
                            if(parseInt('.$valor.') == 1)
                            {
                                $("#'.$id.'").prop("checked", true);
                                $("#'.$id.'").val(1);
                            
                            }else if("'.$valor.'" == "")
                            {
                                $("#'.$id.'").prop("checked", true);
                                $("#'.$id.'").val(1);
                            }else
                            {
                                $("#'.$id.'").prop("checked", false);
                                $("#'.$id.'").val(0);  
                            }
                        });
                        $("#'.$id.'").on("click", function(){
                            if($(this).val()==1)
                            {
                                $("#'.$id.'").prop("checked", false);
                                $("#'.$id.'").val(0);
                            }else
                            {
                                $("#'.$id.'").prop("checked", true);
                                $("#'.$id.'").val(1);
                            }
                        });  
                    </script>';
            return $comp;
        });
    
    }
}
