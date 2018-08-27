@extends('main')

<title>Edit Travel Post</title>

@section('content')


  <div class="row">
    {{ method_field('PUT') }}
    {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}
    <div class="col-md-8">
      {{ Form::label('title', 'Title:') }}
      {{ Form::text('title', null, ["class" => 'form-control input-lg']) }}

<hr>

     {{ Form::label('slug', 'Slug:') }}
     {{ Form::text('slug', null, ['class' => 'form-control']) }}
<hr>
     {{ Form::label('body', "Your adventure:") }}
     {{ Form::textarea('body', null, ["class" => 'form-control']) }}
   </div>

   <div class="col-md-4">
    <div class="well">
     <dl class="dl-horizontal">
       <dt>Created At:</dt>
       <dd>{{ $post->created_at }}</dd>
     </dl>

     <dl class="dl-horizontal">
       <dt>Last Update:</dt>
       <dd>{{ $post->updated_at }}</dd>
     </dl>
<hr>

     <div class="row">
       <div class="col-sm-6">
         {!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
       </div>
       <div class="col-sm-6">
         {{ Form::submit('Save Changes', array('class' => 'btn btn-success btn-block')) }}

    </div>
   </div>
 </div>
</div>
  {!! Form::close() !!}
</div>



@stop
