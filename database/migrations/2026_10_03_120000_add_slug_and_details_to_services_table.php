<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
            $table->longText('details')->nullable()->after('description');
        });

        $used = [];
        foreach (DB::table('services')->orderBy('id')->get(['id', 'title']) as $row) {
            $base = Str::slug($row->title) ?: 'service';
            $slug = $base;
            $suffix = 2;
            while (in_array($slug, $used, true)) {
                $slug = $base.'-'.$suffix++;
            }
            $used[] = $slug;
            DB::table('services')->where('id', $row->id)->update(['slug' => $slug]);
        }

        Schema::table('services', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'details']);
        });
    }
};
