<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            @if (session('success'))
                <p class="alert alert-success" >{{ session('success') }} </p>
            @endif
        </div>
        <div class="row my-5">
            <form action="{{ url('/brand/update/'.$brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">
                <div class="mb-3">
                    <label for="brand_name" class="form-label">Brand Name</label>
                    <input type="text" class="form-control @error('brand_name') is-invalid @enderror" id="brand_name" name="brand_name" value="{{ $brand->brand_name }}">
                    @error('brand_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="file" name="brand_image" class="@error('brand_name') is-invalid @enderror">
                    @error('brand_image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <hr>
                <img src="{{ asset($brand->brand_image) }}" style="width:250px;">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
</x-app-layout>
