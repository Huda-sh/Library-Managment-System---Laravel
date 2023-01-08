@extends('admindashboard')
@section('content')
<div class="container">

<h1>Browse Books</h1>
<a href="{{route('books.create')}}" class="btn btn-primary">Create</a> <br><br>
<div class="col-2"></div>
<div class="col-8">
    <div class="row">
        <div class="col-6">
            <h5>Search By Category</h5>
            <select name="category_id" onchange="location = this.value;" class="form-select">
                <option value="">--</option>
                <option value="{{ route('books.booksByCategory', 0) }}">All</option>
                @foreach ($categories as $item)
                    <option value="{{ route('books.booksByCategory', $item->id) }}">{{ $item->name }}</option>
                @endforeach
            </select><br>
        </div>
        <div class="col-6">
            <form action="{{route('books.search')}}" method="GET">
                <h5>Search Book</h5>
                <div class="row">
                    <div class="col-8">
                        <input type="search" class="form-control" placeholder="enter book" name="search">
                    </div>
                    <div class="col-2">
                        <input type="submit" value="Search" class="btn btn-sm btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
<br><br>
<table class="table table-striped">
    <th>name</th>
    <th>author</th>
    <th>date</th>
    <th>price</th>
    <th>category</th>
    <th colspan="2">Actions</th>
    @foreach ($books as $item)
        <tr>
            <td>
                {{ $item->name }}
            </td>
            <td>
                {{ $item->author }}
            </td>
            <td>
                {{ $item->date }}
            </td>
            <td>
                {{ $item->price }}
            </td>
            <td>
                {{ $item->category->name}}
            </td>
            <td><a href="{{ route('books.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">Edit</a></td>
            <td>
                <form action="{{route('books.destroy',$item->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
    <div class="col-2"></div>
</div>

@endsection
