<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\Category;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
class HomeController extends Controller
{
  public function __construct()
  {
   $this->middleware('guest')->except('logout');
 }
 public function index()
 {
   return view('frontend.index');
 }
 public function shop(Request $request)
 {
  $product=Product::with('images')->Paginate(12);
  if ($request->ajax()) {
   return view('frontend.products',['product' => $product])->render();
 }
 $view=Product::orderBy('view', 'desc')
 ->take(5)
 ->get();
 $category=Category::all()->toArray();
 return view('frontend.shop',compact('product','view','category'));
}

public function single($id)
{
  $comment=Comment::with('user')->where('product_id',$id)->get()->toArray();
  $view=Product::orderBy('view', 'desc')
  ->take(4)
  ->get();
  $single=Product::with('Images')->where('id',$id)->first()->toArray();
                      //dd($single);
                      //dd($single);
  return view('frontend.single',compact('view','single','comment'));
}
public function comment(CommentRequest $request)
{
  $comment = new Comment;
  $comment->content = $request->content;
  $comment->user_id=\Auth::user()->id;
  $comment->product_id= $request->id;
  $comment->save();
  $data=$comment=Comment::with('user')->where('product_id',$request->id)->get()->toArray();
  echo json_encode($data);
}
public function postSearch(Request $req)
{
  if (request()->cate) {
    $product=Product::where('category_id',request()->cate)->get()->toArray();
    // $product=Category::with('products')->where('parent_id',1)->get()->toArray();
    // dd($product);
    return view('frontend.search',compact('product')); 
  }elseif($query=$req->search){
   $query=$req->search;
   $product=Product::where('name', 'like', '%'.$query.'%')
   ->orWhere('price', 'like', '%'.$query.'%')
   ->orWhere('description', 'like', '%'.$query.'%')
   ->orWhere('view', 'like', '%'.$query.'%')
   ->orderBy('view', 'desc')->get();
   return view('frontend.search',compact('product'));
 }else{
  return view('frontend.search');
 }
 
}
public function contact()
{
  return view('frontend.contact');
}
public function about()
{
  return view('frontend.about');
}
}
