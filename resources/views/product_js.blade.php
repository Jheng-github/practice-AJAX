<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>

<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    $(document).ready(function() { //JQ 需要的起手式
        //<button type="button" class="btn btn-primary add_product">儲存</button>
        //前面有個. 任何後綴有add_product 就會去觸發
        $(document).on('click', '.add_product', function(e) {
            //preventDefault 可以阻止表單提交,或者連結觸發
            e.preventDefault();
            //.val 會去抓取你設置的元素名字 如 #name  就會去你有設定 id = name 的位置  因為是用 #  他對應的是id 這個位置
            //並且抓到輸入的值之後 把他放到 productName 跟 productPrice 兩個變數裡面
            let productName = $('#name').val();
            let productPrice = $('#price').val();
            // console.log(productName + productPrice);
            $.ajax({
                //設定你要打的哪一隻API
                url: "{{ route('store.products') }}",
                //POST方式
                method: 'POST',
                //文件格式
                dataType: 'json',
                //左邊的key 看起來是會把這個name 這個屬性發出request 到後端, 被validate 接住 ,意味著
                //user 輸入了一個產品名字 =>透過這個data => 後端用key(name)接住去驗證(驗證的值則是productName) => 驗證沒問題 
                data: {
                    name: productName,
                    price: productPrice

                },
                success: function(res) {
                    if (res.status == 'success') {
                        //一樣道理,會去接住id 是addModal 的區域,裡面內容是一張表單,也就是說,今天如果後端回傳success 就會跑這個if裡面 modal('hide') 就是把表單關閉
                        $('#addModal').modal('hide');
                        //這就是一個方法把這個表單重置,需要[0]選取第0個元素並重置
                        $('#addProductForm')[0].reset();
                        //選取.table 的class類 , 並且重新加載到當前的url(location.href) ,並且連結字符串 +  再把這裡面更新的內容重新放到 .table 這個class類裡面
                        // console.log(123);
                        $('.table').load(location.href + ' .table'); //.前面一定要有空格
                    }
                },
                error: function(err) {
                    //err 會是一大包, 去用err取得其中的responseJSON 這一包東西
                    let error = err.responseJSON;
                    // console.log(error);
                    //error底下還有一包errors , 所以用each(error.errors 迴圈會把它轉出來
                    //    error.errors 這一包結構類似這樣
                    //    errors:
                    //      name:
                    //          ['The name field is required.']
                    //      price:
                    //          ['The price field is required.']
                    //也就是說 index 跟 value 有點類似 key => value 也就是說  name : The name field is required
                    $.each(error.errors, function(index, vaZlue) {

                        //轉出來之後 去抓 <div class="errMsgContainer mb-3"> </div> 
                        //接著透過append 把內容附加上去
                        $('.errMsgContainer').append('<span class="text-danger">' +
                            value + '</span><br>');
                    });
                },
            });
        });

        //show 出 更新產品的時候的view
        $(document).on('click', '.update_product_form', function() {
            // data-id = {{ $product->id }}
            //在class裡面使用 data-id ...等
            //就可以在JQ裡面使用 以下方法得到該職值
            //我猜測應該是要使用當下的值才會跟上面值機用val取得不一樣
            let updateProductId = $(this).data('id');
            let updateProductName = $(this).data('name');
            let updateProductPrice = $(this).data('price');

            //點選更新的時候這樣就可以讀取到原本表單上該有的值了
            $('#up_id').val(updateProductId);
            $('#up_name').val(updateProductName);
            $('#up_price').val(updateProductPrice);
        })


        //更新表單
        $(document).on('click', '.update_product', function(e) {
            e.preventDefault();
            let updateProductId = $('#up_id').val();
            let updateProductName = $('#up_name').val();
            let updateProductPrice = $('#up_price').val();
            $.ajax({
                url: "{{ route('update.products') }}",
                //POST方式
                method: 'POST',
                //文件格式
                dataType: 'json',
                //左邊的key 看起來是會把這個name 這個屬性發出request 到後端, 被validate 接住
                data: {
                    id: updateProductId,
                    name: updateProductName,
                    price: updateProductPrice
                },
                success: function(res) {
                    if (res.status == 'success') {
                        //一樣道理,會去接住id 是addModal 的區域,裡面內容是一張表單,也就是說,今天如果後端回傳success 就會跑這個if裡面 modal('hide') 就是把表單關閉
                        $('#updateModal').modal('hide');
                        //這就是一個方法把這個表單重置,需要[0]選取第0個元素並重置
                        $('#updateProductForm')[0].reset();
                        //選取.table 的class類 , 並且重新加載到當前的url(location.href) ,並且連結字符串 +  再把這裡面更新的內容重新放到 .table 這個class類裡面
                        let x = $('.table').load(location.href + ' .table');
                    }
                },
                error: function(err) {

                    let error = err.responseJSON;

                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' +
                            value + '</span><br>');
                    });
                },
            });
        });

        //刪除表單
        $(document).on('click', '.delete_product', function(e) {
            e.preventDefault();
            let deleteProductId = $(this).data('id');

            if (confirm('你確定要刪除此筆資料嗎？')) {
                $.ajax({
                    url: "{{ route('delete.products') }}",
                    //POST方式
                    method: 'POST',
                    //文件格式
                    dataType: 'json',
                    //左邊的key 看起來是會把這個name 這個屬性發出request 到後端, 被validate 接住
                    data: {
                        id: deleteProductId,
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            //一樣道理,會去接住id 是addModal 的區域,裡面內容是一張表單,也就是說,今天如果後端回傳success 就會跑這個if裡面 modal('hide') 就是把表單關閉
                            // $('#updateModal').modal('hide');
                            //這就是一個方法把這個表單重置,需要[0]選取第0個元素並重置
                            // $('#updateProductForm')[0].reset();
                            //選取.table 的class類 , 並且重新加載到當前的url(location.href) ,並且連結字符串 +  再把這裡面更新的內容重新放到 .table 這個class類裡面
                            let x = $('.table').load(location.href + ' .table');
                        }
                    },
                    error: function(err) {

                        let error = err.responseJSON;

                        $.each(error.errors, function(index, value) {
                            $('.errMsgContainer').append(
                                '<span class="text-danger">' +
                                value + '</span><br>');
                        });
                    },
                });
            }
        });

        //用做搜尋,keyup 按鍵被鬆開時進行查詢
        $(document).on('keyup',function(e) {
            e.preventDefault();
            let searchString =  $('#search').val();
            console.log(searchString);
            $.ajax({
                url:"{{route('search-product')}}",
                method: "POST",
                data:{
                    search : searchString,
                },
                success :function(res){
                    $('.table-data').html(res);
                    if(res.status == 'nothing found'){
                        $('.table-data').html('<span class="text-danger">' + 'Nothing found' + '</span>');
                    }
                }
            });
        });
    });
</script>
