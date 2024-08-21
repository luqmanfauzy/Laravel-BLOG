@extends('layouts.navbar')
@section('title', 'category')

@section('content')

    <div>
        <p class="text-3xl m-[20px] text-blue-600 font-bold">Category : {{ $nameCategory->name_category }}</p>

        <div class="container mx-auto px-[40px]">
            <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                <div class="flex flex-col pb-3">
                    @foreach ($postCategories as $post)
                        <a href="{{ route('detail', $post->slug) }}">
                            <dd class="text-3xl font-semibold my-5">{{ $post->title }}</dd>
                        </a>
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400 font-bold">author :
                            <a href="/author/{{ $post->user->id }}"> {{ $post->user->name }} </a>
                        </dt>
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">{{ $post->body }}</dt>
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Posted at : <span
                            class="text-purple-500 font-medium">{{ $post->created_at }} </span></dt>
                    @endforeach
                </div>
            </dl>
            
            <div class="mt-4">
                {{ $postCategories->links() }}
            </div>

            <a href="/">
                <button type="button" class="my-10 text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Back</button>
            </a>
        </div>

    </div>

@endsection
