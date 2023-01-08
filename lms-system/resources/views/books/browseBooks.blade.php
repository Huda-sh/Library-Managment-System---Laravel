@extends('userdashboard')
@section('content')
    <div class="container">
        <h1>Browse Books</h1><br>

        <div class="col-2"></div>

        <div class="col-8">
            @if ($message = Session::get('success'))
            <div class="alert alert-info">
                {{ $message }}
            </div>
            @endif
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
                    <form action="{{ route('books.search') }}" method="GET">
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
                <th>Actions</th>
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
                            {{ $item->category->name }}
                        </td>
                        <td>
                            <form action="{{ route('books.addToCart', $item->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Add To Cart</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-2"></div>
    </div>
@endsection
