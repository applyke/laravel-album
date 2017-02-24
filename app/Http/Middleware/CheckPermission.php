<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Role;
use App\Model\Permission;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $actionName)
    {
        $role_id = $request->user()->role_id;
        $permission  =  Permission::where('name', $actionName)->get();
       
        if($permission->isEmpty()){
            return response()->json([
                'error' => "There were some problems with your permission"
            ], 401);
        }

        foreach ($permission as $object) {
            $permission = $object;
        }
        $access =  Role::find($role_id)->permissions()->get();

        foreach ($access as $object) {
            if ($permission->id == $object->id){
                return $next($request);
            }

        }
        return response()->json([
            'error' => "There were some problems with your permission"
        ], 401);

    }
}
