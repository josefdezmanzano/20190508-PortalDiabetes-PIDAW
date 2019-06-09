<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration
{
    public function up()
    {
        Schema::table('chatter_discussion', function (Blueprint $table) {
            $table->foreign('chatter_category_id')->references('id')->on('chatter_categories')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
        });
        Schema::table('chatter_post', function (Blueprint $table) {
            $table->foreign('chatter_discussion_id')->references('id')->on('chatter_discussion')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
        });
        Schema::table('medicions', function (Blueprint $table) {

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');;
        });
       // Schema::table('recomendacions', function (Blueprint $table) {

        //    $table->foreign('medicion_id')
         //       ->references('id')->on('medicions')
          //      ->onDelete('cascade')
          //      ->onUpdate('cascade');
        //s});
    }

    public function down()
    {
        Schema::table('chatter_discussion', function (Blueprint $table) {
            $table->dropForeign('chatter_discussion_chatter_category_id_foreign');
            $table->dropForeign('chatter_discussion_user_id_foreign');
        });
        Schema::table('chatter_post', function (Blueprint $table) {
            $table->dropForeign('chatter_post_chatter_discussion_id_foreign');
            $table->dropForeign('chatter_post_user_id_foreign');
        });
    }
}
