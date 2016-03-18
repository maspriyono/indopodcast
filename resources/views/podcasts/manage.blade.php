@extends('app')

@section('content')
<div class="x_panel container-podcast-manage">
  <div class="x_title">
    <h3>Available Podcast Feeds</h3>
  </div>
  <div class="x_content">
          <ul class="list-unstyled top_profiles scroll-view" tabindex="5001" style="overflow: hidden; outline: none; cursor: -webkit-grab;">
          @if(DB::table('podcasts')->where('user_id','=',Auth::user()->id)->count() > 0)
              @foreach(DB::table('podcasts')->where('user_id','=',Auth::user()->id)->get() as $cast)
                  <li class="media event">
                      <div class="podcast-container">
                          <div class="profile_pic" style="width: 100px;">
                            <img class="podcast-thumbnail img-circle profile_img"
                            src="{{asset($cast->feed_thumbnail_location)}}" />
                          </div>

                          <div class="media-body">
                            <span class="podcast-added-on">Added on {{ date('F d, Y', strtotime($cast->created_at)) }}</span>
                            <h4 class="podcast-title">{{$cast->name}}</h4>
                            <a target="_blank" href="{{$cast->web_url}}">
                            </a>
                            <br/>
                            <div class="podcast-action-list">
                                <ul class="list-inline">
                                    <li class='feed-delete btn btn-default' data-feed-machine-name="{{$cast->machine_name}}">
                                        <i class="fa fa-trash"></i>&nbsp;Delete
                                    </li>
                                </ul>
                            </div>
                          </div>
                      </div>
                  </li>
              @endforeach
          @endif
          </ul>
        </div>
      </div>

      <div class="x_panel container-fluid">
            <h4 class="section-title">Add a podcast feed</h4>
            {!! Form::model($podcast = new \App\Podcast, ['method' =>'POST','action' => ['PodcastController@add']]) !!}
                <div class="form-group">
                    {!! Form::text('feed_url', null,
                    ['class' => 'form-control','required','placeholder' => 'Enter a Podcast Feed Url here: http://example.com/feed']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Add Feed', ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
      </div>
@stop
@section('js-footer')
    <script>
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
    });
    </script>
@stop
