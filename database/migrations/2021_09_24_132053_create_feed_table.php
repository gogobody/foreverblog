<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->integer('blog_id')->default(0)->comment('外键ID');
            $table->string('title', 255)->comment('标题');
            $table->string('author', 255)->comment('作者');
            $table->string('link', 255)->comment('链接');
            $table->text('desc')->nullable()->comment('描述');
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
        Schema::dropIfExists('feed');
    }
}
