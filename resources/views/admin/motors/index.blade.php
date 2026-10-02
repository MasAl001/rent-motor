<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Daftar Motor') }}
            </h2>
            <a href="{{ route('admin.motors.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
            <i class="fa-solid fa-plus mr-2 text-white"></i>
            Motor</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-success-error-message/>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="table-auto w-full !my-4" id="motors-table">
                        <thead class="">
                            <tr>
                                <th class="px-4 py-2 border border-black">ID</th>
                                <th class="px-4 py-2 border border-black">Nama Motor</th>
                                <th class="px-4 py-2 border border-black">Kategori</th>
                                <th class="px-4 py-2 border border-black">Plat Nomor</th>
                                <th class="px-4 py-2 border border-black">Harga Sewa</th>
                                <th class="px-4 py-2 border border-black">Status</th>
                                <th class="px-4 py-2 border border-black">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($motors as $motor)
                                <tr>
                                    <td class="border px-4 py-2 border-black">{{ $motor->id }}</td>
                                    <td class="border px-4 py-2 border-black">{{ $motor->merk }} {{ $motor->model }} {{ $motor->year }}</td>
                                    <td class="border px-4 py-2 border-black">{{ $motor->category->name }}</td>
                                    <td class="border px-4 py-2 border-black">{{ $motor->plate_number }}</td>
                                    <td class="border px-4 py-2 border-black">Rp {{ number_format($motor->rental_price, 0, ',', '.') }}</td>
                                    <td class="border px-4 py-2 border-black">
                                        <span @class([
                                            'text-xs px-2 py-1 rounded-full',
                                            'bg-green-100 text-green-700' => $motor->status === 'available',
                                            'bg-yellow-100 text-yellow-700' => $motor->status === 'rented',
                                            'bg-orange-100 text-orange-700' => $motor->status === 'maintenance',
                                            'bg-gray-100 text-gray-500' => $motor->status === 'inactive',
                                        ])>
                                            {{ $motor->status }}
                                        </span>
                                    </td>
                                    <td class="border px-4 py-2 flex flex-wrap gap-2 items-center border-black">
                                        <a href="{{ route('admin.motors.edit', $motor) }}" class="text-indigo-600 hover:underline">Edit</a>
                                        <form action="{{ route('admin.motors.destroy', $motor) }}" method="POST" class="inline" onsubmit="return confirm('Hapus motor ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-black-400 border border-black">Belum ada daftar motor.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $motors->links() }}
        </div>
    </div>
</x-app-layout>