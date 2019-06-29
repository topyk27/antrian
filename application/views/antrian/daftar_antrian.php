<!DOCTYPE html>
<!--
Copyright 2015 Erik Nijenhuis <erik@xerdi.com>.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

     http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
-->
<html>
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#1a237e">

        <title>Daftar Antrian Sidang</title>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url('asset/material/material/css/ripples.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('asset/material/material/css/material-wfont.min.css') ?>" rel="stylesheet">

        <link href="<?php echo base_url('asset/material/css/flipper.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('asset/material/css/custom.css') ?>" rel="stylesheet">
        
    </head>
    <body>
        <input type="hidden" value="<?php echo $ruang; ?>" name="ruang_sidang" id="id_ruang">
        <div class="navbar navbar-inverse logo-pa">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
        </div>
        
        <div class="container">
            <div id="example-row" class="row">
                <div class="col-xs-12 col-md-3 full-card">
                    <div class="flip-card active-card">
                        <h1 align="center">Ruang Sidang 1</h1>
                        <div class="card label-info">
                            <h6 id="no_antrian"></h6>
                        </div>
                        <!-- <a href="javascript:void(0)" class="btn btn-primary btn-fab btn-raised icon-material-replay" id="first"></a> -->
                        <div class="well">
                            <h1 id="no_perkara"></h1>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-12 col-md-9 full-card">
                    <div class="flip-card active-card">
                        <h1 align="center">Daftar Antrian</h1>
                        <div class="card alert-success" style="height: 457px;">
                            <div class="col-md-13 table-responsive">
                                <table id="tabel_sidang" class="table table-bordered">
                                    <thead>
                                        <!-- <tr>
                                            <th scope="col" colspan="4" style="font-size: 2em;">Ruang Sidang 1</th>
                                        </tr> -->
                                        <tr>
                                            <th class="col-md-1" scope="col">NO. Antrian</th>
                                            <th class="col-md-2" scope="col">NO. Perkara</th>
                                            <th class="col-md-4" scope="col">Penggugat</th>
                                            <th class="col-md-4" scope="col">Tergugat</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tampil_data" style="text-align: center;">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>                
            </div>
        </div>
        
        <!--    JAVASCRIPT DEPENENCIES      -->
        
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <script src="<?php echo base_url('asset/material/material/js/ripples.min.js') ?>"></script>
        <script src="<?php echo base_url('asset/material/material/js/material.min.js') ?>"></script>
        
        <script src="<?php echo base_url('asset/material/js/flipper.js') ?>"></script>
        <script src="<?php echo base_url('asset/DataTables/datatables.min.js') ?>"></script>
        <script src="<?php echo base_url('asset/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') ?>"></script>
        <script src="<?php echo base_url('asset/js/daftar_antrian.js') ?>"></script>
        
        
        
    </body>
</html>
