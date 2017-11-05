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
        <span class="icon"><i class="fa fa-address-card-o"></i></span>    
        <span>Contact Agent</span>
    </h3>
</div>
<div class="modal-body">
    <form method="POST" action="<?= route('getrealt.posts.store') ?>" accept-charset="UTF-8" class="add">
        {!! csrf_field() !!}

        <div class="form-group ">
            <label class="control-label" for="Title">Title</label>
            <input id="Title" class="form-control" type="text" name="title" placeholder="Title">
        </div>
        <div class="form-group ">
            <label class="control-label" for="Url">Url</label>
            <input id="Url" class="form-control" type="text" name="url" placeholder="Url">
        </div>
        <div class="form-group ">
            <label class="control-label" for="Tags">Tags</label>
            <input id="Tags" class="form-control tags" type="text" name="tags" placeholder="Tags">
        </div>
        <div class="form-group ">
            <label class="control-label" for="Entry">Content</label>
            <textarea id="Entry" class="form-control redactor" name="entry" placeholder="Content"></textarea>
        </div>
        <div class="form-group ">
            <label class="control-label" for="Seo_description">SEO Description</label>
            <textarea id="Seo_description" class="form-control" name="seo_description" placeholder="SEO Description"></textarea>
        </div>
        <div class="form-group ">
            <label class="control-label" for="Seo_keywords">SEO Keywords</label>
            <input id="Seo_keywords" class="form-control tags" type="text" name="seo_keywords" placeholder="SEO Keywords">
        </div>
        <div class="form-group ">
            <div class="checkbox">
                <label for="Is_published" class="control-label">
                    <input id="Is_published" type="checkbox" name="is_published" class="form-check-input">Published</label>
            </div>
        </div>
        <div class="form-group ">
            <label class="control-label" for="Published_at">Publish Date</label>
            <div class="input-group">
                <input id="Published_at" class="form-control datetimepicker" type="text" name="published_at" placeholder="Publish Date"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
        <div class="form-group text-right">
            <input class="btn btn-primary" type="submit" value="Save">
        </div>

    </form>

</div>

</script>
