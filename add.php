<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blacklist Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Blacklist/"><i class="fa fa-dashboard"></i> Back to View</a></li>
        <li class="active">Blacklist Details</li>
      </ol>
    </section>
	<form class="form-horizontal" method="POST" action="<?php echo base_url();?>Blacklist/add">
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
		  <fieldset>
		    <legend>Blacklist Details</legend>
		  	<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="bl_id" value="<?php if(isset($records->bl_id)) echo $records->bl_id ?>"/>
                <?php echo validation_errors(); ?>
			    <div class="box-body">
				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Domain Name<span style="color:red">*</span></label>

					  <div class="col-sm-5">
						<input type="text" data-pms-required="true"  class="form-control" name="bl_domainname" id="bl_domainname"  value="<?php if(isset($records->bl_domainname)) echo $records->bl_domainname ?>">
					  </div>
				</div>
				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Registry Domain ID<span style="color:red">*</span></label>
					  <div class="col-sm-5">
					  <input type="text" data-pms-required="true"  class="form-control" name="bl_domainid" id="bl_domainid"  value="<?php if(isset($records->bl_domainid)) echo $records->bl_domainid ?>">
					  </div>
				</div>
				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Registrar</label>
					  <div class="col-sm-5">
						<input type="text" data-pms-required="true"  class="form-control" name="bl_registrar" id="bl_registrar"  value="<?php if(isset($records->bl_registrar)) echo $records->bl_registrar ?>">
					  </div>
				</div>
                <div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Name Server</label>

					  <div class="col-sm-5">
						<input type="text" data-pms-required="true" class="form-control" name="bl_nameserver" id="bl_nameserver"  value="<?php if(isset($records->bl_nameserver)) echo $records->bl_nameserver ?>">
					  </div>
				</div>
				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Creation Date</label>

					  <div class="col-sm-5">
						<input type="text" data-pms-required="true"  class="form-control" name="bl_domaincreated" id="bl_domaincreated"  value="<?php if(isset($records->bl_domaincreated)) echo $records->bl_domaincreated ?>">
					  </div>
				</div>
				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Registry Expiry Date</label>

					  <div class="col-sm-5">
						<input type="text" data-pms-required="true" class="form-control" name="bl_domainexp" id="bl_domainexp"  value="<?php if(isset($records->bl_domainexp)) echo $records->bl_domainexp ?>">
					  </div>
				</div>
				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Secure</label>
					  <div class="col-sm-5">
						<input type="text" data-pms-required="true" class="form-control" name="bl_secure" id="bl_secure"  value="<?php if(isset($records->bl_secure)) echo $records->bl_secure ?>">
					  </div>
				</div>
                </div>
              <!-- /.box-body -->
              
            
			</fieldset>
          </div>
          
          <!-- /.box -->
        </div>
		<div class="box-footer">                
                <div class="row">
                  <div class="col-md-6">
                  </div>
                  <div class="col-md-4">
                      <button type="button" class="btn btn-danger" onclick="window.location.reload();">Cancel</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
	    </div>
        <!-- /.col -->
        </div>
      
    </section>
	
	</form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






