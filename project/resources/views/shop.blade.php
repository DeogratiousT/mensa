@extends('layouts.app')

@section('sections')
    <section>
        <div class="px-4 py-2 mt-5 mb-2 text-center">
            <h1 class="display-5 fw-bold">Shop with Us <span><i class="fa-regular fa-face-smile text-warning"></i></span></h1>
            <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Get quality products at the comfort of your homes</p>
            </div>
        </div>            
    </section>

    <section>
        <div class="container">
            <h6 class="lead">All Products</h6>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
                @forelse ($products as $product)
                    <div class="col">
                        <div class="card">
                        <img src="{{ asset('assets/products/cover_images') . '/' . $product->cover_image }}" class="card-img-top" alt="" style="width: 100%; height:200px">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('products.show', $product) }}" class="text-dark" style="text-decoration: none">{{ $product->name }}</a>
                            </h5>
                            <p>
                                KSH. {{ $product->price }}
                                @if ($product->rating == 1)
                                    <i class="fa-regular fa-star text-info"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                @elseif ($product->rating == 2)
                                    <i class="fa-regular fa-star text-info"></i>
                                    <i class="fa-regular fa-star text-info"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                @elseif ($product->rating == 3)
                                    <i class="fa-regular fa-star text-info"></i>
                                    <i class="fa-regular fa-star text-info"></i>
                                    <i class="fa-regular fa-star text-info"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                @elseif ($product->rating == 4)
                                    <i class="fa-regular fa-star text-info"></i>
                                    <i class="fa-regular fa-star text-info"></i>
                                    <i class="fa-regular fa-star text-info"></i>
                                    <i class="fa-regular fa-star text-info"></i>
                                    <i class="fa-regular fa-star"></i>
                                @elseif ($product->rating == 5)
                                    <i class="fa-regular fa-star text-info"></i>
                                    <i class="fa-regular fa-star text-info"></i>
                                    <i class="fa-regular fa-star text-info"></i>
                                    <i class="fa-regular fa-star text-info"></i>
                                    <i class="fa-regular fa-star text-info"></i>
                                @endif
                            </p>
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#add-to-cart">Add to Cart</button>
                        </div>
                        </div>
                    </div>
                @empty
                    <p>No Records</p>
                @endforelse
            </div>
        </div>

        <div class="m-4 text-center">
            {{ $products->links() }}
        </div>

        <!-- Modal -->
        <div id="add-to-cart" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-success">
                    <div class="modal-body p-4">
                        <div class="text-light text-center">
                            <i class="dripicons-checkmark h1"></i>
                            <h4 class="mt-2">Tada!</h4>
                            <p class="mt-3">Added to Cart</p>
                            <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </section>
@endsection