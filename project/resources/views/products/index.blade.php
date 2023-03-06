@extends('layouts.app')

@section('sections')
    <section>
        <div class="px-4 py-2 my-5 text-center">
            <h1 class="display-5 fw-bold">All Products</h1>
            <a href="{{ route('products.create') }}" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i> Create Product</a>
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
                        <th>Category</th>
                        <th>Price</th>
                        <th>Rating</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <img src="{{ asset('assets/products/cover_images') . '/' .  $product->cover_image }}" style="height:35px; width:35px" alt="">
                            </td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->rating }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}" data-toggle="tooltip" data-placement="bottom" title="Edit Product" class="mr-2"><i class="fa-regular fa-pen-to-square"></i></a>

                                <a href="{{ route('products.destroy', $product) }}" data-toggle="tooltip" data-placement="bottom" title="Delete Product" onclick="event.preventDefault(); document.getElementById('delete-product-{{ $product->id }}').submit();"><i class="fa-regular fa-trash-can text-danger"></i></a>

                                <form id="delete-product-{{ $product->id }}" action="{{ route('products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No Products</td>
                        </tr>
                    @endforelse
                </tbody>
              </table>

              {{ $products->links() }} 

        </div>
    </section>
@endsection