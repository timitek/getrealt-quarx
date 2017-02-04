<div class="well well-lg">
    <form action="/phpsdk/index.php#searchResults" method="post">
        <span ng-show="advancedSearch" class="label label-primary pull-right pointer" ng-click="advancedSearch = false"><i class="fa fa-arrow-circle-up"></i> Simple Search</span>
        <span ng-show="!advancedSearch" class="label label-primary pull-right pointer" ng-click="advancedSearch = true"><i class="fa fa-arrow-circle-down"></i> Advanced Search</span>

        <div class="form-group">
            <label for="keywords">Search</label>
            <div class="input-group add-on">
                <input class="form-control" id="keywords" name="keywords" placeholder="Enter keywords (address, listing id, etc..)">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="animated" ng-class="{ bounceIn: advancedSearch }" ng-show="advancedSearch">
            <div class="row">
                <div class="col-xs-12 col-md-6 form-group">
                    <label for="maxPrice">Max Price</label>
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" class="form-control" id="maxPrice" name="maxPrice" placeholder="Max Price" value="">
                    </div>
                </div>                        

                <div class="col-xs-12 col-md-6 form-group">
                    <label for="minPrice">Min Price</label>
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" class="form-control" id="minPrice" name="minPrice" placeholder="Min Price" value="">
                    </div>
                </div>

                <div class="col-xs-12">
                    <fieldset class="search-section">
                        <legend>Property Type</legend>
                        <div class="row">
                            <div class="col-xs-12 col-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="includeResidential" value="true"> 
                                        Include Residential
                                    </label>
                                </div>                                
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="includeLand" value="true"> 
                                        Include Land
                                    </label>
                                </div>                                
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="includeCommercial" value="true"> 
                                        Include Commercial
                                    </label>
                                </div>                                
                            </div>
                        </div>
                    </fieldset>
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-primary" name="searchByKeyword">Search</button>
    </form>
</div>
