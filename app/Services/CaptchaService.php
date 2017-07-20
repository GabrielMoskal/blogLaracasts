<?php

namespace App\Services;


class CaptchaService
{

    public function captcha() {
        $validationResult = $this->getValidationResult();

        if ($validationResult['success'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    private function getValidationResult() {
        $secret = env('CAPTCHA_SECRET');
        $response = request('g-recaptcha-response');
        $remoteip = request()->ip();


        $url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");
        return json_decode($url, true);
    }
}