<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    public function up()
    {
        Schema::create(config("file-handler.table-name"), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("slug");
            $table->morphs("filedable");
            $table->unsignedBigInteger("created_by")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists(config("file-handler.table-name"));
    }
}
