
function base_url(){
    return $('#baseurl').val();
}
function handleFiles() {
    var filesToUpload = document.getElementById('input_img').files;
    var file = filesToUpload[0];

    // Create an image
    var img = document.createElement("img");
    // Create a file reader
    var reader = new FileReader();
    // Set the image once loaded into file reader
    reader.onload = function (e) {
        img.src = e.target.result;

        var canvas = document.createElement("canvas");
        //var canvas = $("<canvas>", {"id":"testing"})[0];
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0);

        var MAX_WIDTH = 4000;
        var MAX_HEIGHT = 4000;
        var width = img.width;
        var height = img.height;

        if (width > height) {
            if (width > MAX_WIDTH) {
                height *= MAX_WIDTH / width;
                width = MAX_WIDTH;
            }
        } else {
            if (height > MAX_HEIGHT) {
                width *= MAX_HEIGHT / height;
                height = MAX_HEIGHT;
            }
        }
        canvas.width = width;
        canvas.height = height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, width, height);

        var dataurl = canvas.toDataURL("image/png");
        document.getElementById('image_review').src = dataurl;
    }
    // Load files into file reader
    reader.readAsDataURL(file);


    // Post the data
    /*
     var fd = new FormData();
     fd.append("name", "some_filename.jpg");
     fd.append("image", dataurl);
     fd.append("info", "lah_de_dah");
     */
}
$('#image_review').click(function(){
    $('#input_img').click();
})

function createAlias(name)
{
    var str = $(name).val();
    // chuyển chuỗi sang chữ thường để xử lý
    str= str.toLowerCase();
    /* tìm kiếm và thay thế tất cả các nguyên âm có dấu sang không dấu*/
    str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");

    str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");

    str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");

    str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");

    str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");

    str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");

    str= str.replace(/đ/g,"d");

    str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-");

    /* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */

    str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1-

    str= str.replace(/^\-+|\-+$/g,"");//cắt bỏ ký tự - ở đầu và cuối chuỗi

    document.getElementById("alias").value = str;// xuất kết quả xữ lý ra keyword
}
function getModalPrice(id)
{
    $("#myModal").remove();
    $.ajax({
        url:base_url() + 'admin/product/price',
        dataType:"html",
        type:"POST",
        data:{id:id},
        success:function(res){
            $('body').append(res);
            $("#myModal").modal();
        }
    });
}

function updatePrice(){
    if($('#priceform').validationEngine('validate')){
        $.ajax({
            url:base_url() + 'admin/product/updatePrice',
            dataType:"html",
            type:"POST",
            data:{id:$('#id_item').val(),price0:$('#price0').val(),price1:$('#price1').val(),price2:$('#price2').val(),price3:$('#price3').val(),price4:$('#price4').val(),price5:$('#price5').val(),price6:$('#price6').val(),day1:$('#day1').val(),day2:$('#day2').val(),day3:$('#day3').val(),day4:$('#day4').val(),day5:$('#day5').val(),day0:$('#day0').val(),day6:$('#day6').val()},
            success:function(res){
                alert('Bạn đã cập nhật thành công');
                location.reload();
            }
        });
    }
}
function DoCheck(status,FormName,from_)
{
    var alen=eval('document.'+FormName+'.elements.length');
    alen=(alen>1)?eval('document.'+FormName+'.checkone.length'):0;
    if (alen>0)
    {
        for(var i=0;i<alen;i++)
            eval('document.'+FormName+'.checkone[i].checked=status');
    }
    else
    {
        eval('document.'+FormName+'.checkone.checked=status');
    }
    if(from_>0)
        eval('document.'+FormName+'.checkall.checked=status');
}

function DoCheckOne(FormName)
{
    var alen=eval('document.'+FormName+'.elements.length');
    var isChecked=true;
    alen=(alen>1)?eval('document.'+FormName+'.checkone.length'):0;
    if (alen>0)
    {
        for(var i=0;i<alen;i++)
            if(eval('document.'+FormName+'.checkone[i].checked==false'))
                isChecked=false;
    }
    else
    {
        if(eval('document.'+FormName+'.checkone.checked==false'))
            isChecked=false;
    }
    eval('document.'+FormName+'.checkall.checked=isChecked');
}
function ActionDelete(formName)
{
    var $check = false;
    jQuery("input[name='checkone[]']").each(function(){
        if($(this).is(':checked')){
            $check = true;
        }
    });
    if($check == false){
        alert('Bạn chưa chọn mục nào để xóa');
    }
    else{
        if(confirm('Bạn có chắc chắn muốn xóa không ?')){
            eval('document.' + formName + '.submit();');
        }
    }
}
