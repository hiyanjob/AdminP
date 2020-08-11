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
        <?php } else {?>
          <div id="error_text" class="alert" style="color: red;"><?php echo $this->session->flashdata('error'); ?></div>
          <?php }?>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="">
                   <!--  <a href="<?php echo base_url('AdminController/dashboard');?>"></a> > Orientation  -->
                    <h2 class="head">  City Management</h2>
                    
                    <div class="row">
    <div class="col-sm-10" >
       <!-- <label for="search">
                                     <input type="text" id="search" placeholder="Search..." class="seach"><i class="fa fa-search" id="fa-search" style="margin-left: -23px;color: white;"> </i>
                               
                                   </label> -->
    </div>
    <div class="col-sm-2"><a href="<?php echo base_url('AdminController/addcity') ?>">
        <button class="butbutton" >Add City</button></a>
    </div>
  </div>
                    <ul class="nav navbar-right panel_toolbox">
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table id="table" class="table table-striped datatable">
                      <thead class="theadcon">
                        <tr>
                          <th>ID</th>
                          <th>City Name</th>
                          <th>Action</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $index = 1 ; if($city){ foreach($city as $ci){
                         foreach ($ci['_id'] as $keyId ) {

                        ?>
                        <tr>
                         <!--   <td><?php echo $index; ?></td> -->
                          <input type="hidden" name="_id" value="<?php echo $keyId;?>">
                          <th scope="index"><?php echo $index++;?></th>
                          <td><?php echo $ci['cityName']; ?></td>
                          <td>
                            <a href="<?php echo base_url();?>AdminController/addcity/<?php echo $keyId;?>">
                              <i class="fa fa-edit" style="font-size: 22px;"></i></a>&nbsp;&nbsp;
                            <a href="<?php echo base_url();?>AdminController/deletecity/<?php echo $keyId;?>">
                              <i class="fa fa-trash" style="font-size: 22px;"></i></a>
                          </td> 
                          <!-- <?php //echo base_url();?>admin/adminController/verifyUser/<?php //echo $u->userID; ?> -->
                          <td><?php if( $ci['status'] == 'Active'){?>
                            <a href="<?php echo base_url();?>AdminController/updateInactiveCity/<?php echo $keyId;?>"><i class="fa fa-toggle-on" style="font-size: 24px;"></i></a>
                          <?php } else {?>
                            <a href="<?php echo base_url();?>AdminController/updateActiveCity/<?php echo $keyId;?>"><i class="fa fa-toggle-off" style="font-size: 24px;"></i></a>
                         <?php }?>
                          </td> 
                        </tr>
                        <?php  } } }?>

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


       

    
	

   
     

 