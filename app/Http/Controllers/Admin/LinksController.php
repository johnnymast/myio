<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LinksRequest;
use App\Session\Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Link;
use App\Hit;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.links.index', ['links' => Link::paginate(config('myio.admin.pagination.items_per_page'))]);
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
        $hits = Hit::where('link_id', $link->id)->paginate(config('myio.admin.pagination.items_per_page'));
        return view('admin.links.show', compact('link', 'hits'));
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
        if ($link->delete()) {
            Flash::success('Link deleted.');
        } else {
            Flash::error('Could not delete this link.');
        }

        return redirect()->route('admin.links.index');
    }
}
