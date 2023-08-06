  <!-- Modal -->
  
  {{-- {{ dd(route('store.products')) }} --}}
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
      {{-- <form action={{ro ute('store.products')}} method="POST" id="addProductForm"> --}}
        <form action="" method="POST" id="addProductForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">新增產品</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <div class="errMsgContainer mb-3">

                </div>

                <div class="form-group">
                    <label for="name">產品名字</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="產品名稱">
                </div>

                <div class="form-group mt-3">
                    <label for="price">產品價格</label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="產品價格">
                </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                <button type="button" class="btn btn-primary add_product">儲存</button>
              </div>
            </div>
          </div>
    </form>
  </div>

  