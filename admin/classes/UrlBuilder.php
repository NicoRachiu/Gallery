<?php

class UrlBuilder
{
    public function getBaseUrl(): string
    {
        $pathInfo = pathinfo($_SERVER['PHP_SELF']);
        $protocol = stripos($_SERVER["SERVER_PROTOCOL"], 'https') === 0 ? 'https' : 'http';
        $baseUrl = $protocol.'://'.$_SERVER['HTTP_HOST'].$pathInfo['dirname'].'/';

        return str_replace('/admin/', '/', $baseUrl);
    }
}