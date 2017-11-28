<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\BikeType;
use App\Driver;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class DriverController extends Controller
{
    private $resource = 'driver';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resource = $this->resource;
        $resource_pl = str_plural($resource);
        $per_page = config('constants.ADMIN_PER_PAGE');
        $$resource_pl = User::ofType('driver')->with('driver')->orderBy('id', 'desc')->paginate($per_page);
        return view('admin.'. $resource . '.list', compact($resource_pl, 'resource', 'resource_pl'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resource = $this->resource;
        $resource_pl = str_plural($resource);
        $$resource = User::find($id);
        $bike_types = BikeType::all();
        return view('admin.'. $resource . '.edit', compact($resource, 'resource', 'resource_pl', 'bike_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'first_name' => 'required|max:255',
                'last_name' => 'max:255',
                'email' => 'required_without_all:phone_number|email|max:255|unique:users,email,'.$id,
                'phone_number' => 'required_without_all:email|unique:users,phone_number,'.$id,
                'username' => Rule::unique('drivers')->ignore($id, 'user_id'),
                'bike_type_id' => 'exists:bike_types,id'
            ]
        );
        $user = User::find($id);
        $user->fill($request->all());
        $user->driver->fill($request->all());
        $user->push();
        return redirect()->back()->with('success', 'Update was successfully done.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'Passenger successfully removed!');
    }

    public function changeStatus(Request $request, $id)
    {
        if (!$request->has('current_status')) {
            return redirect()->back()->with('error', 'Sorry! something went wrong.');
        }

        if ($request->input('current_status') == 'Y') {
            $is_active = 'N';
            $msg = 'disabled';
        }
        else {
            $is_active = 'Y';
            $msg = 'enabled';
        }

        User::where('id', $id)->update(['is_active' => $is_active]);
        return redirect()->back()->with('success', 'Passenger is ' . $msg . '!');
    }

    public function viewDocument(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);
        $driver->load('document_type');

        return view('admin.driver.view_document', compact('driver'));
    }

    public function changeDocumentStatus(Request $request, $driver_id, $document_id)
    {
        if (!$request->has('current_status')) {
            return redirect()->back()->with('error', 'Sorry! something went wrong.');
        }

        if ($request->input('current_status') == 2) {
            $verification_status = 1;
            $msg = 'Document status changed to pending.';
        }
        else {
            $verification_status = 2;
            $msg = 'Document is verified.';
        }
//        \DB::connection()->enableQueryLog();
        DB::table('driver_document_type')->where(['id' => $document_id])->update(['verification_status' => $verification_status]);
        /*$query = \DB::getQueryLog();
        dd($query);*/

        return redirect()->back()->with('success', $msg);
    }
}
