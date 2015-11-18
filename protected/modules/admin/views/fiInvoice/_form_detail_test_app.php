<script src="<?php echo Yii::app()->theme->baseUrl ?>/admin/partner//run_prettify.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl ?>/admin/partner//angular.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl ?>/admin/partner//bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl ?>/admin/partner//xtForm.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl ?>/admin/partner//todo.js"></script>

<div  ng-app="NgValidationTestApp" ng-controller="TodoCtrl">
    <table class="materials_table items ">
        <thead>
            <tr>
                <!--<td colspan="3" class="item_c item_b">Details</td>-->
                <td class="item_c item_b">
                    <input ng-click="addTodo()" type="button" value="Add row" class="btn btn-small AddRowBtn">
                    <!--<button type="button"class="btn btn-small">Add row</button>-->
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th class="w-20 item_c">#</th>
                <th class="w-500 item_c">Description</th>                        
                <th class="w-200 item_c">Amount SG $</th>                        
                <!--<th class="last item_c">Remove</th>-->
            </tr>
        </thead>
        <tbody>            
            <tr ng-repeat="todo in  vouchers">
                <td>{{$index + 1}}</td>
                <td class="item_c order_no row_class_id"> 
                    <input ng-model="toto.a" value="">
                </td>
                <td class="item_c order_no row_class_id">
                    <input ng-model="toto.b" value="">
                </td>
            </tr>                               
        </tbody>        
    </table>
    
      <?php
          $dataTmp = array("a"=>1,'b'=>2);
          $dataTmp = json_encode($dataTmp);
          ?>
        <div ng-init="vouchers = [<?php echo htmlspecialchars($dataTmp); ?>]; "></div>
    <?php ?> 
</div> <!--end test-->
