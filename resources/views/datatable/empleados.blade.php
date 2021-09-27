
<!-- end buscador -->

<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h2 class="m-0 font-weight-bold text-primary">Listado de Empleado</h2> <a href="#" id="btn-new" class="btn btn-info"><i class="fa fa-user-plus"></i> Crear new</a>
</div>
<table id="data_table" class="table table-striped dataTable">
    <thead>
        <tr role="row">
            <th>N°</th>
            <th class="sorting" ><i class="fa fa-user"></i> Nombre</th>
            <th class="sorting" >@ Email</th>
            <th class="sorting" ><i class="fa fa-venus-mars"></i> Sexo</th>
            <th class="sorting" ><i class="fa fa-briefcase"></i> Área</th>
          
            <th class="sorting" ><i class="fa fa-envelope" aria-hidden="true"></i> Boletin</th>
            <th class="sorting" >Modificar</th>
            <th class="sorting" >Elimanar</th>
           
        </tr>
    </thead>
    <tbody>
                 
    </tbody>
    <tfoot>
                
    </tfoot>
</table>

<script type='text/javascript'>   
   var t =  $('#data_table').DataTable(
        {
            processing: true,
            serverSide: true,
            
            ajax: {
            url: "/getDatos",
            type: 'GET',
            },
            "language": 
            {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": 
                {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                    "oAria": 
                {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }, 
            columns: 
            [
                        { data: 'id'},
                        { data: 'nombre'},
                        { data: 'email'}, 
                        { data: 'sexo'},
                        { data: 'area'},
                        { data: 'boletin'},
                        {
                            "render": function (data, type, JsonResultRow, meta) {
                                return '<button  value="'+JsonResultRow.id+'" data-nombre="'+JsonResultRow.nombre+'" OnClick="editar(this);" class="btn btn-default" title="'+JsonResultRow.id+'" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></button>';
                            }
                        } ,
                        {
                            "render": function (data, type, JsonResultRow, meta) {
                                return '<button value="'+JsonResultRow.id+'" OnClick="eliminar(this);" class="btn" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash"></i> </button>';
                            }
                        },                
            ],
            "columnDefs": 
            [ 
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                } 
            ],
            order: [[0, 'desc']]
        });
        
        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

        $('#btn-new').on('click', function(){
            datatableNew('modalNew', '/newModal')
        });

        function editar(id)
        {
            var id = parseInt(id.value); 
            datatableEdit(id, 'modal', '/edit');
        }       

        function eliminar(id)
        {
            var id = parseInt(id.value); 
            if (window.confirm("Esta seguro de eliminar el siguiente archivo ?")) {
                $.ajax({
                    type: "GET",
                    url: 'destroy/' + id,
                    contentType: false,
                    success: function(data) {
                        var oTable = $('#data_table').dataTable();
                        oTable.fnDraw();
                        //window.location.href='/viewTableEmpleado';
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            }
        }

        var dataTable = $('#data_table').dataTable();
        $("#form_search").keyup(function() {
            dataTable.fnFilter(this.value);
        });
</script>