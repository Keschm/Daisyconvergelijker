<?php

function getProvider() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://services.daisycon.com/publishers/355931/tools/allinone/providers?page=1&per_page=100");
    curl_setopt($ch, CURLOPT_USERPWD, "je@email.nl:wachtwoord");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $json = curl_exec($ch);

    $data = json_decode($json);

    return $data;
}
