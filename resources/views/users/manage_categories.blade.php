@extends('app')

@section('content')
<div class="container main container-podcast-manage">
    
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">Manage Categories Preferences</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(sizeOf($models) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <td>Username</td>
                            <td>Email</td>
                            <td>Category</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                @foreach($models as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        @if (sizeOf($item->categories) > 0)
                        <td>
                            @foreach ($item->categories as $c)
                                {{ $c->name }} 
                            @endforeach
                        @else
                            <td>-
                        @endif
                            <a href="#" data-toggle="modal" data-target="#categories" data-id="{{ $item->id }}" class="choosing-category"><i class="fa fa-pencil"></i></a>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="#" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                <a href="#" class="btn btn-default"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </table>
            @endif
        </div>
    </div>
</div>

<!-- Modal -->
<div id="categories" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Choose A Category</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(array('role' => 'form', 'method' => 'post', 'action' => ['PodcastController@addCategory'])) !!}
        <div class="form-group">
            <div class="row"> 
                <div class="col-md-10">
                    {!! Form::text('new-category', '', ['placeholder' => 'New Category', 'class' => 'form-control']) !!}
                </div>
                <div class="col-md-2">
                    {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div> 
        {!! Form::close() !!}
        <table class="table">
            <thead>
                <th></th>
                <th>Name</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($categories as $k => $c)
                <tr>
                    <td>
                        <input type="checkbox" class="category-preference" data-id="{{ $c->id }}"/>
                    </td>
                    <td>{{ $c->name }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="#" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="btn btn-default"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="save">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@stop

@section('js-footer')
    <script>
    var item_id = -1;
    var categories = [];

    jQuery(document).ready(function($) {
        $('.feed-delete').on('click', function() {
            if (confirm('Are you sure you want to delete this feed?')) {
                var feedMachineName = $.trim($(this).attr('data-feed-machine-name'));
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "/podcast/delete",
                    data: {
                        'feedMachineName': feedMachineName,
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(result) {
                        if(result.status === 1)
                        {
                            location.reload(); // @todo add a response msg
                        }             
                    }
                });
            }
        });

        $('.category-preference').click(function() {
            if (this.checked) {
                categories.push($(this).attr('data-id'));
            } else {
                var index = categories.indexOf($(this).attr('data-id'));
                if (index > -1) {
                    categories.splice(index, 1);
                }
            }
        });

        $('#save').click(function() {
            category_id = $(this).attr('data-id');

            $.ajax({
                type: "POST",
                cache: false,
                url: "/podcast/assign_category",
                data: {
                    'data': {'item_id': item_id, 'category_id': category_id},
                    '_token': "{{ csrf_token() }}"
                },
                success: function(result) {
                    if(result.status === 1) {
                        console.log(result);
                        location.reload(); // @todo add a response msg
                    }
                }
            });
        });
    });
    </script>
@stop