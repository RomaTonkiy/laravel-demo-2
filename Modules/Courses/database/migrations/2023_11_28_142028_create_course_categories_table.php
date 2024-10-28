<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Courses\Models\CourseCategory;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(CourseCategory::TABLE, function (Blueprint $table) {
            $table->id();

            $table->json('name');
            $table->string('slug')->unique();
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->json('short_description')->nullable();
            $table->json('description')->nullable();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained(CourseCategory::TABLE, 'id');

            $table->integer('sort')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(CourseCategory::TABLE);
    }
};
