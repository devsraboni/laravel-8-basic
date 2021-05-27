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
        <div class="row mt-5">
            <div class="col-7">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">User</th>
                        <th scope="col">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $categories->firstItem()+$loop->index }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                @if ($category->created_at == NULL)
                                    <span class="text-danger"> No Date Set</span>
                                @else
                                    {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
            <div class="col-1"></div>
            <div class="col-4">
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>










    </div>
</x-app-layout>
