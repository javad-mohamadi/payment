<?php

if (!function_exists('english')) {
    function english(string $string): array|string
    {
        $farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabicDigits = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        $string = str_replace($farsiDigits, $englishDigits, $string);

        return str_replace($arabicDigits, $englishDigits, $string);
    }
}
