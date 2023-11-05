<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribed_user_notifies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subscriber_id');
            $table->unsignedBigInteger('website_id');
            $table->unsignedBigInteger('post_id');
            $table->enum('status', ['new', 'sent'])->default('new');
            $table->timestamps();
            $table->foreign('subscriber_id')->references('id')->on("users")->onDelete("cascade");
            $table->foreign('website_id')->references('id')->on("websites")->onDelete("cascade");
            $table->foreign('post_id')->references('id')->on("posts")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribed_user_notifies');
    }
};
