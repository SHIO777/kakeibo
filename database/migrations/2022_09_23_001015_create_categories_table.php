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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            // afterはcolumnをaddするときにのみ使用可．新規作成時は使用不可．
            // $table->foreignId('kind_id')->after('id')->constrained()->cascadeOnDelete();
            $table->foreignId('kind_id')->constrained()->cascadeOnDelete();
            $table->string('category');
            $table->text('description')->nullable();
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
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['kind_id']);
            $table->dropColumn(['kind_id']);
        });
        Schema::dropIfExists('categories');
    }
};
