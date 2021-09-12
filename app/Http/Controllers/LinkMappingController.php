<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLink;
use App\Http\Requests\StoreLinkRequest;
use Illuminate\Http\Request;
use App\LinkMapping;
use DB;
use Illuminate\Support\Str;

class LinkMappingController extends Controller
{
    public function index()
    {
        $links = LinkMapping::all();
        return view('links', compact('links'));
    }

    public function show($id)
    {
        $linkstats = LinkMapping::where('id', '=', $id)->get();
        return view('show', compact('linkstats'));
    }

    public function create()
    {
        return view('welcome');
    }

    public function store(StoreLinkRequest $request)
    {
        // Handle the valid request.
        $validated = $request->validated();
        // temp variables to use in multiple places
        // we must set $code so when it passes to multiple places
        // it stays the same
        $custom_slug = $request->custom_slug;
        $code = Str::random(5);
        //create shortened_url variable
        $shortened_url = env('CLIENT_URL') . '/' . $custom_slug . '/' . $code;
        // set up for saving
        $link_mapping = LinkMapping::create([
            'custom_slug'   => $custom_slug,
            'redirect_url'  => $request->redirect_url,
            'code'          => $code,
            'shortened_url' => $shortened_url
        ]);
        // save $link_mapping
        $link_mapping->save();
        // return message
        session()->flash('status', 'URL was successfully shortened');
        return redirect('links');
    }

    public function handleRedirectRequest($slug, $code)
    {
        if(isset($slug, $code))
        {
            $find_redirect_url = DB::table('link_mappings')
                ->where([
                    ['custom_slug', '=', $slug],
                    ['code', '=', $code],
                ])->get();

            if($find_redirect_url->isEmpty())
            {
                return abort(404);
            }
            else
            {
                LinkMapping::saveLinkStat($find_redirect_url);
                return redirect($find_redirect_url[0]->redirect_url);
            }
        }
        else
        {
            return back()->withErrors('msg', 'Something went wrong with the redirect. Try again.');
        }
    }
}
