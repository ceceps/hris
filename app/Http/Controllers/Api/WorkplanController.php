<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\WorkplanInterface;
use Illuminate\Http\Request;

class WorkplanController extends Controller
{
    private $workplanInterface;

    public function __construct(WorkplanInterface $workplanInterface)
    {
      $this->workplanInterface = $workplanInterface;
    }

    public function index()
    {
       return $this->workplanInterface->getAllWorkplans();
    }

}
