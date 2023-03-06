@extends('layouts.app')

@section('sections')
    <section>
        <div class="px-4 py-2 my-5 text-center">
            <h1 class="display-5 fw-bold">All Categories</h1>
            <a href="{{ route('categories.create') }}" class="btn btn-outline-success"> <i class="fa-solid fa-plus"></i> Create Category</a>
        </div>            
    </section>

    <section>
        <div class="container col-lg-6 col-md-6 col-sm-6">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <img src="{{ asset('assets/categories/cover_images') . '/' .  $category->cover_image }}" style="height:35px; width:35px" alt="">
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $category) }}" data-toggle="tooltip" data-placement="bottom" title="Edit Category" class="mr-2"><i class="fa-regular fa-pen-to-square"></i></a>

                                <a href="{{ route('categories.destroy', $category) }}" data-toggle="tooltip" data-placement="bottom" title="Delete Category" onclick="event.preventDefault(); document.getElementById('delete-category-{{ $category->id }}').submit();"><i class="fa-regular fa-trash-can text-danger"></i></a>

                                <form id="delete-category-{{ $category->id }}" action="{{ route('categories.destroy', $category) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No Categories</td>
                        </tr>
                    @endforelse
                </tbody>
              </table>

              {{ $categories->links() }} 

        </div>
    </section>
@endsection