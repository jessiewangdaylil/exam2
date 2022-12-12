<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//請完成下方所有方法的實作，並撰寫對應的路由，用 Postman 來進行測試
class ArticleController extends Controller
{
    /**
     * 回傳該表格的所有資料，以 sort 欄位從小到大排序
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('sort','asc')->get();
        return $articles;
    }

    /**
     * 儲存前端傳入的資料，成功後回傳儲存的內容
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = Article::create($request->all());
        return $article;
    }

    /**
     * 回傳指定的資料
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //$article = Article::where('id',$id)->first();
        //$article = Article::find($id);
        return $article;
    }

    /**
     * 更新指定的資料，成功後回傳更新後的內容
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $num = $article->update($request->only(['subject','content','sort','enabled_at','enabled','cgy_id']));
        return $num;
    }

    /**
     * 刪除指定的資料，成功後回傳 Success
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $num = $article->delete();
        return $num;
    }

    //查詢所有資料，只取 id , subject 以及 content 這三個欄位
    public function querySelect()
    {
        $articles = Article::select(['id','subject','content'])->get();
        return $articles;
    }

    //查詢 enabled_at 於 2022/12/13 00:00:00 之後，enabled 為 true 的資料，按照 created_at 從新到舊排序，回傳第一筆資料的 subject 欄位內容
    public function querySpecific()
    {
        $article = Article::where('enabled_at','>',Carbon::createFromFormat('Y/m/d m:i:s','2022/12/13 00:00:00'))->where('enabled',true)->orderBy('created_at','desc')->first();
        return $article->subject;
    }

    //查詢 enabled_at 於 2022/12/10 00:00:00 之後，enabled 為 true 的資料，按照 created_at 從新到舊排序，回傳第2~4筆資料
    public function queryPagination()
    {
        //$date = Carbon::createFromFormat('Y/m/d m:i:s','2022/12/10 00:00:00');
        //$articles = Article::where('enabled_at','>',$date)->where('enabled',true)->orderBy('created_at','desc')->skip(1)->take(3)->get();
        $articles = Article::where('enabled_at','>','2022-12-10 00:00:00')->where('enabled',true)->orderBy('created_at','desc')->skip(1)->take(3)->get();
        return $articles;
    }

    //查詢 enabled_at 介於 2022/12/10 00:00:00 和 2022/12/15 23:59:59 之間，sort 位於 $min 到 $max 之間的資料並回傳
    public function queryRange($min,$max)
    {
        $articles = Article::where('enabled_at','<','2022/12/15 23:59:59')->where('enabled_at','>','2022/12/10 00:00:00')->whereBetween('sort',[$min,$max])->get();
        return $articles;
    }

    //根據所傳入的分類id，取出該分類所有 enabled 為 true 的資料，依照 sort 從小到大排序，回傳符合的資料
    public function queryByCgy($cgy_id)
    {
        $articles = Article::where('cgy_id',$cgy_id)->where('enabled',true)->orderBy('sort','desc')->get();
        return $articles;
    }

    //試著使用 pluck() 來取得 id 為 key ， subject 為 value 的陣列
    public function queryPluck()
    {
        $data = Article::pluck('subject','id');
        return $data;
    }

    //計算所有 enabled 為 true 的資料筆數後回傳，利用查詢方法 count()
    public function enabledCount()
    {
        $num = Article::where('enabled',true)->count();
        return $num;
    }

    //取得指定分類的所有文章
    public function queryCgyRelation(Cgy $cgy)
    {

    }

    //取得原分類ID為$old_cgy_id的第一個文章，將之改為新分類ID $new_cgy_id
    public function changeCgy($old_cgy_id,$new_cgy_id)
    {

    }

    //取得指定文章的所屬分類
    public function getArticleCgy(Article $article)
    {

    }

    //取得原分類 id 為$old_cgy_id的所有文章，將之改為新分類ID $new_cgy_id
    public function changeAllCgy($old_cgy_id,$new_cgy_id){

    }

    //取得指定文章的所有標籤，連同該標籤建立的時間
    public function queryTags(Article $article){

    }

    //為指定的文章加入 id 為 tag_id 的標籤
    public function addTag(Article $article , $tag_id){

    }

    //為指定的文章移除 id 為 tag_id 的標籤
    public function removeTag(Article $article , $tag_id){

    }

    //將指定文章的標籤重新設定為 1 , 3 , 5 
    public function syncTag(Article $article){

    }

    //為指定的文章加入 id 為 tag_id 的標籤，並設定標籤顏色
    public function addTagWithColor(Article $article , $tag_id, $color){

    }

    //取得指定文章的所有標籤，連同該標籤建立的時間以及標籤顏色
    public function queryTagsWithColor(Article $article){

    }
}
