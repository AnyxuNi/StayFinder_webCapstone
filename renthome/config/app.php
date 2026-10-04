<?php
declare(strict_types=1);

const BASE_URL = '/renthome';
const MAX_UPLOAD_SIZE = 5 * 1024 * 1024; // 5 MB
const MAX_PROPERTY_IMAGES = 8;

function base_url(string $path = ''): string
{
    return BASE_URL . ($path !== '' ? '/' . ltrim($path, '/') : '');
}
