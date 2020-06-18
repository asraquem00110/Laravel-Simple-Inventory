
  <!-- MODALS -->

  <div class="modal" tabindex="-1" role="dialog" id="AddModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header bg-success">
              <h5 class="modal-title"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>
          </div>

          <div class="modal-body">
              <form method="POST" action="{{route('addUnit')}}">
                    @csrf
                    <div class="form-group">
                      <label>UNIT:</label>
                      <input type="text" class="form-control" name="unit" required>
                      <p class="alert-danger errmsg" id="uniterr"></p>
                    </div>
                     <button tybpe="button" class="btn btn-default float-left" data-dismiss="modal"><span class="fa fa-times"></span> CLOSE</button>
                    <button type="submit" id="" class="btn btn-success float-right text-white"><span class="fa fa-plus"></span> CREATE</button>
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
          <div class="modal-header bg-success">
              <h5 class="modal-title"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
               </button>
          </div>

          <div class="modal-body">
              <form id="editForm">
                    @csrf
                    <input type="hidden" id="unitID" name="unitid">
                    <div class="form-group">
                      <label>UNIT:</label>
                      <input type="text" class="form-control" name="unit" id="newunit" required>
                      <p class="alert-danger errmsg" id="edituniterr"></p>
                    </div>
                     <button tybpe="button" class="btn btn-default float-left" data-dismiss="modal"><span class="fa fa-times"></span> CLOSE</button>
                    <button type="button" onclick="updateUnit()" class="btn btn-success float-right text-white"><span class="fa fa-check"></span> UPDATE</button>
                </form>
                

          </div>

      <!--     <div class="modal-footer">


          </div> -->
      </div>
    </div>
  </div>

