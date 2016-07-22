<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id', 20)->unique();
            $table->integer('user_id');
            $table->json('data');
            $table->integer('count');
            $table->timestamp('created_at');
        });
    }

    public function down()
    {
        Schema::drop('orders');
    }
}
