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
                    <h2>Account Verification</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table id="table" class="table table-striped datatable">
                      <thead class="theadcon">
                        <tr>
                           <th>ID</th>
                          <th>Name</th>
                          <th>verification Picture</th>
                          <th>Status</th>
                          <th>Action</th>
                          <th></th>
                          
                          
                        </tr>
                      </thead>
                      <tbody>
                       <?php $index = 1 ; if($validuser){ foreach($validuser as $vusr){
                       
                       foreach ($vusr['_id'] as $keyID) {
                        ?>
                        <tr>
                         <!--   <td><?php //echo $index; ?></td> -->
                           <input type="hidden" name="_id" value="<?php echo $keyID;?>"> 
                          <th scope="index"><?php echo $index++;?></th>
                          <td><?php echo $vusr['name']; ?></td>
                          <td><img src="http://18.204.139.44/Yaass/uploads/<?php echo $vusr['verificationPicture'];?>" width="50" height="50"></td>
                          <td><span id="userStatus"><?php echo $vusr['accountStatus']; ?></span></td>
                          <td>
                              <select class="form-control" id = "type" name="type" style="width:100%">
                                          <option value="" >Select</option>                                                           
                                          <option value="<?php echo $keyID;?>/Approved">Approved</option>
                                          <option value="<?php echo $keyID;?>/Rejected">Rejected</option>
                              </select>
                          </td>
                          <td><button><a href="<?php echo base_url();?>AdminController/viewvaliduser/<?php echo $keyID;?>">View</button></a></td>
                          
                        </tr>
                        <?php 
                         } 
                      } }?>

                      </tbody>                   

                    </table>

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