$(document).ready(function(){
    $("#form").submit(function(e){
        e.preventDefault();
        var data=$("#form").serialize();
        $("#form_error").html("");
        $.ajax({
            url: $("#form").attr("action"),
            method: 'post',
            dataType: 'json',
            data: data,
            success: function(data){
                if(data.success){
                    $("#form").hide();
                    $("#form_thanks").fadeIn(200,function(){
                        setTimeout(function() {
                            $("#form").trigger('reset');
                            $("#form_thanks").hide();
                            $("#form").fadeIn(200);
                        }, 2000);
                    });
                }else{
                    for(var i in data.error){
                        $("#form_error").append("<p>"+data.error[i]+"</p>")
                    }
                }
            }
        });
    });
});