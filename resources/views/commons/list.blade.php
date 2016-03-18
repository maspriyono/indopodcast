@extends('app')

@section('content')

    @include('commons.panel-12-open', [
        'title' => (isset($title) ? $title . ' ' : '') . 'List'
    ])

      @if ((isset($isAddable) && $isAddable) || !isset($isAddable))
    	{!! link_to_action(
	    		$mainController . '@create',
	    		'Add New ' . $mainTitle,
	    		[],
	    		['class' => 'btn btn-primary']
	    	);
    	!!}
      @endif

      @include('commons.table', [
          'heads' => $dataHeader,
          'rows' => $data,
      ])

    @include('commons.panel-close')

@endsection
