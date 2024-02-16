<?php

use App\Traits\Database;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use Database\Migration;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $this->addCommonFields($table, true);

            $table->string('first_name')->nullable();
            $table->string('last_name');
            $table->string('gender')->nullable()->default('male');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('phone_number', 20);
            $table->date('birth_date')->nullable();
            $table->string('avatar_type')->default('gravatar');
            $table->string('avatar_location')->nullable();
            $table->string('timezone')->nullable();
            $table->boolean('opt_in')->default(false);
            $table->tinyInteger('failed_login_attempts')->default(0);
            $table->timestamp('reset_password_date')->nullable();
            $table->string('reset_password_token')->nullable();
            $table->timestamp('reset_password_exipry_date')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->enum('locked', ['Yes', 'No'])->default('No');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamp('email_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
