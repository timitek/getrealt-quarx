<div class="carousel slide" data-ride="carousel" id="quote-carousel">
    <!-- Bottom Carousel Indicators -->
    <ol class="carousel-indicators">
        <?php for ($i = 0; $i < count($testimonials); $i++): ?>
            <li data-target="#quote-carousel" data-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>"></li>
        <?php endfor; ?>        
    </ol>

    <!-- Carousel Slides / Quotes -->
    <div class="carousel-inner">
        <?php for ($i = 0; $i < count($testimonials); $i++): ?>
            <div class="item <?= $i === 0 ? 'active' : '' ?>">
                <div class="row">
                    <div class="col-sm-12">
                        <blockquote>
                            <?= $testimonials[$i]->entry ?>
                            <small><?= $testimonials[$i]->title ?></small>
                        </blockquote>
                        <?php if ($allowEdit): ?>
                            <div style="text-align: center">
                                <?php if ($advancedEdit) : ?>
                                    <?php if (isset($testimonials[$i]->id)): ?>
                                    <a href="<?= url('quarx/blog/'.$testimonials[$i]->id.'/edit') ?>" target="_blank" style="margin-left: 8px;" class="btn btn-xs btn-default"><span class="fa fa-pencil"></span> Edit</a>
                                    <?php endif; ?>
                                    <a href="<?= url('quarx/blog/create') . '?taginit=Testimonial' ?>" target="_blank" style="margin-left: 8px;" class="btn btn-xs btn-default"><span class="fa fa-pencil"></span> Create New</a>
                                <?php else: ?>
                                    <?php if (isset($testimonials[$i]->id)): ?>
                                    <button class="btn btn-xs btn-default" ng-click="frontEnd.editPost('Testimonial', <?= $testimonials[$i]->id ?>)"><span class="fa fa-pencil"></span> Edit</button>
                                    <?php endif; ?>
                                    <button class="btn btn-xs btn-default" ng-click="frontEnd.editPost('Testimonial')"><span class="fa fa-pencil"></span> Create New</button>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endfor; ?>        
    </div>

    <!-- Carousel Buttons Next/Prev -->
    <a data-slide="prev" href="#quote-carousel" class="left carousel-control animated fadeInLeft"><i class="fa fa-chevron-left"></i></a>
    <a data-slide="next" href="#quote-carousel" class="right carousel-control animated fadeInRight"><i class="fa fa-chevron-right"></i></a>
</div>                          
