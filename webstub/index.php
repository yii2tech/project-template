<?php
/**
 * This is a stub for the "web" folder, which should be used during site maintenance.
 *
 * > Note: avoid usage of the PHP code over this file as much as possible, do not use any PHP framework or library,
 *   which may be unavailable by default, also avoid usage of the materials linked via URLs: place CSS as in-line and
 *   images as base64-encoded.
 *
 * Example of base64-encoded image:
 *
 * ```html
 * <img alt="Embedded Image" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIA..." />
 * ```
 *
 */

header("HTTP/1.0 503 Service Unavailable");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyProject Temporary Unavailable</title>
    <style>
        html,
        body {
            background: #eef2f4;
            font-family: "open_sansregular", Helvetica, Arial, sans-serif;
            font-size: 13px;
            line-height: 1.42857143;
            color: #333333;
            padding: 0;
            margin: 0;
        }
        .site-error{
            position: absolute;
            top: 50%;
            height: 300px;
            margin-top: -150px;
            width: 100%;
            text-align: center;

        }

        .site-error .title{
            color: #545962;
            font-size: 26px;
            font-weight: normal;
        }

        @media (max-height: 340px){

            .site-error{
                position: relative;
                top: 0;
                margin-top: 20px;
                width: 100%;
                text-align: center;

            }
        }

    </style>
</head>
<body>
<div class="site-error-wrapp">
    <div class="site-error">
        <div class="container">
            <h1 class="title">Error 503 :)</h1>
            <p>MyProject is temporary unavailable.<br>
                Please, check up later.</p>
        </div>
    </div>
</div>
</body>
</html>
