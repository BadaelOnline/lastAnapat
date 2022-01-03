<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{About,
    Asistent,
    Banner,
    Category,
    Cursos,
    EntidadesFormadoreas,
    Faq,
    General,
    Horario,
    Link,
    Operadores,
    Page,
    Partner,
    Pcategory,
    Portfolio,
    Post,
    Tag,
    Team,
    Testimonial,
    Service,
    Subscriber,
    Tipo_Maquina};
class FrontController extends Controller
{
    public function home()
    {
        $about = About::find(1);
        $banner = Banner::all();
        $general = General::find(1);
        $link = Link::orderBy('name','asc')->get();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $partner = Partner::orderBy('name','asc')->limit(8)->get();
        $pcategories = Pcategory::all();
        $portfolio = Portfolio::all();
        $service = Service::orderBy('title','asc')->get();
        return view ('front.home',compact('about','banner','general','link','lpost','partner','pcategories','portfolio','service'));
    }

    public function about()
    {
        $about = About::find(1);
        $faq = Faq::all();
        $general = General::find(1);
        $link = Link::orderBy('name','asc')->get();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $partner = Partner::orderBy('name','asc')->get();
        $team = Team::orderBy('id','asc')->get();
        return view ('front.about',compact('about','faq','general','link','lpost','partner','team'));
    }

    public function contact()
    {
        $about = About::find(1);
        $faq = Faq::all();
        $general = General::find(1);
        $link = Link::orderBy('name','asc')->get();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $partner = Partner::orderBy('name','asc')->get();
        $team = Team::orderBy('id','asc')->get();
        return view ('front.cotact',compact('about','faq','general','link','lpost','partner','team'));
    }

    public function entidades()
    {
        $about = About::find(1);
        $faq = Faq::all();
        $general = General::find(1);
        $link = Link::orderBy('name','asc')->get();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $partner = Partner::orderBy('name','asc')->get();
        $team = Team::orderBy('id','asc')->get();
        return view ('front.entidades_formadoreas',compact('about','faq','general','link','lpost','partner','team'));
    }

    public function testi()
    {
        $general = General::find(1);
        $link = Link::orderBy('name','asc')->get();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $testi = Testimonial::orderBy('name','asc')->paginate(6);
        return view ('front.testi',compact('general','link','lpost','testi'));
    }
    public function cursos()
    {
        $general = General::find(1);
        $cursos = Cursos::orderBy('id','desc')->where('publico_privado',1)->where('estado',1)->get();
        $entidades = EntidadesFormadoreas::orderBy('id','desc')->get();
        return view ('front.cursos',compact('general','cursos','entidades'));
    }

    public function curso($cursoo)
    {
        $general = General::find(1);
        $link = Link::orderBy('name','asc')->get();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
//        $service = Service::where('slug', $slug)->firstOrFail();
        $curso = Cursos::where('curso',$cursoo)->firstOrFail();
        $entidad = EntidadesFormadoreas::where('id',$curso->entidad)->firstOrFail();
        $tipo = Tipo_Maquina::orderBy('id','desc')->get();
        $horario = Horario::orderBy('id','desc')->where('curso',$curso->id)->get();
        $asistent = Asistent::orderBy('id','desc')->where('curso',$curso->id)->get();

        $operador = Operadores::orderBy('id','desc')->get();

        return view ('front.curso',compact('general','operador','asistent','horario','tipo','entidad','link','lpost','curso'));
    }

    public function entidades_formadoras()
    {
        $service = Service::orderBy('title','asc')->get();
        $general = General::find(1);
        $link = Link::orderBy('name','asc')->get();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $pcategories = Pcategory::all();
        $portfolio = Portfolio::all();
        $entidadesFormadores = EntidadesFormadoreas::orderBy('id','desc')->get();
        return view ('front.entidades_formadoras',compact('general','entidadesFormadores','service','link','lpost','pcategories','portfolio'));
    }

    public function entidade_formadora($slug)
    {
        $general = General::find(1);
        $link = Link::orderBy('name','asc')->get();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $entidadesFormadore = EntidadesFormadoreas::where('id', $slug)->firstOrFail();
        return view ('front.entidade_formadora',compact('general','link','lpost','entidadesFormadore'));
    }

    public function blog()
    {
        $categories = Category::all();
        $general = General::find(1);
        $link = Link::orderBy('name','asc')->get();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $posts = Post::where('status','=','PUBLISH')->orderBy('id','desc')->paginate(3);
        $recent = Post::orderBy('id','desc')->limit(5)->get();
        $tags = Tag::all();

        return view ('front.blog',compact('categories','general','link','lpost','posts','recent','tags'));
    }

    public function blogshow($slug)
    {
        $categories = Category::all();
        $general = General::find(1);
        $link = Link::orderBy('name','asc')->get();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $post = Post::where('slug', $slug)->firstOrFail();
        $old = $post->views;
        $new = $old + 1;
        $post->views = $new;
        $post->update();
        $recent = Post::orderBy('id','desc')->limit(5)->get();
        $tags = Tag::get();

        return view ('front.blogshow',compact('categories','general','link','lpost','post','recent','tags'));
    }

    public function category(Category $category)
    {
        $categories = Category::all();
        $general = General::find(1);
        $link = Link::orderBy('name','asc')->get();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $posts = $category->posts()->latest()->paginate(6);
        $recent = Post::orderBy('id','desc')->limit(5)->get();
        $tags = Tag::all();
        return view ('front.blog',compact('categories','general','link','lpost','posts','recent','tags'));
    }

    public function tag(Tag $tag)
    {
        $categories = Category::all();
        $general = General::find(1);
        $link = Link::orderBy('name','asc')->get();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $posts = $tag->posts()->latest()->paginate(12);
        $recent = Post::orderBy('id','desc')->limit(5)->get();
        $tags = Tag::all();
        return view ('front.blog',compact('categories','general','link','lpost','posts','recent','tags'));
    }

    public function search()
    {

        $query = request("query");

        $categories = Category::all();
        $general = General::find(1);
        $link = Link::orderBy('name','asc')->get();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $posts = Post::where("title","like","%$query%")->latest()->paginate(9);
        $recent = Post::orderBy('id','desc')->limit(5)->get();
        $tags = Tag::all();

        return view('front.blog',compact('categories','general','link','lpost','posts','query','recent','tags'));
    }

    public function page($slug)
    {
        $general = General::find(1);
        $link = Link::orderBy('name','asc')->get();
        $lpost = Post::where('status','=','PUBLISH')->orderBy('id','desc')->limit(5)->get();
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('front.page',compact('general','link','lpost','page'));
    }

    public function subscribe(Request $request)
    {
        \Validator::make($request->all(), [
            "email" => "required|unique:subscribers,email",
        ])->validate();

        $subs = new Subscriber();
        $subs->email = $request->email;
        if ( $subs->save()) {

            return redirect()->route('homepage')->with('success', 'You have successfully subscribed');

           } else {

            return redirect()->back();

           }
    }

}
