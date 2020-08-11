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
        <?php if (!$this->uri->segment(3)) { ?>
        <div class="right_col" role="main">
          <div class="row">
    <div class="col-sm-10">
          <a href="<?php echo base_url('AdminController/dashboard') ?>"><u>Dashboard</u></a> > <a href="<?php echo base_url('AdminController/country') ?>"><u>Country Management</u></a> > Add Country
  </div>
  <div class="col-sm-2"><a href="<?php echo base_url('AdminController/country') ?>"> <button class="butbutton">List Country</button></a></div></div>
            <div class="page-title">
              <div class="title_left">
                <h3>Add Country</h3>
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

                    <form method="post" action="<?php echo site_url('AdminController/insertCountry');?>" data-parsley-validate class="form-horizontal form-label-left">
                       <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">','</div>');?>                    
                    <?php echo form_open('AdminController/insertcountry'); ?>  
         <div class="row">
                    <div class="col-sm-8">
                 <?php /*if($citydetail){ foreach ($citydetail as $cit) {*/
          ?>  
          <!-- <?php //echo $cit['_id'];?> 
          <?php //echo $cit['cityName'];?>

        -->
          <input type="hidden"  name="_id" value="" >
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Country Name<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- <input type="text" name="countryName" value="" class="form-control col-md-7 col-xs-12" maxlength="25" required=""  autocomplete="off" > -->
                          <input type="text" name="countryName" value="" class="form-control col-md-7 col-xs-12" maxlength="25" required pattern="^[A-Z ]*$"  autocomplete="off" placeholder="CAPITAL LETTER ONLY" >
                          <!-- required pattern="[0-9a-zA-Z_.-]*" -->
                        </div>
                        </div>
                      </div>

               </div>

               <div class="row">
                    <div class="col-sm-8">
                       <input type="hidden"  name="_id" value="" >
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Code <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="code" value="" class="form-control col-md-7 col-xs-12" maxlength="25" required pattern="[0-9+]*">
                        </div>
                        </div>
                      </div>              </div>


                  

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Add</button>
                          <a href="<?php echo base_url('AdminController/country');?>"><button class="btn btn-primary" type="button">Cancel</button></a>

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

 <!-- footer content -->
        <?php $this->load->view('admin/layout/footer'); ?> 
        <!-- /footer content -->

    </div>

  </div>
  <?php } else { ?>

    <!-- page content -->
    <div class="right_col" role="main">
          <div class="row">
            <div class="col-sm-10">
              <a href="<?php echo base_url('AdminController/dashboard') ?>"><u>Dashboard</u></a> > 
                <a href="<?php echo base_url('AdminController/country') ?>"><u>country Management</u></a> > Update country
            </div>
            <div class="col-sm-2"><a href="<?php echo base_url('AdminController/country') ?>"> <button class="butbutton">List Country</button></a></div>
          </div>
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Country</h3>
              </div>
           <?php if($this->session->flashdata('error_status')){ ?>
                   <div id="error_text" class="alert" style="color: green;"><?php echo $this->session->flashdata('Success'); ?></div>
        <?php }?>

            </div>
            <div class="clearfix"></div>
            
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />

              
                    <!-- <form method="post" action="" data-parsley-validate class="form-horizontal form-label-left"> -->
                       <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">','</div>');?>                    
                       <?php echo form_open('AdminController/updateCountryDetails'); ?>  
                      <div class="row">
                      <div class="col-sm-8">
                        
                      <div class="form-group">
                          <?php if($country){ foreach ($country as $pt) {
                            // var_dump($pt);die();
                             foreach ($pt["_id"] as $id) {
                              
                          ?>
                        <input type="hidden"  name="_id" value="<?php echo $id; ?>" > 
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Country Name <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="country" value="<?php echo $pt['countryName']; ?>" class="form-control col-md-7 col-xs-12" maxlength="25" required pattern="^[A-Z ]*$"  autocomplete="off" placeholder="CAPITAL LETTER ONLY">
                        </div>
                        </div>
                      </div>



               </div>
               <br/>
               <div class="row">
                    <div class="col-sm-8">
                       <!-- <input type="hidden"  name="_id" value="" > -->
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Code <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="code" value="<?php echo $pt['code']; ?>" class="form-control col-md-7 col-xs-12" maxlength="25" required pattern="[0-9+]*">
                        </div>
                        </div>
                      </div>              </div>

                  

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a href="<?php echo base_url('AdminController/country');?>"><button class="btn btn-primary" type="button">Cancel</button></a>

                        </div>
                      </div>
 <?php echo form_close();?>  

  
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
   <!-- <?php //$this->load->view('admin/layout/footer'); ?> -->
  <?php }} } }?>
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
    <!-- <script>
      $(document).ready(function(){
          $('#countryID').change(function(){
              var countID = $('#countryID').val();
              if(countID !='')
              {
                $.ajax({
                  url:"<?php echo base_url();?>admin/CountryController/getStates",
                  method:"POST",
                  data:{countryID:countID},
                  success:function(data)
                  {
                    $('#stateID').html(data);

                  }
                })
              }
          }); 
      });
    </script> -->
<style>
   .container {
    padding: 0 16px;
  }
</style>

  </body>
</html>
