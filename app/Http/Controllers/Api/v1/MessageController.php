<?php
namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use League\Fractal\Manager;

class MessageController extends ApiController {

	/*
	|--------------------------------------------------------------------------
	| Message Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

    /**
     * Create a new Message controller instance.
     *
     * @param Manager $fractal
     */
	public function __construct(Manager $fractal)
	{
        parent::__construct($fractal);
	}

    /**
     * Display a listing of the messages.
     *
     * @return Response
     */
    public function index()
    {
        return $this->errorUnauthorized('Unauthorized request.');
    }


    /**
     * Show the form for creating a new message.
     *
     * @return Response
     */
    public function create()
    {
        return $this->errorUnauthorized('Unauthorized request.');
    }

    /**
     * Consume the trade message.
     *
     * @return Response
     */
    public function consume(Request $request)
    {
        return $this->errorUnauthorized('Unauthorized request.');
    }

    /**
     * Store a newly created message in storage.
     *
     * @return Response
     */
    public function store()
    {
        return $this->errorUnauthorized('Unauthorized request.');

//        $input = Input::json();
//
//        if (!$input->has('data'))
//        {
//
//            return $this->errorWrongArgs('Wrong Arguments');
//
//        } else
//        {
//
//            try
//            {
//
//                $signinFields = $input->get('data');
//
//                if (!isset($signinFields['coder_id']) || !isset($signinFields['ip_address']))
//                {
//                    return $this->errorWrongArgs('Wrong Arguments');
//                }
//
//                if (!$coder = Coder::find($signinFields['coder_id']))
//                {
//                    return $this->errorNotFound('Coder Not Found');
//                }
//
//                $signin = Signin::saveSignin(new Signin, $signinFields['coder_id'], $signinFields['ip_address']);
//
//                return $this->respondWithItem($signin, function (Signin $signin)
//                {
//                    return [
//                        'id'         => (int) $signin->id,
//                        'coder_id'   => (int) $signin->coder_id,
//                        'ip_address' => (string) $signin->ip_address,
//                        'user_agent' => (string) $signin->user_agent,
//                        'created_at' => (string) $signin->created_at,
//                        'updated_at' => (string) $signin->updated_at,
//                    ];
//                });
//
//            } catch (Exception $e)
//            {
//                return $this->errorInternalError('Internal Error.');
//            }
//        }
    }


    /**
     * Display the specified message.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return $this->errorUnauthorized('Unauthorized request.');
    }


    /**
     * Show the form for editing the specified message.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        return $this->errorUnauthorized('Unauthorized request.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        return $this->errorUnauthorized('Unauthorized request.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        return $this->errorUnauthorized('Unauthorized request.');
    }


}
