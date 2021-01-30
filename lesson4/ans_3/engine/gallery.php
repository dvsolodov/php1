<?php
function getGallery()
{
    return @array_splice(scandir($_SERVER['DOCUMENT_ROOT'] . '/images/gallery/small/'), 2);
}
