<html>

    <head>
        <title>Creación de solicitud</title>
        <?php
        include 'head.php';
        ?>
        <script src="js/fileinput.js" type="text/javascript"></script>
        <script src="js/fileinput.min.js" type="text/javascript"></script>
        <script src="js/fileinput_locale_es.js" type="text/javascript"></script>
        <link href="css/fileinput.css" rel="stylesheet" type="text/css"/>
    </head>  
    <script>

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


    </script>
    <body>
        <?php
        include 'Menu.php';
        ?>  
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form">

                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="control-label">Nombre de la Solicitud</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Solicitud">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="inputPassword3" class="control-label">Descripción</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea class="form-control input-sm " type="textarea" id="message"
                                              placeholder="Descripción de la solicitud" maxlength="250" rows="7"></textarea>
                                    <span class="help-block">
                                        <p id="characterLeft" class="help-block ">Le quedan : 250 caracteres</p>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="control-label">Tipo de la Solicitud</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                        <option value="0" selected="">Seleccionar un tipo de solicitud</option>
                                        <option value="1">Hadware</option>
                                        <option value="2">Software</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2"> 
                                    <label for="inputEmail3" class="control-label">Adjuntar Archivos</label></div>
                                <div class="col-sm-10">
                                    <input id="input-ru" type="file" multiple=true class="file-loading">
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <br>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="form-control input-sm btn btn-success disabled"
                                                id="btnSubmit" name="btnSubmit" style="height:35px">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
        <script>
            $("#input-ru").fileinput({
                language: "es",
                uploadUrl: "http://localhost/site/file-upload-batch",
                allowedFileExtensions: ["jpg", "png", "gif"],
                minFileCount: 1,
                maxFileCount: 3

            });
        </script>       
    </body>
    <?php
    include 'pie.php';
    ?>


</html>