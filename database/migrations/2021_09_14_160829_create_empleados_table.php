<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id()->comment('Identificador de área');
            $table->string('nombre', 250)->comment('Nombre completo del empleado. Campo tipo tex. Solo debe permitir letras con o sin tilde y espacios. No se adminiten caracteres especiales ni numeros.');
            $table->string('email', 250)->comment('Correo electronico del empleado. Campo de tipo Text Email. Solo permite una estructura de correo. Obligatorio');
            $table->char('sexo', 1)->comment('Campo de tipo radio Button. M para masculino F para femenino. Obligatorio');

            $table->unsignedBigInteger('area_id')->comment('Area de la empresa a la que pertenece el empleado. Campo tipo select. Oblligatorio');
            $table->foreign('area_id')->references('id')->on('areas');

            $table->integer('boletin')->nullable()->comment('1 para Recibir boletin. 0 para no recibir boletin. Campo de tipo checkbox. Opcional');
            $table->text('descripcion')->comment('Se describe la experiencia del empleado. Campo de tipo textarea. Obligatorio');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
