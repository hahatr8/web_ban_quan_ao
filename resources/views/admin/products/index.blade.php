@extends('admin.dashboard')

@section('title')
    Danh sach san pham
@endsection


@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Datatables</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Danh sách</h5>

                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Thêm mới</a>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>img_thumbnail</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Category</th>
                                <th>Price regular</th>
                                <th>Price sale</th>
                                <th>Views</th>
                                <th>Is active</th>
                                <th>Is hot deal</th>
                                <th>Is good deal</th>
                                <th>Is new</th>
                                <th>Is show home</th>
                                <th>Tag</th>
                                <th>created_at</th>
                                <th>updated_at</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($data as $item)
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        @php
                                            $url = $item->img_thumbnail;

                                            if (!\Str::contains($url, 'http')) {
                                                $url = Storage::url($url);
                                            }
                                        @endphp

                                        <img src="{{ $url }}" width="100px" alt="">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->sku }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->price_regular }}</td>
                                    <td>{{ $item->price_sale }}</td>
                                    <td>{{ $item->views }}</td>
                                    <td>{!! $item->is_active ? '<span class="badge bg-primary">YES</span>' : '<span class="badge bg-danger">NO</span>' !!}</td>
                                    <td>{!! $item->is_hot_deal ? '<span class="badge bg-primary">YES</span>' : '<span class="badge bg-danger">NO</span>' !!}</td>
                                    <td>{!! $item->is_good_deal
                                        ? '<span class="badge bg-primary">YES</span>'
                                        : '<span class="badge bg-danger">NO</span>' !!}</td>
                                    <td>{!! $item->is_new ? '<span class="badge bg-primary">YES</span>' : '<span class="badge bg-danger">NO</span>' !!}</td>
                                    <td>{!! $item->is_show_home
                                        ? '<span class="badge bg-primary">YES</span>'
                                        : '<span class="badge bg-danger">NO</span>' !!}</td>
                                    <td>
                                        @foreach ($item->tags as $tag)
                                            <span class="badge bg-info">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.products.show', $item) }}" class="btn btn-info">Show</a>
                                        <a href="{{ route('admin.products.edit', $item) }}"
                                            class="btn btn-warning mt-2 mb-2">Edit</a>

                                        <form action="{{ route('admin.products.destroy', $item) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không')">Delete</button>
                                        </form>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection
