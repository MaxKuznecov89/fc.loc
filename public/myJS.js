$(function () {
    $(".orderHockers").click(function () {

        $.ajax({
            type: 'POST',
            url: '/main/test',
            data: {a:"data for server"},
            success: function(resp) {
               let hsuper = document.querySelector(".hsuper");
               hsuper.innerHTML=resp;
            }
        });
    });
});

