<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products=Product::orderBy('id','DESC')->get();
        return view('backend.product.index',compact('products'));
    }

    public function productStatus(Request $request){
        // dd($request->all());
        if($request->mode=='true'){
            DB::table('products')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('products')->where('id',$request->id)->update(['status'=>'active']);
        }
        return response()->json(['msg'=>'Successfully update status','status'=>true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //return $request->all();
        $request->validate([
            'title'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'required',
            'condition'=>'nullable|in:banner,promo',
            'status'=>'nullable|in:active,inactive',
        ]);
        $data=$request->all();
        $slug=Str::slug($request->input('title'));
        $slug_count=Product::where('slug',$slug)->count();
        if($slug_count>8){
            $slug = time().'-'.$slug;
        }
        $data['slug']=$slug;
        $status=Product::create($data);
        if($status){
            return redirect()->route('banner.index')->with('success','Successfully created banner');
        }
        else{
            return back()->with('error','Something went wrong!');
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        if($product){
            return view('backend.product.edit',compact('product'));
        }else{
            return back()->with('error','Data not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBannerRequest  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if($product){
            $request->validate([
                'title'=>'string|required',
                'description'=>'string|nullable',
                'photo'=>'required',
                'condition'=>'nullable|in:product,promo',
                'status'=>'nullable|in:active,inactive',
            ]);
            $data=$request->all();

            $status=$product->fill($data)->save();
            if($status){
                return redirect()->route('product.index')->with('success','Successfully update product');
            }
            else{
                return back()->with('error','Something went wrong!');
            }
        }
        else{
            return back()->with('error','data not found');
        }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        if($product){
            $status=$product->delete();
            if($status){
                return redirect()->route('product.index')->with('success','product successfully deleted');
            }
            else{
                return back()->with('error','Something went wrong!');
            }
        }else{
            return back()->with('error','Data not found');
        }
    }
}
