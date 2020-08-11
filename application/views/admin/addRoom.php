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

  

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row">
    <div class="col-sm-10">
          <a href="<?php echo base_url('AdminController/dashboard') ?>"><u>Dashboard</u></a> > <a href="<?php echo base_url('AdminController/chatRoom') ?>"><u>Chat Room Management</u></a> > Add Chat Room
  </div>
  <div class="col-sm-2"><a href="<?php echo base_url('AdminController/chatRoom') ?>"> <button class="butbutton">List chatRoom</button></a></div></div>
            <div class="page-title">
              <div class="title_left">
                <h3>Add chatRoom</h3>
              </div>
           <?php if($this->session->flashdata('Success')){ ?>
                   <div id="error_text" class="alert" style="color: red;"><?php echo $this->session->flashdata('Success'); ?></div>
        <?php }?>

            </div>
            <div class="clearfix"></div>
            
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />

              
                    <form method="post" action="<?php echo site_url('AdminController/insertRoom');?>" data-parsley-validate class="form-horizontal form-label-left">
                       <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">','</div>');?>                    
                    <?php echo form_open('AdminController/insertCity'); ?>  
         <div class="row">
                     <div class="col-sm-8">

                      <div class="form-group">
                        
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Type</label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                         <select class="form-control" name="type" id="type" required="">

                          <option value="">Select </option>
                          <option value="Country">Country</option>
                          <option value="City">City</option>                    
                        </select>
                        </div>
                      </div>
                      </div>

               </div>

               <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Room</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="form-control" name="id" id="id">
                      <!-- <option value="">Select SubCategory</option>
                      <?php 
                      /*if($subcategory){
                      foreach($subcategory as $row)
                     { ?>
                  <option value="<?php echo $row->subcat_id;?>" >
                  <?php echo $row->subcat_name;?></option>
                   <?php  } } else{echo '<option value="0">No data in subcategory</option>';}*/ ?> -->
                    </select>
                      </div>
                      </div>
                      </div>

               </div>


                  

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Add</button>
                          <a href="<?php echo base_url('AdminController/chatRoom');?>"><button class="btn btn-primary" type="button">Cancel</button></a>

                        </div>
                      </div>
 <?php echo form_close();?>  

  <?php /*} }*/ ?>    
                    <!-- </form> -->
                  </div>
                </div>
              </div>
            </div>

                   </div>
        <!-- /page content -->
      
              </div>
    </div>
  </div>

    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>assets/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url();?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url();?>assets/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url();?>assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url();?>assets/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url();?>assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url();?>assets/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url();?>assets/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url();?>assets/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>assets/build/js/custom.min.js"></script>
  <script type="text/javascript">
        window.setTimeout(function() {
        $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
        });
        },4000);
    </script>
    <script>
      $(document).ready(function(){
          $('#type').change(function(){
              var countID = $('#type').val();
              console.log(countID);
              if(countID !='')
              {
                $.ajax({
                  url:"<?php echo base_url();?>AdminController/getList",
                  method:"POST",
                  data:{category:countID},
                  success:function(data)
                  {
                    $('#id').html(data);

                  }
                })
              }
          }); 
      });
    </script>
<style>
   .container {
    padding: 0 16px;
  }
</style>

  </body>
</html>
