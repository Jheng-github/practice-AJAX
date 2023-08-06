<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <title>AJAX CRUD</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2 class="my-5 text-center">test Ajax</h2>

                <a href="" class="btn btn-success my-3" data-bs-toggle="modal"
                    data-bs-target="#addModal">新增產品</a>
                    <input type="text" name="search" id="search" class="mb-3 form-control" placeholder="輸入商品名字....">
                <div class="table-data">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                {{-- <i class="las la-edit"></i> --}}
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr>
                                    <th>{{ $key + 1 }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <a href="#" class="btn btn-success update_product_form"
                                            data-bs-toggle="modal" {{-- 會去找相對應的id updateModal 的那個BS方法 --}} 
                                            data-bs-target="#updateModal"
                                            data-id={{ $product->id }} 
                                            data-name={{ $product->name }}
                                            data-price={{ $product->price }}>
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#"
                                           class="btn btn-danger delete_product"
                                           data-id={{ $product->id }}
                                           >
                                            <i class="las la-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
    </div>


    @include('product_js')
    @include('add_product')
    @include('update_product')

    {!! Toastr::message() !!}
</body>

</html>
