<?php
$arrCat = $data['arrCat'];
$dataCat =array();
$data= json_decode($data['json_map'],true);
foreach ($arrCat as $key=>$tab):
    $class='location';
    if($key==1093)  $class='building';
    
    
?>
<div class="map-item <?php echo $class ?>" <?php if($class !='location') echo 'style="display:none;"'?>  >
    <div class="box-3">
        <h3 class="title-2"><?php echo $tab; ?></h3>
        <?php 
                if(isset($data[$key])){
                        echo '<ul class="list-2">';
                        foreach ($data[$key] as $value)  echo "<li><a href='javascript:;'>$value</a></li>";
                        echo "</ul>";
                }
            ?>
    </div>    
</div>
<?php endforeach;?>

<script type="text/javascript">
$(function(){
    $('.select-map').on('click',function(){
          var tab=  $(this).find('img').attr('alt');
          $('.map-item').hide();
          $('.'+tab).show();
    });
})
</script>