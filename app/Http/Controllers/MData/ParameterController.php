<?php

namespace App\Http\Controllers\MData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MData\Parameter;

class ParameterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
    	$parameter = Parameter::findOrFail($id);
    	return view('mdata.parameter.add-edit', ['edit'=>true, 'data'=> $parameter]);
    }

    public function update(Request $request, $id)
    {
        $parameter = Parameter::findOrFail($id);
        $parameter->update($request->all());
        return redirect('mdata/parameter/1')
            ->withSuccess(__('Nilai Parameter berhasil diubah.'));
    }
}
