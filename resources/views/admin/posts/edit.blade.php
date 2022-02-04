@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <div class="col-12">
          <h1 class="text-center">MODIFICA IL POST</h1>
       </div>

       @if ($errors->any())
       <div class="alert alert-danger col-8">
          <ul>
             @foreach ($errors->all() as $error)
                <li  role="alert">
                 {{$error}}
                </li>
             @endforeach
          </ul>
       </div>
       @endif


      <div class="col-8">
         <form action="{{route('admin.posts.update', $post)}}" method="POST">
            @csrf
            @method('PUT') 

            <div class="mb-3">
               <label for="title" class="form-label">Titolo</label>
               <input type="text" class="form-control @error('title')
                  is-invalid
               @enderror" id="title" name="title" placeholder="Titolo" value="{{old('title', $post->title)}}">

               @error('title')
               <div id="validationServer05Feedback" class="invalid-feedback">
                  {{$error}}
                </div>
               @enderror
               
            </div>
            
            <div class="mb-3">
               <label for="description" class="form-label @error('description')
               is-invalid
            @enderror">Contenuto</label>
               <textarea class="form-control" id="description" name="description" rows="3">{{old('description', $post->description)}}</textarea>

               @error('description')
               <div id="validationServer05Feedback" class="invalid-feedback">
                  {{$error}}
                </div>
               @enderror
            </div>


            <div class="my-3">
               <label for="category" class="form-label">Seleziona una categoria:</label>
               <select name="category_id" id="category_id" class="form-control" >
                  <option>Selezionare una categoria</option>
                  @foreach ($categories as $category)
                     <option 
                        @if ($category->id == old('category_id', $post->category_id))
                        selected
                        @endif
                        value="{{$category->id}}" >    
                        {{$category->name}}</option>
                  @endforeach
               </select>
            </div>
            
            
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>

          </form>
      </div>


   </div>
</div>
@endsection

@section('title')
  Edit post
@endsection