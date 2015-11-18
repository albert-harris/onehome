jQuery(function($) {
	
	if (($.browser.msie) &&
		($.browser.version <= 8))
	{
		$('#locationCheckBoxList ul li:first-child').addClass(
			'last');

		$('#locationCheckBoxList ul li:last-child').addClass(
			'last');
	}

	$('#locationCheckBoxList .checkBoxList_list input.checkBoxList_item.specialInternationRegions').parent('li').addClass(
		'specialInternationalRegions');

	var CoBrandStateSelection = (function ()
	{
		var coBrandStateSelection = {},
			window = this;

		function setSelectedStateText()
		{
			var hidSelectedLocation = $('#hidSelectedLocation');
			var hlSelectedLocation = $('#hlSelectedLocation');

			if ((hidSelectedLocation.length > 0) &&
				(hlSelectedLocation.length > 0))
			{
				var allStatesSelected = true;
				var selectedStates = hidSelectedLocation.val();

				if (selectedStates.length > 2)
				{
					allStatesSelected = false;

					hlSelectedLocation.text(
						'Multiple Selected');

					if ((selectedStates.length % 2) == 0)
					{
						for (var index = 0; index < selectedStates.length; index += 2)
						{
							var selectedStateAbbreviation = selectedStates.substr(
								index,
								2);

							var chkSelectedState = $('#locationCheckBoxList .checkBoxList_list input[type=checkbox][value=' + selectedStateAbbreviation + ']');

							if (chkSelectedState.length > 0)
							{
								chkSelectedState.attr(
									'checked',
									true);
							}
						}

						var totallocationCheckboxCount = $('#locationCheckBoxList .checkBoxList_list input[type=checkbox][name=location]').length;
						var totallocationCheckedCount = $('#locationCheckBoxList .checkBoxList_list input[type=checkbox][name=location]:checked').length;

						if (totallocationCheckboxCount == totallocationCheckedCount)
						{
							var chkAllLocation = $('#chkAllLocation');

							if (chkAllLocation.length > 0)
							{
								chkAllLocation.attr(
									'checked',
									true);

								chkAllLocation.click();

								chkAllLocation.attr(
									'checked',
									true);
							}
						}
					}
				}
				else if ((selectedStates.length == 2) &&
					(selectedStates != 'XX'))
				{
					var chkSelectedState = $('#locationCheckBoxList .checkBoxList_list input[type=checkbox][value=' + selectedStates + ']');

					if (chkSelectedState.length > 0)
					{
						hlSelectedLocation.text(
							$('label[for=' + chkSelectedState.attr('id') + ']').text());

						chkSelectedState.attr(
							'checked',
							true);
					}

					allStatesSelected = false;
				}

				if (allStatesSelected)
				{
					hlSelectedLocation.text(
						$('label[for=chkAllLocation]').text());

					var chkAllLocation = $('#chkAllLocation');

					if (chkAllLocation.length > 0)
					{
						chkAllLocation.attr(
							'checked',
							true);

						chkAllLocation.click();

						chkAllLocation.attr(
							'checked',
							true);
					}

					if ((window.CoBrandCountySelection) &&
						(typeof (CoBrandCountySelection.ClearAllCountySelections) == 'function'))
					{
						CoBrandCountySelection.ClearAllCountySelections();
					}
				}

				if (hlSelectedLocation.find('em').length == 0)
				{
					hlSelectedLocation.append('<em></em>');
				}
			}
		}

		function cancelStateSelections()
		{
			$('#locationCheckBoxList .checkBoxList_list input[type=checkbox]').attr(
				'checked',
				false);

			$('#chkAllLocation').attr(
				'checked',
				false);

			setSelectedStateText();
		}

		coBrandStateSelection.HideStateSelection = function ()
		{
			cancelStateSelections();

			$('#locationCheckBoxList').hide();
		};

		$(function ()
		{
			setSelectedStateText();
		});

		$('body').click(function ()
		{
			cancelStateSelections();

			$('#locationCheckBoxList').hide();
		});

		$('#locationCheckBoxList').click(function (
			event)
		{
			event.stopPropagation();
		});

		$('#hlSelectedLocation').click(function (
			event)
		{
			event.stopPropagation();
			
			$('.checkBoxList').hide();

			if ((window.CoBrandCountySelection) &&
				(typeof (CoBrandCountySelection.HideCountySelection) == 'function'))
			{
				CoBrandCountySelection.HideCountySelection();
			}

			if ((window.CoBrandCategorySelection) &&
				(typeof (CoBrandCategorySelection.HideCategorySelection) == 'function'))
			{
				CoBrandCategorySelection.HideCategorySelection();
			}

			var stateCheckBoxList = $('#locationCheckBoxList');

			if (stateCheckBoxList.length > 0)
			{
				stateCheckBoxList.show();

				if (stateCheckBoxList.is(':visible'))
				{
					window.location.hash = ' ';
				}
				else
				{
					cancelStateSelections();
				}
			}
		});

		$('#chkAllLocation').click(function ()
		{
			$('#locationCheckBoxList .checkBoxList_list input[type=checkbox][name=location]').attr(
				'checked',
				this.checked);
		});

		$('#locationCheckBoxList .checkBoxList_list input[type=checkbox]').click(function ()
		{
			if (this.checked)
			{
				var totalCheckboxCount = $('#locationCheckBoxList .checkBoxList_list input[type=checkbox][name=location]').length;
				var totalCheckedCount = $('#locationCheckBoxList .checkBoxList_list input[type=checkbox][name=location]:checked').length;

				if ((totalCheckboxCount > 0) &&
					(totalCheckboxCount == totalCheckedCount))
				{
					$('#chkAllLocation').attr(
						'checked',
						true);
				}
			}
			else
			{
				$('#chkAllLocation').attr(
					'checked',
					false);
			}
		});

		$('#hlCancelLocationSelection').click(function ()
		{
			cancelStateSelections();

			$('#locationCheckBoxList').hide();
		});

		$('#hlOKLocationSelection').click(function ()
		{
			var hidSelectedLocation = $('#hidSelectedLocation');

			if (hidSelectedLocation.length > 0)
			{
				var allStatesSelected = false;

				var chkAllLocation = $('#chkAllLocation');

				if ((window.CoBrandCountySelection) &&
					(typeof (CoBrandCountySelection.ClearAllCountySelections) == 'function'))
				{
					CoBrandCountySelection.ClearAllCountySelections();
				}

				if ((chkAllLocation.length > 0) &&
					(chkAllLocation.attr('checked')))
				{
					allStatesSelected = true;
				}
				else
				{
					hidSelectedLocation.val(
						'');

					var chkSelectedStates = $('#locationCheckBoxList .checkBoxList_list input[type=checkbox]:checked');

					if (chkSelectedStates.length > 0)
					{
						var selectedStateAbbreviations = [];

						chkSelectedStates.each(function (
							index)
						{
							selectedStateAbbreviations.push(
								this.value);
						});

						if (selectedStateAbbreviations.length > 0)
						{
							hidSelectedLocation.val(
								selectedStateAbbreviations.join(''));

							if ((selectedStateAbbreviations.length == 1) &&
								(window.CoBrand) &&
								(typeof (CoBrand.GetCountyCheckBoxListHTMLByRegionAbbreviation) == 'function'))
							{
								CoBrand.GetCountyCheckBoxListHTMLByRegionAbbreviation(
									selectedStateAbbreviations[0],
									function (
										countyCheckBoxListHTML)
									{
										if (window.CoBrandCountySelection)
										{
											if (typeof (CoBrandCountySelection.LoadCounties) == 'function')
											{
												CoBrandCountySelection.LoadCounties(
													(countyCheckBoxListHTML || ''));
											}

											if (typeof (CoBrandCountySelection.SelectAllCounties) == 'function')
											{
												CoBrandCountySelection.SelectAllCounties();
											}
										}
									});
							}
						}

						else
						{
							allStatesSelected = true;
						}
					}
					else
					{
						allStatesSelected = true;
					}
				}

				if ((allStatesSelected) &&
					(chkAllLocation.length > 0))
				{
					chkAllLocation.attr(
						'checked',
						true);

					chkAllLocation.click();

					chkAllLocation.attr(
						'checked',
						true);

					var chkSelectedInternationalRegions =
						$('#locationCheckBoxList .checkBoxList_list input[type=checkbox][name=specialInternationalRegion]:checked');

					var noSpecialInternationalRegionsSelected = true;

					if (chkSelectedInternationalRegions.length > 0)
					{
						var selectedAbbreviations = [];

						chkSelectedInternationalRegions.each(function (
							index)
						{
							selectedAbbreviations.push(
								this.value);
						});

						if (selectedAbbreviations.length > 0)
						{
							noSpecialInternationalRegionsSelected = false;

							var chklocations =
								$('#locationCheckBoxList .checkBoxList_list input[type=checkbox][name=location]');

							if (chklocations.length > 0)
							{
								chklocations.each(function (
									index)
								{
									selectedAbbreviations.push(
										this.value);
								});
							}

							hidSelectedLocation.val(
								selectedAbbreviations.join(''));
						}
					}

					if (noSpecialInternationalRegionsSelected)
					{
						hidSelectedLocation.val(
							chkAllLocation.val());
					}
				}

				setSelectedStateText();
			}

			$('#locationCheckBoxList').hide();
		});

		return coBrandStateSelection;
	})();
	
});