<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('requirements');
            $table->string('type'); // academic or non-academic
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scholarships');
    }
};