@extends('userdashboard')
@section('content')
    <div class="container">
        <h1>Welcome {{Auth::user()->first_name}}</h1>
        @foreach ($notifications as $item)
        <div class="card mb-3" style="max-width: 700px;">
            <div class="row g-0">
              <div class="col-md-8">
                  <div class="card-body">
                      <h5 class="card-title">{{$item->type}}</h5>
                      <p class="card-text">{{$item->data}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-body">
                        <form action="{{route('notifications.destroy',$item->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-primary">mark as read</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
