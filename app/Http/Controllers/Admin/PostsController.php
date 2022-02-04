<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // prendo tutti i post e restituisco la struttura
        $posts = Post::orderBy('id', 'desc')->paginate(8);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dump($request);

        $request->validate(
            $this->validateData(),
            $this->validateErrors(),
        );

        // inizializzo una variabile a cui assegno i dati del form
        $data = $request->all();

        // inizializzo una nuova variabile con modello Post
        $new_post = new Post();
        $new_post->fill($data);
        $new_post->slug = Post::generateSlug($new_post->title);
        $new_post->save();

        return redirect()->route('admin.posts.show', $new_post);
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if($post)
        {
            return view('admin.posts.show', compact('post'));
        }
        abort(404, 'Post non trovato');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if($post){
            return view('admin.posts.edit', compact('post'));
        }
        abort(404, 'Pagina non trovata');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            $this->validateData(),
            $this->validateErrors(),
        );

        $data = $request->all();

        
        if($data['title'] !== $post->title){
            $data['slug'] = Post::generateSlug($data['title']);
        }

        $post->update($data);


        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', "Il post {$post->title} è stato eliminato");
    }

    private function validateData(){
        return [
            'title'=>'required|min:2|max:50',
            'description'=>'required|min:4',
        ];
    }

    private function validateErrors(){
        return
        [
            'title.required'=>'Il testo è un campo obbligatorio',
            'title.min'=>'Il titolo deve essere lungo almeno 2 caratteri',
            'title.max'=>'Il titolo può essere lungo massimo 50 caratteri',
            'description.required'=>'Il testo è un campo obbligatorio',
            'description.min'=>'La descrizione deve essere lunga  almeno 2 caratteri',
            'description.max'=>'La descrizione può essere lungoa massimo 50 caratteri',
        ];
    }
}
