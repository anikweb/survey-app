<?php

namespace App\Http\Controllers;

use App\Models\ResultSuggestion;
use Illuminate\Http\Request;

class ResultSuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.result_suggestion.index',[
            'results' => ResultSuggestion::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return v;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResultSuggestion  $resultSuggestion
     * @return \Illuminate\Http\Response
     */
    public function show(ResultSuggestion $resultSuggestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResultSuggestion  $resultSuggestion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = ResultSuggestion::find($id);
        return view('backend.pages.result_suggestion.edit',[
            'result' => $result,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResultSuggestion  $resultSuggestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            "*" => "required",
        ]);
        $result = ResultSuggestion::find($request->result_id);
        $result->result = $request->result;
        $result->suggestion = $request->suggestion;
        $result->save();
        return back();
        // return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResultSuggestion  $resultSuggestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResultSuggestion $resultSuggestion)
    {
        //
    }
}
