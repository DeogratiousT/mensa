@extends('layouts.app')

@section('sections')
    <section>
        <div class="px-4 py-2 my-5 text-center">
            <h1 class="display-5 fw-bold">Edit {{ $category->name }}</h1>
        </div>            
    </section>

    <section>
        <div class="container col-lg-6 col-md-6 col-sm-6">
            <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
    
                <div class="form-group mt-4">
                    <label for="name">Name</label>
                    <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" id="name" name="name" value="{{ $category->name }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                </div>

                <div class="form-group mt-4">
                    <label for="cover_image">Cover Image</label>
                    <img src="{{ asset('assets/categories/cover_images') . '/' . $category->cover_image }}" alt="" style="height: 35px; width:35px">
                    <input class="form-control {{ $errors->has('cover_image') ? ' is-invalid' : '' }}" type="file" id="cover_image" name="cover_image" value="{{ asset('assets/categories/cover_images') . '/' . $category->cover_image }}">
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