//@author Jason
/*
1. khi vừa load trang thì chọn all, check tất cả
2. khi người ta uncheck cái All thì uncheck tat ca , check other
3. khi người ta uncheck hết đống ớ giữa thì tự động check cái Others
4. khi người ta ráng uncheck luôn cái others -> không cho uncheck
5. nếu đang all (tất cả check) mà người ta uncheck 1 cái ở giữa hoặc others thì tự động uncheck cái All
**/
function checkboxList(form)
{
    
    $('.multiselectbox').each(function(){
        var totalChecked = $(this).find('input[type="checkbox"]:checked').length;
        if(form === 'search' && totalChecked === 0)//check all as default
        {
            $(this).find('input[type="checkbox"]').prop('checked', true);
        }
        else//DYNAMIC FORM
        {
            var checkboxListUlHolder = $(this).find('.checkBoxList_list');
            var totalCheckItems = checkboxListUlHolder.find('.checkboxItem').length;
            var totalChecked = checkboxListUlHolder.find('.checkboxItem:checked').length;

            var checkboxOtherChecked = true;
            if($(this).find('.checkboxOther').length > 0)
            {
                if($(this).find('.checkboxOther').is(':checked') == false)
                    checkboxOtherChecked = false;
            }
            $(this).find('.checkAll').prop('checked',totalCheckItems === totalChecked && checkboxOtherChecked);
        }
    });
    
    //bb - DYNAMIC FORM
    //SELECT BOX - action click to show
    $('.checkAll').on('click',function(){
        var objCurrentHolder = $(this).parent().children('.checkBoxList');
        if(objCurrentHolder.is(':visible'))
            objCurrentHolder.hide();
        else
            objCurrentHolder.show();
        
    });
    
    //Jason
    //action click OK
    $('.checkBoxList_actions .btn-ok').on('click',function(){
        $(this).parent().parent('.checkBoxList').hide();
    });
    
    //Jason
    //action click CANCEL
    $('.checkBoxList_actions .btn-cancel').on('click',function(){
        $(this).parent().parent('.checkBoxList').find('input[type="checkbox"]').prop('checked', false);        
        $(this).parent().parent('.checkBoxList').hide();
        
    });
    
    //Jason
    //click out of area
    $(document).mouseup(function (e)
    {        
        var container = $(".checkBoxList");
        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            container.hide();
        }
    });
    
    
    /**
     * <Jason>
     */
    $('.checkAll').click(function(){
        var status = $(this).is(':checked');  
        $(this).parent().next().find('.checkboxItem').prop('checked',status);
    });
    
    //Jason
    var objCheckboxItem = $('.multiselectbox .checkBoxList_list .checkboxItem');    
    objCheckboxItem.on('click',function(){
        var checkboxListUlHolder = $(this).parent().parent().parent('.checkBoxList_list');
        var totalCheckItems = checkboxListUlHolder.find('.checkboxItem').length;
        var totalChecked = checkboxListUlHolder.find('.checkboxItem:checked').length;
        
        var objHolder = checkboxListUlHolder.parent('.checkBoxList_container').parent('.multiselectbox');
        if(totalChecked === 0)//must select at least one checkbox - auto check others
        {
            if(objHolder.find('.checkboxOther').length > 0)
            {
                objHolder.find('.checkboxOther').prop('checked', true);
            }
        }            
          
        var checkboxOtherChecked = true;
        if(objHolder.find('.checkboxOther').length > 0)
        {
            if(objHolder.find('.checkboxOther').is(':checked') === false)
                checkboxOtherChecked = false;
        }
        checkboxListUlHolder.prev().children('.checkAll').prop('checked',totalCheckItems === totalChecked && checkboxOtherChecked);
    });

}