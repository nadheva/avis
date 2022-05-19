<div class="page-header">
    <nav class="navbar navbar-expand">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav">
            <li class="nav-item small-screens-sidebar-link">
                <a href="#" class="nav-link"><i class="material-icons-outlined">menu</i></a>
            </li>
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?= base_url('/public') ?>/theme/assets/images/avatars/<?= user()->user_image ?>" alt="profile image">
                    <span><?= user()->fullname ?></span><i class="material-icons dropdown-icon" data-toggle="tooltip" data-placement="bottom" title="Profile">keyboard_arrow_down</i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= base_url('/') ?>/user">Profile</a>
                    <a class="dropdown-item" href="<?= base_url('/') ?>/user/edit">Edit Profile</a>
                    <a class="dropdown-item" href="<?= base_url('/') ?>/user/change_pass">Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url('/') ?>/logout">Log out</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle notification" href="#" id="notification" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons-outlined" data-toggle="tooltip" data-placement="bottom" title="Notification">notifications</i> 
                    <?php if($notif->count_notif != 0) : ?>
                    <span class="num"><?= $notif->count_notif ?></span>
                    <?php endif ?>
                </a>
                <div class="dropdown-menu pt-0 pb-0" style="width: 290px;" aria-labelledby="notification">
                    <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="mr-auto">Notification</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <?php if($notif->count_notif == 0) : ?>
                        <div class="toast-body">
                            You dont have notification right now!
                        </div>
                        <?php endif ?>
                        <?php if($notif->task_overdue != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->task_overdue ?> task over due! <a href="<?= base_url('') ?>/user/dashboard/#tabtask" >click here</a> 
                        </div>
                        <?php endif ?>
                        <?php if($notif->task_open != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->task_open ?>  task open! <a href="<?= base_url('') ?>/user/dashboard/#tabtask">click here</a> 
                        </div>
                        <?php endif ?>
                        <?php if($notif->task_requestapprove != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->task_requestapprove ?>  request approve task! <a href="<?= base_url('') ?>/user/dashboard/#tabtask">click here</a> 
                        </div>
                        <?php endif ?>
                        <?php if($notif->ctask_overdue != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->ctask_overdue ?> child task over due! <a href="<?= base_url('') ?>/user/dashboard/#tabtask" >click here</a> 
                        </div>
                        <?php endif ?>
                        <?php if($notif->ctask_open != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->ctask_open ?> child task open! <a href="<?= base_url('') ?>/user/dashboard/#tabtask">click here</a> 
                        </div>
                        <?php endif ?>
                        <?php if($notif->ctask_requestapprove != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->ctask_requestapprove ?> child request approve task! <a href="<?= base_url('') ?>/user/dashboard/#tabtask">click here</a> 
                        </div>
                        <?php endif ?>
                        <?php if($notif->rio_overdue != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->rio_overdue ?> rio over due! <a href="<?= base_url('') ?>/user/dashboard/#tabrio" >click here</a> 
                        </div>
                        <?php endif ?>
                        <?php if($notif->rio_open != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->rio_open ?>  rio open! <a href="<?= base_url('') ?>/user/dashboard/#tabrio">click here</a> 
                        </div>
                        <?php endif ?>
                        <?php if($notif->rio_requestapprove != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->rio_requestapprove ?>  request approve rio! <a href="<?= base_url('') ?>/user/dashboard/#tabrio">click here</a> 
                        </div>
                        <?php endif ?>
                        <?php if($notif->childrio_overdue != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->childrio_overdue ?> child rio over due! <a href="<?= base_url('') ?>/user/dashboard/#tabrio" >click here</a> 
                        </div>
                        <?php endif ?>
                        <?php if($notif->childrio_open != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->childrio_open ?> child rio open! <a href="<?= base_url('') ?>/user/dashboard/#tabrio">click here</a> 
                        </div>
                        <?php endif ?>
                        <?php if($notif->childrio_requestapprove != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->childrio_requestapprove ?> child request approve rio! <a href="<?= base_url('') ?>/user/dashboard/#tabrio">click here</a> 
                        </div>
                        <?php endif ?>
                        <?php if($notif->reqapprove_fourm != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->reqapprove_fourm ?> approve 4m change request! <a href="<?= base_url('') ?>/user/dashboard/#tabfourm">click here</a> 
                        </div>
                        <?php endif ?>
                        <?php if($notif->reject_bom != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->reject_bom ?> rejected bom file! <a href="<?= base_url('') ?>/bom">click here</a> 
                        </div>
                        <?php endif ?>
                        <?php if($notif->reqapprove_bom != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->reqapprove_bom ?> approve new bom file! <a href="<?= base_url('') ?>/bom">click here</a> 
                        </div>
                        <?php endif ?>
                        <?php if($notif->reqapprove_bom_status != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->reqapprove_bom_status ?> approve change status bom file! <a href="<?= base_url('') ?>/bom">click here</a> 
                        </div>
                        <?php endif ?>
                        <?php if($notif->reqapprove_baan != 0) : ?>
                        <div class="toast-body">
                            You have <?= $notif->reqapprove_baan ?> approve new baan file! <a href="<?= base_url('') ?>/bom?show=baan">click here</a> 
                        </div>
                        <?php endif ?>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" id="dark-theme-toggle"><i class="material-icons-outlined" onclick="document.getElementById('myImage').src='<?= base_url('/public') ?>/theme/assets/images/logo-dark.png'" data-toggle="tooltip" data-placement="bottom" title="Dark Mode">brightness_2</i><i class="material-icons">brightness_2</i></a>
            </li>
        </ul>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item nav-w" style="margin-right: 1px;">
                    <a class="nav-link"><i class="material-icons-outlined">watch_later</i></a>
                </li>
                <li class="nav-item">
                    <a id="clock" class="nav-link"></a>
                </li>
                <li class="nav-item nav-w">
                    <a class="nav-link">|</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><?= date('d M Y') ?></a>
                </li>
            </ul>
        </div>
    </nav>
</div>