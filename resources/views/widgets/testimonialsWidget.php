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
                                <?php if (isset($testimonials[$i]->id)): ?>
                                <button class="btn btn-xs btn-default" ng-click="home.editPost('Testimonial', " . $testimonials[$i]->id . ")"><span class="fa fa-pencil"></span> Edit</button>
                                <?php else: ?>
                                <button class="btn btn-xs btn-default" ng-click="home.editPost('Testimonial')"><span class="fa fa-pencil"></span> Create Now</button>
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
