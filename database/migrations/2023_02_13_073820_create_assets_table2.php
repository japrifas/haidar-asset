<?php

use App\Models\Employee;
use App\Models\Manufacture;
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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('assetTag');
            $table->string('assetName');
            $table->string('status');
            $table->string('model');
            $table->foreignIdFor(Manufacture::class);
            $table->string('ram');
            $table->string('processor');
            $table->string('windows');
            $table->string('antivirus');
            $table->foreignIdFor(Employee::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
};
