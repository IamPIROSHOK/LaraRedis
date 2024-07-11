<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function broadcast(Request $request)
    {
        broadcast(new PusherBroadcast($request->get('message')))->toOthers();

        return view('broadcast', ['message' => $request->get('message')]);
    }

    public function receive(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
//        $user = request()->user();
        $user = $request->get('user');
        return view('receive', ['message' => $request->get('message')], ['user' => $user]);
    }
}
