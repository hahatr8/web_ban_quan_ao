@include('client.layouts.header')




<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shopping Cart</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Name</th>
                        <th>Giá thường</th>
                        <th>Giá sale</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody class="align-middle">

                    @if (session()->has('cart'))
                    @foreach (session('cart') as $item)
                    <tr>
                        <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">
                            {{ $item['name'] }}</td>
                        <td class="align-middle">{{ $item['price_regular'] }}</td>
                        <td class="align-middle">{{ $item['price_sale'] }}</td>
                        <td class="align-middle">{{ $item['color']['name'] }}</td>
                        <td class="align-middle">{{ $item['size']['name'] }}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary text-center"
                                    value="{{ $item['quantity'] }}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                </tbody>

                
            </table>
        </div>

        <div class="col-md-4">
            <h2>Tổng tiền: {{ number_format($totalAmount) }}</h2>
            <form action="{{ route('client.order.save') }}" method="post">
                @csrf
                <div class="mt-3 mb-2">
                    <label
                        for="user_name"> {{ \Str::convertCase('user_name', MB_CASE_TITLE) }}</label>
                    <input type="text" name="user_name" id="user_name" value="{{ auth()->user()?->name }}">
                </div>
                <div class="mt-3 mb-2">
                    <label
                        for="user_email"> {{ \Str::convertCase('user_email', MB_CASE_TITLE) }}</label>
                    <input type="text" name="user_email" id="user_email" value="{{ auth()->user()?->emai }}">
                </div>
                <div class="mt-3 mb-2">
                    <label
                        for="user_phone"> {{ \Str::convertCase('user_phone', MB_CASE_TITLE) }}</label>
                    <input type="text" name="user_phone" id="user_phone">
                </div>
                <div class="mt-3 mb-2">
                    <label
                        for="user_address"> {{ \Str::convertCase('user_address', MB_CASE_TITLE) }}</label>
                    <input type="text" name="user_address" id="user_address">
                </div>
                <button class="btn btn-primary" type="submit">Đặt hàng</button>
            </form>
        </div>

    </div>
</div>

<!-- Cart End -->
@include('client.layouts.footer')
