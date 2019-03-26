<div id="main_navigation" class="dark_navigation"> <!-- Main navigation start -->
    <div class="inner_navigation">
        <ul class="main">
            <li class="active navAct"><a id="current" href="<?=base_url('dashboard')?>"><i class="icon-dashboard"></i> Dashboard</a></li>

            <?Php $role = $this->session->userdata('role');
            if($role!=="User"){
                ?>

            <?Php
            }
            ?>
            <li><a href=""><i class="icon-envelope"></i>SMS</a>
                <ul class="sub_main">
                    <li><a href="<?=base_url('sms/newsms')?>">New SMS</a></li>
                    <li><a href="<?=base_url('sms/newbulksms')?>">New Bulk SMS</a></li>
                </ul>
            </li>
            <li><a href=""><i class="icon-group"></i>Contacts List</a>
                <ul class="sub_main">
                    <li><a href="<?=base_url('contacts')?>">View Active Contacts</a></li>
                    <li><a href="<?=base_url('contacts/suspended')?>">View Suspended Contacts</a></li>
                </ul>
            </li>
            <li><a href=""><i class="icon-puzzle-piece"></i>SMS Groups</a>
                <ul class="sub_main">
                    <li><a href="<?=base_url('groups')?>">View Groups</a></li>
                    <li><a href="<?=base_url('groups/add')?>">Add Group</a></li>
                    <li><a href="<?=base_url('groups/import')?>">Import to Group</a></li>
                </ul>
            </li>
            <li><a href=""><i class="icon-file-text"></i> SMS Reports</a>
                <ul class="sub_main">
                    <li><a href="<?=base_url('reports/cummulative')?>">Cummulative Queries</a></li>
                    <li><a href="<?=base_url('reports/purchases')?>">Purchase Report</a></li>
                    <li><a href="<?=base_url('reports/received')?>">Group Messages Received</a></li>
                    <li><a href="<?=base_url('reports/replied')?>">Group Messages Replied</a></li>
                    <li><a href="<?=base_url('reports/pending')?>">Group Messages Pending</a></li>
                    <li><a href="<?=base_url('reports/bulksms')?>">Bulk Alerts Sent</a></li>
                    <li><a href="<?=base_url('reports/sms')?>">Single Alerts Sent</a></li>
                    <li><a href="<?=base_url('reports/subscribed')?>">Subscribed Contacts</a></li>
                    <li><a href="<?=base_url('reports/subscriptions')?>">Subscription Messages</a></li>
					<li><a href="<?=base_url('reports/managers')?>">Managers Reports </a></li>
                    <li><a href="<?=base_url('reports/supervisors')?>">Supervisors Reports</a></li>
                </ul>
            </li>
            <li><a href=""><i class="icon-comments"></i>SMS Logs</a>
                <ul class="sub_main">
                    <li><a href="<?=base_url('logs/inbox')?>">SMS Inbox log</a></li>
                    <li><a href="<?=base_url('logs/outbox')?>">Outbox log</a></li>
                    <li><a href="<?=base_url('logs/autoreplies')?>">Autoreply log</a></li>
                </ul>
            </li>
        <?Php if($role==="MANAGER"){ ?>
            <li><a href=""><i class="icon-flag"></i>BlackList</a>
                <ul class="sub_main">
                    <li><a href="<?=base_url('blacklist')?>">View Blacklist</a></li>
                    <li><a href="<?=base_url('addblacklist')?>">Blacklist Number</a></li>
                </ul>
            </li>
            <li><a href=""><i class="icon-tags"></i>Products</a>
                <ul class="sub_main">
                    <li><a href="<?=base_url('products')?>">View Products</a></li>
                    <li><a href="<?=base_url('products/add')?>">Add Product</a></li>
                    <li><a href="<?=base_url('products/import')?>">Import Products</a></li>
                </ul>
            </li>
            <li><a href=""><i class="icon-map-marker"></i> Towns</a>
                <ul class="sub_main">
                    <li><a href="<?=base_url('towns')?>">View Towns</a></li>
                    <li><a href="<?=base_url('towns/add')?>">Add Town</a></li>
                    <li><a href="<?=base_url('towns/import')?>">Import Towns</a></li>
                </ul>
            </li>
            <li><a href=""><i class="icon-globe"></i>Regions</a>
                <ul class="sub_main">
                    <li><a href="<?=base_url('regions')?>">View Regions</a></li>
                    <li><a href="<?=base_url('regions/add')?>">Add Region</a></li>
                    <li><a href="<?=base_url('regions/import')?>">Import Regions</a></li>
                </ul>
            </li>
            <li><a href=""><i class="icon-circle-blank"></i>Supervisors</a>
                <ul class="sub_main">
                    <li><a href="<?=base_url('supervisors')?>">View Supervisors</a></li>
                    <li><a href="<?=base_url('supervisors/add')?>">Add Supervisor</a></li>
                    <li><a href="<?=base_url('supervisors/import')?>">Import Supervisor</a></li>
                </ul>
            </li>
            <li><a href=""><i class="icon-circle"></i>Managers</a>
                <ul class="sub_main">
                    <li><a href="<?=base_url('managers')?>">View Managers</a></li>
                    <li><a href="<?=base_url('managers/add')?>">Add Manager</a></li>
                    <li><a href="<?=base_url('managers/import')?>">Import Managers</a></li>
                </ul>
            </li>
            
            <li><a href=""><i class="icon-user"></i> User Management</a>
                <ul class="sub_main">
                    <li><a href="<?=base_url('users/active')?>">View Active Users</a></li>
                    <li><a href="<?=base_url('users/suspended')?>">View Suspended Users</a></li>
                    <li><a href="<?=base_url('users/add')?>">Add User</a></li>
                </ul>
            </li>
        <?php endif ?>
            <?Php if($role==="SUPER_ADMIN"){ ?>
                <li><a href=""><i class="icon-cogs"></i> App Settings</a>
                    <ul class="sub_main">
                        <li><a href="<?=base_url('settings/configuration')?>">SDP Configuration</a></li>
                        <li><a href="<?=base_url('settings/services')?>">Agrimanagr Services</a></li>
                    </ul>
                </li>
            <?php endif ?>
        </ul>
    </div>
</div>