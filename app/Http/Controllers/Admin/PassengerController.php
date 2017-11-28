<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PassengerController extends Controller
{
    private $resource = 'passenger';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resource = $this->resource;
        $per_page = config('constants.ADMIN_PER_PAGE');
        $passengers = User::ofType('passenger')->orderBy('id', 'desc')->paginate($per_page);
        return view('admin.'. $resource . '.list', compact('passengers', 'resource'));
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
        $passenger = User::find($id);
        return view('admin.'. $resource . '.edit', compact('passenger', 'resource'));
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
            ]
        );
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();
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
}
