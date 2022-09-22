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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // $table->
            // $table->foreignId('kind_id')->after('id')->nullable()->constrained('kind')->cascadeOnDelete();
            $table->foreignId('kind_id')->after('id')->constrained('kinds')->cascadeOnDelete();
            $table->foreignId('category_id')->after('kind_id')->constrained('categories')->cascadeOnDelete();
            $table->integer('price');
            $table->date('date');
            $table->string('place')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('transactions');
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['kind_id']);
            $table->dropColumn(['kind_id']);

            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id']);
        });
    }
};
