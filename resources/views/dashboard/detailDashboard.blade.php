@extends('layouts.dashboard')
@section('titleDashboard', 'Dashboard')

@section('contentDashboard')

<div class="m-10 ms-[20%] bordered">
    <div class="flex justify-center items-center border p-4">
        @if ($detail->image)
            <img src="{{ asset('storage/' . $detail->image) }}" alt="{{ $detail->category->name_category }}" class="max-w-full h-auto">
        @else
            <img src="https://picsum.photos/1200/400?random&category={{ urlencode($detail->category->name_category) }}" alt="{{ $detail->category->name_category }}" class="max-w-full h-auto">
        @endif
    </div>
    <div class="mb-5">
        <span>id post : {{ $detail->id }}</span>
    </div>
    <span>Author : {{ $detail->user->name }}</span>
    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Title : {{ $detail->title }}</p>
    <p class="text-lg font-semibold mb-5">{{ $detail->body }}</p>
    <p class="font-semibold">Category : {{ $detail->category->name_category }}</p>
    <p class="text-sm font-light">{{ $detail->created_at }}</p>

    <a href="{{ route('dashboard.index') }}">
        <button type="button" class="mt-10 text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Back</button>
    </a>
</div>

@endsection