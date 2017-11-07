<script type="text/ng-template" id="iconModal.html">

<div class="modal-header">
    <button type="button" class="close" data-ng-click="cancel()" aria-hidden="true">&times;</button>
    <h3 class="modal-title" id="modal-title">
        <span class="icon"><i class="fa fa-smile-o"></i></span>    
        <span>Select Icon</span>
    </h3>
</div>
<div class="modal-body">
    <section id="redactor-modal-fonts">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-group">
                    <input id="fontSearch" class="form-control" placeholder="search" ng-model="searchText">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h1><i id="iconSelected" class="fa" ng-class="selectedIcon"></i> <span ng-bind="selectedIconText"></span></h1>
            </div>
        </div>
        <div class="row re-icon-list">
            <div class="col-xs-12">
                <button type="button" 
                        class="btn btn-default re-btn-icon" 
                        data-toggle="tooltip" 
                        data-placement="top" 
                        ng-repeat="icon in icons | filter : searchText : false"
                        ng-click="selectIcon(icon)"
                        title="@{{icon}}">
                    <i class="fa fa-@{{icon}}" id="insert-icon-@{{icon}}"></i>
                </button>
            </div>
        </div>
    </section>

</div>
<div class="modal-footer">
    <button class="btn btn-primary" ng-click="insert()">
        Insert
    </button>
    <button class="btn btn-default" ng-click="cancel()">
        Cancel
    </button>
</div>
</script>
