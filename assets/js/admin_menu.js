
function getXMLHTTP() { //fuction to return the xml http object
    var xmlhttp = false;
    try {
        xmlhttp = new XMLHttpRequest();
    }
    catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (e) {
            try {
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e1) {
                xmlhttp = false;
            }
        }
    }

    return xmlhttp;
}


function select_lang(lang_id,possition) {
    var baseurl = $("#baseurl").val();
    var strURL = baseurl + 'admin/menu/select_lang/'+lang_id+'/'+possition;
    var req = getXMLHTTP();
    if (req) {
        req.onreadystatechange = function () {
            if (req.readyState == 4) {
                // only if "OK"
                if (req.status == 200) {

                    document.getElementById('parent_menu').innerHTML = req.responseText;

                } else {
                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                }
            }
        }
        req.open("GET", strURL, true);
        req.send(null);
    }
}

//Script for getting the dynamic values from database using jQuery and AJAX
$(function () {
    $('#sc_get').change(function () {
        var baseurl = $("#baseurl").val();
        var form_data = {
            name: $('#sc_get').val(),lang:$('#lang').val()
        };
        $.ajax({
            url: baseurl+"admin/menu/get_subcat",
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function (rs) {
                show_cate(rs.cat,rs.lang);
            }
        });
    });
});

function show_cate(module,lang) {

    var baseurl = $("#baseurl").val();
    var strURL = baseurl + "admin/menu/cate_show/"+module+"/"+lang ;
    var req = getXMLHTTP();

    if (req) {

        req.onreadystatechange = function () {
            if (req.readyState == 4) {
                // only if "OK"
                if (req.status == 200) {

                    document.getElementById('sc_show').innerHTML = req.responseText;
                    menu_creat_url(module);
                } else {
                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                }
            }
        }
        req.open("GET", strURL, true);
        req.send(null);
    }
}

$(function () {
    $('#sc_show').change(function () {
        menu_creat_url($('#sc_get').val(), $(this).val());
    });
});

function menu_creat_url(module) {

    var baseurl = $("#baseurl").val();
    var form_data = {
        module:module,
        alias:$('#sc_show').val()
    };

    $('#url_menu').val('');

    $.ajax({
        url: baseurl + "admin/menu/get_iditem",
        type: 'POST',
        dataType: 'json',
        data: form_data,
        success: function (rs) {
            if(rs){
                $('#url_menu').val(rs.url);
            }
        },
        complete: function () {

        }
    });
}


