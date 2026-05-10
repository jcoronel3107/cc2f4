<?php

namespace App\Helpers;

class BankHelper
{
    public static function getBankInfo()
    {
        return [
            'account_number' => env('BANK_ACCOUNT_NUMBER', 'No especificado'),
            'account_type' => env('BANK_ACCOUNT_TYPE', 'Ahorros'),
            'bank_name' => env('BANK_NAME', 'Banco'),
            'owner' => env('BANK_OWNER', 'Empresa'),
            'identification' => env('BANK_IDENTIFICATION', 'N/A'),
        ];
    }
}