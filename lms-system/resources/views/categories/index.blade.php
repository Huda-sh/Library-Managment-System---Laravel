@extends('admindashboard')
@section('content')
<div class="container">

<h1>Show All Catergories</h1>
<a href="{{route('categories.create')}}" class="btn btn-primary">Create</a><br><br>
<div class="col-3"></div>
<div class="col-6">

<table class="table table-striped">
    <th>id</th>
    <th>name</th>
    <th colspan="2">Actions</th>
    @foreach ($categories as $item)
        <tr>
            <td>
                {{ $item->id }}
            </td>
            <td>
                {{ $item->name }}
            </td>
            <td><a href="{{ route('categories.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">Edit</a></td>
            <td>
                <form action="{{route('categories.destroy',$item->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
</div>
<div class="col-3"></div>
</div>

@endsection
