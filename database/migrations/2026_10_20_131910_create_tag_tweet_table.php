<?php

use App\Models\Tag;
use App\Models\Tweet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tag_tweet', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Tag::class);
            $table->foreignIdFor(Tweet::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_tweet');
    }
};
