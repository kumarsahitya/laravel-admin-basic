<?php

use App\Traits\Database;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    use Database\Migration;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $this->addCommonFields($table, true);
            $table->string('key')->unique();
            $table->string('display_name')->nullable();
            $table->json('value')->nullable();
            $table->boolean('locked')->default(false);
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
