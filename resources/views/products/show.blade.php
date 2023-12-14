@extends('products.layout')

@section('content')
    <br>

    <div class="row">
        <div class="col align-self-start">
            <a class="btn btn-primary" 
                href="{{route('products.index')}}">
                All Products
            </a>
        </div>
    </div>

    <br>

    <div class="container p-5">

            <div class="mb-3">
                <h3>{{$product->name}}</h3>
            </div>
            <div class="mb-3">
                <h3>{{$product->details}}</h3>
            </div>
            <div class="mb-3">
                <img src="/images/{{$product->image}}" alt="" width='200px'>
            </div> 

    </div>
@endsection 