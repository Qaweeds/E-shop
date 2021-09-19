<?php


namespace App\Service\Contracts;


interface ImageServiseInterface
{
    public static function upload($image);

    public static function remove($image);
}
