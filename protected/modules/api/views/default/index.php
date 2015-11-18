<?php
$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1>Oauth <small>1.0a Version.</small></h1>

<hr/>
<h2>Document Document</h2>
<a href="http://oauth.net/" class="btn info ">Oauth Official</a>
<a href="http://open.weibo.com/wiki/Oauth" class="btn ">Sina Oauth Explanation</a>


<hr/>
<h2>Client Client</h2>
<p>
This is a simple client provides two ways web and app login. <?php echo CHtml::link('Client',array('client/index'),array('class'=>'btn danger'))?>

</p>

<hr/>
<h2>Server Service</h2>


<table class="wiki_table" border="0" cellspacing="0" cellpadding="0">
<tbody><tr>
<th class="wiki_table_thfirst"> Interface
</th><th> Explanation
</th></tr>
<tr>
<td class="wiki_table_tdfirst"><a href="<?php echo Yii::app()->createAbsoluteUrl('api/oauth/authorize');?>" title="Oauth/authorize">oauth/authorize</a>
</td><td>Request user authorization Token
</td></tr>
<tr>
<td class="wiki_table_tdfirst"><a href="<?php echo Yii::app()->createAbsoluteUrl('api/oauth/request_token');?>" title="OAuth/request token">oauth/access_token</a>
</td><td>Obtain authorization before Request Token
</td></tr>
<tr>
<td class="wiki_table_tdfirst"><a href="<?php echo Yii::app()->createAbsoluteUrl('api/oauth/access_token');?>" title="OAuth/access token">oauth/access_token</a>
</td><td>Obtain authorization before Access Token
</td></tr>
</tbody></table>
	
