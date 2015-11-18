<?php

/**
 * Display truncated version of text and show full text on click
 *
 * @author LH
 */
class ShortTextWidget extends CWidget {
	
	/**
	 * @var string the text to be truncated
	 */
	public $text;
	
	/**
	 * @var string url will be called when click to the text
	 */
	public $urlOnCLick = '#';
	
	/**
	 * Renders the content of the portlet.
	 */
	public function run() {
		$shortTextTpl = '<span class="short-text" title="Click to view">%s</span>';
		$fullTextTpl = '<span class="full-text hide">%s</span>';
		Yii::app()->clientScript->registerScript('short-text-widget', "
			$('body').on('click', '.short-text', function() {
				$(this).hide();
				$(this).siblings('.full-text').removeClass('hide');
				$.get($(this).siblings('.short-text-url').val());
			});
		");
		echo sprintf($shortTextTpl, InputHelper::stripoff($this->text, 4)) .
			sprintf($fullTextTpl, $this->text) .
			CHtml::hiddenField('', $this->urlOnCLick, array('class'=>'short-text-url'));
	}
	
}
