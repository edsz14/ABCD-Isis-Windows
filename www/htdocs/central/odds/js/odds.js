/*
function  show_controls(object, lang_param) {  
    alert(variable_fields.length);
    if (object.value == "") { 
        $('#button_submit').attr("disabled", true);        
        $('[id^="jv_error"]').hide();
        $('#optionals').html('');
    }
    else {        
        $('#button_submit').attr("disabled", false);
        $.ajax({
            url: 'lib/show_controls.php',
            data: {
                content : object.value,
                lang : lang_param
            },
            cache: false,
            type: 'post',
            success: function (data) {
                $('#optionals').html('');
                $('[id^="jv_error"]').hide();

                $.each($.parseJSON(data), function(key,value) {
                    $('#optionals').append(value);
                });
                // recorrer para setear valores!
                $("[data-jv]").keyup(function() {
                    check_field(this);
                });
                $("[data-jv]").bind("input", function(){
                    check_field(this);
                })
            }
        });
    }       
}
*/
function sendForm() { 
    // si es un sar
    /*
    document.getElementById('common_error').style.display = 'none';
    alert(document.getElementById('referer').value);
    if (document.getElementById('referer').value =='sar') {
        
        var init_page = document.getElementById('tag020').value;
        var title = document.getElementById('tag012').value;
        if ( (trim(title) == "") && (trim(init_page) == "")) {
            document.getElementById('common_error').style.display = 'block';
            return false;
        } else {
            document.getElementById('common_error').style.display = 'none';
            document.forma1.action="process_odds.php";
            document.forma1.submit();
        }
    } else {
        document.forma1.action="process_odds.php";
        document.forma1.submit();
    }
    */
    document.forma1.action="process_odds.php";
    document.forma1.submit();
}

function newPopup(url, w, h) {    
    popupWindow = window.open(
    url, 'popUpWindow', 'height='+h+',width='+w+',left=1,top=1,resizable=yes,scrollbars=yes,directories=no,titlebar=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')
}


/**********************************************************************/
function trim (myString) {
    return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
}    

	function cleanForm() {        
        $('[id^="jv_error"]').hide(); 
        //document.getElementById("level").onchange();
        _cleanForm();        
    }

    function _cleanForm() {
        form = document.getElementById('forma1');
        //i = 1;

        $(':input', form).each(function() {

            var type = this.type;
            var tag = this.tagName.toLowerCase(); // normalize case
            var tagId = $(this).attr('id').toLowerCase(); // normalize case
            
            
            //if (tagId.substring(0, 3) == 'tag') {

                // it's ok to reset the value attr of text inputs,
                // password inputs, and textareas
                if (type == 'text' || type == 'password') {
                    if (!$(this).attr('readonly')) { 
                        this.value = "";
                    }
                }
                else if (type == 'textarea') {
                    //alert(this.value);
                    this.value='';
                    document.getElementById("comments").value = "";
                }

                // checkboxes and radios need to have their checked state cleared
                // but should *not* have their 'value' changed

                else if (type == 'checkbox' || type == 'radio')
                    this.checked = false;
                
                // select elements need to have their 'selectedIndex' property set to -1
                // (this works for both single and multiple select elements)
                else if (tag == 'select')
                    this.selectedIndex = -1;
            //}
        });
  };


function check(last) {
    var el = document.getElementById("select_other");
    var str = el.options[el.selectedIndex].value;
    //if(str == "others") {
    if(str == last) {
        show();
    }else {
        hide();
    }
}

function hide(){
    document.getElementById('other').style.visibility='hidden';
}
function show(){
    document.getElementById('other').style.visibility='visible';
}


function check_category_combo() {    
    var el = document.getElementById("category");
    var str = el.options[el.selectedIndex].value;
    if(str == "XX") {
        show_category_combo();
    }else {
        hide_category_combo();
    }
}
function hide_category_combo() {
    document.getElementById('category_other').style.visibility='hidden';
}
function show_category_combo() {
    document.getElementById('category_other').style.visibility='visible';
}

    function check_field(check) { 
        jv_cur_check = check;        
        if($(jv_cur_check).next().attr("id") == "jv_error") {
            $(jv_cur_check).next().remove();
        }
        var check_arr = $(jv_cur_check).attr('data-jv').split(" ")        
        for(i in check_arr) {
            var error = "";
            var func_name = check_arr[i].match(/^\w+/);
            var params = check_arr[i].substr(String(func_name).length+1);
            params = params.substr(0, params.length-1)
            if(error = eval("jv."+func_name).call(undefined, eval("params"))){ 
                $(jv_cur_check).after(jv_err_open+error+jv_err_close); 
                return;
            }
        }        
    }

function VerDocumentoSA(Base, Parameters) {
    
    msgwin=window.open("","AEUDOC","width=400,height=280,resizable");
    msgwin.focus();
    /*document.verdocumento.mfn.value=Mfn
    document.verdocumento.lang.value=Lang;
    document.verdocumento.occ.value=Occ;
    */
    //document.verdocumentoSA.sa.value='sa';
    //alert("sa");ion 
    /*
    
    Action || ( Action = '')
    if (Action != '') {
        Base = Base.concat("|");
        Base = Base.concat(Action);
    }   
    Parameters || (Parameters = '')
    if (Parameters != '') {
        Base = Base.concat("|");
        Base = Base.concat(Parameters);
    }*/
    //document.getElementById('base').value=Base;
    document.getElementById('sa').value = 'sa';
    document.getElementById('parametersODDS').value = Parameters;
    document.getElementById('base').value = Base;
    document.getElementById('verdocumentoSA').submit();
}