                
<!--  main container -->
<div class="main-inner">
    <h1 class="title-page">Property Search Result</h1>
    <br/>
    
    <?php
    $this->widget('zii.widgets.CListView', array(
                    'id' => 'search_result',
                    'dataProvider' => $model,
                    'ajaxUpdate'=>false,
                    'itemView'=>'search/search_item',
                    'itemsCssClass' => false,
                    'summaryText'=> 'Showing {start} - {end} of {count} packages',
                    'template' => '{items}<div class="clearfix"></div>{pager}',
                    'enablePagination'=>true,
                    'pagerCssClass' => 'pagination',
                    'pager'=>array(
                            'cssFile' => false,
                            'header'=>false,
                            'previousPageCssClass' => 'hidden',
                            'nextPageCssClass' => 'hidden',
                            'firstPageCssClass'=>'hidden',
                            'lastPageCssClass'=>'hidden',
                    )
            )
    );
    ?>

</div>

<!--  aside -->
<aside class="sidebar">

    <!-- box -->
    <?php $this->widget('PropertySearch'); ?>

    <div class="space-3">
        <a href="#bank-valuation" class="btn-3 btn-large various">Bank Valuation Request</a>
    </div>

    <div id="bank-valuation" class="popup">
        <h2 class="title-2">Bank Valuation Request</h2>
        <form class="form-type" action="post">
            <div class="in-row clearfix">
                <label class="lb">Property Name or Address <span class="require">*</span></label>
                <div class="group">
                    <input type="text" class="text" />
                </div>
            </div>
            <div class="in-row clearfix">
                <label class="lb">Postal code <span class="require">*</span></label>   
                <div class="group">                                 
                    <select>
                        <option>(140049) 49 Strathmore Avenue</option>
                        <option>Option 1</option>
                        <option>Option 2</option>
                        <option>Option 3</option>
                        <option>Option 4</option>
                        <option>Option 5</option>
                    </select>
                </div>
            </div>
            <div class="in-row clearfix">
                <label class="lb">HDB Town/Estate <span class="require">*</span></label>    
                <div class="group">                             
                    <select>
                        <option>Tampines</option>
                        <option>Option 1</option>
                        <option>Option 2</option>
                        <option>Option 3</option>
                        <option>Option 4</option>
                        <option>Option 5</option>
                    </select>
                </div>
            </div>
            <div class="in-row clearfix">
                <label class="lb">Property Type <span class="require">*</span></label>   
                <div class="group">    
                    <div class="col-1">
                        <select>
                            <option>Apartment / Condo</option>
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                            <option>Option 4</option>
                            <option>Option 5</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select>
                            <option>Condominimum</option>
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                            <option>Option 4</option>
                            <option>Option 5</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="in-row clearfix">
                <label class="lb">Unit# <span class="require">*</span></label>
                <div class="group">
                    <div class="col-1">
                        <input type="text" class="text" placeholder="12" />
                    </div>
                    <div class="col-3">-</div>
                    <div class="col-2">
                        <input type="text" class="text" placeholder="58" />
                    </div>
                </div>
            </div>
            <div class="in-row clearfix">
                <label class="lb">Price $ <span class="require">*</span></label>
                <div class="group">
                    <input type="text" class="text" />
                </div>
            </div>
            <div class="in-row clearfix">
                <label class="lb">Official/BankValuation $</label>
                <div class="group">
                    <input type="text" class="text" />
                </div>
            </div>
            <div class="in-row clearfix">
                <label class="lb"># of Bedrooms <span class="require">*</span></label>
                <div class="group">
                    <input type="text" class="text" />
                </div>
            </div>
            <div class="in-row clearfix">
                <label class="lb">Floor Area <span class="require">*</span></label>
                <div class="group">
                    <input type="text" class="text" />
                </div>
            </div>
            <div class="in-row clearfix">
                <label class="lb">Listing Description <span class="require">*</span></label>
                <div class="group">
                    <textarea rows="3" cols="30" class="text"></textarea>
                </div>
            </div>
            <div class="in-row clearfix">
                <label class="lb">Furnished</label>                                    
                <div class="group">
                    <ul class="list-check list-check-2 clearfix">
                        <li><input type="radio" name="furnished" id="unfurnished" checked /><label for="unfurnished">Unfurnished</label></li>
                        <li><input type="radio" name="furnished" id="partially" /><label for="partially">Partially Furnished</label></li>
                        <li><input type="radio" name="furnished" id="fully" /><label for="fully">Fully Furnished</label></li>         
                    </ul>
                </div>
            </div>
            <div class="in-row clearfix">
                <label class="lb">Floor</label>   
                <div class="group">                       
                    <select>
                        <option>Ground Floor</option>
                        <option>Low Floor</option>
                        <option>Middle Floor</option>
                        <option>High Floor</option>
                        <option>Penthouse</option>
                    </select>
                </div>
            </div>
            <div class="in-row clearfix">
                <label class="lb">Lease Term</label>   
                <div class="group">                      
                    <select>
                        <option>One Year</option>
                        <option>Two Years</option>
                        <option>Three or More Years</option>
                        <option>Short Term</option>
                        <option>Flexible</option>
                    </select>
                </div>
            </div>
            <div class="in-row clearfix">
                <label class="lb"># of bathrooms</label>
                <div class="group">
                    <input type="text" class="text" placeholder="Enter text" />
                </div>
            </div>
            <div class="in-row clearfix">
                <label class="lb">Special Features</label>                                    
                <div class="group">
                    <ul class="list-check list-check-2 clearfix">
                        <li><input type="radio" name="furnished" id="unfurnished" checked /><label for="unfurnished">Penthouse</label></li>
                        <li><input type="radio" name="furnished" id="unfurnished" checked /><label for="unfurnished">Corner Unit</label></li>
                        <li><input type="radio" name="furnished" id="unfurnished" checked /><label for="unfurnished">Sea View</label></li>
                        <li><input type="radio" name="furnished" id="unfurnished" checked /><label for="unfurnished">Renovated</label></li>
                        <li><input type="radio" name="furnished" id="unfurnished" checked /><label for="unfurnished">City View</label></li>
                        <li><input type="radio" name="furnished" id="unfurnished" checked /><label for="unfurnished">Park / Greenery View</label></li>
                        <li><input type="radio" name="furnished" id="unfurnished" checked /><label for="unfurnished">Swimming Pool View</label></li>
                        <li><input type="radio" name="furnished" id="unfurnished" checked /><label for="unfurnished">Original Condition</label></li>
                        <li><input type="radio" name="furnished" id="unfurnished" checked /><label for="unfurnished">Low Floor</label></li>
                        <li><input type="radio" name="furnished" id="unfurnished" checked /><label for="unfurnished">High Floor</label></li>
                        <li><input type="radio" name="furnished" id="unfurnished" checked /><label for="unfurnished">Ground Floor</label></li>
                        <li><input type="radio" name="furnished" id="unfurnished" checked /><label for="unfurnished">Colonial Building</label></li>
                    </ul>
                </div>
            </div>
            <div class="in-row clearfix">
                <button type="button" class="btn-3">Submit</button>
            </div>
        </form>
    </div>

    <!-- box -->
    <?php $this->widget('ext.GlobalEnquiry.Enquiry');?>
    <div class="bn-advers-2"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/bn-ads-2.jpg" alt="image" /></a></div>

</aside>

