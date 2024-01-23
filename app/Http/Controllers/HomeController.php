<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Post;
use App\Models\Rubric;
use App\Models\Tag;
use Faker\Provider\Lorem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Home Page';
        $posts = Post::orderBy('id', 'desc')->get();
        return view('home', compact('title', 'posts'));
    }

    public function show()
    {
        $title = 'About Page';
        return view('about', compact('title'));
    }

    public function create()
    {
        $title = 'Create Page';
        $rubrics = Rubric::pluck('title', 'id')->all();
        return view('create', compact('title','rubrics'));
    }

    public function store(Request $request)
    {
        // dump($request->input('title'));
        // dump($request->input('content'));
        // dump($request->input('rubric_id'));
        // dd($request->all());

        $this->validate($request, 
        [
            'title' => 'required|min:5|max:100',
            'content' => 'required',
            'rubric_id' => 'required|integer',
        ],
        [
            'title.required' => 'Заполните поле название',
            'title.min:5' => 'Минимум 5 символов',
            'title.max:100' => 'Максимум 100 символов',
            'content.required' => 'Заполните поле контент',
            'rubric_id.required' => 'Заполните поле рубрика',
            'rubric_id.integer' => 'Поле является числом',
            
        ]
    );

        Post::create($request->all());
        return redirect()->route('home');
    }

}



        // $post = Post::find(1);
        // dump($post->title);
        // foreach ($post->tags as $tag) {
        //     dump($tag->title);
        // }

        // $tag = Tag::find(1);

        

        // $posts = Post::all();
        // foreach ($posts as $post) {
        //     dump($post->title, $post->rubric->title); 
        // }
        

       

        // Post::destroy(5);

        // $post = Post::find(3);
        // dump($post->title, $post->rubric->title);

        // $rubric = Rubric::find(2);
        // dump($rubric->title, $rubric->posts->title);

        // $post = Post::find(2);
        // dump($post->title, $post->rubric->title);

        // $rubrics = Rubric::find(2);

        // dump($rubrics->title);
        
        // foreach ($rubrics->posts as $post) {
        //     dump($post->title);
        // }

 

        // $post = new Post();
        // $post->title = 'Статья 1';
        // $post->content = 'Контент 1';
        // $post->save();
        //$data = Post::all();
        //$data = Post::limit(2)->get();

        // $data = Post::where('id','<', '3')->select('title')->get();
        // dd($data);

        // $data = City::all();
        // $data = City::limit(5)->get();
        // $data = City::find(2);
        // $data = Country::find('AGO');
        // dd($data);
        // Post::create(['title' => 'Пост 5', 'content' => 'Content 5']);
      
        
        // $query = DB::insert("INSERT INTO posts (title, content, created_at, updated_at)
        // VALUES (?,?,?,?)", ['Пост 4', 'Lorem', NOW(), NOW()]);

        // $query = DB::insert("INSERT INTO posts (title, content)
        // VALUES (?,?)", ['Пост 5', 'Lorem']);

        // DB::update("UPDATE posts SET created_at = ?, updated_at = ? WHERE created_at IS NULL OR updated_at IS NULL", [NOW(), NOW()]);

        // DB::delete("DELETE FROM posts WHERE id = ?", [5]);
        // $posts = DB::select("SELECT * FROM posts");
        // return $posts;
        // $res = 2 + 3;
        // $name = 'Name'; 
        // return view('home', compact('res', 'name'));

        //$data = DB::table('country')->get();
        //$data = DB::table('country')->limit(5)->get();
        // $data = DB::table('country')->select('Code','Name')->limit(5)->get();
        // $data = DB::table('country')->select('Code','Name')->first();
        // $data = DB::table('country')->select('Code','Name')->orderBy('Code', 'desc')->first();
        // $data = DB::table('city')->select('ID','Name')->find(2);
        // $data = DB::table('city')->select('ID','Name')->where([
        //     ['id', '>', 2],
        //     ['id', '<', 6],
        //     ])->get();
        // $data = DB::table('city')->where('id', '<', 5)->value('Name');
        // $data = DB::table('country')->limit(10)->pluck('Name', 'Code');
        // $data = DB::table('city')->select('CountryCode')->distinct()->get();

        // $data = DB::table('city')->select('city.ID', 'city.Name', 'country.Code', 'country.Name as countryname')->limit(10)
        //     ->join('country', 'city.CountryCode', '=', 'country.Code') -> get();

        // dd($data);
        // $datas = DB::table('country')->select('Code','Name')->limit(5)->get();
        // return view('home', compact('datas'));