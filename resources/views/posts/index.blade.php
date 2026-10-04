<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Postingan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-300 dark:border-gray-700">
                            <th class="p-3">ID</th>
                            <th class="p-3">Judul Post</th>
                            <th class="p-3">Penulis (User ID)</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <td class="p-3">{{ $post->id }}</td>
                                <td class="p-3">{{ $post->title }}</td>
                                <td class="p-3">User #{{ $post->user_id }}</td>
                                <td class="p-3">
                                    {{-- Menampilkan tombol Edit HANYA jika User memiliki akses --}}
                                    @can('update', $post)
                                        <a href="{{ route('posts.edit', $post->id) }}" class="inline-block px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-sm font-semibold">
                                            Edit Post
                                        </a>
                                    @else
                                        <span class="inline-block px-3 py-1 bg-gray-500 text-white rounded text-sm">Tidak Ada Izin Edit</span>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-500">Belum ada postingan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>