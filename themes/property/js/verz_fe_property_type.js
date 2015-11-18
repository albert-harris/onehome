/* ANH DUNG - Id: verz_fe_property_type
 *  Mar 10, 2015
 */
$(window).load(function(){ });        
    
    /********** begin for dropdown search property type */
    $(function(){
        $('.choose-list').each(function(){
            $(this).find(".choosed-text").click(function(e){
                $(this).next().slideToggle();
                fnCheckIsReadyOpen();
            });
        });

        $("input[name='choosetype']").click(function(){ //    $("input[name='choosetype']").change(function(){
    //        var number = $("input[name='choosetype']:checked").val(); 
            var number = $(this).val();
//                current = "#choosetype" + number;
                current = $(this).closest('li').find('ul:first');
                $(current).slideToggle();
                fnRadioCheck($(this));
                fnHideRadioNotCheck(); // $(current).slideDown();            
        });
    }); // end $(function(){
    
    function fnCheckIsReadyOpen(){
        $("input[name='choosetype']").each(function(){
            if($(this).is(':checked')){
                var parentLi = $(this).closest('li');
                if(parentLi.find('ul').eq(0).css('display')!='block'){
                    $(this).trigger('click');
                    return false;
                }
            }
        });
    }
    
    function fnHideRadioNotCheck(){
        $('.choose-list input:radio').each(function(){
            if(!$(this).is(':checked')){
                var parentLi = $(this).closest('li');
                if(parentLi.find('ul').eq(0).css('display')=='block'){
                    parentLi.find('ul').eq(0).slideToggle();
                    fnRadioUnCheck($(this));
                }
            }
        });
    }
    
    function fnRadioCheck(this_){ // this_ là radio check
        var parentLi = this_.closest('li');
        var SubUl = parentLi.find('ul').eq(0);
        var label = parentLi.find('.parent_lb').text()
        var zonechoosetype = this_.closest('.choose-list');
        var CheckAll = true;
        SubUl.find('input:checkbox').each(function(){
            if($(this).is(':checked')){
                CheckAll = false;
                return false;
            }
        });
        
        if(CheckAll){
            SubUl.find('input:checkbox').attr('checked', true);
            zonechoosetype.find('.choosed-text').html(label);
        }
    }
    
    function fnRadioUnCheck(this_){
        var parentLi = this_.closest('li');
        var SubUl = parentLi.find('ul').eq(0);
        SubUl.find('input:checkbox').attr('checked', false);
    }
    
    function fnCheckBoxClick(){
        $('.choose-list').each(function(){
            var div_wrap_type = $(this);
            $(this).find('input:checkbox').click(function(){
                var addPlus = false;
                var parentUl = $(this).closest('ul');
                var parentLi = parentUl.closest('li');
                parentUl.find('input:checkbox').each(function(){
                    if(!$(this).is(':checked')){
                        addPlus = true;
                        return false;
                    }
                });
                var label = parentLi.find('.parent_lb').text();
                if(addPlus){
                    label = label+' +';
                }
                div_wrap_type.find('.choosed-text').html(label);
            });
        }); // end $('.choose-list').each(function(){
    }
    
    $(document).mouseup(function (e)
    {
        var container = $("#zonechoosetype");

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            container.find(".sub-list").hide();
        }
    });
    
    /************* end for dropdown search property type */