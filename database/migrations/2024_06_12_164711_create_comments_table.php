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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('blog_post_id')->constrained()->onDelete('cascade');
            $table->timestamps(); // Add this for created_at/updated_at
            // $table->softDeletes(); // Add this for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
