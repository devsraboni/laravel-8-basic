<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="container">
        @if (session('success'))
            <p class="alert alert-success" >{{ session('success') }} </p>
        @endif
        <div class="row my-5">
            <div class="col-7">
                <div class="card-group">
                    @foreach ($galleries as $gallery)
                        <div class="col-md-4 mt-5">
                            <div class="card">
                                <img src="{{ asset($gallery->image) }}" alt="">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-4">
                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Upload Multiple Image</label>
                        <input type="file" name="gallery_image[]" class="@error('gallery') is-invalid @enderror" multiple>
                        @error('gallery')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
