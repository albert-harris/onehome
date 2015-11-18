<div class="box-1 space-3">
      <div class="title"><h3>Personal Information</h3></div>
      <div class="content space-5 tempt"> 
            <div class="row clearfix">
                <div class="lb-1"><b>Name :</b></div> <?php echo $model->title. ' ' . $model->first_name.' ' . $model->last_name; ?>
            </div>
            <div class="row clearfix">
                <div class="lb-1"><b>Mobile :</b></div> <?php echo $model->phone; ?>
            </div>
            <div class="row clearfix">
                <div class="lb-1"><b>Country :</b></div> <?php
                            if(!empty($model->country_id) && isset($model->country->area_name)){
                                echo $model->country->area_name;
                            }
                        ?>
            </div>
            <div class="row clearfix">
                <div class="lb-1"><b>Address :</b></div> <?php echo $model->address; ?>
            </div>
      </div>
</div>
