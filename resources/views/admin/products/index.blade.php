@extends('admin.main')

@section('body')

    @if (session('success'))
        <div class="bg-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="bg-danger">
            <ul>
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Quantitiy</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantitiy }}</td>
                    <td><img src="{{ asset("storage/$product->image") }}" width="100px"></td>
                    <td>
                        <form action="{{url("deleteProduct/$product->id")}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">delete</button>
                        </form>
                        <h1>
                            <a class="btn btn-success" href="{{url("editProduct/$product->id")}}" >edit</a>
                        </h1>
                    </td>
               
            
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection