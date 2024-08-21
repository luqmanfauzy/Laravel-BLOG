@extends('layouts.dashboard')
@section('titleDashboard', 'Dashboard')

@section('contentDashboard')

<div class="pt-40">

<form class="max-w-md mx-auto" method="POST" action="{{ route('dashboard.store') }}" enctype="multipart/form-data">
    <p class="text-5xl">Create Post</p>
    @csrf
    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="title" id="title" value="{{ old('title') }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Title</label>
        @error('title') 
            <span class="text-red-600">{{ $message }}</span>
        @enderror
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="slug" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Slug</label>
        @error('slug')
            <span class="text-red-600">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
        <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
        @error('image')
            <span class="text-red-600">{{ $message }}</span>
        @enderror
        <img id="image_preview" class="mt-4 w-full h-auto" style="max-width: 100%; height: auto; display: none;">
    </div>
    <div class="my-4">
        <label for="categories_id" class="block text-gray-900">Category :</label>
        <select name="categories_id" id="categories_id" class="mt-2 p-2 w-full border border-gray-300 rounded-md" required>
            <option name="categories_id" value="" disabled selected>Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('categories_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name_category }}
                </option>
            @endforeach
        </select>
        @error('categories_id')
            <span class="text-red-600">{{ $message }}</span>
        @enderror
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="body" id="body" value="{{ old('body') }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="body" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Body</label>
        @error('body')
            <span class="text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
  </form>
  
</div>

<a href="{{ route('dashboard.index') }}"></a>

<script>
    //automated generate slug
    document.getElementById('title').addEventListener('input', function() {
        var title = this.value;
        var slug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        document.getElementById('slug').value = slug;
    });

    //preview image upload
    document.getElementById('file_input').addEventListener('change', function(event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image_preview').style.display = 'block';
                document.getElementById('image_preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection