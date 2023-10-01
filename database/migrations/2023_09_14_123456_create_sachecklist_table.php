<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSAChecklistTable extends Migration
{
    public function up()
    {
        Schema::create('SAchecklist', function (Blueprint $table) {
            $table->id();
            $table->json('remark_data'); // JSON column to store the complex object
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('remarks');
    }
}
