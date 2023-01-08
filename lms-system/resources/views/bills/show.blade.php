@extends('userdashboard')
@section('content')
    <div class="container">
        <h1>Bill</h1>
        <div class="col-2"></div>
    </div>
    <div class="container">
        <div class="col-8">
            <div class="row">
                <div class="col-6">
                    <div class="card border-primary ">
                        <h4 class="card-body"> Total : {{ $bill->total }}</h4>
                    </div><br>
                </div>
                <div class="col-6">
                    <div class="card border-primary">
                        <h4 class="card-body"> Date : {{ $bill->date }}</h4>
                    </div>
                </div>
            </div>
            <table class="table table-striped">
                <th>Book Name</th>
                <th>Price</th>
                @foreach ($bill->billItems as $item)
                    <tr>
                        <td>{{ $item->book->name }}</td>
                        <td>{{ $item->book->price }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-2"></div>
    </div>
@endsection
