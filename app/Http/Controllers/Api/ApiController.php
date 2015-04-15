<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    protected $statusCode = 200;

    const CODE_SUCCESS          = 'SUCCESS';
    const CODE_WRONG_ARGS       = 'WRONG_ARGS';
    const CODE_NOT_FOUND        = 'NOT_FOUND';
    const CODE_INTERNAL_ERROR   = 'INTERNAL_ERROR';
    const CODE_UNAUTHORIZED     = 'UNAUTHORIZED';
    const CODE_FORBIDDEN        = 'FORBIDDEN';

    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;

        if (Input::has('include'))
        {            
            $this->fractal->parseIncludes(Input::get('include'));
        }
    }

    /**
     * Getter for statusCode
     *
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    
    /**
     * Setter for statusCode
     *
     * @param int $statusCode Value to set
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param $item
     * @param $callback
     * @return mixed
     */
    protected function respondWithItem($item, $callback)
    {
        $resource = new Item($item, $callback);

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    /**
     * @param $collection
     * @param $callback
     * @return mixed
     */
    protected function respondWithCollection($collection, $callback)
    {
        $resource = new Collection($collection, $callback);

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    /**
     * @param array $array
     * @param array $headers
     * @return mixed
     */
    protected function respondWithArray(array $array, array $headers = [])
    {
        $response = Response::json($array, $this->statusCode, $headers);
        return $response;
    }

    /**
     * @param array $response
     * @param string $message
     * @return mixed|Response
     */
    protected function respondWithSuccess($response = [], $message = 'Response has been generated successfully.')
    {
        if ($this->statusCode !== 200) {
            trigger_error(
                "Error in the message, success message on a http status not equal to 200...",
                E_USER_WARNING
            );
            
            return $this->errorInternalError('Internal Error.'); 
        }

        return $this->respondWithArray([
            'data' => [
                'http_code' => $this->statusCode,
                'data' => $response,
                'message' => $message,
            ]
        ]);
    }

    /**
     * @param $message
     * @param $errorCode
     * @return mixed
     */
    protected function respondWithError($message, $errorCode)
    {
        if ($this->statusCode === 200) {
            trigger_error(
                "Error in the 'erroring', error message on a http status code 200...",
                E_USER_WARNING
            );
            $this->statusCode = 500;
        }

        return $this->respondWithArray([
            'error' => [
                'code' => $errorCode,
                'http_code' => $this->statusCode,
                'message' => $message,
            ]
        ]);
    }

    /**
     * Generates a Response with a 403 HTTP header and a given message.
     *
     * @param string $message
     * @return Response
     */
    public function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)->respondWithError($message, self::CODE_FORBIDDEN);
    }

    /**
     * Generates a Response with a 500 HTTP header and a given message.
     *
     * @param string $message
     * @return Response
     */
    public function errorInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)->respondWithError($message, self::CODE_INTERNAL_ERROR);
    }

    /**
     * Generates a Response with a 404 HTTP header and a given message.
     *
     * @param string $message
     * @return Response
     */
    public function errorNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(404)->respondWithError($message, self::CODE_NOT_FOUND);
    }

    /**
     * Generates a Response with a 401 HTTP header and a given message.
     *
     * @param string $message
     * @return Response
     */
    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)->respondWithError($message, self::CODE_UNAUTHORIZED);
    }

    /**
     * Generates a Response with a 400 HTTP header and a given message.
     *
     * @param string $message
     * @return Response
     */
    public function errorWrongArgs($message = 'Wrong Arguments')
    {
        return $this->setStatusCode(400)->respondWithError($message, self::CODE_WRONG_ARGS);
    }

    /**
     * Generates a Response with a 200 HTTP header and a given message.
     *
     * @param string $message
     * @return Response
     */
    public function sendSuccess($message = 'Request process successfully.')
    {
        return $this->setStatusCode(200)->respondWithSuccess($message, self::CODE_SUCCESS);
    }
    
}
