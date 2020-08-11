<?php $this->load->view('admin/layout/linkassets'); ?>  
    <div class="container body">
      <div class="main_container">
               <div class="col-md-3 left_col">
       <?php $this->load->view('admin/layout/left'); ?>
        
        </div>
          
        <!-- top navigation -->
        <div class="top_nav">
         <?php $this->load->view('admin/layout/top-nav'); ?>
        </div>
        <!-- /top navigation -->

     
     <div class="right_col" role="main">
      <?php if($this->session->flashdata('Success')){ ?>
                   <div id="error_text" class="alert" style="color: green;"><?php echo $this->session->flashdata('Success'); ?></div>
        <?php }?>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                    <?php $index = 1 ; if($viewvaliduser){ foreach($viewvaliduser as $validusr){
                       
                       foreach ($validusr['_id'] as $keyID) {
                 ?> 
                                    <form>
                                      <div class="form-group row">
                                          <label for="pp" class="col-sm-2 control-label"><b>Profile Pic</b></label>
                                              <div class="col-sm-10">
                                                <img src="http://18.204.139.44/Yaass/uploads/<?php echo $validusr['verificationPicture'];?>" 
                                                width="100" height="100" >
                                              </div>
                                      </div>

                                      <div class="form-group row">
                                      <label for="pp" class="col-sm-2 control-label"><b>Name</b></label>
                                              <div class="col-sm-10">
                                              <?php echo $validusr['name']; ?>
                                              </div>
                                      </div>

                                      <div class="form-group row">
                                      <label for="pp" class="col-sm-2 control-label"><b>Status</b></label>
                                              <div class="col-sm-10">
                                              <?php echo $validusr['accountStatus']; ?>
                                              </div>
                                      </div>

                                      <div class="form-group row">
                                      <label for="pp" class="col-sm-2 control-label"><b>Created Date</b></label>
                                              <div class="col-sm-10">
                                              <?php echo $validusr['createdAt']; ?>
                                              </div>
                                      </div>
                                   
                                            
                                    <?php }}}?>
                                    <a href="<?php echo base_url('AdminController/validuser');?>" type="submit"  class="btn btn-primary"><i class="fa fa-angle-left"
                                    style="font-size: 17px;
                                      padding: 0px 8px 0px 0px;
                                      vertical-align: text-bottom;"
                                    ></i>Back</a>          
                                </form>    
                                    <!-- </div> -->
                                </div>
                            </div>
                            <!-- basic form end -->
                </div>
            </div>
        </div>



                   

    <!--chart -->
      <div class="row">
        <!-- <div class="col-md-1"></div> -->
        <div class="col-md-10" style="width: 500px;height: 250px;">
    <!--       Chart.js Canvas Tag -->
          <canvas id="barChart" ></canvas>
        </div>
        <div class="col-md-10" style="width: 500px;height: 250px;">
    <!--       Chart.js Canvas Tag -->
          <canvas id="myChart" ></canvas>
        </div>
        <!-- <div class="col-md-1"></div> -->
     </div><br><br>
    
      <!--chart -->
      <div class="row">
        <!-- <div class="col-md-1"></div> -->
        <div class="col-md-10" style="width: 500px;height: 250px;">
    <!--       Chart.js Canvas Tag -->
          <canvas id="age" ></canvas>
        </div>
        <div class="col-md-10" style="width: 500px;height: 250px;">
    <!--       Chart.js Canvas Tag -->
          <canvas id="myChart1" ></canvas>
        </div>
        <!-- <div class="col-md-1"></div> -->
     </div><br><br>
        <!-- /page content -->

  
  
</div>






        <!-- footer content -->
         <?php $this->load->view('admin/layout/footer'); ?> 
        <!-- /footer content -->
      </div>
    </div>

    

 <?php $this->load->view('admin/layout/linkscript'); ?> 
 <script type="text/javascript">
        window.setTimeout(function() {
        $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
        });
        }, 1500);
    </script>

<script>
             // Write on keyup event of keyword input element
            $("#search").keyup(function(){
             var searchText = $(this).val().toLowerCase();
             // Show only matching TR, hide rest of them
             $.each($("#table tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf(searchText) === -1)
               $(this).hide();
            else
               $(this).show();                
                });
             }); 
        </script>
        <script type="text/javascript">
          var dataTable = $('.datatable').DataTable({
            "order": [[ 0, "desc" ]],
            buttons: [
                {

                  extend: 'excel',
                  text: 'Export to Excel'
                },
              ],
  /*dom: "<'row'<'col-md-3'l><'col-md-6 text-center'B><'col-md-3'f>>" +
         "<'row'<'col-md-12'tr>>" +
         "<'row'<'col-md-5'i><'col-md-7'p>>"*/
          dom: "<'row'<'col-md-2'l><'col-md-8 text-right'f><'col-md-1 text-right'B>>" +
         "<'row'<'col-md-12'tr>>" +
         "<'row'<'col-md-5'i><'col-md-7'p>>",
        drawCallback: function(settings) {
    if (!$('.datatable').parent().hasClass('table-responsive')) {
      $('.datatable').wrap("<div class='table-responsive'></div>");
    }
  }
});

dataTable.columns().every(function() {
  var column = this;

  $('.filter-column', this.footer()).on('keyup change', function() {
    if (column.search() !== this.value) {
      column
        .search(this.value)
        .draw();
      this.focus();
    }
  });
});
        </script>
    <script type="text/javascript">
      $('select').on('change', function() 
     { //console.log('hi');        
        var value = this.value;
        var details = value.split('/');
        
        var datas = {_id:details[0],accountStatus:details[1]}
        console.log(datas);
        if(details[1] =='Approved' || details[1] == 'Rejected')
        {
            $.ajax({
            url: '<?php echo site_url('AdminController/updatevalidstatus'); ?>',
            type: 'POST',
            data: datas,
            // dataType: 'json',
            success: function(data) {
              console.log('success function');
                console.log(`the success datas are, ${data}`);

                // $('#userStatus').html(data.replace(/`/g, ''));

            //  alert('some','yes this is worked')
            //  setTimeout(function(){// wait for 5 secs(2)
              window.location.replace("http://18.204.139.44/YaassAdmin/AdminController/validuser"); // then reload the page.(3)
            //         }, 1000);  
            },
            error:function(jqXHR, textStatus, errorThrown){
              console.log("jqXHR:",jqXHR);
              console.log('textStatus',textStatus);
              console.log('errorThrown',errorThrown);
            }
         });
        }
        // location.reload();
    });
    </script>
<style>
   .container {
    padding: 0 16px;
  }
</style> 