<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('speaker_id')->nullable()->onDelete('set null');
            $table->foreignId('talk_id')->nullable()->onDelete('set null');
            $table->foreignId('chairman_id')->nullable()->onDelete('set null');
            $table->date('date');
            $table->time('time');
            $table->integer('song')->nullable();
            $table->boolean('exception')->default(false);
            $table->string('custom_talk')->nullable();
            $table->string('custom_speaker')->nullable();
            $table->boolean('thanked')->default(false);
            $table->string('comments')->nullable();
            $table->integer('grade')->nullable();
            $table->string('identifier')->nullable()->default(null);
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
        Schema::dropIfExists('bookings');
    }
}
