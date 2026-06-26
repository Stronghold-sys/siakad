<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMahasiswaRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $mahasiswa = $this->route('mahasiswa');
        $mahasiswaId = $mahasiswa instanceof \App\Models\Mahasiswa ? $mahasiswa->id : $mahasiswa;

        return [
            'nim' => ['required', 'string', 'unique:mahasiswas,nim,' . $mahasiswaId],
            'nama' => ['required', 'string', 'min:3'],
            'jurusan_id' => ['required', 'exists:jurusans,id'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.min' => 'Nama minimal terdiri dari 3 karakter.',
            'jurusan_id.required' => 'Jurusan wajib dipilih.',
            'jurusan_id.exists' => 'Jurusan tidak valid.',
        ];
    }
}
