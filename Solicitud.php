<?php session_start(); ?>
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

    <body>
        <?php
        include 'Menu.php';
        ?>  
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form" id="FormSolicitud">

                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="control-label" >Nombre de la Solicitud</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control " id="inputEmail3" placeholder="Solicitud" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="inputPassword3" class="control-label">Descripción</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea class="form-control input-sm " type="textarea" id="message"
                                              placeholder="Descripción de la solicitud" maxlength="250" rows="7" required></textarea>
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
                                    <select class="form-control"  Id="Tipo" class="required">
                                        <option value="0" selected="">Seleccionar un tipo de solicitud</option>
                                        <option value="1">Software</option>
                                        <option value="2">Hardware</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="Software">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="control-label">Sub Tipo de la Solicitud</label>
                                </div>

                                <div class="col-sm-9">
                                    <select class="form-control" class="required">
                                        <option value="0" selected="">Seleccionar un  sub tipo de solicitud</option>
                                        <optgroup label="SALUD TOTAL">
                                            <option value="1">STAR</option>
                                            <option value="2">Analisis Seg.  Pendientes</option>
                                            <option value="3">Impresion Actas Masivas</option>
                                            <option value="4">Imagen</option>
                                            <option value="5">SIGSC</option>
                                            <option value="6">Consulta NAP</option>
                                        </optgroup>
                                        <optgroup label="CUENTAS MEDICAS">
                                            <option value="7">GADOR</option>
                                            <option value="8">ALEA</option>
                                            <option value="9">SIF</option>
                                            <option value="10">Consulta Volantes</option>
                                            <option value="11">Afirmo</option>                                                                                       
                                        </optgroup>
                                        <optgroup label="PORTAL SIGAME">
                                            <option value="12">CTC</option>
                                            <option value="13">Ambulatorio</option>
                                            <option value="14">Ecopetrol</option>
                                            <option value="15">Visitas</option>
                                            <option value="16">Call</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="Hardware">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="control-label">Sub Tipo de la Solicitud</label>
                                </div>

                                <div class="col-sm-9">
                                    <select class="form-control">
                                        <option value="0" selected="">Seleccionar un  sub tipo de solicitud</option>
                                        <option value="1">Perifericos</option>
                                        <option value="2">Mouse</option>
                                        <option value="2">Teclado</option>
                                        <option value="2">Pantalla</option>
                                        <option value="2">Torre</option>
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
                                        <button id="btnSubmit" type="submit" class="form-control input-sm btn btn-success disabled "
                                                name="btnSubmit" style="height:35px">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
        <table id="table-pagination" data-toggle="table" data-url="newjson.json" data-cache="false" data-height="299" data-height="400" data-pagination="true" data-search="true">
            <thead>
                <tr>
                    <th data-field="id">Item ID</th>
                    <th data-field="name">Item Name</th>
                    <th data-field="price">Item Price</th>
                </tr>
            </thead>
        </table>
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
    <link href="css/bootstrap-table.css" rel="stylesheet" type="text/css"/>
    <script src="js/bootstrap-table.js" type="text/javascript"></script>

</html>