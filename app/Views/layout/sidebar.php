<div class="page-sidebar">
    <div class="logo-box">
        <a href="<?= base_url() ?>">
            <img id="myImage" src="<?= base_url('/public') ?>/theme/assets/images/logo-light.png" width="150px" class="img-fluid" alt="">
        </a>
        <a href="#" id="sidebar-close">
            <i class="material-icons">close</i>
        </a> 
        <a href="#" id="sidebar-state">
            <i class="material-icons">keyboard_double_arrow_left</i>
            <i class="material-icons compact-sidebar-icon">keyboard_double_arrow_right</i>
        </a>
    </div>
    <div class="page-sidebar-inner slimscroll">
        <ul class="accordion-menu">
            <?php $uid = user()->level_id ?>
            <?php if(in_groups('admin')) : ?>
            <li class="sidebar-title">
                Admin
            </li>
            <li class="<?= ($active_menu == 'manage_users') ? 'active-page' : ''  ?>">
                <a href="<?= base_url('/') ?>/admin" title="Manage User" class="active"><i class="material-icons-outlined">manage_accounts</i>Manage User</a>
            </li>
            <?php endif ?>
            <li class="sidebar-title">
                Apps
            </li>
            <?php if($uid != '8' && $uid != '7') : ?>
            <li class="<?= ($active_menu == 'dashboard') ? 'active-page' : ''  ?>">
                <a href="<?= base_url('/') ?>/user/dashboard" data-toggle="tooltip" data-placement="right" title="My Dashboard"><i class="material-icons">assignment_ind</i>My Dashboard</a>
            </li>
            <li class="<?= ($active_menu == 'task') ? 'active-page' : ''  ?>">
                <a href="<?= base_url('/') ?>/task" data-toggle="tooltip" data-placement="right" title="Task"><i class="material-icons">task</i>Task</a>
            </li>
            <li class="<?= ($active_menu == 'project') ? 'active-page' : ''  ?>">
                <a href="<?= base_url('/') ?>/project" data-toggle="tooltip" data-placement="right" title="Projects"><i class="material-icons">assessment</i>Projects</a>
            </li>
            <li class="<?= ($active_menu == 'repository') ? 'active-page' : ''  ?>">
                <a href="<?= base_url('/') ?>/repository" data-toggle="tooltip" data-placement="right" title="Library"><i class="material-icons">inventory_2</i>Library</a>
            </li>
            <li class="<?= ($active_menu == 'rio') ? 'active-page' : ''  ?>">
                <a href="<?= base_url('/') ?>/rio" data-toggle="tooltip" data-placement="right" title="RIO"><i class="material-icons">assignment</i>RIO</a>
            </li>
            <?php endif ?>
            <li class="<?= ($active_menu == 'bom') ? 'active-page' : ''  ?>">
                <a href="<?= base_url('/') ?>/bom" data-toggle="tooltip" data-placement="right" title="BOM"><i class="material-icons">storage</i>BOM</a>
            </li>
            <li class="<?= ($active_menu == 'drawing') ? 'active-page' : ''  ?>">
                <a href="<?= base_url('/') ?>/drawing" data-toggle="tooltip" data-placement="right" title="Drawing"><i class="material-icons">square_foot</i>Drawing</a>
            </li>
            <?php if($uid != '8' && $uid != '7') : ?>
            <li class="<?= ($active_menu == 'll') ? 'active-page' : ''  ?>">
                <a href="<?= base_url('/') ?>/lessonlearn" data-toggle="tooltip" data-placement="right" title="Lesson learned"><i class="material-icons">model_training</i>Lesson learned</a>
            </li>
            <li class="<?= ($active_menu == 'avqs') ? 'active-page' : ''  ?>">
                <a href="<?= base_url('/') ?>/avqs" data-toggle="tooltip" data-placement="right" title="AV Quality System"><i class="material-icons">change_history</i>AV Quality System</a>
            </li>
            <li class="<?= ($active_menu == 'mg') ? 'active-page' : ''  ?>">
                <a href="<?= base_url('/') ?>/mguideline" data-toggle="tooltip" data-placement="right" title="Manufacturing Guideline"><i class="material-icons">precision_manufacturing</i>Manufacturing Guideline</a>
            </li>
            <li class="<?= ($active_menu == 'eng') ? 'active-page' : ''  ?>">
                <a href="<?= base_url('/') ?>/engchange" data-toggle="tooltip" data-placement="right" title="Engineering Change"><i class="material-icons">settings_suggest</i>Engineering Change</a>
            </li>
            <li class="<?= ($active_menu == 'ds') ? 'active-page' : ''  ?>">
                <a href="<?= base_url('/') ?>/designstandard" data-toggle="tooltip" data-placement="right" title="Design Standard"><i class="material-icons">menu_book</i>Design Standard</a>
            </li>
            <?php endif ?>
            <li class="sidebar-title">
                Account
            </li>
            <li class="<?= ($active_menu == 'profile') ? 'active-page' : ''  ?>">
                <a href="<?= base_url('/') ?>/user" data-toggle="tooltip" data-placement="right" title="Profile"><i class="material-icons-outlined">account_circle</i>Profile</a>
            </li>
            <li class="<?= ($active_menu == 'edit_profile') ? 'active-page' : ''  ?>">
                <a href="<?= base_url('/') ?>/user/edit" data-toggle="tooltip" data-placement="right" title="Edit Profile"><i class="material-icons-outlined">mode_edit</i>Edit Profile</a>
            </li>
            <li class="<?= ($active_menu == 'change_pass') ? 'active-page' : ''  ?>">
                <a href="<?= base_url('/') ?>/user/change_pass" data-toggle="tooltip" data-placement="right" title="Change Password"><i class="material-icons-outlined">lock</i>Change Password</a>
            </li>
        </ul>
    </div>
</div>
<div class="page-container">