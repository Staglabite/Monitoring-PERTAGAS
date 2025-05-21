<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('branch');
            $table->timestamps();
            
            $table->unique(['user_id', 'branch']);
        });

        // Migrate existing branch data
        $users = DB::table('users')->whereNotNull('branch')->get();
        foreach ($users as $user) {
            DB::table('user_branches')->insert([
                'user_id' => $user->id,
                'branch' => $user->branch,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('branch');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('branch')->nullable()->after('role');
        });

        // Restore the first branch for each user
        $userBranches = DB::table('user_branches')
            ->select('user_id', 'branch')
            ->groupBy('user_id')
            ->get();

        foreach ($userBranches as $userBranch) {
            DB::table('users')
                ->where('id', $userBranch->user_id)
                ->update(['branch' => $userBranch->branch]);
        }

        Schema::dropIfExists('user_branches');
    }
}; 