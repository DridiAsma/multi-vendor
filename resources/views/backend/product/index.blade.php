@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth">
                                <i class="fa fa-arrow-left"></i></a>Products
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('product.create') }}"><i
                                    class="icon-plus"></i>Create Product</a>
                        </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Product</li>
                        </ul>
                        <p class="float-right">Total Products : {{ \App\Models\Product::count() }}</p>
                    </div>

                </div>
            </div>



            <div class="col-lg-12">
                @include('backend.layouts.notification')
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Products</strong> List</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Photo</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Size</th>
                                        <th>Conditions</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td><img src="{{ $item->photo }}" alt="brand image"
                                                    style="max-height: 90px; max-width: 120px">
                                            </td>
                                            <td>{{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->discount }}%</td>
                                            <td>{{ $item->size }}</td>

                                            <td>
                                                @if ($item->conditions == 'new')
                                                    <span class="badge badge-success">{{ $item->conditions }}</span>
                                                @elseif ($item->conditions == 'popular')
                                                    <span class="badge badge-warning">{{ $item->conditions }}</span>
                                                @else
                                                    <span class="badge badge-primary">{{ $item->conditions }}</span>
                                                @endif
                                            <td>
                                                <input type="checkbox" name="toogle" value="{{ $item->id }}"
                                                    data-toggle="switchbutton"
                                                    {{ $item->status == 'active' ? 'checked' : '' }} data-onlabel="active"
                                                    data-offlabel="inactive" data-size="sm" data-onstyle="success"
                                                    data-offstyle="danger">

                                            </td>
                                            <td>
                                                <a href="{{ route('product.edit', $item->id) }}" data-toggle="tooltip"
                                                    title="edit" class="float-left btn btn-sm btn-outline-wrning"
                                                    data-placement="bottom">
                                                    <i class="fas fa-edit"></i></a>

                                                <form class="float-left ml-1"
                                                    action="{{ route('product.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="" data-toggle="tooltip" title="delete"
                                                        data-id="{{ $item->id }}"
                                                        class="dltBtn btn btn-sm btn-outline-danger"
                                                        data-placement="bottom"><i class="fas fa-trash-alt"></i></a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection

@section('scripts')
    {{--  //notification delete  --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function(e) {
            var form = $(this).closest('form');
            var dataID = $(this).data('id');
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })


        });
    </script>

{{--  //button switch  --}}
    <script>
        $('input[name=toogle]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            $.ajax({
                url: "{{ route('product.status') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    mode: mode,
                    id: id,
                },
                success: function(response) {
                    if (response.status) {
                        alert(response.msg);
                    } else {
                        alert('Please try again!');
                    }
                }
            })
        });
    </script>
@endsection
