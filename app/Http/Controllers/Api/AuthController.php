<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ResponseAPI;

    protected $userInterface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function register(UserRequest $request)
    {
        return $this->userInterface->requestUser($request);
    }

    public function login(Request $request)
    {
        return $this->userInterface->loginUser($request);
    }

    public function logout(Request $request)
    {
        return $this->userInterface->logout($request);
    }
}
