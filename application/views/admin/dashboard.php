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
           <div class="row  border-bottom white-bg dashboard-header">
           <div class="col-sm-12">
             <h2>Welcome To Aalap</h2>
           </div>
         </div>

         <div class="row">
             <div class="column">
               <div class="card">            
                 <div class="circle">4</div>           
                    <div class="container text-center">
                      <h3><a href="<?php echo base_url()?>AdminController/user" class="size">Registered Users</a></h3>
                    </div>
               </div>
             </div>  

            <div class="column">
              <div class="card">                
                <div class="circle">5</div>               
                <div class="container text-center">
                  <h3><a href="" data-toggle="tab" class="size">Guest Users</a></h3>
                </div>
              </div>
            </div> 

           <div class="column">
            <div class="card">              
              <div class="circle">3</div>             
              <div class="container text-center">
                <h3><a href="" data-toggle="tab" class="size">Uninstalled App</a></h3>
              </div>
            </div>
           </div> 

           <div class="column">
            <div class="card">            
              <div class="circle">6</div>           
              <div class="container text-center">
                <h3><a href="" data-toggle="tab" class="size">Deleted Accounts</a></h3>
              </div>
            </div>
          </div>

          </div>

           <div class="row">
            <div class="column">
              <div class="card">            
                <div class="circle">6</div>           
                <div class="container text-center">
                  <h3><a href="" data-toggle="tab" class="size">Idle Users</a></h3>
                </div>
              </div>
            </div>  

            <div class="column">
              <div class="card">            
                <div class="circle">9</div>           
                <div class="container text-center">
                  <h3><a href="" data-toggle="tab" class="size">Chat Hours</a></h3>
                </div>
              </div>
            </div> 

           <div class="column">
            <div class="card">            
              <div class="circle">8</div>           
              <div class="container text-center">
                <h3><a href="" data-toggle="tab" class="size">Video Call</a></h3>
              </div>
            </div>
           </div> 

           <div class="column">
            <div class="card">            
              <div class="circle">3</div>           
              <div class="container text-center">
                <h3><a href="" data-toggle="tab" class="size">Audio Call</a></h3>
              </div>
            </div>
           </div>

         </div>
         <div class="row">
             <div class="column">
                  <div class="card">                
                    <div class="circle">3</div>               
                    <div class="container text-center">
                      <h3><a href="" data-toggle="tab" class="size">Frequent Users</a></h3>
                    </div>
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
        <style>

   .dashboard-header {
    border-top: 0;
    padding: 20px 20px 20px 20px;

  }

  .white-bg {
    background-color: #ffffff;
}

.border-bottom {
    border-bottom: 1px solid #e7eaec !important;
}

.row {
    margin-right: -15px;
    margin-left: -15px;
  }

  .dashboard-header h2 {
    margin-top: 10px;
    font-size: 26px;

  }
   .container {
    padding: 0 16px;

  }

   .card {
    box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.2);
    padding: 1px 0px;
    margin-left: 60px;
    margin-right: 4px;
    margin-top: 20px;

  }

   .column {
    float: left;
    width: 23%;
    margin-bottom: 16px;
    padding: 0 8px;

  }
  .circle {
    border-radius: 50%;
    text-align: center;
    font-size: 50px;
    padding: 35% 0px;
    margin: 20px 37px 0px;
    line-height: 0;
    position: relative;
    background: #25344c;
    color: white;
    font-weight: 400;
    font-family: Helvetica, Arial Black, sans;
  }
  .size{
    font-size: 16px;
    
  }

   </style> 