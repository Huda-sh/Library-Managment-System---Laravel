@extends('admindashboard')
@section('content')
    <div class="container">
        <h1>Edit Books</h1>
        <div class="col-1"></div>
        <div class="col-6">
            <form action="{{ route('books.update', $book->id) }}" method="post">
                @method('PUT')
                @csrf
                <br><label class="form-lable">Name:</label><br>
                <input class="form-control" type="text" name="name" value="{{ $book->name }}" placeholder="enter name">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span><br>
                @endif
                <br><label class="form-lable">Author:</label><br>
                <input class="form-control" type="text" name="author" value="{{ $book->author }}"
                    placeholder="enter author">
                @if ($errors->has('author'))
                    <span class="text-danger">{{ $errors->first('author') }}</span><br>
                @endif
                <br><label class="form-lable">Date</label><br>
                <input class="form-control" type="date" name="date" value="{{ $book->date }}"
                    placeholder="enter date">
                @if ($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span><br>
                @endif
                <br><label class="form-lable">Price</label><br>
                <input class="form-control" type="number" name="price" value="{{ $book->price }}"
                    placeholder="enter price">
                @if ($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span><br>
                @endif
                <br><label class="form-lable">Category</label><br>
                <select class="form-control" name="category_id">
                    <option value="">--</option>
                    @foreach ($categories as $item)
                        @if ($book->category->id == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                    @endforeach
                </select>
                @if ($errors->has('category_id'))
                    <span class="text-danger">{{ $errors->first('category_id') }}</span><br>
                @endif
                <button type="submit" class="btn btn-primary">submit</button>
            </form>
        </div>
        <div class="col-2"></div>
    </div>
@endsection
