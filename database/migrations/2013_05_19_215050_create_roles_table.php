<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('status')->default(1);
            $table->timestamps();
        });


        Role::create([
            'name' => 'Administrateur',
            'description' => 'role D\'Administrateur',
        ]);


        Role::create([
            'name' => 'Auditeur',
            'description' => 'role D\'Auditeur',
        ]);

        Role::create([
            'name' => 'Courier',
            'description' => 'role D\'Courier',
        ]);

        Role::create([
            'name' => 'Department Head',
            'description' => 'role Department Head',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
