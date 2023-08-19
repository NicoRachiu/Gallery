<?php
function redirect($location)
{
    header("Location: {$location}");
}

function enqueueAsset(string $path): void
{
    $urlBuilder = new UrlBuilder();

    echo $urlBuilder->getBaseUrl().'assets/'.$path;
}
