<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->integer('categories_id', true);
            $table->text('categories_image', 65535)->nullable();
            $table->text('categories_icon', 65535)->nullable();
            $table->integer('categories_parent_id')->default(0)->index('idx_categories_parent_id');
            $table->integer('categories_sort_order')->nullable();
            $table->string('categories_name', 191);
            $table->boolean('categories_status')->default(1);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
