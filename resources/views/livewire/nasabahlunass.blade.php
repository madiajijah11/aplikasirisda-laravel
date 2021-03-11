<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Nasabah Lunas
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="md:container md:mx-auto">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
                @endif
                <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah
                    Nasabah</button>
                @if ($isModal)
                @include('livewire.create-nasabahlunass')
                @endif
                <table class="table-fixed border-separate">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-6">Nama Lengkap</th>
                            <th class="px-4 py-6">Nomor HP</th>
                            <th class="px-4 py-6">Alamat</th>
                            <th class="px-4 py-6">Nomor Rekening</th>
                            <th class="px-4 py-6">Pinjaman</th>
                            <th class="px-4 py-6">Jangka Waktu</th>
                            <th class="px-4 py-6">Status</th>
                            <th class="px-4 py-6">Input Date</th>
                            <th class="px-4 py-6">Update Date</th>
                            <th class="px-4 py-6">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($nasabahlunass as $row)
                        <tr>
                            <td class="border px-2 py-2">{{ $row->nama }}</td>
                            <td class="border px-2 py-2">{{ $row->nohp }}</td>
                            <td class="border px-2 py-2">{{ $row->alamat }}</td>
                            <td class="border px-2 py-2">{{ $row->norekening }}</td>
                            <td class="border px-2 py-2">{{ $row->pinjaman }}</td>
                            <td class="border px-2 py-2">{{ $row->jangkawaktu }}</td>
                            <td class="border px-2 py-2">{{ $row->status }}</td>
                            <td class="border px-2 py-2">{{ $row->created_at }}</td>
                            <td class="border px-2 py-2">{{ $row->updated_at }}</td>
                            <td class="border px-2 py-2">
                                <button wire:click="edit({{ $row->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">Edit</button>
                                <button wire:click="delete({{ $row->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded" onclick="return confirm('Yakin ingin menghapus?') || event.stopImmediatePropagation()">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="9">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
