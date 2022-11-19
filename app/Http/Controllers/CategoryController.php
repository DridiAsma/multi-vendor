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
        $parent_cats=Category::where('is_parent',1)->orderBy('title','ASC')->get();
        return view('backend.category.create',compact('parent_cats'));
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
            'is_parent'=>'sometimes|in:1',
            'parent_id'=>'nullable',
            'status'=>'nullable|in:active,inactive',
        ]);
        $data=$request->all();
        $slug=Str::slug($request->input('title'));
        $slug_count= Category::where('slug',$slug)->count();
        if($slug_count>0){
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
        $parent_cats=Category::where('is_parent',1)->orderBy('title','ASC')->get();
        if($category){
            return view('backend.category.edit',compact('category', 'parent_cats'));
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
                'summary'=>'string|nullable',
                'photo'=>'required',
                'is_parent'=>'sometimes|in:1',
                'parent_id'=>'nullable|exists:category,id',
                'status'=>'required|in:active,inactive',
            ]);
            $data=$request->all();

            $status=$category->fill($data)->save();
            if($status){
                return redirect()->route('category.index')->with('success','Successfully update CATEGORY');
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
    public function destroy($id)
    {
        $category=Category::find($id);
        $child_cat_id=Category::where('parent_id',$id)->pluck('id');
        if($category){
            $status=$category->delete();
            if($status){
                if(count($child_cat_id)>0){
                    Category::shiftChild($child_cat_id);
                }

                return redirect()->route('category.index')->with('success','Category successfully deleted');
            }
            else{
                return back()->with('error','Something went wrong!');
            }
        }
        else{
            return back()->with('error','Data not found');
        }
    }

    public function getChildByParentID(Request $request, $id){
     $category=Category::find($request->id);
     if($category){
        $child_id=Category::getChildByParentID($request->id);
        if(count($child_id)<=0){
            return response()->json(['status'=>false, 'data'=>null,'msg'=>'']);
        }
        return response()->json(['status'=>true,'data'=>$child_id,'msg'=>'']);
    }
     else{
        return response()->json(['status'=>false,'data'=>null,'msg'=>'Category not found']);
     }
    }
}
