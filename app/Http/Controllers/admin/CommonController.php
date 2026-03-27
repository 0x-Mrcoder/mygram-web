<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
    public function status(Request $request)
    {
        $id = $request->id;
        $table = $request->table;
        $status = $request->status;

        try {
            DB::table($table)->where('id', $id)->update(['status' => $status]);
            return response()->status(200)->json(['status' => true, 'msg' => 'Status Updated Successfully']);
        } catch (\Exception $e) {
            return response()->status(200)->json(['status' => false, 'msg' => 'Status Update Failed']);
        }
    }
}
