<?php

namespace App\Http\Controllers;

use App\Models\Quote;

use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Quote::all(['text']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields=$request->validate([
            'text'=>'required',
        ]);
        $quote=Quote::create($fields);
                return 'the Quote added';

        // return ['quote'=>$quote];
    }

    /**
     * Display the specified resource.
     */
    public function show(Quote $quote)
    {
        return $quote->text;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quote $quote)
    {
        $fields=$request->validate([
            'text'=>'required',
        ]);
        $quote->update($fields);
                return 'the Quote modified';

        // return ['quote'=>$quote];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quote $quote)
    {
        $quote->delete();
        return 'the quote was deleted';
    }
    // public function searchQuote($length){
    //     $quote=Quote::whereRaw('LENGTH(text) <= ?',[$length])->get();
    //     return $quote;

    // }


    public function randomQuote()
{
    $quote = Quote::inRandomOrder()->first();

    return $quote->text;
}

}
