@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Edits Banners</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Banners</li>
                            <li class="breadcrumb-item active">Edits</li>
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
                            <form action="{{ route('category.update',$category->id)}}" method="post">
                                @csrf
                                @method('patch')
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <label for="">Titre <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Titre" name="title"
                                                value="{{$category->title}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6 col-sm-12">
                                        <label>Condition <span class="text-danger">*</span></label>
                                        {{--  <select name="condition" class="form-control show-tick">
                                            <option value="">Condition</option>
                                            <option value="banner" {{$category->condition== 'category' ? 'selected' : ''}}>
                                                category
                                            </option>
                                            <option value="promo" {{$category->condition== 'promo' ? 'selected' : ''}}>
                                                Promo
                                            </option>
                                        </select>  --}}
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <label></label>
                                        <select name="status" class="form-control show-tick">
                                            <option value="">Status</option>
                                            <option value="active" {{$category->status== 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="inactive" {{$category->status== 'inactive' ? 'selected' : '' }}>
                                                InActive</option>
                                        </select>
                                    </div>
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
                                        <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$category->photo}}">
                                    </div>
                                    <div id="holder" style="margin-top:15px;max-height:100px;">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <label for="">Description<span class="text-danger">*</span></label>
                                    <div class="form-group mt-3">
                                        <textarea id="description" class="form-control no-resize" placeholder="Please...">{{$category->summary}}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>

    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
@endsection
