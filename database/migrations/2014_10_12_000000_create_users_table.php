<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('role_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('about_me')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'name' => 'admin',
            'email' => 'admin@softui.com',
            'role_id' => 1,
            'password' => Hash::make('secret'),
        ]);

        User::create([
            'name' => "Auditeur",
            'email' => "auditeur@gmail.com",
            'role_id' => 2,
            'password' => Hash::make('secret')
        ]);

        User::create([
            'name' => "Courier",
            'email' => "courier@gmail.com",
            'role_id' => 3,
            'password' =>Hash::make('secret')
        ]);
        User::create([
            'name' => "Department Head",
            'email' => "department@gmail.com",
            'role_id' => 4,
            'password' =>Hash::make('secret')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
