@extends('admin.dashboard')

@section('title')
    Cap nhat san pham: {{ $model->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Cập nhật Danh mục: {{ $model->name }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    @if ($errors->any() || session('error'))
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        @if ($errors->any())
                            <div class="alert alert-danger" style="width: 100%;">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" style="width: 100%;">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.categories.update', $model->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div>
                                        <label for="" class="form-label">Name:</label>
                                        <input type="text" class="form-control" id="name"
                                            value="{{ $model->name }}" name="name">
                                    </div>

                                    <div class="mt-3">
                                        <label for="" class="form-label">FILE:</label>
                                        <input type="file" class="form-control" id="cover" name="cover">
                                        <img src="{{ \Storage::url($model->cover) }}" width="50px" alt="">
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="row">

                                            <div class="col-md-2">
                                                <div class="form-check form-switch form-switch-info">
                                                    <label for="" class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" value="1"
                                                            @if ($model->is_active) checked @endif name="is_active" id="is_active"> Is
                                                        active
                                                    </label>
                                                </div>
                                            </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--end col-->
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button type="button" class="btn btn-info m-3"><a href="{{route('admin.categories.index')}}">Q/L Trang chủ</a></button>
                    </div><!-- end card header -->
                </div>
            </div>
            <!--end col-->
        </div>
    </form>
@endsection

@section('script-libs')
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('content');

        function addImageGallery() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
                <div class="col-md-4" id="${id}_item">
                    <label for="${id}" class="form-label">Image</label>
                    <div class="d-flex">
                        <input type="file" class="form-control" name="product_galleries[]" id="${id}">
                        <button type="button" class="btn btn-danger" onclick="removeImageGallery('${id}_item')">
                            <span class="bx bx-trash"></span>
                        </button>
                    </div>
                </div>
            `;

            $('#gallery_list').append(html);
        }

        function removeImageGallery(id, galleryID, imagePath) {
            if (confirm('Chắc chắn xóa không?')) {
                $('#' + id).remove();

                let html =
                    `<input type="hidden" class="form-control" name="delete_galleries[${galleryID}]" value="${imagePath}">`;
                $('#delete_galleries').append(html);
            }
        }
    </script>
@endsection
