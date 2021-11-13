<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('rating');
            $table->morphs('rateable');
            $table->index('rateable_id');
            $table->index('rateable_type');
            $table->foreignId('user_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('ratings', function (Blueprint $table) {
            $table->dropForeign('ratings_user_id_foreign');
        });
        Schema::dropIfExists('ratings');

    }
}
