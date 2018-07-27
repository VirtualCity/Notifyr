<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?=base_url('Contacts')?>"><i class="fa fa-group"></i> Contacts</a></li>
            <li class="active">Add Contact</li>
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
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                    </div>
                    <h4 class="panel-title">Add Contact</h4>
                </div>
                <div class="panel-body">
                    <div class="well-content no_search">

                        <form action="<?=base_url('contacts/add')?>" method="post" class="form-horizontal">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="col-md-12 col-xs-12">
                                      <label for="msisdn" class="field_name align_right lblBold">Mobile Number </label><span class="text-danger"> *</span>
                                      <div >
                                          <input required type="text" name="msisdn" id="msisdn" placeholder="Mobile Number" class="form-control" value="<?=$msisdn?>"/>

                                          <span class="text-danger"> <?php echo form_error('msisdn'); ?> </span>
                                      </div>
                                  </div>
                                  <div class="col-md-12 col-xs-12">
                                      <label for="name" class="field_name align_right lblBold">Name </label>
                                      <div >
                                          <input  type="text" name="name" id="name"  class="form-control" value="<?=$name?>"/>
                                      </div>
                                  </div>
                                  <div class="col-md-12 col-xs-12">
                                      <label for="name" class="field_name align_right lblBold">ID Number </label>
                                      <div >
                                          <input  type="text" name="id_number" id="id_number"  class="form-control" value="<?=$id_number?>"/>
                                      </div>
                                  </div>

                                  <div class="col-md-12 col-xs-12">
                                      <label for="email" class="field_name align_right lblBold">Email</label>
                                      <div >
                                          <input  type="text" name="email" id="email"  class="form-control" value="<?=$email?>"/>
                                      </div>
                                  </div>

                                  <div class="col-md-12 col-xs-12">
                                      <label for="address" class="field_name align_right lblBold">Address</label>
                                      <div >
                                          <input  type="text" name="address" id="address"  class="form-control" value="<?=$address?>"/>
                                      </div>
                                  </div>
                              </div>

                              <div class="col-md-6">
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
                                  <div class="col-md-12 col-xs-12">
                                      <label >Region </label><span class="text-danger"> *</span>
                                      <select name="region_id" id="region_id" class="form-control" >
                                          <option value="">---Please Select Region---</option>
                                          <?php
                                          if(!empty($regions)){
                                              foreach($regions as $row) { ?>
                                                  <option value="<?=$row->id?>"><?=$row->name?></option>
                                              <?php   }
                                          } ?>
                                      </select>

                                      <span class="text-danger"> <?php echo form_error('region_id'); ?> </span>
                                  </div>
                                  <div class="col-md-12 col-xs-12">
                                      <label >Town </label><span class="text-danger"> *</span>
                                      <select name="town_id" id="town_id" class="form-control" >
                                          <option value="">---Please Select Town---</option>
                                          <?php
                                          if(!empty($towns)){
                                              foreach($towns as $row) { ?>
                                                  <option value="<?=$row->id?>"><?=$row->name?></option>
                                              <?php   }
                                          } ?>
                                      </select>

                                      <span class="text-danger"> <?php echo form_error('town_id'); ?> </span>
                                  </div>

                              </div>
                          </div>
                            <div class="form_row col-md-offset-6">
                                <label class="field_name align_right"></label>
                                <div class="field">
                                    <button type="submit" class="btn btn-large btn-primary"><i class="fa fa-save"></i> Save Contact</button>
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