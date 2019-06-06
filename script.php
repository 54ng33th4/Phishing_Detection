<script>

  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
  var param = '';
  var $customerList=[ {'columnName':'customer_name','label':'Blacklist'} ];
  $(function () {
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Date picker
    $('#bl_domaincreated').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
	$('#bl_domainexp').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });

     //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });

     //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    $table = $('#customer_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>Blacklist/get",
            "type": "POST",
            "data" : function (d) {
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
			<?php if($this->session->userdata['user_type']=='A'){ ?> $('td', row).eq(8).html('<center><a href="<?php echo base_url();?>Blacklist/edit/'+data['bl_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['bl_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');<?php } ?>
		},

        "columns": [
            { "data": "bl_status", "orderable": true },
            { "data": "bl_domainname", "orderable": false },
            { "data": "bl_domainid", "orderable": false },
            { "data": "bl_registrar", "orderable": false },
			{ "data": "bl_nameserver", "orderable": false },
            { "data": "bl_domaincreated", "orderable": false },
			{ "data": "bl_domainexp", "orderable": false },
			{ "data": "bl_secure", "orderable": false },
			<?php if($this->session->userdata['user_type']=='A'){ ?> { "data": "bl_id", "orderable": false }<?php } ?>
        ]
        
    } );
    
    
  });
 function confirmDelete(bl_id){
    var conf = confirm("Do you want to Delete Blacklist Details ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Blacklist/delete",
            data:{bl_id:bl_id},
            method:"POST",
            datatype:"json",
            success:function(data){
                var options = $.parseJSON(data);
                noty(options);
                $table.ajax.reload();
            }
        });

    }
    }
</script>