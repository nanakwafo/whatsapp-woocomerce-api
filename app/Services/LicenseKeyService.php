<?php

namespace App\Services;

class LicenseKeyService
{
    public static function generate()
    {
        $prefix = "WAWC"; // WooCommerce WhatsApp AI
        $block1 = strtoupper(bin2hex(random_bytes(2)));
        $block2 = strtoupper(bin2hex(random_bytes(2)));
        $block3 = strtoupper(bin2hex(random_bytes(2)));

        return "{$prefix}-{$block1}-{$block2}-{$block3}";
    }
}
