<?php 

namespace App;


class Config 
{

    /**
     * @var array
     */
    public const SERVICE_ID = [
        'main' => 17793,
    ];


    /**
     * @var array
     */
    private const PIN_ERROR_TEXT = [
        'main'  => 'Wrong PIN, please try again',
        'sub_1' => 'Wrong PIN, please try again',
        'sub_2' => 'Wrong PIN, please try again',
        'sub_3' => 'Check your SMS code',
        'sub_4' => 'Wrong CODE, please try again',
        'sub_5' => 'Wrong PIN, please try again',
        'sub_6' => 'Wrong PIN, please try again',
        'sub_7' => 'Wrong PIN, please try again',
        'sub_8' => 'Wrong PIN, please try again',
        'sub_9' => 'Wrong PIN, please try again',
        'sub_10' => 'Wrong PIN, please try again',
        'sub_11' => 'Wrong PIN, please try again',
        'sub_12' => 'Wrong PIN, please try again',
    ];


    /**
     * @var array
     */
    private const OPERATORS_ERROR_CODES = [
        100 => 'INVALID_CREDENTIALS',
        101 => 'NO_AUTHORIZATION',
        102 => 'SERVICE_NOT_FOUND',
        104 => 'INVALID_DATA',
        105 => 'INVALID_STATUS',
        106 => 'SUBSCRIBER_NOT_FOUND',
        107 => 'INVALID_CLIENT_IP',
        108 => 'INVALID_DATA_NO_MNC',
        109 => 'INVALID_DATA_NO_MNC',
        110 => 'INVALID_DATA_INV_OPERATOR',
        111 => 'VALIDATION_GENERAL_ERROR',
        112 => 'INVALID_DATA_INV_MSISDN',
        113 => 'INVALID_DATA_INV_MSISDN_ON_CARRIER',
        115 => 'WIFI_IDENTIFICATION_NOT_SUPPORTED',
        116 => 'INVALID_DATA_INV_EMPTY_PIN',
        117 => 'INVALID_DATA_INV_PIN_FORMAT',
        118 => 'INVALID_DATA_INV_PIN',
        119 => 'INVALID_DATA_INV_PIN_NO_RETRY',
        120 => 'BILLING_GENERAL_ERROR',
        121 => 'BILLING_OPER_SERVICE_ERROR',
        123 => 'BILLING_OPER_CLIENT_ERROR',
        124 => 'BILLING_OPER_GENERAL_ERROR',
        125 => 'BILLING_OPER_CONSTRAINT_ERROR',
        126 => 'BILLING_OPER_BLOCKED_USER',
        130 => 'SHARED_PROVISIONING_ERROR',
        140 => 'DAILY_SERVICE_GLOBAL_LIMIT_EXCEEDED',
        141 => 'ERR_CODE_SERVICE_TIME_LIMIT_REACHED',
        150 => 'SUBSCRIPTION_SUSPENDED_ERROR',
        160 => 'CANCEL_PARTIAL_SUCCESS',
        162 => 'CANCEL_NO_SUBSCRIPTIONS_FOUND',
        165 => 'CANCEL_NO_SUBSCRIPTIONS_ELEGIBLE',
        166 => 'CANCEL_NO_SUBSCRIPTIONS_CANCELLED',
        167 => 'CONCURRENT_DUPLICATED_REQUEST',
        170 => 'FAILURE_PERCENTAGE_EXCEEDED',
        171 => 'BLACKLIST_PERCENTAGE_EXCEEDED',
        200 => 'GENERAL_ERROR',
    ];



    /**
     * @param string $sub_land
     * @return int
     */
    public static function serviceId(string $sub_land): int
    {
        return self::SERVICE_ID[$sub_land];
    }


    /**
     * @param int $code
     * @return string
     */
    public static function operatorError(int $code): string
    {
        return self::OPERATORS_ERROR_CODES[$code];
    }


    /**
     * @param string $sub_land
     * @return string
     */
    public static function pinError(string $sub_land): string 
    {
        return self::PIN_ERROR_TEXT[$sub_land];
    }
}