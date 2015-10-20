@extends('app')

@section('content')
<div class="container main container-podcast-manage">
    
    <div class="row">
        <div class="col-md-3">
            <h3 class="page-title">Manage Podcast Feeds</h3>
        </div>
        
        <div class="col-md-9">
            {!! Form::model($podcast = new \App\Podcast, ['method' =>'POST','action' => ['PodcastController@add']]) !!}
                <div class="form-group">
                    <div class="col-md-10">
                        {!! Form::text('feed_url', null, 
                    ['class' => 'form-control','required','placeholder' => 'Enter a Podcast Feed Url here: http://example.com/feed']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::submit('Add Feed', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div> 
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(sizeOf($models) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <td>Title</td>
                            <td>URL</td>
                            <td>Category</td>
                            <td>Tags</td>
                        </tr>
                    </thead>
                @foreach($models as $cast)
                    <tr>
                        <td>{{ $cast->title }}</td>
                        <td>{{ $cast->url }}</td>
                        <td>
                            {{ $cast->category ? $cast->category->name : '-' }} 
                            <a href="#" data-toggle="modal" data-target="#categories" data-id="{{ $cast->id }}" class="choosing-category"><i class="fa fa-pencil"></i></a>
                        </td>
                        @if (sizeOf($cast->tags) > 0)
                        <td>
                            @foreach ($cast->tags as $tag)
                                {{ $tag }} 
                            @endforeach
                        @else
                            <td>-
                        @endif
                         <i class="fa fa-pencil"></i></td>
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
                <th>No.</th>
                <th>Name</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($categories as $k => $c)
                <tr>
                    <td>{{ $k + 1 }}</td>
                    <td>{{ $c->name }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="#" class="btn"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="btn"><i class="fa fa-trash"></i></a>
                            <a href="#" class="btn checking-category" data-id="{{ $c->id }}"><i class="fa fa-check"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@stop

@section('js-footer')
    <script>
    var item_id = -1;
    var category_id = -1;

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

        $('.choosing-category').click(function() {
            console.log('choosing-category');
            item_id = $(this).attr('data-id');
        });

        $('.checking-category').click(function() {
            console.log('checking-category');
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