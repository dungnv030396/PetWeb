{{--@extends('ProductManagementViews.productManagement')--}}
{{--@section('contentManager')--}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <!------ Include the above in your HEAD tag ---------->

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table id="data" class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>order date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $item)
                    <tr>
                        <td> {{ $item->id }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->amount }}</td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function () {
        $('#table').DataTable({
            "processing": true,
            "serverSide":true,
            "ajax": "{{ route('demo') }}",
            "columns":[
                {"data" : "id" },
                {"data" : "created_at" }
            ]
        });
    })
</script>
{{--@endsection--}}