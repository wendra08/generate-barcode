@extends('layouts.app')

@section('content')
    <div class="px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Daftar Barcode</h1>
            <a href="{{ route('barcodes.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Barcode
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Form untuk Generate PDF -->
            <form id="generateForm" action="{{ route('barcodes.generate-pdf') }}" method="POST">
                @csrf
                <div class="p-4 bg-gray-50 border-b flex justify-between items-center">
                    <div>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="selectAll" class="form-checkbox h-5 w-5 text-blue-600 rounded">
                            <span class="ml-2 text-gray-700 font-medium">Pilih Semua</span>
                        </label>
                        <span id="selectedCount" class="ml-4 text-gray-600 font-semibold">0 dipilih</span>
                    </div>
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded disabled:opacity-50 disabled:cursor-not-allowed inline-flex items-center"
                        id="generateBtn" disabled>
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Generate & Download PDF
                    </button>
                </div>

                <div id="checkboxList"></div>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12">
                                Pilih
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kode Barcode
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Dibuat
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($barcodes as $barcode)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <input type="checkbox" name="barcode_ids[]" value="{{ $barcode->id }}"
                                        class="barcode-checkbox form-checkbox h-5 w-5 text-blue-600 rounded cursor-pointer">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $barcode->code }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">{{ $barcode->description ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                                    {{ $barcode->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $barcode->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $barcode->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('barcodes.edit', $barcode) }}"
                                        class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>

                                    <!-- Form DELETE terpisah -->
                                    <form action="{{ route('barcodes.destroy', $barcode) }}" method="POST"
                                        class="inline delete-form"
                                        onsubmit="return confirm('Yakin ingin menghapus barcode ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                        </path>
                                    </svg>
                                    <p class="mt-2 font-medium">Belum ada data barcode</p>
                                    <p class="text-sm">Klik tombol "Tambah Barcode" untuk menambahkan barcode baru</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($barcodes->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t">
                    {{ $barcodes->links() }}
                </div>
            @endif
        </div>

        <script>
            const selectAllCheckbox = document.getElementById('selectAll');
            const barcodeCheckboxes = document.querySelectorAll('.barcode-checkbox');
            const generateBtn = document.getElementById('generateBtn');
            const selectedCount = document.getElementById('selectedCount');
            const generateForm = document.getElementById('generateForm');
            const checkboxList = document.getElementById('checkboxList');

            function updateSelectedCount() {
                const checked = document.querySelectorAll('.barcode-checkbox:checked');
                const count = checked.length;

                selectedCount.textContent = `${count} dipilih`;
                generateBtn.disabled = count === 0;

                selectAllCheckbox.checked = count === barcodeCheckboxes.length && count > 0;
            }

            selectAllCheckbox.addEventListener('change', function () {
                barcodeCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateSelectedCount();
            });

            barcodeCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedCount);
            });

            // Prevent accidental form submits on delete forms
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') e.preventDefault();
                });
            });

            // Fix: Inject selected IDs as multiple hidden inputs before submitting
            generateForm.addEventListener('submit', function (e) {
                const selectedIds = Array.from(document.querySelectorAll('.barcode-checkbox:checked'))
                    .map(cb => cb.value);

                if (selectedIds.length === 0) {
                    e.preventDefault();
                    alert('Pilih minimal satu barcode sebelum generate PDF.');
                    return;
                }

                // Clear previous hidden inputs
                checkboxList.innerHTML = '';

                // Add hidden inputs for each selected ID
                selectedIds.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'barcode_ids[]';
                    input.value = id;
                    checkboxList.appendChild(input);
                });
            });

            // Initial update
            updateSelectedCount();
        </script>
@endsection
