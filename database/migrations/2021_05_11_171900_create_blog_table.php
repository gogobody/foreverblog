<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->integer('id', true)->comment('ID');
            $table->string('name', 255)->comment('名称');
            $table->string('link', 255)->comment('链接');
            $table->string('email', 255)->nullable()->comment('邮箱');
            $table->text('message')->comment('寄语');
            $table->boolean('status')->default(0)->comment('状态值:0=审核中,1=正常,2=未通过,3=疑似异常,4=异常');
            $table->boolean('is_comment')->default(1)->comment('是否允许评论,1=允许,0=不允许');
            $table->text('history')->nullable()->comment('博客历史事件');
            $table->integer('views')->nullable()->default(0)->comment('阅读量');
            $table->string('slug', 225)->nullable()->comment('Slug');
            $table->boolean('is_notify')->default(0)->comment('是否已发送审核结果通知，1=已发送，0=未发送');
            $table->integer('abnormal_num')->default(0)->comment('异常次数');
            $table->integer('abnormal_at')->nullable()->default(0)->comment('上次异常时间');
            $table->timestamp('adopted_at')->nullable()->comment('通过时间');
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
        Schema::dropIfExists('blog');
    }
}
