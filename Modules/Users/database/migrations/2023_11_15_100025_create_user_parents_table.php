<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Users\Models\User;
use Modules\Users\Models\UserParent;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(UserParent::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(User::TABLE)->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(UserParent::TABLE);
    }
};
