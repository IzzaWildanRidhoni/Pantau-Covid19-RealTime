<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
    
    .box{
        padding:30px 40px;
        border-radius:5px;
    }
    </style>

    <title>Pantau Penyebaran virus Corona</title>
  </head>
  <body>

    <div class="jumbotron jumbotron-fluid bg-primary text-light">
        <div class="container">
            <h1 class="display-4">Corona Virus</h1>
            <p class="lead">
                <h2>Pantau Penyebaran Covid 19 Di Dunia secara real Time</h2><br>mari bersama menjaga kesehatan
            </p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="text-light bg-danger box">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Positif</h5>
                        <h2 id="data-kasus">1234</h2>
                        <h5>orang</h5>
                    </div>
                    <div class="col-md-4">
                        <img src="img/sad.svg" alt="" width="100px">
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-light bg-info box">
                <div class="row">
                    <div class="col-md-6">
                        <h5>meninggal</h5>
                        <h2 id="data-mati">1234</h2>
                        <h5>orang</h5>
                    </div>
                    <div class="col-md-4">
                        <img src="img/cry.svg" alt="" width="100px">
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-light bg-success box">
                <div class="row">
                    <div class="col-md-6">
                        <h5>sembuh</h5>
                        <h2 id="data-sembuh">1234</h2>
                        <h5>orang</h5>
                    </div>
                    <div class="col-md-4">
                        <img src="img/happy.svg" alt="" width="100px">
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="text-light bg-primary mt-3 box">
                <div class="row">
                    <div class="col-md-3">
                        <h2>Indonesia</h2>
                        <h5 id="data-id">
                        Positif :12 orang <br>
                        meninggal :20 orang <br>
                        sembuh  :3 orang
                        </h5>
                    </div>
                    <div class="col-md-4">
                        <img src="img/indonesia.svg" alt="" width="100px">
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header bg-danger text-light">
                <b>Data Kasus Virus Corona di Indonesia</b>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <th>No.</th>
                        <th>Nama Provinsi</th>
                        <th>Positif</th>
                        <th>sembuh</th>
                        <th>meninggal</th>
                    </thead>
                    <tbody id="table-data">

                    </tbody>
                </table>
            </div>
        </div>

    </div>



    <footer class="bg-primary text-center text-light mt-3 p-5">
        Create By izza WIldan Ridhoni
    </footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function(){
            
            //panggil fungsi semua data  global
            semuaData();
            dataNegara();
            dataProvinsi();

            //untuk refres otomatis
            setInterval(function() {
                dataProvinsi();
                semuaData();
                dataNegara();
            },3000);


            function semuaData() {
                $.ajax({
                    url:'https://coronavirus-19-api.herokuapp.com/all',
                    success :function(data) {
                        try {
                            var json =data;
                            var kasus =data.cases;
                            var meninggal=data.deaths;
                            var sembuh=data.recovered;

                            $('#data-kasus').html(kasus);
                            $('#data-mati').html(meninggal);
                            $('#data-sembuh').html(sembuh);
                        } catch {
                            alert('eror');
                        }
                    }
                });
            }
            function dataNegara() {
                $.ajax({
                    url:'https://coronavirus-19-api.herokuapp.com/countries',
                    success :function(data) {
                        try {
                            var json =data;
                            var html=[];

                            if(json.length >0){
                                var i;
                                for(i=0;i<json.length;i++){
                                    var dataNegara =json[i];
                                    var namaNegara =dataNegara.country;

                                    if(namaNegara==='Indonesia'){
                                        var kasus=dataNegara.cases;
                                        var mati=dataNegara.deaths;
                                        var sembuh=dataNegara.recovered;
                                        
                                        $('#data-id').html(
                                            'positif :'+kasus+' orang <br> Meninggal :'+mati+' Orang <br> Sembuh :'+sembuh+' orang'
                                        )

                                    }
                                }
                            }
                        } catch {
                            alert('eror');
                        }
                    }
                });
            }
            function dataProvinsi() {
                $.ajax({
                    url:'curl.php',
                    type:'GET',
                    success :function(data) {
                        try {
                            $('#table-data').html(data);
                        } catch {
                            alert('eror');
                        }
                    }
                });
            }

        });
    </script>
  </body>
</html>