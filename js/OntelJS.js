/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function centerModal() {
    $(this).css('display', 'block');
    var $dialog = $(this).find(".modal-dialog");
    var offset = ($(window).height() - $dialog.height()) / 2;
    // Center modal vertically in window
    $dialog.css("margin-top", offset);
}
$('.modal').on('show.bs.modal', centerModal);
$(window).on("resize", function () {
    $('.modal:visible').each(centerModal);
});
$(document).ready(function () {
    $("#message").keyup(function () {
        var max = 250;
        var len = $(this).val().length;
        if (len >= max) {
            $("#characterLeft").text("Ha llegado al límite");
        } else {
            $("#characterLeft").text("Le quedan : " + (max - len) + " caracteres");
        }
    });
});
$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
    $("#SolDes").css("display", "none");
    $("#Verifica").click(function () {
        if ($("#SolDes").css("display") == "none") {
            $("#icon-cambio").removeClass("fa fa-2x fa-fw fa-angle-double-down");
            $("#icon-cambio").addClass("fa fa-2x fa-fw fa-angle-double-up");
            $("#SolDes").css("display", "block");
        } else {
            $("#icon-cambio").removeClass("fa fa-2x fa-fw fa-angle-double-up");
            $("#icon-cambio").addClass("fa fa-2x fa-fw fa-angle-double-down");
            $("#SolDes").css("display", "none");
        }

    });
});
function Alert_Danger(mensaje) {
    $('#area_alertas').append(' <div class="alert alert-danger" role="alert"><strong>Peligro!  </strong>' + mensaje + '</div>');
    alertTimeout();
}

function Alert_Success(mensaje) {
    $('#area_alertas').append(' <div  class="alert alert-success" role="alert"><strong>Exitosamente!   </strong>' + mensaje + '</div>');
    alertTimeout();
}
function Alert_Info(mensaje) {
    $('#area_alertas').append(' <div class="alert alert-info" role="alert" > <strong>Aviso!  </strong>' + mensaje + '</div>');
    alertTimeout();
}
function Alert_Warning(mensaje) {
    $('#area_alertas').append(' <div class="alert alert-warning" role="alert"><strong>Advertencia!  </strong>' + mensaje + '</div>');
    alertTimeout();
}


function alertTimeout() {
    window.setTimeout(function () {
        $(".alert").fadeTo(1500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 1000);
}
$(function () {
    $('#login-form-link').click(function (e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function (e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
});
function InfoSoli(IdSolicitud)
{
    $.ajax({
        type: 'POST',
        url: './models/InfoSolicitud.php',
        data: "IdSolicitud=" + IdSolicitud,
        success: function (data)
        {
            $('#stack1').html(data);
        }
    });
}
function InfoUsuario(IdUsuario)
{
    $.ajax({
        type: 'POST',
        url: './models/InfoUsuario.php',
        data: "IdUsuario=" + IdUsuario,
        success: function (data)
        {
            $('.modal-content').html(data);
        }
    });
}






$(document).ready(function () {
    $("#Tipo").change(function () {
        if ($("#Tipo").val() != 0) {
            $("#btnSubmit").removeClass("disabled");
            $("#btnSubmit").addClass("active");
            //Sofware
            if ($("#Tipo").val() == 1) {
                $("#Software").css("display", "block");
                $("#Hardware").css("display", "none");
            }
//hadware
            if ($("#Tipo").val() == 2) {
                $("#Software").css("display", "none");
                $("#Hardware").css("display", "block");
            }
        } else {
            $("#btnSubmit").removeClass("active");
            $("#btnSubmit").addClass("disabled");
            $("#Software").css("display", "none");
            $("#Hadware").css("display", "none");
        }
    });
});


$('#all').click(function (e) {
    alert(123);
    var href = this.href;  
    e.preventDefault();  
    $.ajax({
        url: 'inicio.php',
        data: {some: data},
        success: function () {
            document.location = href;  // redirect browser to link
        }
    });
});
//$(document).ready(function () {
//    $("#all").click(function () {
//        window.location.replace("inicio.php");
//    })
//});