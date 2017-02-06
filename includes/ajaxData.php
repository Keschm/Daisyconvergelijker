<?php
header('Access-Control-Allow-Origin: *');

include_once "links.php";

if(isset($_POST['send'])) {
    $providerReqString = '';

    $ctr = 0;
    $len = count($_POST['provider']);
    if ($len > 0) foreach ($_POST['provider'] as $value) {
        $providerReqString .= ($ctr != $len - 1 ? $value . ',' : $value);
        $ctr++;
    }

    $ch = curl_init();
    curl_setopt(
        $ch,
        CURLOPT_URL,
        "https://services.daisycon.com/publishers/355931/tools/allinone?placeholder_media_id=217695&placeholder_subid=217695&page=1&per_page=300&order=regularprice"
        . (!empty($_POST['package']) ? '&allinone_type=' . $_POST['package'] : '')
        . (!empty($_POST['connection']) ? '&internet_type=' . $_POST['connection'] : '')
        . (!empty($_POST['provider']) ? '&provider=' . $providerReqString : '')
        . (!empty($_POST['housenumber']) && !empty($_POST['zipcode']) ? '&zipcode=' . $_POST['zipcode'] : '')
        . (!empty($_POST['housenumber']) && !empty($_POST['zipcode']) ? '&housenumber=' . $_POST['housenumber'] : '')
    );
    curl_setopt($ch, CURLOPT_USERPWD, "je@email.nl:wachtwoord");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $json = curl_exec($ch);

    $data = json_decode($json);

    foreach ($data as $package) {
        $package->subscription_price = number_format($package->subscription_price, 2, ',', '.');

        $package->bandwidth_download = round($package->bandwidth_download);
        $package->bandwidth_upload = round($package->bandwidth_upload);

        $package->download_suffix = ($package->bandwidth_download >= 1000 ? "Gb" : "Mb");
        $package->upload_suffix = ($package->bandwidth_upload >= 1000 ? "Gb" : "Mb");

        $package->bandwidth_download =($package->bandwidth_download >= 1000 ? substr($package->bandwidth_download, 0, -3) : $package->bandwidth_download);
        $package->bandwidth_upload = ($package->bandwidth_upload >= 1000 ? substr($package->bandwidth_upload, 0, -3) : $package->bandwidth_upload);

        if ($package->program_id == 6340 && $package->provider_id != 12 && $package->provider_id != 10) {
            if ($links[$package->link] != '') {
                $package->link = $links[$package->link];
            } else {
                echo '<small>Bij internetdealer:</small>';
            }
        }
        ?>
        <div class="package">
            <div class="package-wrapper">
                <div class="left">
                    <div class="col logo">
                        <span></span><img src="<?php echo $package->provider_image; ?>" class="image" alt="<?php echo $package->provider_name; ?>">
                    </div>
                    <div class="col info">
                        <span class="title package-title"><?php echo $package->title; ?></span>
                        <?php if ($package->discount_duration != 0) { ?>
                            <span class="discount-title">ACTIE: Eerste <?php echo $package->discount_duration; ?> maanden voor <?php echo $package->discount_price; ?> p/m.</span>
                        <?php } ?>
                        <ul class="features">
                            <?php
                            echo ($package->installation_costs == 0 ? '<li><i class="fa fa-caret-right" aria-hidden="true"></i>Geen installatiekosten berekend</li>' : '<li><i class="fa fa-caret-right" aria-hidden="true"></i>Installatiekosten: &euro;' . number_format($package->installation_costs, 2, ',', '.') . '</li>');
                            echo ($package->tv_count != 0 ? '<li><i class="fa fa-caret-right" aria-hidden="true"></i>Aantal tv&#39;s aansluitbaar: ' . $package->tv_count . '</li>' : '');
                            echo ($package->tv_recording == true ? '<li><i class="fa fa-caret-right" aria-hidden="true"></i>Televisie opnemen</li>' : '');
                            echo ($package->tv_on_demand == true ? '<li><i class="fa fa-caret-right" aria-hidden="true"></i>Thuis films bestellen</li>' : '');
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="right">
                    <div class="col">
                        <div class="infoColumn download">
                            <span class="title download"><span><?php echo $package->bandwidth_download; ?> <?php echo $package->download_suffix; ?></span> <div class="downicon"></div></span></span>
                            <?php echo ($package->tv_channels_digital_count != 0 ? '<span class="title second-row tvcount"><span>' . $package->tv_channels_digital_count . ' TV</span> <div class="tvicon"></div></span>' : ''); ?>
                        </div>
                        <div class="infoColumn upload">
                            <span class="title upload"><span><?php echo $package->bandwidth_upload; ?> <?php echo $package->upload_suffix; ?></span> <div class="upicon"></div></span></span>
                            <?php echo ($package->tv_channels_hd_count != 0 ? '<span class="title second-row tvcount"><span>' . $package->tv_channels_hd_count . ' HD</span> <div class="hdicon"></div></span>' : ''); ?>
                        </div>
                        <div class="infoColumn price">
                            <span class="title price"><span><?php echo $package->subscription_price; ?></span></span>
                        </div>
                    </div>
                    <div class="col redirect">
                        <a class="link" href="<?php echo $package->link; ?>">Bekijken</a><br />
                        <button class="show-more">Meer info <i class="fa fa-angle-down" aria-hidden="true"></i></i></button>
                    </div>
                </div>
                <br class="clearfix" />
            </div>
        </div>
        <?php
    }
}
