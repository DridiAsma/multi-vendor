<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands=Brand::orderBy('id','DESC')->get();
        return view('backend.brand.index',compact('brands'));
    }

    public function brand_status(Request $request){
        // dd($request->all());
        if($request->mode=='true'){
            DB::table('brands')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('brands')->where('id',$request->id)->update(['status'=>'active']);
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
        return view('backend.brand.create');
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

            'photo'=>'required',

            'status'=>'nullable|in:active,inactive',
        ]);
        $data=$request->all();
        $slug=Str::slug($request->input('title'));
        $slug_count=Brand::where('slug',$slug)->count();
        if($slug_count>8){
            $slug = time().'-'.$slug;
        }
        $data['slug']=$slug;
        $status=Brand::create($data);
        if($status){
            return redirect()->route('brand.index')->with('success','Successfully created brand');
        }
        else{
            return back()->with('error','Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand=Brand::find($id);
        if($brand){
            return view('backend.brand.edit',compact('brand'));
        }else{
            return back()->with('error','Data not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *

     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $brand=Brand::find($id);
        if($brand){
            $request->validate([
                'title'=>'string|required',
                'photo'=>'required',
                'status'=>'nullable|in:active,inactive',
            ]);
            $data=$request->all();

            $status=$brand->fill($data)->save();
            if($status){
                return redirect()->route('brand.index')->with('success','Successfully update brand');
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
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand=Brand::find($id);
        if($brand){
            $status=$brand->delete();
            if($status){
                return redirect()->route('brand.index')->with('success','brand successfully deleted');
            }
            else{
                return back()->with('error','Something went wrong!');
            }
        }else{
            return back()->with('error','Data not found');
        }
    }
}
