<div ng-controller="listingsWidget">
    <div class="row" ng-if="listings">
        <div class="col-xs-12 col-sm-6 col-lg-4" ng-repeat="listing in listings">
            <div class="thumbnail listing-result animated bounceInDown">
                <img class="listing-result-img" ng-src="{{listing.thumbnail}}?newWidth=242&maxHeight=200" alt="...">
                <div class="caption">
                    <div class="listing-result-address"><i class="fa fa-map-marker"></i> <span ng-bind="listing.address"></span></div>
                    <div class="listing-result-attributes">
                        <div>
                            <span class="label label-primary"><span ng-bind="listing.listingTypeURLSlug"></span></span>
                            <span class="label label-primary" ng-if="listing.beds"><span ng-bind="listing.beds"></span> Bed</span>
                            <span class="label label-primary" ng-if="listing.baths"><span ng-bind="listing.baths"></span> Bath</span>
                        </div>
                        <div class="listing-result-dimensions" ng-if="listing.squareFeet || listing.lot || listing.acres">
                            <span class="listing-result-dimension" ng-if="listing.squareFeet">
                                <strong><abbr title="Square Feet">Sqft.:</abbr></strong> <span ng-bind="listing.squareFeet"></span>
                            </span>
                            <span class="listing-result-dimension" ng-if="listing.lot">
                                <strong>Lot:</strong> <span ng-bind="listing.lot"></span>
                            </span>
                            <span class="listing-result-dimension" ng-if="listing.acres">
                                <strong>Acres:</strong> <span ng-bind="listing.acres"></span>
                            </span>
                        </div>
                    </div>
                    <div class="listing-result-price"><span ng-bind="listing.listPrice"></span></div>
                    <div class="listing-result-provider"><strong>Provided By:</strong> <span ng-bind="listing.providedBy"></span></div>
                </div>
            </div>
        </div>
    </div>
</div>
