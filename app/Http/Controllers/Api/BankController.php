<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Bank;
use App\Traits\ResponseAPI;
use Dotenv\Result\Success;
use Illuminate\Http\Request;

class BankController extends Controller
{
    use ResponseAPI;
    public function index()
    {
        $bank = Bank::get();
        return $this->success('All Bank',$bank);
    }

}
