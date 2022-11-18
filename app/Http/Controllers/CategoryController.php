<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catergors=Category::orderBy('id','DESC')->get();
        return view('backend.category.index',compact('catergors'));
    }


    public function category_status(Request $request){
        // dd($request->all());
        if($request->mode=='true'){
            DB::table('categories')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('categories')->where('id',$request->id)->update(['status'=>'active']);
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
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //return $request->all();
        $request->validate([
            'title'=>'string|required',
            'summary'=>'string|nullable',
            'photo'=>'required',
            'is_parent'=>'required',
            'parent_id'=>'required',
            'status'=>'nullable|in:active,inactive',
        ]);
        $data=$request->all();
        $slug=Str::slug($request->input('title'));
        $slug_count= Category::where('slug',$slug)->count();
        if($slug_count>8){
            $slug = time().'-'.$slug;
        }
        $data['slug']=$slug;
        $status= Category::create($data);
        if($status){
            return redirect()->route('category.index')->with('success','Successfully created Category');
        }
        else{
            return back()->with('error','Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::find($id);
        if($category){
            return view('backend.category.edit',compact('category'));
        }else{
            return back()->with('error','Data not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if($category){
            $request->validate([
                'title'=>'string|required',
                'description'=>'string|nullable',
                'photo'=>'required',
                'condition'=>'nullable|in:category,promo',
                'status'=>'nullable|in:active,inactive',
            ]);
            $data=$request->all();

            $status=$category->fill($data)->save();
            if($status){
                return redirect()->route('category.index')->with('success','Successfully update banner');
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
