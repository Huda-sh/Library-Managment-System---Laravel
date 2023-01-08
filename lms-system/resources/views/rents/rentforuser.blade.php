@extends('userdashboard')
@section('content')
    <div class="container">
        <h1>Show Rents</h1>
        @if ($message = Session::get('success'))
            <div class="alert alert-info">
                {{ $message }}
            </div>
        @endif
        <div class="container">
            <a href="{{ route('rents.createrent') }}" class="btn btn-primary">Create</a><br><br>
            <form class="form-inline" action="{{ route('rents.rentInRangeForUser') }}" method="get">
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
                <th>book</th>
                <th>start date</th>
                <th>end date</th>
                <th>restore date</th>
                <th colspan="2">actions</th>
                @foreach ($rents as $item)
                    <tr>
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
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
