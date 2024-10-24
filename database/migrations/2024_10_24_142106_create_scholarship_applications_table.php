<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('scholarship_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scholarship_id')->constrained();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('semester');
            $table->decimal('ipk', 3, 2);
            $table->string('document_path');
            $table->string('status')->default('belum di verifikasi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scholarship_applications');
    }
};