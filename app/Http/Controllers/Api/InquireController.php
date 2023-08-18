<?php

namespace App\Http\Controllers\Api;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inquire\CreateRequest;
use App\Http\Requests\Inquire\ListRequest;
use App\Http\Resources\InquireResource;
use App\Models\Inquire;
use Faker\Core\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Uid\Ulid;

class InquireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ListRequest $request)
    {
        //get user company

        $managerCompanyId = $request->user()->company()->first()->pivot->company_id;

        // select from view
        $inquires = DB::table('inquire_details')->where('company_id', $managerCompanyId)->get();

        return response()->json($inquires);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $userId = $request->user()->id;

        $inquireId = (new Ulid)->toBase32();

        $inquire = Inquire::create([
            'inquire_id' => $inquireId,
            'user_id' => $userId,
            'status_id' => Status::PENDING->value,
            'type' => $request->type,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return new InquireResource($inquire);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inquire $inquire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inquire $inquire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inquire $inquire)
    {
        //
    }
}
