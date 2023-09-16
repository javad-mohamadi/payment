<?php

namespace App\Enum;

Enum BankEnum: string
{
    case SNAPP_SHOP = 'snapp_shop';
    case MELLI = 'melli';
    case SAMAN = 'saman';
    case PASARGAD = 'pasargad';
    case MEHR = 'mehr';

    public static function getBanks(): array
    {
        return [
            '6060' => self::SNAPP_SHOP,
            '6037' => self::MELLI,
            '6219' => self::SAMAN,
            '5022' => self::PASARGAD,
            '6063' => self::MEHR,
        ];
    }
}
