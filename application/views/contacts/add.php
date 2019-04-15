<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?=base_url('Contacts')?>"><i class="fa fa-group"></i> Contacts</a></li>
            <li class="active">Add Contact</li>
        </ol>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="well-content no_search">

                        <form id="addcontactform" action="<?=base_url('contacts/add')?>" method="post" class="form-horizontal">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="col-md-12 col-xs-12">
                                      <label for="msisdn" class="field_name align_right lblBold">Mobile Number </label><span class="text-danger"> *</span>
                                      <div >
                                          <input required number="true" type="text" name="msisdn" id="msisdn" placeholder="Mobile Number" class="form-control" value="<?=$msisdn?>"/>

                                          <span class="text-danger"> <?php echo form_error('msisdn'); ?> </span>
                                      </div>
                                  </div>
                                  <div class="col-md-12 col-xs-12">
                                      <label for="name" class="field_name align_right lblBold">Name </label>
                                      <div >
                                          <input required  type="text" name="name" id="name"  class="form-control" value="<?=$name?>"/>
                                      </div>
                                  </div>
                                  <div class="col-md-12 col-xs-12">
                                      <label for="code" class="field_code align_right lblBold">Code </label>
                                      <div >
                                          <input  type="text" code="code" id="code"  class="form-control" value="<?=$code?>"/>
                                      </div>
                                  </div>
                                  <div class="col-md-12 col-xs-12">
                                      <label for="name" class="field_name align_right lblBold">ID Number </label>
                                      <div >
                                          <input number="true"  type="text" name="idno" id="id_number"  class="form-control" value="<?=$id_number?>"/>
                                      </div>
                                  </div>

                              </div>

                              <div class="col-md-6">
                              <div class="col-md-12 col-xs-12">
                                      <label for="email" class="field_name align_right lblBold">Email</label>
                                      <div >
                                          <input email="true"  type="text" name="email" id="email"  class="form-control" value="<?=$email?>"/>
                                      </div>
                                  </div>
                              <div class="col-md-12 col-xs-12">
                                      <label for="address" class="field_name align_right lblBold">Address</label>
                                      <div >
                                          <input  type="text" name="address" id="address"  class="form-control" value="<?=$address?>"/>
                                      </div>
                                  </div>

                              <div class="col-md-12 col-xs-12">
                                    <label > Factory  </label><span class="text-danger"></span>
                                    <select name="factory_id" id="factory_id" class="form-control" >
                                        <option value="">-- Select Factory --</option>
                                        <?php
                                        if(!empty($factories)){
                                            foreach($factories as $row) { ?>
                                            <option value="<?=$row->id?>"><?=$row->name?></option> <!--<?php// if ($row->id ===$userfactory){echo "selected";}?>-->
                                            <?php   }
                                        } ?>
                                    </select>

                                    <span class="text-danger"> <?php echo form_error('factory_id'); ?> </span>
                                </div>
                                  <div class="col-md-12 col-xs-12">
                                      <label >Group </label><span class="text-danger"> *</span>
                                      <select name="group_id" id="group_id" class="form-control" >
                                          <option value="">---Please Select Group---</option>
                                          <?php
                                          if(!empty($groups)){
                                              foreach($groups as $row) { ?>
                                                  <option value="<?=$row->id?>" ><?=$row->name?></option>
                                              <?php   }
                                          } ?>
                                      </select>

                                      <span class="text-danger"> <?php echo form_error('group_id'); ?> </span>
                                  </div>
                                  <!-- <div class="col-md-12 col-xs-12">
                                      <label >Region </label><span class="text-danger"> *</span>
                                      <select name="region_id" id="region_id" class="form-control" >
                                          <option value="">---Please Select Region---</option> -->
                                          <?php
                                        //   if(!empty($regions)){
                                              //foreach($regions as $row) { ?>
                                                  <!-- <option value="<?//=$row->id?>"><?//=$row->name?></option> -->
                                              <?php  // }
                                         // } ?>
                                      <!-- </select>

                                      <span class="text-danger"> <?php //echo form_error('region_id'); ?> </span>
                                  </div> -->
                                  <!-- <div class="col-md-12 col-xs-12">
                                      <label >Town </label><span class="text-danger"> *</span>
                                      <select name="town_id" id="town_id" class="form-control" >
                                          <option value="">---Please Select Town---</option> -->
                                          <?php
                                          //if(!empty($towns)){
                                             // foreach($towns as $row) { ?>
                                                  <!-- <option value="<?//=$row->id?>"><?//=$row->name?></option> -->
                                              <?php  // }
                                         // } ?>
                                      </select>

                                      <!-- <span class="text-danger"> <?php //echo form_error('town_id'); ?> </span> -->
                                  <!-- </div> -->

                              </div>
                          </div>
                        <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                                <label class="field_name align_right"></label>
                                <div class="field">
                                    <button type="submit" class="btn btn-large btn-primary"><i class="fa fa-save"></i> Save Contact</button>
                                    <button type="reset" class="btn btn-large btn-default"><i class="fa fa-save"></i> Reset</button>
                                </div>
                            </div>
                        </div>

                        </form>
                    </div>

                </div>
                <div class="panel-footer">Add Contact</div>
            </div>
        </div>
    </div>
</div>

<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
<script src="<?php echo base_url()?>assets/js/jquery.min.js" type="text/javascript"></script>

<script>
    
    $(document).ready(function() {

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

        $('select[name="region_id"]').on('change', function() {
            var regionId = $(this).val();
            var base='<?php echo base_url(); ?>';
            if(regionId) {
                $.ajax({
                    url:  base + 'towns/getTownByRegion/'+regionId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#town_id').empty();
                        $('#town_id').append('<option value="" selected>---Please Select Town---</option>');
                        
                        $.each(data, function(key, value) {
                            $('#town_id').append('<option value="'+ value.id +'" selected> '+ value.name +'</option>');
                        });
                        $(".ms-parent").removeAttr("style");
                    },
                });
            }else{
                $('#town_id').empty();
            }
        });

        
        // $('select[name="factory_id"]').on('change', function() {
        //     var factoryId = $(this).val();
        //     var base='<?php //echo base_url(); ?>';
        //     if(factoryId) {
        //         $.ajax({
        //             url:  base + 'groups/getGroupsByFactoryId/'+factoryId,
        //             type: "GET",
        //             dataType: "json",
        //             success:function(data) {
        //                 $('#group_id').empty();
        //                 $('#group_id').append('<option value="" selected>---Please Select Group---</option>');
                        
        //                 $.each(data, function(key, value) {
        //                     $('#group_id').append('<option value="'+ value.id +'" selected> '+ value.name +'</option>');
        //                 });
        //                 $(".ms-parent").removeAttr("style");
        //             },
        //         });
        //     }else{
        //         $('#group_id').empty();
        //     }
        // });


        
    });
    
</script>
<script type="text/javascript">
        $().ready(function(){
			$('#addcontactform').validate();
        });
</script>