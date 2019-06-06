
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blacklist Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Blacklist/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">Blacklist Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
			<?php if($this->session->userdata['user_type']=='A')
			{ ?>
				<div class="col-md-2 pull-right">
                  <a href="<?php echo base_url();?>Blacklist/add" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Add New</a>
				</div>
			<?php } ?>	
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="customer_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.NO.</th>
				  <th>DOMAIN.NAME</th>
				  <th>DOMAIN.ID</th>
                  <th>REGISTRAR</th>
				  <th>NAMESERVER</th>
                  <th>DOMAIN.CREATED</th>
				  <th>DOMAIN.EXP</th>
				  <th>SECURE</th>
				  <?php if($this->session->userdata['user_type']=='A'){ ?><th>EDIT/DELETE</th><?php } ?>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






