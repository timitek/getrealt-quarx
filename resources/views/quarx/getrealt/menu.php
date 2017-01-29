<li class="sidebar-header">
    <a href="<?= url('quarx/getrealt') ?>"><span class="fa fa-home"></span> <span>GetRealT</span></a>
</li>
<li class="<?= (Request::is('quarx/getrealt/settings') || Request::is('quarx/getrealt/settings/*')) ? 'active' : '' ?>">
    <a href="<?= url('quarx/getrealt/settings') ?>"><span class="fa fa-gear"></span> Settings</a>
</li>
