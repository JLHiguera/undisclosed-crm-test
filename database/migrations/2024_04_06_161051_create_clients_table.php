<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 60);
            $table->string('direccion', 200);
            $table->decimal('estimacion_venta', 12, 2);
            $table->text('observaciones');
            $table->string('giro', 45);
            $table->string('url', 100);
            $table->enum('fase_venta', ['iniciada', 'procesando', 'completada', 'rechazada']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
