<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->integer('id', true)->comment('ID');
            $table->string('name', 255)->nullable()->comment('发布人名称');
            $table->string('email', 255)->nullable()->comment('发布人email');
            $table->string('title', 255)->comment('标题');
            $table->text('content')->nullable()->comment('内容');
            $table->boolean('is_comment')->default(1)->comment('是否开启评论:1=开启,0=关闭');
            $table->string('type', 32)->nullable()->comment('类型:notice=公告,article=文章,page=单页');
            $table->string('key', 255)->nullable()->comment('页面标识，用于单页链接');
            $table->integer('read_num')->default(0)->comment('阅读数量');
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
        Schema::dropIfExists('article');
    }
}
