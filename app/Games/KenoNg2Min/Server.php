<?php

namespace VanguardLTE\Games\KenoNg2Min {

    use Illuminate\Support\Facades\Log;

    set_time_limit(5);

    class Server
    {
        public function get($request, $game)
        {
            function get_($request, $game)
            {
                \DB::transaction(function () use ($request, $game) {
                    try {
                        $userId = \Auth::id();
                        if ($userId == null) {
                            $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid login"}';
                            exit($response);
                        }

                        $slotSettings = new SlotSettings($game, $userId);
                        if (!$slotSettings->is_active()) {
                            $response = '{"responseEvent":"error","responseType":"","serverResponse":"Game is disabled"}';
                            exit($response);
                        }

                        if ($_REQUEST == null) {
                            $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid request"}';
                            exit($response);
                        }

                        $postData = $_REQUEST;
                        $action = (string)$postData['oper'];
                        if ($action == 'getbalance') {
                            exit('{"st":"ok","balance":"905950987"}');
                        }

                        if ($action == 'update') {
                            exit('{"id":2430,"SRVTIME":"04.01.2025 14:17:35","name_en":"KZT","vdo":"1","cgame":"","term":"","lang":"","currency":"","id_cur":3,"currencyname":"Теңге","hosturl":"http:// flgamer.de","logo":"universal_1.png","srv1":"ida=1&idh=0&ps=qazxsw&trans=1","srv2":"ida=1&idh=0&ps=qwerty&trans=1","srv3":"ida=1&idh=0&ps=qwerty&trans=1","srv4":"ida=1&idh=0&ps=qwerty&trans=1","srv6":"ida=2&idh=0&ps=qww&trans=1","srv7":"ida=2&idh=0&ps=qwert&trans=1","srv8":"ida=1&idh=0&ps=qww&trans=1","srv9":"ida=1&idh=0&ps=qwert&trans=1","srv10":"ida=2&idh=0&ps=qwert&trans=1","srv11":"ida=2&idh=0&ps=qwerty&trans=1","srv12":"ida=1&idh=0&ps=qww&trans=1","srv13":"ida=1&idh=0&ps=qww&trans=1","srv14":"ida=2&idh=0&ps=qwerty&trans=1","srv15":"ida=2&idh=0&ps=qwerty&trans=1","srv16":"ida=2&idh=0&ps=qwerty&trans=1","srv17":"ida=2&idh=0&ps=qwerty&trans=1","srv18":"ida=2&idh=0&ps=qwert&trans=1","srv19":"ida=2&idh=0&ps=qwert&trans=1","srv25":"ida=1&idh=0&ps=qwerty&trans=1","srv26":"ida=1&idh=0&ps=qwerty&trans=1","srv27":"ida=1&idh=0&ps=qwerty&trans=1","srv28":"ida=1&idh=0&ps=qwerty&trans=1","srv29":"ida=2&idh=0&ps=qwert&trans=1","srv30":"ida=2&idh=0&ps=qwerty&trans=1","srv31":"ida=2&idh=0&ps=qwerty&trans=1","srv32":"ida=2&idh=0&ps=qwert&trans=1","srv33":"ida=1&idh=0&ps=qww&trans=1","srv34":"ida=2&idh=0&ps=qww&trans=1","srv35":"ida=2&idh=0&ps=qww&trans=1","srv36":"ida=1&idh=0&ps=qwert&trans=1","srv37":"ida=2&idh=0&ps=qww&trans=1","srv38":"ida=1&idh=0&ps=qww&trans=1","srv39":"ida=1&idh=0&ps=qww&trans=1","srv40":"ida=1&idh=0&ps=qwert&trans=1","srv41":"ida=1&idh=0&ps=qwerty&trans=1","srv42":"ida=2&idh=0&ps=qww&trans=1","srv43":"ida=2&idh=0&ps=qwerty&trans=1","srv44":"ida=2&idh=0&ps=qwert&trans=1","srv45":"ida=2&idh=0&ps=qwert&trans=1","srv46":"ida=2&idh=0&ps=qwert&trans=1","srv48":"ida=2&idh=0&ps=qwert&trans=1","srv49":"ida=2&idh=0&ps=qwert&trans=1","srv50":"ida=2&idh=0&ps=qwerty&trans=1","srv51":"ida=1&idh=0&ps=qwert&trans=1","srv53":"ida=1&idh=0&ps=qwert&trans=1","srv54":"ida=1&idh=0&ps=qwert&trans=1","srv57":"ida=1&idh=0&ps=qwert&trans=1","srv58":"ida=2&idh=0&ps=qwert&trans=1","srv59":"ida=2&idh=0&ps=qwert&trans=1","srv60":"ida=2&idh=0&ps=qwert&trans=1","srv61":"ida=1&idh=0&ps=qwert&trans=1","srv62":"ida=2&idh=0&ps=qwert&trans=1","srv63":"ida=1&idh=0&ps=qwert&trans=1","srv64":"ida=1&idh=0&ps=qwert&trans=1","srv65":"ida=2&idh=0&ps=qwerty&trans=1","srv66":"ida=1&idh=0&ps=qwert&trans=1","srv67":"ida=1&idh=0&ps=qwert&trans=1","srv68":"ida=1&idh=0&ps=qwert&trans=1","srv69":"ida=2&idh=0&ps=qwert&trans=1","srv70":"ida=2&idh=0&ps=qwert&trans=1","srv72":"ida=2&idh=0&ps=qwert&trans=1","srv73":"ida=2&idh=0&ps=qwert&trans=1","srv74":"ida=2&idh=0&ps=qwert&trans=1","srv75":"ida=1&idh=0&ps=qwert&trans=1","srv76":"ida=1&idh=0&ps=qwert&trans=1","srv77":"ida=2&idh=0&ps=qwert&trans=1","srv78":"ida=1&idh=0&ps=qwert&trans=1","srv79":"ida=1&idh=0&ps=qwert&trans=1","srv80":"ida=1&idh=0&ps=qwert&trans=1","srv81":"ida=2&idh=0&ps=qwert&trans=1","srv82":"ida=1&idh=0&ps=qwert&trans=1","srv83":"ida=2&idh=0&ps=qwert&trans=1","srv84":"ida=2&idh=0&ps=qww&trans=1","srv85":"ida=2&idh=0&ps=qwert&trans=1","srv86":"ida=2&idh=0&ps=qww&trans=1","srv87":"ida=1&idh=0&ps=qwert&trans=1","srv88":"ida=1&idh=0&ps=qwert&trans=1","srv89":"ida=2&idh=0&ps=qwert&trans=1","srv90":"ida=2&idh=0&ps=qwerty&trans=1","srv91":"ida=2&idh=0&ps=qww&trans=1","srv92":"ida=2&idh=0&ps=qww&trans=1","srv93":"ida=2&idh=0&ps=qww&trans=1","srv94":"ida=2&idh=0&ps=qwerty&trans=1","srv95":"ida=2&idh=0&ps=qwerty&trans=1","srv96":"ida=2&idh=0&ps=qwerty&trans=1","srv97":"ida=2&idh=0&ps=qwerty&trans=1","srv98":"ida=2&idh=0&ps=qwerty&trans=1","srv9999":"ida=1&idh=0&ps=qwert&trans=1","tmz":"+6","ct":"05.01.2025 1:17:37","kenoemon":1,"rulemon":1,"rulon":1,"pokon":1,"kenoon":1,"kenogon":1,"t_bill":1,"apply":1,"id_lang":1,"basket":0,"ispay":0,"hallid":2,"tbs":"1","lgn":"2430","pwd":"3934","st":"success","cfstolmin":100,"cfstolmax":500,"coin6":"100-100-100-100-100","cf2min":100,"cf2max":100,"cf3min":100,"cf3max":100,"cf6min":100,"cf6max":100,"cf9min":100,"cf9max":100,"cf12min":100,"cf12max":100,"cf18min":100,"cf18max":100,"cf36min":100,"cf36max":100,"cfkenomin":100,"cfkenomax":100,"coin7":"100-100-100-100-100","cfstolemmin":100,"cfstolemmax":500,"coin8":"100-100-100-100-100","cf2emmin":100,"cf2emmax":100,"cf3emmin":100,"cf3emmax":100,"cf6emmin":100,"cf6emmax":100,"cf9emmin":100,"cf9emmax":100,"cf12emmin":100,"cf12emmax":100,"cf18emmin":100,"cf18emmax":100,"cf36emmin":100,"cf36emmax":100,"cfkenoemmin":100,"cfkenoemmax":100,"coin9":"100-100-100-100-100","cfkenogmin":100,"cfkenogmax":100,"coin10":"100-100-100-100-100","cfpokmin":100,"cfpokmax":100,"coin234":"100-100-100-100-100","balance":905965187,"balanceSYS":"905965187","hall":"D_EMO","nick":"243020","key":"988712062","sys":1,"isHttps":0,"paysys":"0"}');
                        }

                        if ($action == 'getgameinfo') {
                            exit('{"tir":2098591,"b1":73,"b2":12,"b3":61,"b4":20,"b5":46,"b6":10,"b7":19,"b8":36,"b9":8,"b10":21,"b11":59,"b12":56,"b13":17,"b14":43,"b15":76,"b16":44,"b17":49,"b18":3,"b19":4,"b20":52,"t2":40,"betoff":0,"idv":"0","video":1,"time_round":125,"time_wait":-23,"time_betoff":-23,"jp1sw":0,"jp1":1040128,"jps1":5,"statistic":[0,29,21,25,20,23,33,34,29,24,22,23,27,22,28,31,25,26,24,30,26,21,32,28,25,24,22,22,28,28,27,20,25,23,27,29,25,29,23,23,22,27,23,19,32,25,19,25,22,29,20,24,26,30,29,22,14,26,19,26,25,28,23,28,20,18,22,24,19,28,24,29,19,27,29,29,21,24,33,26,22],"cold":{"0":[56,14],"1":[65,18],"2":[43,19],"3":[46,19],"4":[58,19],"5":[68,19],"6":[72,19],"7":[4,20],"8":[31,20],"9":[50,20]},"hot":{"0":[7,34],"1":[78,33],"2":[6,33],"3":[44,32],"4":[22,32],"5":[15,31],"6":[53,30],"7":[19,30],"8":[75,29],"9":[74,29]},"history":{"tirid0":{"tirnum":2098590,"b0":61,"b1":73,"b2":68,"b3":75,"b4":71,"b5":51,"b6":29,"b7":57,"b8":34,"b9":77,"b10":74,"b11":17,"b12":80,"b13":3,"b14":24,"b15":78,"b16":37,"b17":13,"b18":18,"b19":8},"tirid1":{"tirnum":2098589,"b0":57,"b1":32,"b2":56,"b3":24,"b4":7,"b5":63,"b6":36,"b7":1,"b8":49,"b9":21,"b10":44,"b11":62,"b12":22,"b13":30,"b14":37,"b15":28,"b16":12,"b17":48,"b18":54,"b19":79},"tirid2":{"tirnum":2098588,"b0":59,"b1":9,"b2":31,"b3":57,"b4":48,"b5":52,"b6":5,"b7":15,"b8":10,"b9":12,"b10":8,"b11":47,"b12":40,"b13":19,"b14":1,"b15":43,"b16":23,"b17":78,"b18":25,"b19":35},"tirid3":{"tirnum":2098587,"b0":31,"b1":62,"b2":11,"b3":61,"b4":59,"b5":25,"b6":17,"b7":29,"b8":30,"b9":51,"b10":53,"b11":34,"b12":55,"b13":73,"b14":67,"b15":78,"b16":13,"b17":38,"b18":44,"b19":9},"tirid4":{"tirnum":2098586,"b0":17,"b1":74,"b2":4,"b3":33,"b4":62,"b5":22,"b6":11,"b7":52,"b8":51,"b9":28,"b10":9,"b11":30,"b12":1,"b13":16,"b14":13,"b15":48,"b16":67,"b17":14,"b18":7,"b19":18},"tirid5":{"tirnum":2098585,"b0":10,"b1":44,"b2":22,"b3":2,"b4":69,"b5":59,"b6":65,"b7":53,"b8":55,"b9":66,"b10":41,"b11":14,"b12":67,"b13":54,"b14":74,"b15":71,"b16":6,"b17":33,"b18":5,"b19":50},"tirid6":{"tirnum":2098584,"b0":24,"b1":49,"b2":73,"b3":30,"b4":26,"b5":5,"b6":14,"b7":10,"b8":8,"b9":39,"b10":41,"b11":45,"b12":27,"b13":37,"b14":13,"b15":78,"b16":12,"b17":75,"b18":31,"b19":18},"tirid7":{"tirnum":2098583,"b0":35,"b1":43,"b2":3,"b3":69,"b4":21,"b5":40,"b6":65,"b7":67,"b8":14,"b9":57,"b10":33,"b11":1,"b12":36,"b13":25,"b14":42,"b15":18,"b16":17,"b17":74,"b18":6,"b19":77},"tirid8":{"tirnum":2098582,"b0":12,"b1":40,"b2":35,"b3":62,"b4":71,"b5":64,"b6":7,"b7":70,"b8":79,"b9":75,"b10":56,"b11":28,"b12":59,"b13":20,"b14":63,"b15":44,"b16":3,"b17":22,"b18":19,"b19":51}},"topwin":{"0":{"round":"2098591","code":"7710819212151","sum":"30000","curr":"KZT"},"1":{"round":"2098591","code":"7710812997654","sum":"20000","curr":"KZT"},"2":{"round":"2098591","code":"7710816763688","sum":"15000","curr":"KZT"},"3":{"round":"2098591","code":"7710815395002","sum":"10000","curr":"KZT"},"4":{"round":"2098591","code":"7710807953265","sum":"3800","curr":"KZT"},"5":{"round":"2098590","code":"7710802447161","sum":"1020000","curr":"KZT"},"6":{"round":"2098590","code":"7710804453751","sum":"680000","curr":"KZT"},"7":{"round":"2098590","code":"7710803381125","sum":"510000","curr":"KZT"},"8":{"round":"2098590","code":"7710803734585","sum":"340000","curr":"KZT"},"9":{"round":"2098590","code":"7710797595162","sum":"15500","curr":"KZT"},"10":{"round":"2098589","code":"7710799705673","sum":"930000","curr":"KZT"},"11":{"round":"2098589","code":"7710793741555","sum":"620000","curr":"KZT"},"12":{"round":"2098589","code":"7710794827221","sum":"465000","curr":"KZT"},"13":{"round":"2098589","code":"7710792096060","sum":"310000","curr":"KZT"},"14":{"round":"2098589","code":"7710787039850","sum":"3800","curr":"KZT"},"15":{"round":"2098588","code":"7710774012919","sum":"960000","curr":"KZT"},"16":{"round":"2098588","code":"7710773846786","sum":"640000","curr":"KZT"},"17":{"round":"2098588","code":"7710777072529","sum":"480000","curr":"KZT"},"18":{"round":"2098588","code":"7710779771003","sum":"320000","curr":"KZT"},"19":{"round":"2098588","code":"7710776426364","sum":"1000","curr":"KZT"},"20":{"round":"2098587","code":"7710768020498","sum":"300000","curr":"KZT"},"21":{"round":"2098587","code":"7710763684845","sum":"200000","curr":"KZT"},"22":{"round":"2098587","code":"7710767798712","sum":"150000","curr":"KZT"},"23":{"round":"2098587","code":"7710768162850","sum":"100000","curr":"KZT"},"24":{"round":"2098587","code":"7710769851722","sum":"50000","curr":"KZT"},"25":{"round":"2098587","code":"7710765380257","sum":"5100","curr":"KZT"},"26":{"round":"2098586","code":"7710750665215","sum":"2040000","curr":"KZT"},"27":{"round":"2098586","code":"7710755226458","sum":"1360000","curr":"KZT"},"28":{"round":"2098586","code":"7710753752739","sum":"1020000","curr":"KZT"},"29":{"round":"2098586","code":"7710756066320","sum":"680000","curr":"KZT"}},"bigwin":{"round":"2098586","code":"7710750665215","sum":"2040000","curr":"KZT"}}');
                        }

                        if ($action == 'bet') {
                            exit('{"status":"success","cpn":[{"cd":7745584758468,"lg":"2430","da":"2025-01-12 19:58:48","sr":11,"tr":"2103117","as":100,"st":1,"cancel":0,"time_start":85,"bt":[{"sm":100,"cf":200000,"wn":0,"nm":"54;44;45;35;25;26;36;46"}]}],"srv":11,"fiscalsum":0,"code":"7745584758468","bt":"0","da":"12.01.2025 19:58:48","bets_11":{"bet":{"0":{"lb":0,"lp":0,"jp":0,"lgt":0,"tir":2103117,"dact":"12.01.2025 19:58:48","nm":"54;44;45;35;25;26;36;46","code":7745584758468,"cancel":0,"time_start":85, "cf":"200000","sm":"100","wn":"0", "st":"1","id":"7745584758","dp":"-"}},"max":"1"},"cltbal":902194787,"limit":"981495966","nal":"606670397","cassir":"2430","user":"2430","bw":"0","as":"100","aw":"0","trslt":"Не окончен","inf":"-","key":143940543,"st":"Ставки приняты","tb":"1","mb":"1"}');
                        }

                    } catch (\Exception $e) {
                        if (isset($slotSettings)) {
                            $slotSettings->InternalErrorSilent($e);
                        } else {
                            $strLog = '';
                            $strLog .= "\n";
                            $strLog .= ('{"responseEvent":"error","responseType":"' . $e . '","serverResponse":"InternalError","request":' . json_encode($_REQUEST) . ',"requestRaw":' . file_get_contents('php://input') . '}');
                            $strLog .= "\n";
                            $strLog .= ' ############################################### ';
                            $strLog .= "\n";
                            $slg = '';
                            if (file_exists(storage_path('logs/') . 'GameInternal.log')) {
                                $slg = file_get_contents(storage_path('logs/') . 'GameInternal.log');
                            }
                            file_put_contents(storage_path('logs/') . 'GameInternal.log', $slg . $strLog);
                        }
                    }
                }, 5);
            }

            get_($request, $game);
        }
    }

}
