<div class="intro clearfix">
    
    <h2 style="color: brown">My Shortlist</h2>
    <?php
    if(!empty($listing)){
        ?>
    <form id="shortListing" action="<?php echo Yii::app()->createAbsoluteUrl('/member/member_profile/SendEnquiryShortList');?>" method="post" >
        <div class="col-5">
            <button type="button" class="btn-5 btRemoveAll">
                <span class="ico-check">Clear Shortlist</span>
            </button>
        </div>

        <div class="col-5">
            <button type="button" class="btn-5 btEnquiry">
                <span class="ico-check">Send Enquiry</span>
            </button>
        </div>

        <div class="clear"></div>
        <?php
        $dataProvider = $listing;
        $this->widget('zii.widgets.CListView', array(
            'id'=>'short_list',
            'dataProvider' => $dataProvider,
            'viewData'=>array('dataProvider'=>$dataProvider),
            'ajaxUpdate'=>false,
            'itemView'=>'normal_user/itemShortList',
            'itemsCssClass' => false,
            'enablePagination'=>true,
            'pagerCssClass' => 'pagination',
            'pager'=>array(
                'cssFile' => false,
                'header'=>false,
                'firstPageCssClass'=>'hidden',
                'lastPageCssClass'=>'hidden',
            )
        ));
    }
    ?>
    </form>

</div>

<style>
    .intro .col-3 {
        width:484px !important;
    }
</style>

    <script type="text/javascript">

        $(document).ready(function(){
            $('.btEnquiry').click(function() {
                var atLeastOneIsChecked = $('input[name=\"chkList[]\"]:checked').length > 0;
                if (!atLeastOneIsChecked)
                {
                    alert('Please select at least one property to send Enquiry');
                    return false;
                }else{
                    $('#shortListing').submit();
                }
            });

            fnBindDelete();
            fnBindDeleteShortlist();
        });

        function fnBindDelete(){
            $('.btRemoveAll').on('click', function (){
                if(!confirm('Are you sure you want to delete all this item?')) return false;
                var th = $(this);
                var url = '<?php echo Yii::app()->createAbsoluteUrl('/member/member_profile/removeAllShortList');?>';

                $.ajax({
                    type: 'POST',
                    dataType : 'JSON',
                    url: url,
                    success: function(data) {
                        alert(data.message);
                        th.closest('tr').remove();
                        if(data['code']){
                            location.reload();
                        }
                    }
                });
                return false;
            });
        }

        function fnBindDeleteShortlist(){
            $('.delete_shortlist').on('click', function (){

                if(!confirm('Are you sure you want to delete this item?')) return false;
//                var th = $(this);
                var url = '<?php echo Yii::app()->createAbsoluteUrl('/member/member_profile/removeShortList'); ?>';
                var params = {};

                params["listing_id"] = $(this).data('listing-id');

                $.ajax({
                    type: 'POST',
                    dataType : 'JSON',
                    data : params,
                    url: url,
                    success: function(data) {
                        alert(data.message);
//                        th.closest('tr').remove();
                        if(data['code']){
                            location.reload();
                        }
                    }
                });
                return false;
            });
        }

    </script>