<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->integer('location_id')->unsigned();

            $table->string('title');
            $table->text('description');
            $table->decimal('price');

            $table->enum('status', ['active', 'draft'])->default('draft');

            $table->boolean('is_expired')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_hidden')->default(false);

            $table->date('expires_at');

            $table->integer('views')->default(0);
            
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
        Schema::dropIfExists('posts');
    }
}
