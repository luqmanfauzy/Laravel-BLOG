@extends('layouts.navbar')
@section('title', 'home')

@section('content')

    <div class="container mx-auto px-[40px]">
        <form class="mt-20" action="/">
            <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="search" name="search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search" value="{{ request('search') }}" required />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search
                </button>
            </div>
        </form>

        @if ($posts->isEmpty())
        <div class="m-10">
            <p class="text-center">Post Not Found ☹</p>
        </div>
        @else
            <p class="text-3xl m-10"> ini halaman home</p>

            <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">

                <div class="flex flex-col pb-3">
                    @foreach ($posts as $post)
                        <dd class="text-3xl font-semibold my-5">{{ $post->title }}</dd>
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">{{ $post->id }}</dt>
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">author : <span
                                class="text-purple-500 font-medium"><a
                                    href="/author/{{ $post->user->id }}">{{ $post->user->name }}</a> </span></dt>
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">category : <span
                                class="text-purple-500 font-medium"><a
                                    href="/category/{{ $post->category->id }}">{{ $post->category->name_category }}</a>
                            </span>
                        </dt>
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">{{ $post->excerpt }}
                            <a href="/detail/{{ $post->slug }}" class="text-blue-800">View more...</a>
                        </dt>
                    @endforeach
                    
                </div>

            </dl>
            <div class="mt-4 mb-7">
                {{ $posts->links() }}
            </div>

            @endif

    </div>
@endsection
