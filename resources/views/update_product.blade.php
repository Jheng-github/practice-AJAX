  <!-- Modal -->
  
  {{-- {{ dd(route('store.products')) }} --}}
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModal" aria-hidden="true">
      <form action="" method="POST" id="updateProductForm">
      @csrf
      <input type="hidden" id="up_id">
      <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="updateModalLabel">更新產品</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <div class="errMsgContainer mb-3">

              </div>

              <div class="form-group">
                  <label for="name">產品名字</label>
                  <input type="text" class="form-control" name="up_name" id="up_name" placeholder="產品名稱">
              </div>

              <div class="form-group mt-3">
                  <label for="price">產品價格</label>
                  <input type="text" class="form-control" name="up_price" id="up_price" placeholder="產品價格">
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
              <button type="button" class="btn btn-primary update_product">更新產品</button>
            </div>
          </div>
        </div>
  </form>
</div>

