<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use App\Models\ArticleStatus;
use App\Models\UploadImage;
use App\Library\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PosterPagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Helper::forgetSessionArticleEdit();

        $articles = DB::table('articles')
            ->leftJoin('article_statuses', 'status', '=', 'article_statuses.status_id')
            ->where('author', '=', Auth::user()->id)
            ->orderBy('articles.updated_at', 'desc')
            ->limit(999)
            ->select('articles.*', 'article_statuses.status_name')
            ->get();

        $article_statuses = ArticleStatus::all();
        $count = $articles->count();

        return view('poster/my_posts', compact('articles', 'article_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $new_article = new Article;
        $new_article->title = $request->title;
        $new_article->content = $request->content;
        $new_article->author = Auth::user()->id;
        $new_article->status = $request->status_id;
        $new_article->featured_image_id = $request->image_id;
        $new_article->save();

        return redirect('/post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        var_dump($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        Helper::forgetSessionArticleEdit();

        return $this->editCommon($request, $id);
    }

    private function editCommon(Request $request, $id){

        $article = Article::findOrFail($id);

        // requestに画像名が存在する場合は、画像名から取得。edit()から飛んできた場合は、articleの画像IDから
        if (empty(request('image'))) {
            $image = UploadImage::where('id', '=', $article->featured_image_id)->first();
        }else{
            $image = UploadImage::where('name', '=', $request->image)->first();
        }

        return view('poster/article_edit', [
            'article' => $article,
            'statuses' => ArticleStatus::all(),
            'image' => $image,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $article->title = $request->title;
        $article->content = $request->content;
        $article->status = $request->status_id;
        $article->featured_image_id = $request->image_id;
        $article->save();
        return redirect('post/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect('post/');
    }


    public function newPost(Request $request)
    {
        Helper::forgetSessionArticleEdit();

        empty(request('image')) ? $req_image = '' : $req_image = request('image');

        $image = UploadImage::where('name', '=', $req_image)->first();

        $statuses = ArticleStatus::all();
        return view('poster/article_new_post', compact('statuses', 'image'));
    }

    public function continuePost(Request $request)
    {
        empty(request('image')) ? $image_name = '' : $image_name = request('image');

        $image = UploadImage::where('name', '=', $image_name)->first();

        $statuses = ArticleStatus::all();
        return view('poster/article_new_post', compact('statuses', 'image'));
    }

    public function continueEdit(Request $request, $id)
    {
        return $this->editCommon($request, $id);
    }
}
