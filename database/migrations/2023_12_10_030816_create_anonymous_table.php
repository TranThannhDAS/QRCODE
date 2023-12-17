<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anonymous_files', function (Blueprint $table) {
            $table->id();
            $table->string('hashcode')->nullable();
            $table->string('name')->nullable();    
            $table->text('description')->nullable();
            $table->string('qrcode')->nullable();    
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
        Schema::dropIfExists('anonymous_files');
    }
};
