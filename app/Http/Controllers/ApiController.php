<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use App\Common\Utilities\ResponseCode;


abstract class ApiController extends Controller
{
    protected $_model;

    public function __construct(Model $model)
    {
        $this->_model = $model;
    }

    private $generalErrors = array(
        0 => 'Error unknown',
        101 => 'Require method POST',
        102 => 'Require method GET',
        103 => 'Params not exist\'s: "{PARAMETER}"',
        104 => 'Parameter not null',
        105 => 'Password wrong',
        106 => 'Data not found',
        107 => 'Authentication failed',
        108 => 'Network connect failed',
        109 => 'Create failed',
        110 => 'Signature wrong',
        111 => "You don't have permission to create task!",
        200 => 'OK',
        202 => 'Accepted',
    );


    protected $statusCode = Response::HTTP_OK;

    protected $e = array(
        'code' => 0,
        'message' => null,
    );

    protected $parameter;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respondData($data = null, $message = 'Success')
    {
        $this->setStatusCode(Response::HTTP_OK);
        return $this->respond([
            'status' => true,
            'message' => $message,
            'data' => $data
        ]);

    }


    public function respondWithError($errorCode = null, $parameter = null, $value = null)
    {
        if (is_array($parameter)) {
            $parameter = explode(', ', $parameter);
        }
        if (is_array($value)) {
            $value = explode(', ', $value);
        }
        $errorArr = $this->getError($errorCode, $parameter, $value);
        $this->setStatusCode(Response::HTTP_ACCEPTED);
        return $this->respond([
            'status' => false,
            'message' => $errorArr['message'],
            'errorCode' => $errorArr['errorCode'],
        ]);
    }

    public function respond($data, $headers = [])
    {
        return \Response::json($data, $this->getStatusCode(), $headers);
    }

    public function getError($errorCode = null, $parameter = null, $value = null)
    {

        if (empty($errorCode)) $errorCode = 0;

        $errorString = $this->generalErrors[$errorCode];

        if (!empty($parameter)) {
            $errorString = str_replace('{PARAMETER}', $parameter, $errorString);
        }

        if (!empty($value)) {
            $errorString = str_replace('{VALUE}', $value, $errorString);
        }

        return array('errorCode' => $errorCode, 'message' => $errorString);
    }

    public function response($success = false, $message = null, $data = [], $headers = [])
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ])->withHeaders($headers);
    }

    public function resp($status = false, $message = null, $data = [], $statusCode = 200)
    {
        return response()->json(['success' => false, 'message' => $message, 'data' => $data], $statusCode);
    }

    public function _getMessageError($errorCode = null, $parameter = null, $value = null)
    {
        if (empty($errorCode)) $errorCode = 0;
        $errorString = $this->generalErrors[$errorCode];
        if (!empty($parameter)) $errorString = str_replace('{PARAMETER}', $parameter, $errorString);
        if (!empty($value)) $errorString = str_replace('{VALUE}', $value, $errorString);
        return $errorString;
    }
}
