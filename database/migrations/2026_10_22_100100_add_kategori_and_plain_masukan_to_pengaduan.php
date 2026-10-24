<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->foreignId('kategori_id')->nullable()->after('id')
                ->constrained('kategori')->nullOnDelete();
        });

        // Data lama berisi HTML dari CKEditor -> ubah jadi teks polos
        DB::table('pengaduan')->orderBy('id')->each(function ($row) {
            $text = preg_replace('~</(p|li|h[1-6]|tr|div|blockquote)>|<br\s*/?>~i', "\n", (string) $row->masukan);
            $text = html_entity_decode(strip_tags($text), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $text = trim(preg_replace("/\n{3,}/", "\n\n", preg_replace('/[ \t]+/u', ' ', $text)));

            DB::table('pengaduan')->where('id', $row->id)->update(['masukan' => $text]);
        });
    }

    public function down(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->dropConstrainedForeignId('kategori_id');
        });
    }
};