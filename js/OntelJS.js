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
    $('[data-toggle="popover"]').popover();
    $("#SolDes").css("display", "none");
    $("#Verifica").click(function () {
        console.log($("#SolDes").css("display"));
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
function emerCancelar() {
    $('#emerSeg').bPopup();
}
function NoEmerCancelar() {
    $('#emerSeg').bPopup().close();
}

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
          
            $('.modal-content').html(data);
            
        }
    });
}
