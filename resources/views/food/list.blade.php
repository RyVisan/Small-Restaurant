@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($categories as $category)
            <div class="col-md-12 mb-5">
                <h4 style="color: blue;">{{ $category->name }}</h4>
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($foods as $food)
                                @if ($food->category_id==$category->id)
                                    <div class="col-2 text-center mb-4">
                                        <img src="{{ $food->image ? asset('image/'.$food->image) : asset('image/browse-image.jpg') }}" width="100px" height="100px">
                                        <h6 class="name my-2">{{ $food->name }} <span class="price text-danger">${{ $food->price }}</span></h6>
                                        <a href="{{ route('food.view', $food->id) }}"><span class="btn btn-sm btn-outline-primary">View</span></a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
