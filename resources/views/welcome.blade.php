<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>API</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        
    </head>
    <body>
        
        <div class="row">
            <div class="col-md-3 offset-md-1" style="margin-top:50px;">
                <form class="form-group" action="{{route('Backend.store')}}" method="post" style="padding:20px;border:1px solid #ccc;">
                    {{csrf_field()}}
                    <div class="page-header text-center"><h1>Add item</h1></div>
                    <div class="form-group">
                        <label class="form-control-label">ItemName</label>
                        <input type="text" name="itemname" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Price</label>
                        <input type="number" name="price" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">save</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 offset-md-1" style="margin-top:50px;border:1px solid #ccc;">
                @if(session()->has('msg_success'))
                <div class="alert alert-success">
                    {{session()->get('msg_success')}}
                </div>
                @endif
                
                <div class="page-header text-center"><h3>Item List</h3></div>
                <table class="table table-stiped">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php $sum = 0; ?>
                        @foreach($items as $index=> $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->itemname}}</td>
                            <td>{{$item->price}}</td>
                            <td>
                                <button type="submit" class="btn"><a href="{{route('Backend.edit',[$item->id])}}"> Edit</a></button>
                                <button type="submit" class="btn"> <a href="{{route('Backend.deleteconfirm',[$item->id])}}"> Delete</button>
                                </td>
                            </tr>
                            <?php $sum +=($item->price); ?>

                            @endforeach
                        </tbody>
                        <tfoot>
                        <th></th>
                        <th></th>
                        <th>Total <?php echo $sum; ?></th>
                        <th></th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </body>
    </html>