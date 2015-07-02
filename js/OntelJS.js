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
    alertTimeout(2500);
}
function Alert_Success(mensaje) {
    $('#area_alertas').append(' <div  class="alert alert-success" role="alert"><strong>Exitosamente!   </strong>' + mensaje + '</div>');
    alertTimeout(1500);
}
function Alert_Info(mensaje) {
    $('#area_alertas').append(' <div class="alert alert-info" role="alert" > <strong>Aviso!  </strong>' + mensaje + '</div>');
    alertTimeout(1500);
}
function Alert_Warning(mensaje) {
    $('#area_alertas').append(' <div class="alert alert-warning" role="alert"><strong>Advertencia!  </strong>' + mensaje + '</div>');
    alertTimeout(5500);

}


function alertTimeout(tiempo) {
    window.setTimeout(function () {
        $(".alert").fadeTo(tiempo, 0).slideUp(500, function () {
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
function TablaSolicitudes(Ticket)
{
    if (Ticket !== null) {
        $.ajax({
            type: 'POST',
            url: 'controls/TablaSolicitudes.php',
            data: "ticket=" + Ticket,
            success: function (data)
            {
                $('#TablaSolicitud').html(data);
            }
        });
    } else {
        $.ajax({
            url: 'controls/TablaSolicitudes.php',
            success: function (data)
            {
                $('#tablaSolicitudes').html(data);
            }
        });

    }

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
            //Sofware
            if ($("#Tipo").val() == 1) {
                if ($("#selectSoftware").val() !== 0) {
                    $("#btnSubmit").removeClass("disabled");
                    $("#btnSubmit").addClass("active");
                }
                if ($("#selectSoftware").val() == 0) {
                    $("#btnSubmit").removeClass("active");
                    $("#btnSubmit").addClass("disabled");
                }
                $("#Software").css("display", "block");
                $("#Hardware").css("display", "none");
            }
            //Hardware
            if ($("#Tipo").val() == 2) {
                if ($("#selectHardware").val() !== 0) {
                    $("#btnSubmit").removeClass("disabled");
                    $("#btnSubmit").addClass("active");
                }
                if ($("#selectHardware").val() == 0) {
                    $("#btnSubmit").removeClass("active");
                    $("#btnSubmit").addClass("disabled");
                }
                $("#Software").css("display", "none");
                $("#Hardware").css("display", "block");
            }
        } else {
            $("#Software").css("display", "none");
            $("#Hardware").css("display", "none");
            $("#btnSubmit").removeClass("active");
            $("#btnSubmit").addClass("disabled");
        }
    });
    //Activa el boton siempre y cuando seleccione un sub tipo de solicitud de software
    $("#selectSoftware").change(function () {
        if ($("#selectSoftware").val() !== 0) {
            $("#btnSubmit").removeClass("disabled");
            $("#btnSubmit").addClass("active");
        }
        if ($("#selectSoftware").val() == 0) {
            $("#btnSubmit").removeClass("active");
            $("#btnSubmit").addClass("disabled");
        }
    }
    );
    $("#selectHardware").change(function () {
        if ($("#selectHardware").val() !== 0) {
            $("#btnSubmit").removeClass("disabled");
            $("#btnSubmit").addClass("active");
        }
        if ($("#selectHardware").val() == 0) {
            $("#btnSubmit").removeClass("active");
            $("#btnSubmit").addClass("disabled");
        }
    }
    );

    $("#selTypeRol").change(function () {

        if ($("#selTypeRol").val() !== 0 && $("#selTypeGroup").val() !== 0) {
            $("#EnviarUsu").removeClass("disabled");
            $("#EnviarUsu").addClass("active");
        }
        if ($("#selTypeRol").val() == 0 || $("#selTypeGroup").val() == 0) {
            $("#EnviarUsu").removeClass("active");
            $("#EnviarUsu").addClass("disabled");
        }
    }
    );
    $("#selTypeGroup").change(function () {
        if ($("#selTypeRol").val() !== 0 && $("#selTypeGroup").val() !== 0) {
            $("#EnviarUsu").removeClass("disabled");
            $("#EnviarUsu").addClass("active");
        }
        if ($("#selTypeRol").val() == 0 || $("#selTypeGroup").val() == 0) {
            $("#EnviarUsu").removeClass("active");
            $("#EnviarUsu").addClass("disabled");
        }
    }
    );
});

$('#all').click(function (e) {
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
$('#btnSubmitUsu').click(function (e) {
    if ($("#selTypeGroup").val() == 0 || $("#selTypeRol").val() == 0) {
        Alert_Danger("El Grupo y el Rol del Usuario Son obligatorios");
        return
    }
});

$(function () {
    $('.view-pdf').on('click', function () {
        var pdf_link = $(this).attr('href');
        var iframe = '<object data="./uploadTicket/' + pdf_link + '" type="image/jpg">';
        $('#nameFile').html(pdf_link);
        $('.iframe-container').html(iframe);

    });
})

function file(file) {

    $url = "controls/download_file.php?archivo=../uploadTicket/" + file;
    $.ajax({
        type: 'GET',
        url: $url,
        success: function (data) {
            if (data == true) {
                alert('El archivo no se encuentra disponible \n Comuniquese con su administrador.');
            } else {
                window.location = "" + $url + "";
            }
        }

    });
}
       