@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Add products</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Product</li>
                            <li class="breadcrumb-item active">Add</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <form action="{{ route('product.store') }}" method="post">
                                @csrf

                                    <div class="col-sm-12">
                                        <label>Titre <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Titre" name="title" value="{{ old('title') }}">
                                        </div>
                                    </div>

                                    <div class=" col-sm-12">
                                        <label></label>
                                        <select name="status" class="form-control show-tick">
                                            <option value="">Status</option>
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                InActive</option>
                                        </select>
                                    </div>


                                <div class="col-sm-12">
                                    <label>Image<span class="text-danger">*</span></label>

                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" type="text" name="photo">
                                    </div>
                                    <div id="holder" style="margin-top:15px;max-height:100px;">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="">Brands</label>
                                    <select name="condition" class="form-control show-tick">
                                        <option value=""> Brands </option>
                                        @foreach (\App\Models\Brand::get() as $brand)
                                            <option value="">{{$brand->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for=""> Categorys </label>
                                    <select id="cat_id" name="cat_id" class="form-control show-tick">
                                        @foreach (\App\Models\Category::where('is_parent',1)->get() as $cat)
                                           <option value="{{$cat->id}}">{{$cat->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 d-none" id="child_cat_div">
                                    <label for=""> Child Categorys </label>
                                    <select id="chil_cat_id" name="chil_cat_id" class="form-control show-tick">
                                        <option value="">Child Categories</option>

                                    </select>
                                </div>



                                <div class="col-sm-12">
                                    <label>Size</label>
                                    <select name="size" class="form-control show-tick">
                                        <option value="">Sizes</option>
                                        <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}> Small </option>
                                        <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}> Medium</option>
                                        <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}> Large </option>
                                        <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}> Extra Large </option>
                                    </select>
                                </div>


                                <div class="col-sm-12">
                                    <label>Condition</label>
                                    <select name="conditions" class="form-control show-tick">
                                        <option value="">Conditions</option>
                                        <option value="new" {{ old('conditions') == 'new' ? 'selected' : '' }}> New </option>
                                        <option value="popular" {{ old('conditions') == 'popular' ? 'selected' : '' }}> Popular</option>
                                        <option value="winter" {{ old('conditions') == 'winter' ? 'selected' : '' }}> Winter</option>
                                    </select>
                                </div>


                                <div class="col-sm-12">
                                    <label>Vendors</label>
                                    <select name="condition" class="form-control show-tick">
                                        <option value="">Vendors</option>
                                        @foreach (\App\Models\User::where('role','vendor')->get() as $vendor)
                                        <option value="{{$vendor->id}}"> {{$vendor->full_name}} </option>
                                        @endforeach

                                    </select>
                                </div>





                                <div class="col-sm-12">
                                    <label for="">Description<span class="text-danger">*</span></label>
                                    <div class="form-group mt-3">
                                        <textarea id="description" class="form-control no-resize" name="description" placeholder="Please type what you want...">{{ old('description') }}</textarea>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <label for="summary">Summary<span class="text-danger">*</span></label>
                                    <div class="form-group mt-3">
                                        <textarea id="summary" class="form-control no-resize" name="summary" placeholder="Please type what you want...">{{ old('summary') }}</textarea>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')

{{--  //image uplode  --}}
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
{{--  Textera Description  --}}
    <script>
        $(document).ready(function(){
            $('#description').summernote();

        });
    </script>
{{--  Textera Summary  --}}
    <script>
        $(document).ready(function(){
            $('#summary').summernote();
        });
    </script>
{{--  View liste Categories  --}}
    <script>
        $('#cat_id').change(function(){
            var cat_id=$(this).val();

            if(cat_id !=null){
                $.ajax({
                    url:"/admin/category/"+cat_id+"/child",
                    type:"POST",
                    data:{
                        _token:"{{csrf_token()}}",
                        cat_id:cat_id,
                    },
                    success:function(response){
                        var html_option="<option value=''> Child Category </option>";
                        if(response.status){
                            $('#child_cat_id').removeClass('d-none');
                            $.each(response.data,function(id,title){
                                html_option +="<option value='"+id+"'>"+title+"</option>"
                            });
                        }
                        else{
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#chil_cat_id').html(html_option);
                        console.log(response);
                    }
                })
            }
        })
    </script>


@endsection
