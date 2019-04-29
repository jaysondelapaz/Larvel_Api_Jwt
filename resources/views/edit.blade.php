<!DOCTYPE html>
<html>
<head>
	<title>API</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">


</head>
<body>
<div class="row">
	<div class="col-md-4 offset-md-4" style="margin-top:50px;border:1px solid #ccc;">
		<div class="page-header text-center"><h3>Edit {{-- {{$item->id}} --}} {{old('itemname',$item->itemname)}} item</h3> </div>
		<hr>
		<form class="form" method="post" action="{{route('Backend.update',[$item->id])}}">
			{{csrf_field()}}
			<div class="form-group">
				<label>ItemName</label>
				<input type="text" name="itemname" value="{{old('itemname',$item->itemname)}}" class="form-control"/>
			</div>

			<div class="form-group">
				<label>Price</label>
				<input type="number" name="price" value="{{old('price',$item->price)}}" class="form-control"/>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-info">update</button>
			</div>
		</form>
	</div>
</div>
</html>