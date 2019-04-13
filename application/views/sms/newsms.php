<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
             <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">New SMS</li>
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
                    <h4 class="panel-title">New SMS</h4>
                </div>
                <div class="panel-body">
                 <form action="<?php echo base_url('sms/newsms');?>" method="post" class="form-horizontal">

                    <div class="col-md-12 col-xs-12">
                        <label>Mobile Number </label><span class="text-danger"> *</span>

                        <input type="text" name="msisdn" id="msisdn" placeholder="254" class="form-control" value="<?php echo $msisdn;?>"/>
                        <span class="text-danger">  <?php echo form_error('msisdn'); ?> </span>
                        

                    </div>

                    <div class="col-md-12 col-xs-12">
                        	<label>Select Template</label>
                        	<div >
                                <select name="template" id="template_id" class="form-control" >
                                    <option value="">---Please Select Template---</option>
                                    <?php
                                    if(count($templates)>0){
                                        foreach($templates as $row) { ?>
                                        <option value="<?=$row->id?>"  template="<?=$row->template?>"  title="<?=$row->title?>"><?=$row->title?></option>
                                        <?php   }
                                    }else{
                                        echo "No templates found.";
                                    } ?>
                                </select>                             
                            </div>
                    </div>


                    <div class="col-md-12 col-xs-12">
                        <label>Message </label><span class="text-danger"> *</span>


                        <textarea onkeyup="countChars(this);" onkeydown="countChars(this);" maxlength="480" required="true"  id="message" name="message" placeholder="Message" class="form-control" rows="4" value=""><?php echo $message; ?></textarea>
                        <span class="text-danger"><?php echo form_error('message'); ?> </span>
                        
                    </div>

                    <!-- ----------------------------------------------------------- -->

                    <p id="msgNum">0 Message(s)</p>
                    <script type="text/JavaScript">

                    $("#template_id").change(function(){
                        var template= $("#template_id option:selected").attr("template");
                        $("#message").val(template);
                    }); 

                    function countChars(obj){
                        var maxLength = 480;
                        var singleMessageSize = 160;
                        var strLength = obj.value.length;
                        
                        if(((strLength) > -1) && ((strLength) <= 0)){
                            document.getElementById("msgNum").innerHTML = 0 +' out of '+maxLength/singleMessageSize+' Message(s)';
                        }else if(((strLength) > 0) && ((strLength) <= 160)){
                            document.getElementById("msgNum").innerHTML = 1 +' out of '+maxLength/singleMessageSize+' Message(s)';
                        }else if(((strLength) > 160) && ((strLength) <= 320)){
                            document.getElementById("msgNum").innerHTML = 2 +' out of '+maxLength/singleMessageSize+' Message(s)';
                        }else if(((strLength) > 320) && ((strLength) <= 480)){
                            document.getElementById("msgNum").innerHTML = 3 +' out of '+maxLength/singleMessageSize+' Message(s)';
                        }else{
                            document.getElementById("msgNum").innerHTML = ' Message too big (more than 3)';
                        }

                    }

                    // $(document).ready(function() {
                    //     $.ajax({
                    //         url:  <?php echo base_url('contacts/datatable')?>,
                    //         type: "GET",
                    //         dataType: "json",
                    //         success:function(data) {
                    //             $('#msisdn_').empty();
                    //             $.each(data, function(key, value) {
                    //                 $('#msisdn_').append(value.msisdn);
                    //             });
                            
                    //             $(".ms-parent").removeAttr("style");
                    //         },
                    //     });
                    // });
                    </script>

                    <!-- ------------------------------------------------------------------ -->

                    <hr class="field-separator">
                    <div class="col-md-12 col-xs-12">
                        <label class="field_name align_right"></label>
                        <div class="field">

                            <button type="submit" class="btn btn-primary"><i class=""></i> <i class="fa fa-send"></i> Send</button>
                            <button type="reset" class="btn btn-default"><i class=""></i> Reset</button>


                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer">New SMS</div>

        </div>
    </div>
</div>
</div>
</div>
<!-- end #content -->


