@extends('admindashboard')
@section('content')
<div class="container">
<h1>Edit Category</h1>
<div class="col-1"></div>
<div class="col-6">
<form action="{{route('categories.update',$category->id)}}" method="post">
    @method('PUT')
    @csrf
    <label class="form-lable">Name:</label><br><br>
    <input class="form-control" type="text" name="name" value="{{$category->name}}" placeholder="enter name">
    @if($errors->has('name'))
		<span class="text-danger">{{ $errors->first('name') }}</span><br>
	@endif
    <br>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>
<div class="col-2"></div>
</div>

@endsection

