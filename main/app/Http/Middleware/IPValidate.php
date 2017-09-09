<?php

namespace App\Http\Middleware;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Input;
use Session;
use Redirect;
use DB;
use Closure;

class IPValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ipsettings = DB::table('ipsettings')
        ->where('id', 1)
        ->get();
        if(!empty($ipsettings[0]->ips)){
            $arr_ip = explode(',', $ipsettings[0]->ips);

            $ip = $this->getRealIpAddr();

            $check = in_array($ip, $arr_ip);
            if($check){

            }else{ ?> 
            
                <img src="<?php echo asset('assets/dist/img/can-stock.jpg');  ?>" style="position: absolute;
    top: 0; bottom:0; left: 0; right:0;
    margin: auto;"/>

          <?php exit(); }
        }
        return $next($request);
    }

    function getRealIpAddr()
    {

        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
          $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
