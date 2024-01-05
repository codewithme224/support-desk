<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Status;

class HomeController extends Controller
{
    public function home()
    {

        return redirect('dashboard');
    }

}
