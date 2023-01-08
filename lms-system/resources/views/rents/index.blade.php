@extends('admindashboard')
@section('content')
    <div class="container">
        <h1>Show Rents</h1>
        @if ($message = Session::get('success'))
            <div class="alert alert-info">
                {{ $message }}
            </div>
        @endif
        <div class="container">
            <a href="{{ route('rents.create') }}" class="btn btn-primary">Create</a>
            <a href="{{ route('users.usersWithMostRents') }}" class="btn btn-success">users With Most Rents</a><br><br>
            <div class="col-4">
                <label class="form-label">Choose user: </label>
                <select class="form-select" name="user_id" onchange="location = this.value;">
                    <option value="">--</option>
                    <option value="{{ route('rents.rentOfUser', 0) }}">All</option>
                    @foreach ($users as $item)
                        <option value="{{ route('rents.rentOfUser', $item->id) }}">{{ $item->first_name }}
                            {{ $item->last_name }}</option>
                    @endforeach
                </select><br>
            </div>
            <form class="form-inline" action="{{ route('rents.rentInRange') }}" method="get">
                <div class="row">
                    <div class=" col-4">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label">Start Date</label>
                            </div>
                            <div class="col-8">
                                <input class="form-control" type="date" name="s_date">
                                @if ($errors->has('s_date'))
                                    <span class="text-danger">The start date field is required.</span><br>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label">End Date</label>
                            </div>
                            <div class="col-8">
                                <input class="form-control" type="date" name="e_date">
                                @if ($errors->has('e_date'))
                                    <span class="text-danger">The end date field is required.</span><br>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <input type="submit" value="Submit" class="btn btn-success btn-sm">
                    </div>
                </div>
            </form>
            <br>
            <table border="2" class="table table-striped">
                <th>id</th>
                <th>first name</th>
                <th>last name</th>
                <th>book</th>
                <th>start date</th>
                <th>end date</th>
                <th>restore date</th>
                <th colspan="2">actions</th>
                @foreach ($rents as $item)
                    <tr>
                        <td>
                            {{ $item->id }}
                        </td>
                        <td>
                            {{ $item->user->first_name }}
                        </td>
                        <td>
                            {{ $item->user->last_name }}
                        </td>
                        <td>
                            {{ $item->book->name }}
                        </td>
                        <td>
                            {{ $item->start_date }}
                        </td>
                        <td>
                            {{ $item->end_date }}
                        </td>
                        <td>
                            {{ $item->restore_date }}
                        </td>
                        @if ($item->restore_date == null)
                            <td>
                                <form action="{{ route('rents.restore', $item->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Restore Book</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('notifications.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $item->user->id }}">
                                    <input type="hidden" name="book_id" value="{{ $item->book->id }}">
                                    <button type="submit" class="btn btn-success btn-sm">Notify</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
