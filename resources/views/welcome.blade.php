<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image" href="../../logo.png" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <title>API | BoilerConnect</title>
        <style>
            body {
                background-color: #1a202c;
                color: white;
                font-family: var(--bs-body-font-family);
                font-size: var(--bs-body-font-size);
                font-weight: var(--bs-body-font-weight);
                line-height: var(--bs-body-line-height);
            }
            .content {
                background-color: #4a5568;
                border-radius: 5px;
                padding: 15px;
                margin: 2% 25%;
                box-shadow: rgb(0 0 0 / 10%) 0px 4px 12px;
            }
            .app-information {
                margin: 0 25%;
                margin-top: 10px;
                padding: 0 1%;
            }
        </style>
    </head>
    <body>
        <div class="row g-0">
            <div class="col-12" style="display: flex;justify-content: center;">
                <img src="../../public/logo.png">
            </div>
        </div>
        <div class="content">
            <div class="row g-0">
                <div class="col-12 text-center">
                    <h1>BoilerConnect</h1>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="row g-0">
                <div class="col-12 text-center">
                    <h4>Documentation</h4>
                    <a href="https://github.com/AimFried/boilerconnect_web">Configuration</a><br >
                </div>
                <div class="col-12 text-center">
                    <h4>Supports disponibles</h4>
                    <a href="https://github.com/AimFried/boilerconnect_web">Interface Web</a><br >
                    <a href="https://github.com/AimFried/boilerconnect_apk">Application Mobile(Android)</a>
                </div>
            </div>
        </div>
        <div class="app-information">
           <p style="float: right;">Boilerconnect v1.0.0</p>
           <p style="float: left;">Laravel v{{ app()->version() }}</p>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>
