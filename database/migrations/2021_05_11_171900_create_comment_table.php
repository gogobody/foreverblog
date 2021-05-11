<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->integer('id', true)->comment('ID');
            $table->integer('parent_id')->default(0)->comment('上级评论ID');
            $table->integer('reply_id')->nullable()->default(0)->comment('回复评论ID');
            $table->integer('foreign_id')->comment('外键ID');
            $table->enum('type', ['article', 'blog'])->comment('类型:article=文章,blog=博客');
            $table->string('email', 255)->comment('邮箱');
            $table->string('name', 255)->comment('名称');
            $table->string('link', 255)->nullable()->comment('链接');
            $table->text('content')->nullable()->comment('评论内容');
            $table->boolean('is_admin')->default(0)->comment('来源:0=普通用户,1=管理员');
            $table->string('ip', 255)->nullable()->comment('IP');
            $table->boolean('status')->default(2)->comment('状态:0=违规,1=正常,2=审核中');
            $table->timestamps()->comment('更新时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
    }
}
