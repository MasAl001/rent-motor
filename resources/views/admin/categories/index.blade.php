<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Kategori Motor') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'create_category')">
            <i class="fa-solid fa-plus mr-2 text-white"></i>
            Kategori</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-success-error-message/>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="table-auto w-full !my-4" id="categories-table">
                        <thead>
                            <tr>
                                {{-- <th class="px-4 py-2 border border-black">ID</th> --}}
                                <th class="px-4 py-2 border border-black">Nama</th>
                                <th class="px-4 py-2 border border-black">Slug</th>
                                <th class="px-4 py-2 border border-black">Jumlah Motor</th>
                                <th class="px-4 py-2 border border-black">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    {{-- <td class="border px-4 py-2 border-black">{{ $category->id }}</td> --}}
                                    <td class="border px-4 py-2 border-black">{{ $category->name }}</td>
                                    <td class="border px-4 py-2 border-black">{{ $category->slug }}</td>
                                    <td class="border px-4 py-2 border-black">{{ $category->motors_count }}</td>
                                    <td class="border px-4 py-2 flex flex-wrap gap-2 items-center border-black">
                                        <a href="#!" class="bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 text-white font-bold py-2 px-4"
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'edit_category{{ $category->id }}')">
                                        <i class="fas fa-edit text-white"></i></a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 border border-transparent rounded-md hover:bg-red-700 text-white font-bold py-2 px-4"><i class="fas fa-trash-alt text-white"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @push('scripts')
                                //Modal for editing a category
                                <x-modal name="edit_category{{ $category->id }}" max-width="xl" focusable>
                                    <form method="post" action="{{ route('admin.categories.update', $category->id) }}" class="p-6">
                                        @csrf
                                        @method('PUT')

                                        <h2 class="text-lg font-medium text-gray-900">
                                            {{ __('Edit Category') }}
                                        </h2>

                                        <div class="mt-6">
                                            <x-input-label for="name" value="{{ __('Category Name') }}" class="sr-only" />

                                            <x-text-input
                                                id="name"
                                                name="name"
                                                type="text"
                                                class="mt-1 block w-full"
                                                placeholder="{{ __('Category Name') }}"
                                                value="{{ old('name', $category->name) }}"
                                            />

                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>

                                        <div class="mt-6">
                                            <x-input-label for="description" value="{{ __('Description') }}" class="sr-only" />

                                            <x-text-input
                                                id="description"
                                                name="description"
                                                type="text"
                                                class="mt-1 block w-full"
                                                placeholder="{{ __('Description') }}"
                                                value="{{ old('description', $category->description) }}"
                                            />

                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </div>

                                        <div class="mt-6 flex justify-end">
                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                {{ __('Cancel') }}
                                            </x-secondary-button>

                                            <x-primary-button class="ms-3">
                                                {{ __('Update Category') }}
                                            </x-primary-button>
                                        </div>
                                    </form>
                                </x-modal>    
                                @endpush
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-black-400 border border-black">Belum ada kategori.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>

@push('scripts')
    // Modal for creating a new category
    <x-modal name="create_category" max-width="xl" focusable>
        <form method="post" action="{{ route('admin.categories.store') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Create New Category') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="name" value="{{ __('Category Name') }}" class="sr-only" />

                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="mt-1 block w-full"
                    placeholder="{{ __('Category Name') }}"
                    minlength="3"
                    maxlength="50"
                    value="{{ old('name') }}"
                    required
                />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="description" value="{{ __('Description') }}" class="sr-only" />

                <x-text-input
                    id="description"
                    name="description"
                    type="text"
                    class="mt-1 block w-full"
                    placeholder="{{ __('Description') }}"
                    value="{{ old('description') }}"
                />

                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Create Category') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
@endpush
</x-app-layout>