@extends('admindashboard')
@section('content')
    <div class="container">
<h1>Show users with most rents</h1>
<table border="2" class="table table-striped">
    <th>name</th>
    <th>address</th>
    <th>rents</th>
    @foreach ($users as $item)
        <tr>
            <td>
                {{ $item->first_name }} {{ $item->last_name }}
            </td>
            <td>
                {{ $item->address }}
            </td>
            <td>
                {{ $item->rents_count}}
            </td>
        </tr>
    @endforeach
</table>
</div>
@endsection
