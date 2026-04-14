<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            if (Schema::hasColumn('blog_posts', 'author_id')) {
                $table->dropForeign(['author_id']);
                $table->dropColumn('author_id');
            }
            // author column already exists from previous migration
        });
    }


    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('author')->after('slug')->nullable()->default(null);
            $table->dropColumn('author');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade')->after('slug');
        });
    }
};

