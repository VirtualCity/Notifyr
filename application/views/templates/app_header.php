<header class="blue">
    <a href="<?=base_url('dashboard')?>" class="logo_image"><span class="hidden-480 applogo"> </span><span class="hidden-768 txtSmall"></span></a>
    <ul class="header_actions">
	
	 
	
        <li class="dropdown"><a href=""><img src="<?= base_url('assets/img/avatars/user.png') ?>" alt="User image" class="avatar"><span class="hidden-480"><?Php echo($this->session->userdata('fname').' '.$this->session->userdata('sname')); ?></span><i class="icon-angle-down"></i></a>
            <ul>
                <li><a href="<?=base_url('password')?>"><i class="icon-cog"></i> Change password</a></li>
                <li><a href="<?=base_url('logout')?>"><i class="icon-reorder"></i> Logout</a></li>
            </ul>
        </li>
        
    </ul>
</header>