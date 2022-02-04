@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
         <h1>Elenco POST</h1>

         @if (session('deleted'))
            <div class="col-12 alert alert-danger" role="alert">
              {{session('deleted')}}
            </div>
         @endif

         <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Titolo</th>
                <th scope="col">Categoria</th>
                <th scope="col" colspan="3">Handle</th>
              </tr>
            </thead>
            <tbody>

               @foreach ($posts as $post)
               <tr>
                 <th scope="row">{{$post->id}}</th>
                 <td>{{$post->title}}</td>



                 @if ($post->category)
                    <td>{{$post->category->name}}</td>
                 @else
                    <td>-</td>
                 @endif



                 <td>
                  <a href="{{route('admin.posts.show', $post)}}" type="button" class="btn btn-primary">Show</a>
                 </td>
                 <td>
                  <a href="{{route('admin.posts.edit', $post)}}" type="button" class="btn btn-success">Edit</a>
                 </td>
                 <td>
                   <form action="{{route('admin.posts.destroy', $post)}}" method="POST">
                    @csrf
                    @method('DELETE')
                      <button type="submit" value="cancella" class="btn btn-danger">Edit</button>
                  </form>
                 </td>
               </tr>
               @endforeach
            </tbody>
          </table>
        <div>
          {{$posts->links()}}
        </div>
      </div>
      <div>
        <h2>HTML</h2>
        <ul>
          <li></li>
        </ul>
      </div>
</div>
@endsection

@section('title')
  Elenco post
@endsection
