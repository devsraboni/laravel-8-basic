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
                        <th scope="col">Category Name</th>
                        <th scope="col">User</th>
                        <th scope="col">Created</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $categories->firstItem()+$loop->index }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->user->name }}</td>
                            <td>
                                @if ($category->created_at == NULL)
                                    <span class="text-danger"> No Date Set</span>
                                @else
                                    {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ url('category/softdelete/'.$category->id) }}" class="btn btn-sm btn-danger">Delete</a>
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
        <hr>
        <div class="row my-5">
            <div class="col-7">
                <h1 class="text-danger">Trash List</h1>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">User</th>
                        <th scope="col">Created</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trashes as $trash)
                        <tr>
                            {{-- <td></td> --}}
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $trash->category_name }}</td>
                            <td>{{ $trash->user->name }}</td>
                            <td>
                                @if ($trash->created_at == NULL)
                                    <span class="text-danger"> No Date Set</span>
                                @else
                                    {{ Carbon\Carbon::parse($trash->created_at)->diffForHumans() }}
                                @endif
                            </td>
                            <td>
                                <a href="" class="btn btn-sm btn-warning">Delete Permanently</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $trashes->links() }}
            </div>
        </div>










    </div>
</x-app-layout>
