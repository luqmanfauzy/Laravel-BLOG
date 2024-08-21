@extends('layouts.dashboard')
@section('titleDashboard', 'Dashboard')

@section('contentDashboard')

    @if (session('success'))
        <div class="text-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            id="success-alert" role="alert">
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('success update'))
        <div class="text-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            id="success-alert" role="alert">
            <span class="font-medium">{{ session('success update') }}</span>
        </div>
    @endif

    <div class="p-4 sm:ml-64">
        <h2 class="text-4xl font-semibold m-10">My Posts</h2>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <a href="{{ route('dashboard.create') }}">
                <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create
                    new post
                </button>
            </a>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas['posts'] as $data)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $data->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $data->category->name_category }}
                            </td>
                            <td class="px-6 py-4 text-left">
                                <a href="{{ route('dashboard.show', $data->slug) }}"
                                    class="mr-3 text-xl font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <i class="fa-solid fa-circle-info"></i>
                                </a>
                                <a href="{{ route('dashboard.edit', $data->slug) }}"
                                    class="mr-3 text-xl font-medium text-yellow-400 dark:text-blue-500 hover:underline">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                
                                <a href="#" onclick="event.preventDefault(); confirmDelete();" class="mr-3 text-xl font-medium text-red-700 dark:text-blue-500 hover:underline">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                                
                                <form id="delete-post-form-{{ $data->slug }}" action="{{ route('dashboard.destroy', $data->slug) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        setTimeout(function() {
                var alert = document.getElementById('success-alert');
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 3000);

        function confirmDelete(slug) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-post-form-' + slug).submit();
                }
            });
        }
    </script>

@endsection
