<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JournalEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->user()->journalEntries;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> ['required', 'string'],
            'content' => ['required', 'string'],
        ]);

        $entry = JournalEntry::create([
            'title'=> $request->title,
            'content'=> $request->content,
            'public_id'=> Str::orderedUuid(),
            'user_id'=> $request->user()->id
        ]);

        return $entry;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JournalEntry  $journalEntry
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, JournalEntry $journal_entry)
    {
        if ($request->user()->cannot('view', $journal_entry)) {
            abort(404, 'Entry not found');
        }
        return $journal_entry;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JournalEntry  $journalEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JournalEntry $journal_entry)
    {
        if ($request->user()->cannot('update', $journal_entry)) {
            abort(404);
        }
        $request->validate([
            'title'=> ['required', 'string'],
            'content' => ['required', 'string'],
            'is_shared' => ['boolean'],
        ]);

        $journal_entry->title = $request->title;
        $journal_entry->content = $request->content;
        $journal_entry->is_shared = $request->is_shared;

        $journal_entry->save();

        return $journal_entry;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JournalEntry  $journalEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, JournalEntry $journal_entry)
    {
        if ($request->user()->cannot('delete', $journal_entry)) {
            abort(404);
        }
        $journal_entry->delete();
        return;
    }
}
