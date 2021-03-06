<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkgroupPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workgroup_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //post_author
            $table->unsignedBigInteger('stage_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('post_title')->nullable();
            $table->text('post_content')->nullable();
            $table->string('post_type')->nullable()->default('project');
            $table->string('post_url')->nullable();
            $table->string('location')->nullable();
            $table->tinyInteger('post_priority')->nullable()->default(0);
            $table->string('post_status')->nullable()->default('in-progress');
            $table->string('post_color')->nullable()->default('#9DCB5C');
            $table->bigInteger('tenant_id')->nullable();
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
        Schema::dropIfExists('workgroup_posts');
    }
}
