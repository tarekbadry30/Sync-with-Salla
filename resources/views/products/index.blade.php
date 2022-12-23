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
        <div class="col-md-6">    <h1>Sync with Salla task <br/> valinteca.com</h1>
        </div>
        <div class="col-md-6">
            <div class=" row justify-content-end">
                <a href="{{route('products.create')}}" class="btn btn-outline-success"> create </a>
                 <a href="{{route('products.pullNow')}}" class="btn btn-outline-primary"> pull now </a>
            </div>
        </div>
    </div>
    <table class="table table-bordered data-table">

        <thead>

        <tr>
            <th>#</th>

            <th>Name</th>

            <th>sku</th>
            <th>description</th>
            <th>main image</th>

            <th width="100px">Action</th>

        </tr>

        </thead>

        <tbody>

        </tbody>

    </table>

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

                {data: 'sku', name: 'sku'},

                {data: 'description', name: 'description'},
                {data: 'main_image', name: 'main_image',render:(data)=>{
                    return '<img class="img-fluid" width="200" src="'+data+'">';
                }},

                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]

        });



    });

</script>

</html>
