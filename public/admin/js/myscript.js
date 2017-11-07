// mac dinh khi tai ve da co
$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });
});


// viet ham de khi hien thi loi 5s mat di
$(document).ready(function(){
   $("div.alert").delay(5000).slideUp();
});

// xac nhan xoa

function ConfirmDelete()
{
    var x = confirm("Are you sure you want to delete?");
    if (x)
        return true;
    else
        return false;
}

// tao nut bam them anh
$(document).ready(function () {
    $("#addImages").click(function () {
        $("#insert").append('<div class="form-group"><input type="file" name="fEditDetail[]"></div>')
    });
});

// nhan vao nut xoa

$(document).ready(function () {
    $("a#del_img_demo").on('click', function () {

        // tao dg dan
        //alert(111);
        // dg dan toi file xoa trong web.
         var url="http://localhost/OnlineShop/public/admin/product/delimg/";
         //alert(url);
        // luc nao cung phai lay token lam viec voi form, vi khi tac đông dênd form phải có token
        var _token= $("form[name='frmEditProduct']").find("input[name='_token']").val();
        //alert(_token);
        // lay id anh, img la anh

        var idHinh= $(this).parent().find("img").attr("idHinh");
        //alert(idHinh);
        // dg dan
         var img=$(this).parent().find("img").attr("src");
        //alert(img);
        var rid= $(this).parent().find("img").attr("id");
        //alert(rid);
         // bat dau xoa

        $.ajax({
            url:url + idHinh,
            type:'GET',
            cache:false,
            data:{"_token":_token, "idHinh":idHinh, "urlHinh":img},
            success:function (data) {
                if(data=="ok"){
                    $("#"+ rid).remove();
                }
                else{
                    alert("error!")
                }
            }

        });
    });
});