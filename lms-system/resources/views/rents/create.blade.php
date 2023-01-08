@extends('admindashboard')
@section('content')
    <div class="container">
        <h1>Create New Rent</h1>
        <div class="col-1"></div>
        <div class="col-6">

            <form action="{{ route('rents.store') }}" method="post">
                @csrf
                <label class="form-lable">user: </label><br />
                <select class="form-control" name="user_id">
                    <option value="">--</option>
                    @foreach ($users as $item)
                        <option value="{{ $item->id }}">{{ $item->first_name }} {{ $item->last_name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('user_id'))
                    <span class="text-danger">{{ $errors->first('user_id') }}</span><br>
                @endif
                <br>
                <label class="form-lable">book: </label><br>
                <select class="form-control" name="book_id">
                    <option value="">--</option>
                    @foreach ($books as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('book_id'))
                    <span class="text-danger">{{ $errors->first('book_id') }}</span><br>
                @endif
                <br>
                <label class="form-lable">start date</label><br>
                <input class="form-control" type="date" name="start_date" placeholder="enter start date">
                @if ($errors->has('start_date'))
                    <span class="text-danger">{{ $errors->first('start_date') }}</span><br>
                @endif
                <br>
                <label class="form-lable">end date</label><br>
                <input class="form-control" type="date" name="end_date" placeholder="enter end date">
                @if ($errors->has('end_date'))
                    <span class="text-danger">{{ $errors->first('end_date') }}</span><br>
                @endif
                <br>
                <button type="submit" class="btn btn-primary">submit</button>
            </form>
        </div>
        <div class="col-2"></div>
    </div>
@endsection
