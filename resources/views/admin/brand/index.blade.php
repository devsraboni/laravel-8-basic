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
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Brand Name</th>
                        <th scope="col">Brand Image</th>
                        <th scope="col">Created</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                        <tr>
                            <td>{{ $brands->firstItem()+$loop->index }}</td>
                            <td>{{ $brand->brand_name }}</td>
                            <td><img style="width:50px;height:50px;border-radius:50%" src="{{ asset($brand->brand_image) }}" alt=""></td>
                            <td>
                                @if ($brand->created_at == NULL)
                                    <span class="text-danger"> No Date Set</span>
                                @else
                                    {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('/brand/edit/'.$brand->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ url('/brand/delete/'.$brand->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure?')">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $brands->links() }}
            </div>
            <div class="col-1"></div>
            <div class="col-4">
                <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="brand_name" class="form-label">Brand Name</label>
                        <input type="text" class="form-control @error('brand_name') is-invalid @enderror" id="brand_name" name="brand_name">
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <hr>
    </div>
</x-app-layout>
