<?php
require_once('includes/providerGet.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Vergelijker design</title>
        <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/css/style.css">

        <!-- External Javascript files -->
        <script type="text/javascript" src="/js/jquery.js"></script>
        <script type="text/javascript" src="/js/filterSliders.js"></script>
        <script type="text/javascript" src="/js/packageHandler.js"></script>
    </head>
    <body>
        <div id="comparatorWrapper" class="comparator-wrapper">
            <form id="packageHandler" class="packagehandler">
                <div class="address widget">
                    <div class="setting">
                        <label id="test">Postcode</label><br />
                        <input class="field" type="text" name="zipcode" placeholder="1234ab" /><br />
                        <small class="zip error"></small>
                    </div>
                    <div class="setting last">
                        <label>Huisnr. + Toevoeging</label><br />
                        <input class="field address-f" type="text" name="housenumber" placeholder="Huisnr." />
                        <input class="field address-l" type="text" name="addition" placeholder="A" /><br />
                        <small class="hn error"></small>
                        <br class="clearfix" />
                    </div>
                </div>
                <div class="address-button">
                    <button class="button" id="sendAdress">Check postcode <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                </div>
                <div class="filter widget">
                    <div class="setting">
                        <h4 class="heading">Soort pakket</h4>
                        <label class="check"><input type="radio" name="package" value="allinone" checked="checked" /> Alles in 1</label><br />
                        <label class="check"><input type="radio" name="package" value="data+tv" /> Internet + TV</label><br />
                        <label class="check"><input type="radio" name="package" value="data+phone" /> Internet + Bellen</label><br />
                        <label class="check"><input type="radio" name="package" value="data" /> Alleen Internet</label>
                    </div>
                    <div class="setting">
                        <h4 class="heading">Verbindingstype</h4>
                        <label class="check"><input type="radio" name="connection" value=""  checked="checked" /> Alle types</label><br />
                        <label class="check"><input type="radio" name="connection" value="cable" /> Kabel + ADSL</label><br />
                        <label class="check"><input type="radio" name="connection" value="fiberoptic" /> Glasvezel</label>
                    </div>
                    <div class="setting">
                        <h4 class="heading">Download snelheid</h4>
                        <div id="download-slider" class="slider">
                            <div id="download-slider-range" class="slider-range"></div>
                            <div id="download-slider-left" class="slider-handle left"></div>
                            <div id="download-slider-right" class="slider-handle right"></div>
                        </div>
                        <div class="slider-values">
                            <label class="slider-value left">0 Mbit</label>
                            <label class="slider-value right">500 Mbit</label>
                        </div>
                        <br class="clearfix" />
                        <script>sliderInit('download');</script>
                    </div>
                    <div class="setting">
                        <h4 class="heading">Prijs per maand</h4>
                        <div id="price-slider" class="slider">
                            <div id="price-slider-range" class="slider-range"></div>
                            <div id="price-slider-left" class="slider-handle left"></div>
                            <div id="price-slider-right" class="slider-handle right"></div>
                        </div>
                        <div class="slider-values">
                            <label class="slider-value left">€10,00</label>
                            <label class="slider-value right">€100,00</label>
                        </div>
                        <br class="clearfix" />
                        <script>sliderInit('price');</script>
                    </div>
                    <div class="setting">
                        <h4 class="heading">Provider</h4>
                        <label class="check"><input type="checkbox" name="provider[]" value="2"> Fiber</label><br>
                        <label class="check"><input type="checkbox" name="provider[]" value="4"> Stipte</label><br>
                        <label class="check"><input type="checkbox" name="provider[]" value="6"> Tweak</label><br>
                        <label class="check"><input type="checkbox" name="provider[]" value="8"> Tele2</label><br>
                        <label class="check"><input type="checkbox" name="provider[]" value="10"> XS4ALL</label><br>
                        <label class="check"><input type="checkbox" name="provider[]" value="12"> Ziggo</label><br>
                        <label class="check"><input type="checkbox" name="provider[]" value="14"> KPN</label><br>
                        <label class="check"><input type="checkbox" name="provider[]" value="16"> Telfort</label><br>
                        <label class="check"><input type="checkbox" name="provider[]" value="18"> Vodafone</label><br>
                        <label class="check"><input type="checkbox" name="provider[]" value="20"> Online</label><br>
                        <label class="check"><input type="checkbox" name="provider[]" value="22"> NLEx</label><br>
                    </div>
                </div>
                <input type="hidden" name="send" value="true"/>
            </form>
            <div class="packages" id="packageWrapper"></div>
            <br class="clearfix" />
        </div>
    </body>
</html>
