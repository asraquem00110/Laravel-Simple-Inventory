
  <!-- MODALS -->

  <div class="modal" tabindex="-1" role="dialog" id="AddModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>
          </div>

          <div class="modal-body">
              <form id="addform">
                    @csrf
                    <div class="form-group">
                      <label>NAME:</label>
                      <input type="text" class="form-control" name="client">
                      <p class="alert-danger errmsg" id="clienterr"></p>
                    </div>

                    <div class="form-group">
                      <label>ADDRESS:</label>
                      <input type="text" class="form-control" name="address">
                       <p class="alert-danger errmsg" id="adderr"></p>
                    </div>

                    <div class="form-group" style="display: none;">
                      <label>TIN:</label>
                      <input type="text" class="form-control" name="tin">
                       <p class="alert-danger errmsg" id="tinerr"></p>
                    </div>

                    <input type="hidden" name="type" value="0">
                    
        
                    <button type="button" id="savebtn" class="btn btn-warning float-right text-white"><span class="fa fa-plus"></span> CREATE</button>
                </form>
                

          </div>

      <!--     <div class="modal-footer">


          </div> -->
      </div>
    </div>
  </div>


    <div class="modal" tabindex="-1" role="dialog" id="EditModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>
          </div>

          <div class="modal-body">
              <form id="editform">
                    @csrf
                    <input type="hidden" name="clientid" id="clientid">
                    <div class="form-group">
                      <label>NAME:</label>
                      <input type="text" class="form-control" name="client" id="edit_client">
                      <p class="alert-danger errmsg" id="edit_clienterr"></p>
                    </div>

                    <div class="form-group">
                      <label>ADDRESS:</label>
                      <input type="text" class="form-control" name="address" id="edit_address">
                       <p class="alert-danger errmsg" id="edit_adderr"></p>
                    </div>

                    <div class="form-group" style="display: none;">
                      <label>TIN:</label>
                      <input type="text" class="form-control" name="tin" id="edit_tin">
                       <p class="alert-danger errmsg" id="edit_tinerr"></p>
                    </div>
                    
        
                    <button type="button" id="updatebtn" class="btn btn-warning float-right text-white"><span class="fa fa-check"></span> UPDATE</button>
                </form>
                

          </div>

      <!--     <div class="modal-footer">


          </div> -->
      </div>
    </div>
  </div>
