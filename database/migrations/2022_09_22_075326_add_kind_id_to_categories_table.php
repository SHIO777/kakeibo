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
        // category tableにkind_idカラムを追加 
        // -> see lecture 6.13 「tweetテーブルにユーザーIDカラムを追加する」
        // category tableに新たに追加されるkind_idカラムには初期データは何も入らない．
        // nullable()としていないとエラーが発生するので、nullable()を追記．

        // sail php artisan migrate
        // でマイグレートしたのち，phpmyadminより，category tableのkind_idを適当な数で埋めておくこと


        // Schema::table('categories', function (Blueprint $table) {
        //     $table->foreignId('kind_id')->after('id')->nullable()->constrained()->cascadeOnDelete();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('categories', function (Blueprint $table) {
        //     $table->dropForeign(['kind_id']);
        //     $table->dropColumn(['kind_id']);
        // });
    }
};
