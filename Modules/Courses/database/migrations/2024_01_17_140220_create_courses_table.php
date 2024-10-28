<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Courses\Models\CourseCategory;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_category_id')
                ->constrained(CourseCategory::TABLE);

            // region Morph relation
            $table->unsignedBigInteger('creator_id');
            $table->string('creator_type');
            // endregion


            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
