@extends('layouts.navbar')
@section('title', 'detail')

@section('content')

    <p class="text-4xl m-7">Detail Post</p>

    <div class="m-10 ">
        <div class="flex justify-center items-center border p-4">
            @if ($posts->image)
                <img src="{{ asset('storage/' . $posts->image) }}" alt="{{ $posts->category->name_category }}" class="max-w-full h-auto">
            @else
                <img src="https://picsum.photos/1200/400?random&category={{ urlencode($posts->category->name_category) }}" alt="{{ $posts->category->name_category }}" class="max-w-full h-auto">
            @endif
        </div>
        <div class="mb-5">
            <span>id post : {{ $posts->id }}</span>
        </div>
        <span>Author : {{ $posts->user->name }}</span>
        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Title : {{ $posts->title }}</p>
        <p class="text-lg font-semibold mb-5">{{ $posts->body }}</p>
        <p class="font-semibold">Category : {{ $posts->category->name_category }}</p>
        <p class="text-sm font-light">{{ $posts->created_at }}</p>

        <a href="/">
            <button type="button" class="mt-10 text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Back</button>
        </a>
    </div>

@endsection
