$(document).ready(function ()
{
    $("form.niceform").submit(function () {
        retrunform = true;
        var validar = $(this).find(".validar").get();
        for (var i = 0; i < validar.length; i++)
        {
            if ($(validar[i]).val() == "")
            {
                $(validar[i]).css("border", "2px solid red")
                retrunform = false;
            } else
            {
                if ($(validar[i]).hasClass("email"))
                {
                    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($(validar[i]).val()))
                    {
                        $(validar[i]).css("border", "2px solid red");
                        retrunform = false;
                    } else
                        $(validar[i]).css("border", "")
                } else
                {
                    if ($(validar[i]).hasClass("alfanumerico"))
                    {
                        if (!/^[A-Za-z0-9 .]+$/i.test($(validar[i]).val()))
                        {
                            $(validar[i]).css("border", "2px solid red");
                            retrunform = false;
                        } else
                            $(validar[i]).css("border", "")
                    } else
                    {
                        if ($(validar[i]).hasClass("numeric"))
                        {
                            if (!/^(?:\+|-)?\d+$/.test($(validar[i]).val()))
                            {
                                $(validar[i]).css("border", "2px solid red");
                                retrunform = false;
                            } else
                                $(validar[i]).css("border", "")
                        } else
                            $(validar[i]).css("border", "")
                    }
                }
            }
        }

        return retrunform;

    });

    $("#accordion").accordion();

    $("#dialog-confirm").dialog({
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        buttons: {
            "Buscar": function () {
                $(this).dialog("close");
            }
        }
    });

    $(".calendario").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        showOn: "button",
        buttonImage: "images/calendar.gif",
        buttonImageOnly: true,
        yearRange: '1920:',
        buttonText: "Seleccionar"
    });

    $(".calendario").focusout(function () {
        if (!$(this).val().match(/^([0-9]{4}\-[0-9]{2}\-[0-9]{2})$/)) {
            $(this).val("");
        }
    });

    $('.numeric').keyup(function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $(".email").focusout(function () {
        if (!$(this).val().match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)) {
            $(this).val("");
        }
    });

    $(".email_validar_padre").focusout(function () {
        if ($("#id_padre").val() == "")
        {
            if($("#email_acudiente").val()==$("#email_padre").val())
            {
                if($(this).val()!="")
                {
                    $(this).val("");
                    alert("El email del Acudiente (Padre o Madre) no puede ser igual que el email del Acudiente");
                }
            }
            else
            {
                $.post("index.php?controlador=Matricula&accion=verifica_email", {
                    email: $(this).val()
                }, function (data) {
                    if (data == "1")
                    {
                        $(".email_validar_padre").val("");
                        alert("El email que intenta ingresar, ya se encuentra registrado en el sistema");
                    }
                });
            }                        
        }
    });

    $(".email_validar_acudiente").focusout(function () {
        if ($("#id_acudiente").val() == "")
        {
            if($("#email_acudiente").val()==$("#email_padre").val())
            {
                if($(this).val()!="")
                {
                    $(this).val("");
                    alert("El email del Acudiente (Padre o Madre) no puede ser igual que el email del Acudiente");
                }
            }
            else
            {            
                $.post("index.php?controlador=Matricula&accion=verifica_email", {
                    email: $(this).val()
                }, function (data) {
                    if (data == "1")
                    {
                        $(".email_validar_acudiente").val("");
                        alert("El email que intenta ingresar, ya se encuentra registrado en el sistema");
                    }
                });
            }
        }
    });



    $("#numero_documento").focusout(function () { 
            $.post("index.php?controlador=Matricula&accion=verifica_matricula", {
                numero_documento: $(this).val(),
                tipo_documento: $("#tipo_documento").val(),
                anio:$("#anio").val()
            }, function (data) {
                if (data == "1")
                {
                    $("#numero_documento").val("");
                    alert("El tipo de documento y numero de documento que intenta ingresar, ya se encuentra matriculado para este año");
                }
            });
            
            /*
            if ($("#id").length <= 0)
            {
                $.post("index.php?controlador=Matricula&accion=verifica_usuario", {
                    numero_documento: $(this).val(),
                    tipo_documento: $("#tipo_documento").val()
                }, function (data) {
                    if (data == "1")
                    {
                        $("#numero_documento").val("");
                        alert("El tipo de documento y numero de documento que intenta ingresar, ya se encuentra como usuario registrado");
                    }
                });
            }
            */
    });

    $("#tipo_documento").change(function () {
            $.post("index.php?controlador=Matricula&accion=verifica_matricula", {
                numero_documento: $("#numero_documento").val(),
                tipo_documento: $(this).val()
            }, function (data) {
                if (data == "1")
                {
                    $("#numero_documento").val("");
                    alert("El tipo de documento y numero de documento que intenta ingresar, ya se encuentra matriculado para este año");
                }
            });
        if ($("#id").length <= 0)
        {
            $.post("index.php?controlador=Matricula&accion=verifica_usuario", {
                numero_documento: $("#numero_documento").val(),
                tipo_documento: $(this).val()
            }, function (data) {
                if (data == "1")
                {
                    $("#numero_documento").val("");
                    alert("El tipo de documento y numero de documento que intenta ingresar, ya se encuentra como usuario registrado");
                }
            });
        }
    });

    $("#tipo_documento_padre").change(function () {

        $.post("index.php?controlador=Matricula&accion=buscar_padre", {
            numero_documento: $("#numero_documento_padre").val(),
            tipo_documento: $(this).val()
        }, function (data) {
            if (data == "1")
            {
                $("#primer_nombre_padre").val("");
                $("#segundo_nombre_padre").val("");
                $("#primer_apellido_padre").val("");
                $("#segundo_apellido_padre").val("");
                $("#fecha_nacimiento_padre").val("");
                $("#celular_padre").val("");
                $("#telefono_padre").val("");
                $("#ubicacion_padre").val("");
                $("#rh_padre").val("");
                $("#email_padre").val("");
                $("#id_padre").val("");
            } else
            {
                var types = JSON.parse(data);
                $("#id_padre").val(types["id"]);
                $("#primer_nombre_padre").val(types["primer_nombre"]);
                $("#segundo_nombre_padre").val(types["segundo_nombre"]);
                $("#primer_apellido_padre").val(types["primer_apellido"]);
                $("#segundo_apellido_padre").val(types["segundo_apellido"]);
                $("#fecha_nacimiento_padre").val(types["fecha_nacimiento"]);
                $("#celular_padre").val(types["celular"]);
                $("#telefono_padre").val(types["telefono"]);
                $("#ubicacion_padre").val(types["ubicacion"]);
                $("#rh_padre").val(types["rh"]);
                $("#email_padre").val(types["usuario"]);
                var value_radio = types["genero"];
                var value_ciudad = types["ciudad_nacimiento"];
                var value_barrio = types["barrio"];
                $('input[id=genero_padre][value=' + value_radio + ']').attr('checked', 'checked');
                $("#ciudad_nacimiento_padre option[value=" + value_ciudad + "]").attr("selected", true);
                $("#barrio_padre option[value=" + value_barrio + "]").attr("selected", true);
            }
        });
    });

    $("#numero_documento_padre").focusout(function () {

        $.post("index.php?controlador=Matricula&accion=buscar_padre", {
            numero_documento: $(this).val(),
            tipo_documento: $("#tipo_documento_padre").val()
        }, function (data) {
            if (data == "1")
            {
                $("#primer_nombre_padre").val("");
                $("#segundo_nombre_padre").val("");
                $("#primer_apellido_padre").val("");
                $("#segundo_apellido_padre").val("");
                $("#fecha_nacimiento_padre").val("");
                $("#celular_padre").val("");
                $("#telefono_padre").val("");
                $("#ubicacion_padre").val("");
                $("#rh_padre").val("");
                $("#email_padre").val("");
                $("#id_padre").val("");
            } else
            {
                var types = JSON.parse(data);
                $("#id_padre").val(types["id"]);
                $("#primer_nombre_padre").val(types["primer_nombre"]);
                $("#segundo_nombre_padre").val(types["segundo_nombre"]);
                $("#primer_apellido_padre").val(types["primer_apellido"]);
                $("#segundo_apellido_padre").val(types["segundo_apellido"]);
                $("#fecha_nacimiento_padre").val(types["fecha_nacimiento"]);
                $("#celular_padre").val(types["celular"]);
                $("#telefono_padre").val(types["telefono"]);
                $("#ubicacion_padre").val(types["ubicacion"]);
                $("#rh_padre").val(types["rh"]);
                $("#email_padre").val(types["usuario"]);
                var value_radio = types["genero"];
                var value_ciudad = types["ciudad_nacimiento"];
                var value_barrio = types["barrio"];
                $('input[id=genero_padre][value=' + value_radio + ']').attr('checked', 'checked');
                $("#ciudad_nacimiento_padre option[value=" + value_ciudad + "]").attr("selected", true);
                $("#barrio_padre option[value=" + value_barrio + "]").attr("selected", true);
            }
        });
    });

    $("#tipo_documento_acudiente").change(function () {

        $.post("index.php?controlador=Matricula&accion=buscar_padre", {
            numero_documento: $("#numero_documento_acudiente").val(),
            tipo_documento: $(this).val()
        }, function (data) {
            if (data == "1")
            {
                $("#primer_nombre_acudiente").val("");
                $("#segundo_nombre_acudiente").val("");
                $("#primer_apellido_acudiente").val("");
                $("#segundo_apellido_acudiente").val("");
                $("#fecha_nacimiento_acudiente").val("");
                $("#celular_acudiente").val("");
                $("#telefono_acudiente").val("");
                $("#ubicacion_acudiente").val("");
                $("#rh_acudiente").val("");
                $("#email_acudiente").val("");
                $("#id_acudiente").val("");
            } else
            {
                var types = JSON.parse(data);
                $("#id_acudiente").val(types["id"]);
                $("#primer_nombre_acudiente").val(types["primer_nombre"]);
                $("#segundo_nombre_acudiente").val(types["segundo_nombre"]);
                $("#primer_apellido_acudiente").val(types["primer_apellido"]);
                $("#segundo_apellido_acudiente").val(types["segundo_apellido"]);
                $("#fecha_nacimiento_acudiente").val(types["fecha_nacimiento"]);
                $("#celular_acudiente").val(types["celular"]);
                $("#telefono_acudiente").val(types["telefono"]);
                $("#ubicacion_acudiente").val(types["ubicacion"]);
                $("#rh_acudiente").val(types["rh"]);
                $("#email_acudiente").val(types["usuario"]);
                var value_radio = types["genero"];
                var value_ciudad = types["ciudad_nacimiento"];
                var value_barrio = types["barrio"];
                $('input[id=genero_acudiente][value=' + value_radio + ']').attr('checked', 'checked');
                $("#ciudad_nacimiento_acudiente option[value=" + value_ciudad + "]").attr("selected", true);
                $("#barrio_acudiente option[value=" + value_barrio + "]").attr("selected", true);
            }
        });
    });

    $("#numero_documento_acudiente").focusout(function () {

        $.post("index.php?controlador=Matricula&accion=buscar_padre", {
            numero_documento: $(this).val(),
            tipo_documento: $("#tipo_documento_acudiente").val()
        }, function (data) {
            if (data == "1")
            {
                $("#primer_nombre_acudiente").val("");
                $("#segundo_nombre_acudiente").val("");
                $("#primer_apellido_acudiente").val("");
                $("#segundo_apellido_acudiente").val("");
                $("#fecha_nacimiento_acudiente").val("");
                $("#celular_acudiente").val("");
                $("#telefono_acudiente").val("");
                $("#ubicacion_acudiente").val("");
                $("#rh_acudiente").val("");
                $("#email_acudiente").val("");
                $("#id_acudiente").val("");
            } else
            {
                var types = JSON.parse(data);
                $("#id_acudiente").val(types["id"]);
                $("#primer_nombre_acudiente").val(types["primer_nombre"]);
                $("#segundo_nombre_acudiente").val(types["segundo_nombre"]);
                $("#primer_apellido_acudiente").val(types["primer_apellido"]);
                $("#segundo_apellido_acudiente").val(types["segundo_apellido"]);
                $("#fecha_nacimiento_acudiente").val(types["fecha_nacimiento"]);
                $("#celular_acudiente").val(types["celular"]);
                $("#telefono_acudiente").val(types["telefono"]);
                $("#ubicacion_acudiente").val(types["ubicacion"]);
                $("#rh_acudiente").val(types["rh"]);
                $("#email_acudiente").val(types["usuario"]);
                var value_radio = types["genero"];
                var value_ciudad = types["ciudad_nacimiento"];
                var value_barrio = types["barrio"];
                $('input[id=genero_acudiente][value=' + value_radio + ']').attr('checked', 'checked');
                $("#ciudad_nacimiento_acudiente option[value=" + value_ciudad + "]").attr("selected", true);
                $("#barrio_acudiente option[value=" + value_barrio + "]").attr("selected", true);
            }
        });
    });





});

