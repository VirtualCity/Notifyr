
<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
       <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
       <li><a href="<?=base_url('Contacts')?>"><i class="fa fa-group"></i> Contacts</a></li>
              <li class="active">Edit Contact</li>
    </ol>
    </div>
    <div id="alert_placeholder">
        <?php
        $appmsg = $this->session->flashdata('appmsg');
        if(!empty($appmsg)){ ?>
        <div id="alertdiv" class="alert <?=$this->session->flashdata('alert_type') ?> "><a class="close" data-dismiss="alert">x</a><span><?= $appmsg ?></span></div>
        <?php } ?>
    </div>
 

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-no-rounded-corner panel-default">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                         
                    </div>
                    <h4 class="panel-title">Edit Contact</h4>
                </div>
                <div class="panel-body">
                <div class="well-content no_search">

                    <form action="<?=base_url('contacts/modify')?>" method="post" class="form-horizontal">
                        <input type="hidden" name="id" value="<?=$id?>"/>

                         <div class="col-md-6 col-xs-12">
                        <label for="msisdn" class="field_name align_right lblBold">Mobile Number </label><span class="text-danger"> *</span>
                        <div >
                            <input required type="text" name="msisdn" id="msisdn" placeholder="Mobile Number" class="form-control" value="<?=$msisdn?>"/>
                            
                            <span class="text-danger"> <?php echo form_error('msisdn'); ?> </span>
                        </div>
                    </div>
                        <hr class="field-separator">



                        <div class="col-md-6 col-xs-12">
                        <label for="name" class="field_name align_right lblBold">Name </label>
                        <div >
                            <input  type="text" name="name" id="name"  class="form-control" value="<?=$name?>"/>
                        </div>
                    </div>

                        
                        <hr class="field-separator">

                         <div class="col-md-6 col-xs-12">
                        <label for="email" class="field_name align_right lblBold">Email</label>
                        <div >
                            <input  type="text" name="email" id="email"  class="form-control" value="<?=$email?>"/>
                        </div>
                    </div>
                        <hr class="field-separator">

                        <div class="col-md-6 col-xs-12">
                        <label for="address" class="field_name align_right lblBold">Address</label>
                        <div >
                            <input  type="text" name="address" id="address"  class="form-control" value="<?=$address?>"/>
                        </div>
                    </div>
                    <hr class="field-separator">
                        <div class="form_row">
                            <label class="field_name align_right"></label>
                            <div class="field">
                                <button type="submit" class="btn btn-large blue"><i class="icon-save"></i> Edit</button>
                            </div>
                        </div>

                    </form>
                </div>
                   
                </div>
                <div class="panel-footer">Edit Contact</div>
            </div>
        </div>
    </div>
</div>
<script>



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

