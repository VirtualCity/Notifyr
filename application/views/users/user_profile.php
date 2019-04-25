<!-- begin #content -->
<div class="content">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-lg-4 col-md-5">
	                        <div class="card card-user">
	                            <div class="image">
	                                <img src="<?=base_url()?>assets/img/bg.png" alt="..."/>
	                            </div>
	                            <div class="card-content">
	                                <div class="author">
	                                  <img class="avatar border-white" src="<?=base_url()?>assets/img/faces/face-2.png" alt="..."/>
	                                  <h4 class="card-title"><?Php echo($this->session->userdata('fname').' '.$this->session->userdata('sname')); ?><br />
	                                     <a href="#"><small><?=$email?></small></a>
	                                  </h4>
	                                </div>
	                            </div>
	                            <hr>
	                            <div class="text-center">
	                                <div class="row">
	                                    <div class="col-md-3 col-md-offset-1">
	                                        <h5>12<br /><small>Files</small></h5>
	                                    </div>
	                                    <div class="col-md-4">
	                                        <h5>2GB<br /><small>Used</small></h5>
	                                    </div>
	                                    <div class="col-md-3">
	                                        <h5>24,6$<br /><small>Spent</small></h5>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-lg-8 col-md-7">
	                        <div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title">Edit Profile</h4>
	                            </div>
	                            <div class="card-content">
	                                <form>
	                                    <div class="row">
	                                        <div class="col-md-5">
	                                            <div class="form-group">
	                                                <label>Role</label>
	                                                <input type="text" class="form-control border-input" disabled placeholder="Company" value="<?=$role?>">
	                                            </div>
	                                        </div>
	                                        <div class="col-md-3">
	                                            <div class="form-group">
	                                                <label>Username</label>
	                                                <input type="text" class="form-control border-input" disabled placeholder="Username" value="<?=$username?>">
	                                            </div>
	                                        </div>
	                                        <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label for="exampleInputEmail1">Email address</label>
	                                                <input type="email" class="form-control border-input" value="<?=$email?>" placeholder="Email">
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="row">
	                                        <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>First Name</label>
	                                                <input type="text" class="form-control border-input" placeholder="First Name" value="<?=$fname?>">
	                                            </div>
	                                        </div>
	                                        <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Last Name</label>
	                                                <input type="text" class="form-control border-input"  placeholder="Last Name" value="<?=$oname?>">
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="row">
	                                        <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Address</label>
	                                                <input type="text" class="form-control border-input" placeholder="Home Address" value="<?=$address?>">
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="row">
	                                        <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>City</label>
	                                                <input type="text" class="form-control border-input" placeholder="City" value="">
	                                            </div>
	                                        </div>
	                                        <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>Country</label>
	                                                <input type="text" class="form-control border-input" placeholder="Country" value="">
	                                            </div>
	                                        </div>
	                                        <div class="col-md-4">
	                                            <div class="form-group">
	                                                <label>Postal Code</label>
	                                                <input type="number" class="form-control border-input" placeholder="ZIP Code">
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="text-center">
	                                        <!-- <button type="submit" class="btn btn-info btn-fill btn-wd">Update Profile</button> -->
	                                    </div>
	                                    <div class="clearfix"></div>
	                                </form>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
</div>
<!-- end #content -->
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