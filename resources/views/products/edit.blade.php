<!DOCTYPE html>

<html>

<head>

    <title>Sync with Salla task</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

</head>

<body>



<div class="container">

    <div class="row pt-4">
        <div class="col-md-6">
            <h1>Sync with Salla task <br/> valinteca.com</h1>
            <h2>edit product</h2>
        </div>
        <div class="col-md-6">

        </div>
    </div>
    <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="hidden" name="product_id" value="{{$product->id}}" >
            <input type="text" class="form-control" id="name" name="name" value="{{old('name',$product->name)}}" >
            @if($errors->has('name'))
                <div class="error alert-danger p-2 m-1">{{ $errors->first('name') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="sku">SKU</label>
            <input type="text" class="form-control" id="sku" name="sku" value="{{old('sku',$product->sku)}}" >
            @if($errors->has('sku'))
                <div class="error alert-danger p-2 m-1">{{ $errors->first('sku') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="price">price</label>
            <input type="number" min="0" class="form-control" id="price" name="price" value="{{old('price',$product->price)}}"  >
            @if($errors->has('price'))
                <div class="error alert-danger p-2 m-1">{{ $errors->first('price') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="image">image</label>
            <input type="file" class="form-control" id="image" name="image" >
            @if($errors->has('image'))
                <div class="error alert-danger p-2 m-1">{{ $errors->first('image') }}</div>
            @endif
            <img src="{{$product->main_image}}" width="200" class="pt-2 img-fluid">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{old('description',$product->description)}}</textarea>
            @if($errors->has('description'))
                <div class="error alert-danger p-2 m-1">{{ $errors->first('description') }}</div>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-success">SAVE</button>
        </div>
    </form>
</div>



</body>



<script type="text/javascript">

    $(function () {



        var table = $('.data-table').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('products.listing') }}",

            columns: [

                {data: 'id', name: 'id'},

                {data: 'name', name: 'name'},

                {data: 'email', name: 'email'},

                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });



    });

</script>

</html>
