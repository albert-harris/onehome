<?php
function buil_menu($models, $idul = '', $classli='',$before_link='',$after_link='',$before_content='',$after_content='')
{
	$str = '<li class="{classli}">{before_link}<a href="{link}">{before_content}{content}{after_content}</a>{after_link}</li>';
	$str_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if(!empty($models))
	{
		if($idul != '')
		{
			echo '<ul id="'.$idul.'">';
		}
		else
		{
			echo '<ul>';	
		}
		$i=0;
		
		foreach($models as $model)
		{
			$class_li = $classli;
			if($i==0)
			{
				$class_li .= ' first';
			}
			else
			{
				if($i==(count($models)-1))
				{
					$class_li .= ' last';
				}
			}
			$link = '';
			if(empty($model->link))
			{
				if($str_link == Yii::app()->createAbsoluteUrl($model->slug))
				{
					$class_li .= ' current';
				}
				$link = Yii::app()->createAbsoluteUrl($model->slug);
			}
			else
			{	
				if(strpos($model->link,'http://') !== false)
				{
					if($str_link == $model->link)
					{
						$class_li .= ' current';
					}
					$link = $model->link;
				}
				else
				{
					if($str_link == ((Yii::app()->createAbsoluteUrl($model->link).'/')))
					{
						$class_li .= ' current';
					}
					$link = Yii::app()->createAbsoluteUrl($model->link).'/';
				}
			}
			echo str_replace(array('{classli}','{before_link}','{link}','{before_content}','{content}','{after_content}','{after_link}'),array($class_li,$before_link,$link,$before_content,$model->title,$after_content,$after_link),$str);
			$i++;
		}
		
		echo '</ul>';
	}
}
buil_menu($models,$idul,$classli,$before_link,$after_link,$before_content,$after_content);
?>