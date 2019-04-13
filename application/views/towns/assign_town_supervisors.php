<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
           <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
           <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-map-marker"></i> Towns</a></li>
           <li class="active">Assign Clerk</li>
       </ol>
   </div>



<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                </div>
                <h4 class="panel-title">Panel Title here</h4>
            </div>
            <div class="panel-body">
                <form action="<?=base_url('towns/assignsupervisor')?>" method="post" class="form-horizontal">
                    <input type="hidden" name="id" value="<?=$id?>"/>

                    <div class="col-md-6 col-xs-12">
                        <label>Region </label>
                        <input readonly="true" required type="text" name="region" class="form-control" value="<?=$region?>"/>
                        <span class="text-danger"> <?php echo form_error('region'); ?> </span>
                    </div>

                    <div class="col-md-6 col-xs-12">
                        <label>Town </label>
                        <input readonly="true" required type="text" name="town" class="form-control" value="<?=$town?>"/>
                        <span class="text-danger"> <?php echo form_error('town'); ?> </span>
                    </div>     

                    <div class="col-md-12 col-xs-12">
                        <label>Clerks </label>
                        <select class="form-control" id="myduallistbox" multiple="multiple" name="supervisor[]" size="15">
                            <?php
                            if(!empty($supervisors)){
                                foreach($supervisors as $row) { ?>
                                <option value="<?=$row->id?>" ><?=$row->name?> - <?=$row->mobile?></option>
                                <?php   }
                            } ?>
                        </select>                    
                    </div>






                       
                         <hr class="field-separator">

                    <div class="col-md-12 col-xs-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Assign</button>
                        <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                    </div>

                    </form>
                </div>
                <div class="panel-footer">Panel Footer Here</div>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->



 




    <script src="<?php echo base_url(); ?>assets/js/jquery.bootstrap-duallistbox.js"></script>
    <script>


        jQuery("#myduallistbox").bootstrapDualListbox({

        });

        jQuery("#myduallistbox").bootstrapDualListbox('setBootstrap2Compatible', true);

        function showalert(message,alerttype){
            $('#alert_placeholder').append('<div id="alertdiv" class="alert ' + alerttype + '"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
            setTimeout(function() {
                $('#alertdiv').remove();
            },6000);
        }

        function showMessage(message){
            if(message.length>0){
                showalert2(message,"alert-info");
            }
        }

        function showalert2(message,alerttype){
            $('#alert_placeholder').append('<div id="alertdiv" class="alert ' + alerttype + '"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
            setTimeout(function() {
                $('#alertdiv').remove();
            },3000);


        }

    </script>
