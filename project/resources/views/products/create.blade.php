@extends('layouts.app')

@section('sections')
    <section>
        <div class="px-4 py-2 my-5 text-center">
            <h1 class="display-5 fw-bold">Create Products</h1>
        </div>            
    </section>

    <section>
        <div class="container col-lg-6 col-md-6 col-sm-6">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
    
                <div class="form-group mt-4">
                    <label for="name">Name</label>
                    <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" id="name" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                </div>

                <div class="form-group mt-4">
                    <label for="category_id">Category</label>
                    <select class="form-control {{ $errors->has('category_id') ? ' is-invalid' : '' }}" id="category_id" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('category_id') }}
                        </span>
                    @endif
                </div>

                <div class="form-group mt-4">
                    <label for="price">Price</label>
                    <input class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" type="number" id="price" name="price" value="{{ old('price') }}">
                    @if ($errors->has('price'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('price') }}
                        </span>
                    @endif
                </div>

                <div class="form-group mt-4">
                    <label for="rating">Rating</label>
                    <input class="form-control {{ $errors->has('rating') ? ' is-invalid' : '' }}" type="number" min="1" max="5" id="rating" name="rating" value="{{ old('rating') }}">
                    @if ($errors->has('rating'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('rating') }}
                        </span>
                    @endif
                </div>

                <div class="form-group mt-4">
                    <label for="cover_image">Cover Image</label>
                    <input class="form-control {{ $errors->has('cover_image') ? ' is-invalid' : '' }}" type="file" id="cover_image" name="cover_image" value="{{ old('cover_image') }}">
                    @if ($errors->has('cover_image'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('cover_image') }}
                        </span>
                    @endif
                </div>
    
                <div class="form-group mt-4 text-center">
                    <button class="btn btn-success btn-block" type="submit">
                        <i class="mdi mdi-content-save"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection