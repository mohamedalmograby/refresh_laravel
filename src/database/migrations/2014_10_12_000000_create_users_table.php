<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('role_id')->constrained();
            $table->rememberToken();
            $table->timestamps();
        });

        $this->createAdminUser();
        $this->createRegularUser();
    }

    private function createAdminUser()
    {
        $user = User::factory(1)->create()->first();
        $user->name = 'admin';
        $user->email = 'admin@laravel.com';
        $user->password = Hash::make('12345678');
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->role_id = 1;
        $user->save();
    }

    private function createRegularUser()
    {
        $user = User::factory(1)->create()->first();
        $user->name = 'customer';
        $user->email = 'customer@laravel.com';
        $user->password = Hash::make('12345678');
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->role_id = 2;
        $user->save();
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
