<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Collective\Html\HtmlBuilder as Html;

class HtmlProvider extends ServiceProvider
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
        
        Html::macro('callout', function($titulo, $contenido, $fa=null, $tema){
            $comp = '<div class="callout callout-'.$tema.'">';
            $comp .= '<h4><i class="'.$fa.'"></i> '.$titulo.'</h4>';
            $comp .= '<p>'.$contenido.'</p>';
            $comp .= '</div>';
            return $comp;
        });

        Html::macro('alert_advanced', function($titulo, $contenido, $fa=null, $tema){
            $comp = '<div class="alert alert-'.$tema.' alert-dismissible">';
            $comp .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
            $comp .= '<h4><i class="icon '.$fa.'"></i> '.$titulo.'</h4>';
            $comp .= $contenido;
            $comp .= '</div>';
            return $comp;
        });

        Html::macro('modal_advanced', function ($id, $fa, $title, $message, $size, $activo){
              
            $comp = '
            <style>
                    #mdialTamanio{
                      width: '.$size.'% !important;
                    }
                  </style>
            <div id="'.$id.'" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" id="mdialTamanio" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"> <i class="'.$fa.'"></i> '.$title.'</h4>
                                </div>
                                           
                                    <div id="content_'.$id.'">
                                    '.$message.'
                                    </div>
                                
                                <!--<div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                                </div>-->
                                
                            </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>';
            if($activo==true){
                $comp .= '
                <script>
                    $(function(){
                        $("#'.$id.'").modal("show");
                    });
                </script>';
            }else{
                $comp .= '
                <script>
                    $(function(){
                        $("#'.$id.'").modal("hide");
                    });
                </script>';
            } 
            $comp .= '
                <script>
                    $(function(){
                        $(".close").on("click", function(){
                            $("#'.$id.'").modal("hide");
                        });
                    });
                </script>';        
            return $comp;
        });

        Html::macro('alert_modal', function($id, $fa, $title, $message, $color){
            $comp = '<div class="modal modal-'.$color.' fade in" id="'.$id.'" style="display: block; padding-right: 17px;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close cerrar" data-dismiss="" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title"><i class="'.$fa.'"></i> '.$title.'</h4>
                                </div>';
            $comp .= ' <div class="modal-body">
                            <p>'.$message.'</p>
                       </div>';
            $comp .= ' <div class="modal-footer">
                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><span aria-hidden="true">×</span> cerrar todo</button>
                            <!--<button type="button" class="btn btn-outline">Save changes</button>-->
                       </div>';
            $comp .= ' </div>
                        <!-- /.modal-content -->
                    </div>
                        <!-- /.modal-dialog -->
                </div>';
            $comp .= '
                <script>
                    $(function(){
                        $(".cerrar").on("click", function(){
                            $("#'.$id.'").attr("style", "display:none");
                        });
                    });
                </script>';
            return $comp;
        });

        Html::macro('modal', function ($id, $fa, $title, $message, $size){
              
            $comp3 = '
            <style>
                    #mdialTamanio{
                      width: '.$size.'% !important;
                    }
                  </style>
            <div id="'.$id.'" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" id="mdialTamanio" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"> <i class="'.$fa.'"></i> '.$title.'</h4>
                                </div>
                                           
                                    <div id="content_'.$id.'">
                                    '.$message.'
                                    </div>
                                
                                <!--<div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                                </div>-->
                                
                            </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>';


            $comp = '<!-- Modal -->
                        <div id="'.$id.'" class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel"><i class="'.$fa.'"></i> '.$title.'</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="content_'.$id.'" class="modal-body">
                                    '.$message.'                                
                                </div>
                                <!--<div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Understood</button>
                                </div>-->
                                </div>
                            </div>
                        </div>';
            
            /*$comp .= '
                <script>
                    $(function(){
                        $(".close").on("click", function(){
                            $("#'.$id.'").modal("hide");
                        });
                    });
                </script>'; */       
            return $comp;
        });
        
        Html::macro('alert', function ($class, $icon, $message){
              
            $comp = '<div class="alert '.$class.' alert-dismissable"><i class="'.$icon.'"></i>';

            $comp .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;';

            $comp .= '</button>'.$message.'</div>';
            
            return $comp;
        });
    }
}

