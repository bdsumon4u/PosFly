<?php

namespace App\Http\Controllers;

use App\utils\helpers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TenantController extends Controller
{

    //------------- GET ALL USERS---------\\

    public function index(request $request)
    {
        abort_if(!is_null(tenant()), 403);
        // How many items do you want to display.
        $perPage = $request->limit;
        $pageStart = \Request::get('page', 1);
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage;
        $order = $request->SortField;
        $dir = $request->SortType;
        $helpers = new helpers();
        // Filter fields With Params to retrieve
        $columns = array(0 => 'id', 1 => 'name', 2 => 'phone', 3 => 'shop_name', 4 => 'statut');
        $param = array(0 => 'like', 1 => 'like', 2 => 'like', 3 => 'like', 4 => '=');

        $model = tenancy()->model()->newQuery();

        foreach ($columns as $key => $field) {
            $pk = $param[$key];
            $col = $key ? 'data->'.$field : $field;
            $model->when($request->filled($field), function ($query) use ($request, $model, $field, $pk, $col) {
                $pk == 'like' ?
                    $model->where($col, 'like', "{$request[$field]}")
                    : $model->where($col, $request[$field]);
            });
        }

        //Multiple Filter
        $Filtred = $model
            // Search With Multiple Param
            ->where(function ($query) use ($request) {
                return $query->when($request->filled('search'), function ($query) use ($request) {
                    return $query->where('id', 'LIKE', "%{$request->search}%")
                        ->orWhere('data->name', 'LIKE', "%{$request->search}%")
                        ->orWhere('data->phone', 'LIKE', "%{$request->search}%")
                        ->orWhere('data->shop_name', 'LIKE', "%{$request->search}%")
                        ->orWhere('data->statut', '=', "%{$request->search}%");
                });
            });
        $totalRows = $Filtred->count();
        $users = $Filtred
            ->when($perPage != -1, function ($q) use ($offSet) {
                $q->offset($offSet);
            })
            ->limit($perPage)
            ->orderBy($order, $dir)
            ->get();

        return response()->json([
            'users' => $users,
            'totalRows' => $totalRows,
        ]);
    }

    //------------- STORE NEW USER ---------\\

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        abort_if(!is_null(tenant()), 403);
        $data = $this->validate($request, [
            'id' => ['required', 'unique:tenants', Rule::unique('domains', 'domain')],
            'name' => 'required',
            'phone' => 'required',
            'shop_name' => 'required',
        ], [
            'id.unique' => 'This ID already taken.',
        ]);
        \DB::transaction(function () use ($data) {
            tenancy()->model()->create([
                'statut' => 1,
            ] + $data)->domains()->create([
                'domain' => $data['id'],
            ]);
        }, 10);

        return response()->json(['success' => true]);
    }

    //------------ function show -----------\\

    public function show($id){
        //

    }

    //------------- UPDATE  USER ---------\\

    public function update(Request $request, $id)
    {
        abort_if(!is_null(tenant()), 403);
        $data = $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'shop_name' => 'required',
        ], [
            'id.unique' => 'This ID already taken.',
        ]);
        \DB::transaction(function () use ($data, $id) {
            tenancy()->model()->findOrFail($id)->update($data);
        }, 10);

        return response()->json(['success' => true]);

    }

    //----------- IsActivated (Update Statut User) -------\\

    public function IsActivated(request $request, $id)
    {
        abort_if(!is_null(tenant()), 403);
        if ($tenant = tenancy()->model()->find($id)) {
            $tenant->update([
                'statut' => intval($request['statut']),
            ]);
            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }
}
