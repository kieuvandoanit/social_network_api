<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reaction_posts', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained('posts');
            $table->foreignId('user_id')->constrained('users');
            $table->integer('reaction_type');
            $table->timestamps();
            $table->primary(array('post_id', 'user_id'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reaction_posts');
    }
};
