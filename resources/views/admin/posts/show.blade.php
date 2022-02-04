@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <div class="col">
          <h1>{{$post->title}}</h1>
          <p>{{$post->description}}</p>
          <p>{{$post->slug}}</p>
          <a href="{{route('admin.posts.edit', $post)}}" type="button" class="btn btn-success">Edit</a>
          <a href="{{route('admin.posts.index')}}" type="button" class="btn btn-secondary">Back</a>
       </div>
   </div>
</div>
@endsection

@section('title')
  {{$post->title}}
@endsection