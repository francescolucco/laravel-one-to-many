<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category(){
        return $this->belongsTo('App\Category');
    }

    protected $fillable =[
        'title',
        'description',
        'slug',
        'category_id'
    ];


    public static function generateSlug($title){
        
        // Creo la stringa
        $slug = Str::slug($title);

        // duplico lo slug creato
        $slug_base = $slug;
        
        // controllo se esistono post che hanno slug uguali al post "presente" che sto controllando
        $post_presente = Post::where('slug', $slug)->first();

        // Faccio un ciclo while che si attiverà se il controllo ha trovato doppioni. Se lo trova aggingia -1. Incrementa il contatore e rifà la ricerca
        $c=1;
        while($post_presente){
            $slug = $slug_base . '-' . $c;
            $c++;
            $post_presente = Post::where('slug', $slug)->first();
        }

        return $slug;
    }
}
