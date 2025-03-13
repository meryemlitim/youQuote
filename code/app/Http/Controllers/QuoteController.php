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
    public function searchQuote($length)
{
    // Get quotes with text length less than or equal to the given length
    // $quotes = Quote::whereRaw('LENGTH(text) <= ?', [$length])->get();
    $allQuote=Quote::all();
    $filteredQuotes = $allQuote->filter(function ($quote) use ($length) {
        return str_word_count($quote->text) <= $length;
    });
    if($filteredQuotes->isEmpty()){
        return response()->json(['message'=>'No quote with that number of words'],404);
    }
    return $filteredQuotes->pluck('text');

   
    }

    
    


    // Return the quotes as a JSON response


    public function randomQuote()
{
    $quote = Quote::inRandomOrder()->first();

    return $quote->text;
}

}
