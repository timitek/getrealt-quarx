<li class="sidebar-header">
    <a href="<?= url('quarx/getrealt') ?>"><span class="fa fa-home"></span> <span>GetRealT</span></a>
</li>
<li class="<?= (Request::is('quarx/getrealt/settings') || Request::is('quarx/getrealt/settings/*')) ? 'active' : '' ?>">
    <a href="<?= url('quarx/getrealt/settings') ?>"><span class="fa fa-gear"></span> Settings</a>
</li>
<li class="<?= (Request::is('quarx/getrealt/contact') || Request::is('quarx/getrealt/contact/*')) ? 'active' : '' ?>">
    <a href="<?= url('quarx/getrealt/contact') ?>"><span class="fa fa-address-book"></span> Contact</a>
</li>
<link rel="stylesheet" type="text/css" href="<?= asset('assets/themes/getrealt/css/admin/getrealt-admin.css') ?>">
<script type="text/javascript" src="<?= asset('assets/themes/getrealt/js/getrealt-admin.min.js') ?>"></script>
