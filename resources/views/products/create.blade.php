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

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container p-5">
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label class="form-label">Details</label>
                <textarea class="form-control" name="details" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input class="form-control" name="image" type="file">
            </div> 
            <button type="submit" class="btn btn-primary">Submit</button>           
        </form>
    </div>
@endsection 