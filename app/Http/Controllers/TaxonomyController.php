<?php

namespace App\Http\Controllers;

use App\Models\Taxonomy;
use Illuminate\Http\Request;

class TaxonomyController extends Controller
{

    public function __invoke(Request $request){

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taxonomys = Taxonomy::all();
        return view('alltax')->with('taxonomys', $taxonomys);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('taxcreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:120', 
            'tax' => 'required'
        ]);

        $taxonomy = new Taxonomy([
            'name' => $request->name, 
            'slug' => $request->name, 
            'tax' => $request->tax
        ]);

        $taxonomy->save();

        return to_route('taxonomy.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Taxonomy $taxonomy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Taxonomy $taxonomy)
    {
        $tax = Taxonomy::find($taxonomy->id);
        return view('taxcreate')->with('tax', $tax);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Taxonomy $taxonomy)
    {
        $tax = Taxonomy::find($taxonomy->id);
        $tax->tax = $request->tax;
        $tax->save();

        return to_route('taxonomy.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Taxonomy $taxonomy)
    {
        $tax = Taxonomy::find($taxonomy->id);
        $tax->delete();
        return to_route('taxonomy.index');
    }
}
