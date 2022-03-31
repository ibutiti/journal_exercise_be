<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;

class JournalEntryShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke($public_id)
    {
        $journal_entry = JournalEntry::where('public_id', $public_id)->where('is_shared', true)->firstOrFail();

        return $journal_entry;
    }

}
