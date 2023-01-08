@extends('userdashboard')
@section('content')
    <div class="container">

        <h1>Cart</h1>
        <div class="col-2"></div>
        <div class="col-8">
            @if (count($cart_items)!=0)
            <form class="form-inline" action="{{ route('bills.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label class="form-label">Address:</label>
                    <input class="form-control" type="text" name="address">
                    @if ($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span><br>
                    @endif
                </div>
                <br>
                <input type="submit" value="Pay" class="btn btn-success">
            </form>
            <br>
            @endif
            <table class="table table-striped">
                <th>id</th>
                <th>name</th>
                <th>author</th>
                <th>date</th>
                <th>price</th>
                <th>category</th>
                <th>Actions</th>
                @foreach ($cart_items as $item)
                    <tr>
                        <td>
                            {{ $item->id }}
                        </td>
                        <td>
                            {{ $item->book->name }}
                        </td>
                        <td>
                            {{ $item->book->author }}
                        </td>
                        <td>
                            {{ $item->book->date }}
                        </td>
                        <td>
                            {{ $item->book->price }}
                        </td>
                        <td>
                            {{ $item->book->category->name }}
                        </td>
                        <td>
                            <form action="{{ route('cartItems.destroy', $item->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-2"></div>
    </div>
@endsection
