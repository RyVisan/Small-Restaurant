@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-3 mb-5">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <img src="{{ $food->image ? asset('image/'.$food->image) : asset('image/browse-image.jpg') }}" width="100%" height="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-5">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <h4 class="name my-2">Name</h4>
                            <h4 class="name my-2">Price</h4>
                            <h4 class="name my-2">Category</h4>
                            <h4 class="name my-2">Description</h4>
                        </div>
                        <div class="col-8">
                            <h4 class="name my-2">: {{ $food->name }}</h4>
                            <h4 class="name my-2">: ${{ $food->price }}</h4>
                            <h4 class="name my-2">: {{ $food->category->name }}</h4>
                            <h4 class="name my-2">: {{ $food->description }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
