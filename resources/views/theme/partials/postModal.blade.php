<script type="text/ng-template" id="postModal.html">


<!--div class="container">

    <div class="row animated bounceInDown">
        <?= Form::open(['route' => 'getrealt.posts.store', 'class' => 'add']) ?>

            <?= FormMaker::fromTable('blogs', Config::get('quarx.forms.blog')) ?>

            <div class="form-group text-right">
                <?= Form::submit('Save', ['class' => 'btn btn-primary']) ?>
            </div>

        <?= Form::close() ?>
    </div>

</div-->


<div class="modal-header">
    <button type="button" class="close" data-ng-click="cancel()" aria-hidden="true">&times;</button>
    <h3 class="modal-title" id="modal-title">
        <span class="icon"><i class="fa fa-file-o"></i></span>    
        <span ng-if="!id">Create Post</span>
        <span ng-if="id">Edit Post</span>
    </h3>
</div>
<div class="modal-body">
    <form accept-charset="UTF-8" class="add">

        <div class="form-group">
            <label class="control-label" for="Title">Title</label>
            <input id="postModal-title" class="form-control" type="text" name="title" placeholder="Title" ng-model="title">
        </div>
        
        <div class="form-group">
            <label class="control-label" for="Icon">Icon</label>
            <div>
                <h1 ng-if="iconDetails" style="margin-top: 0;"><i id="iconSelected" class="fa" ng-class="iconDetails.icon"></i></span></h1>
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-primary" ng-click="selectIcon()">
                        Select Icon
                    </button>
                    <button type="button" class="btn btn-default" ng-click="clearIcon()" ng-if="iconDetails">
                        Clear
                    </button>
                </div>
            </div>
        </div>

        <div class="form-group ">
            <label class="control-label" for="Entry">Content</label>
            <textarea id="postModal-entry" class="form-control redactor" name="entry" placeholder="Content"></textarea>
        </div>

        <div class="form-group ">
            <label class="control-label" for="Entry">Also Post In</label>
            <div>
                <label class="btn btn-sm btn-primary">
                    <input type="checkbox" ng-model="main"> Recent Posts
                </label>
                <label class="btn btn-sm btn-primary">
                    <input type="checkbox" ng-model="news"> News
                </label>
            </div>
        </div>

        <div class="form-group text-right">
            <button class="btn btn-primary" ng-click="save()">
                Save
            </button>
        </div>
    </form>

</div>

</script>
