<?php
/**
 * Created by PhpStorm.
 * User: akk
 * Date: 16/01/2019
 * Time: 14:36
 */

namespace App\Common\Utilities;


class ResponseCode
{
    const ERROR_UNKNOWN = 0;
    const REQUIRE_METHOD_POST = 101;
    const REQUIRE_METHOD_GET = 102;
    const PARAMS_NOT_EXISTS = 103;
    const PARAM_NOT_NULL = 104;
    const PASSWORD_WRONG = 105;
    const DATA_NOT_FOUND = 106;
    const AUTHENTICATION_FAILED = 107;
    const NETWORK_CONNECT_FAILED = 108;
    const CRUD_FAILED = 109;
    const SIGNATURE_WRONG = 110;
    const DONT_HAVE_PERMISSION = 111;
    const OK = 200;
    const ACCEPTED = 202;
}
