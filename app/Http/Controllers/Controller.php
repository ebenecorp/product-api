<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *    title="Product Management API",
 *    version="1.0.0",
 *    description="Kindly use POST Man to test the Post request endpoints and ensure the request body utilizes x-www-form-encoded body type" ,   
 *               
 *            
 *                  
 *                   
 * )
 */


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
