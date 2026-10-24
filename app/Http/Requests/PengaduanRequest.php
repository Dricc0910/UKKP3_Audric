<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengaduanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nama'    => trim((string) $this->input('nama')),
            'masukan' => trim((string) $this->input('masukan')),
            'email'   => strtolower(trim((string) $this->input('email'))),
            'no_hp'   => preg_replace('/[\s\-().]/', '', (string) $this->input('no_hp')),
        ]);
    }

    public function rules(): array
    {
        return [
            'kategori_id'    => ['required', 'integer', 'exists:kategori,id'],
            'nama'           => ['required', 'string', 'max:100'],
            'email'          => ['required', 'email:rfc', 'max:150'],
            'no_hp'          => ['required', 'regex:/^(\+62|62|0)8[0-9]{8,12}$/'],
            'lampiran'       => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,pdf,doc,docx,xls,xlsx,zip', 'max:2048'],
            'hapus_lampiran' => ['nullable', 'boolean'],
            'masukan'        => ['required', 'string', 'max:5000'],
            'no_meja'        => ['required', 'integer', 'between:1,30'],
        ];
    }

    public function messages(): array
    {
        return [
            'required'           => ':attribute wajib diisi.',
            'kategori_id.exists' => 'Kategori tidak valid.',
            'masukan.max'        => 'Masukan maksimal :max karakter.',
            'max.string'         => ':attribute maksimal :max karakter.',
            'email.email'        => 'Format email belum benar.',
            'no_hp.regex'        => 'Nomor HP tidak valid. Contoh: 081234567890.',
            'lampiran.mimes'     => 'Format file harus JPG, PNG, WEBP, PDF, DOC, DOCX, XLS, XLSX, atau ZIP.',
            'lampiran.max'       => 'Ukuran file maksimal 2 MB.',
            'lampiran.uploaded'  => 'File gagal diunggah. Ukuran maksimal 2 MB.',
            'no_meja.between'    => 'No. meja/kursi harus antara 1 sampai 30.',
            'no_meja.integer'    => 'No. meja/kursi harus berupa angka.',
        ];
    }

    public function attributes(): array
    {
        return [
            'kategori_id' => 'Kategori',
            'nama'        => 'Nama',
            'email'       => 'Email',
            'no_hp'       => 'No. HP',
            'lampiran'    => 'Lampiran',
            'masukan'     => 'Masukan',
            'no_meja'     => 'No. meja/kursi',
        ];
    }
}