<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
        <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">SMS Contact</li>
    </ol>
    </div> 

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                    <h4 class="panel-title">Sent SMS To : <?php echo $name;?></h4>
                <div class="panel-body">
                   <div class="well-content no_search">

                    <form id="contactsmsform" action="<?=base_url('contacts/sendsms')?>" method="post" class="form-horizontal">
                        <input type="hidden" name="id" value="<?=$id?>"/>

                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <label for="msisdn" class="field_name align_right lblBold">Mobile Number </label><span class="text-danger"> *</span>
                                <div >
                                    <input required type="text" name="msisdn" id="msisdn" placeholder="Mobile Number" class="form-control" value="<?=$msisdn?>"  readOnly="true"/>
                                    <span class="text-danger"> <?php echo form_error('msisdn'); ?> </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <label for="message" class="field_name align_right lblBold">Message</label><span class="text-danger"> *</span>
                                
                                <div class="field">
                                    <textarea  id="message" required name="message" placeholder="Message" class="form-control" rows="4" value=""></textarea>
                                    <span class="text-danger"> <?php echo form_error('fname'); ?> </span>
                                </div>
                            </div>
                        </div>
                        <hr class="field-separator">

                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div >
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Send</button>
                                    <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div> 
                
                </div>
                <div class="panel-footer">SMS Contact</div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url()?>assets/js/jquery.min.js" type="text/javascript"></script>
 
<script type="text/javascript">
   $(document).ready(function(){
        <?php if ($this->session->flashdata('appmsg')): ?>
            <?php $appmsg = $this->session->flashdata('appmsg'); ?>
                        swal({
                            title: "Done",
                            text: "<?php echo $this->session->flashdata('appmsg'); ?>",
                            timer: 3000,
                            showConfirmButton: false,
                            type: "<?php echo $this->session->flashdata('alert_type_') ?>"
                    });
        <?php endif; ?>       
    });

</script> 
<script type="text/javascript">
        $().ready(function(){
			$('#contactsmsform').validate();
        });
</script>

<!-- <script>



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

</script> -->

