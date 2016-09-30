$(function(){
     $('.form-set .set-left .set-bottom a.look').click(function(){
         var htmlTmp = resolveEventFormView(formItemsJson, 0);
         $('body').addClass('modal-open');
         $('.modal').show();
         $('.modal fieldset').empty().append(htmlTmp);
     })
     
    function resolveEventFormView(items,index){
        var htmlTmp = "";
        if (items != null && items.length > 0) {
            var i = 0;
            var flagAddi = false;
            for (iii = 0; iii < items.length; iii++) {
                var tmpItem = items[iii];
                if(tmpItem.Type == 'input'){
                    htmlTmp += '<div class="control-group" style="margin-bottom:22px;">';
                    htmlTmp += '<label class="control-label" style="font-weight:bold;">'+tmpItem.Title+'</label>';
                    htmlTmp +='<div class="controls"><input class="input-xxlarge"  type="text" placeholder="'+tmpItem.Description+'"></div></div>';
                }else if(tmpItem.Type =='textarea'){
                    htmlTmp += '<div class="control-group" style="margin-bottom:22px;">';
                    htmlTmp +='<label class="control-label" style="font-weight:bold;">'+tmpItem.Title+'</label>';
                    htmlTmp +='<div class="controls"><textarea rows="10" cols="20" placeholder ="'+tmpItem.Description+'"></textarea>';
                    htmlTmp +='</div></div>';
                }else if(tmpItem.Type =='radio' || tmpItem.Type =='checkbox'){
                    if (tmpItem.Subitems != null && tmpItem.Subitems.length > 0) {
                        htmlTmp +='<div class="control-group controls-radio" style="margin-bottom:22px;">';
                        htmlTmp +='<label class="control-label" style="font-weight:bold;">'+tmpItem.Title+'</label>';
                        htmlTmp +='<div class="controls"></div></div>';
                        for(var j = 0 ; j<tmpItem.Subitems.length;j++){
                            htmlTmp +='<span><input type="'+ tmpItem.Type + '" value="' + tmpItem.Subitems[j].replace("\"", "\\\"").replace("\n", " ") + '" />&nbsp'+tmpItem.Subitems[j]+'</span>';
                        }
                    }
                }else if(tmpItem.Type =="select"){
                     if (tmpItem.Subitems != null && tmpItem.Subitems.length > 0) {
                        htmlTmp +='<div class="control-group controls-radio" style="margin-bottom:22px;">';
                        htmlTmp +='<label class="control-label" style="font-weight:bold;">'+tmpItem.Title+'</label>';
                        htmlTmp +='<div class="controls">';
                        htmlTmp +='<select name="items[' + index + '][' + i + '].Value">';
                        htmlTmp +='<option>请选择</option>';
                        for(var j=0; j<tmpItem.Subitems.length;j++){
                             htmlTmp +='<option value="' + tmpItem.Subitems[j].replace("\"", "\\\"").replace("\n", " ") + '">' + tmpItem.Subitems[j] +'</option>"';    
                        }
                        htmlTmp += '</select></div></div>';
                     }
                }
            }
        }
        return htmlTmp;
    }
        /*关闭弹框*/
    $('.modal button.close').click(function(){
        $('body').removeClass('modal-open');
        $('.modal .modal-body fieldset .control-group').remove();
        $('.modal').hide();
    })
    $('.modal .modal-footer a.btn-create-default').click(function(){
        $('body').removeClass('modal-open');
        $('.modal .modal-body fieldset .control-group').remove();
        $('.modal').hide();
    })
});
