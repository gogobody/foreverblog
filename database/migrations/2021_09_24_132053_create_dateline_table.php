<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatelineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dateline', function (Blueprint $table) {
            $table->integer('id', true)->comment('ID');
            $table->integer('blog_id')->default(0)->comment('博客ID');
            $table->timestamp('date')->nullable()->comment('时间');
            $table->text('content')->nullable()->comment('内容');
            $table->boolean('status')->nullable()->default(1)->comment('状态,0=审核中,1=审核通过,2=审核不通过');
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
        Schema::dropIfExists('dateline');
    }
}
