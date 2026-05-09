<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePeminjamanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'peminjam_id' => 'required|exists:peminjams,id',
        'ruang_id'    => 'required|exists:ruangs,id',
        'tgl_pakai'   => 'required|date|after_or_equal:today',
        'durasi_jam'  => 'required|integer|min:1',
        'keperluan'   => 'required|string|min:1',
        'peralatan_id'   => 'nullable|array',
        'jumlah_pinjam'  => 'nullable|array',
        'jumlah_pinjam.*' => 'integer|min:1',
    ];

    }
}
