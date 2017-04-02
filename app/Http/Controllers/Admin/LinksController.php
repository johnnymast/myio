<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LinksRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Link;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::All();
        return view('admin.links.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Show create create link form
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param LinksRequest|Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LinksRequest $request)
    {
        // Store the link
    }


    /**
     * Display the specified resource.
     *
     * @param Link $link
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Link $link)
    {
        // Show a link
        dd($link);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Link $link
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Link $link)
    {
        // edit this link
    }


    /**
     * Update the specified resource in storage.
     *
     * @param LinksRequest|Request $request
     * @param Link                 $link
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(LinksRequest $request, Link $link)
    {
        // Update the link
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Link $link
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Link $link)
    {
        // Delete the link
    }
}
