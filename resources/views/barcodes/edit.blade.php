@extends('layouts.app')

@section('content')
<div class="px-4">
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('barcodes.index') }}" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Barcode</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('barcodes.update', $barcode) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="code" class="block text-gray-700 text-sm font-bold mb-2">
                        Kode Barcode <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="code" id="code"
                           value="{{ old('code', $barcode->code) }}"
                           class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('code') border-red-500 @enderror"
                           placeholder="Contoh: 1234567890" required>
                    @error('code')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-600 text-xs mt-1">Masukkan angka atau kode unik untuk barcode</p>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                        Deskripsi
                    </label>
                    <textarea name="description" id="description" rows="4"
                              class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Masukkan deskripsi produk atau keterangan (opsional)">{{ old('description', $barcode->description) }}</textarea>
                    <p class="text-gray-600 text-xs mt-1">Deskripsi akan muncul di bawah barcode pada PDF</p>
                </div>

                <div class="flex items-center justify-between pt-4 border-t">
                    <a href="{{ route('barcodes.index') }}"
                       class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </a>
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
