<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductUseRemarkDemandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('phone', 20);
            $table->string('email', 50);
            $table->integer('qq');
            $table->tinyInteger('licence_id')->default(1);
            $table->tinyInteger('category')->default(1);
            $table->tinyInteger('region')->default(1);
            $table->decimal('price', 10, 2)->default(0);
            $table->string('message', 200)->default('');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('licences', function (Blueprint $table) { 
            $table->increments('id');
            $table->string('name', 30);
            $table->string('email', 30)->default('');
            $table->string('phone', 30)->default('');
            $table->integer('qq')->default(0);
            $table->decimal('price', 10, 2)->default(0);
            $table->tinyInteger('region')->default(0);
            $table->tinyInteger('category')->default(1);
            $table->string('image', 100);
            $table->integer('collection')->default(0);
            $table->string('message', 1000)->default('');
            $table->tinyInteger('status')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
