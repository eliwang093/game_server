<?php 
namespace VanguardLTE\Games\RobotsKA
{
    set_time_limit(5);
    class Server
    {
        public function get($request, $game)
        {
            function get_($request, $game)
            {
                \DB::transaction(function() use ($request, $game)
                {
                    try
                    {
                        $userId = \Auth::id();
                        if( $userId == null ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid login"}';
                            exit( $response );
                        }
                        $slotSettings = new SlotSettings($game, $userId);
                        if( !$slotSettings->is_active() ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"","serverResponse":"Game is disabled"}';
                            exit( $response );
                        }
                        $postData = json_decode(trim(file_get_contents('php://input')), true);
                        $balanceInCents = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                        $result_tmp = [];
                        $aid = '';
                        if( $postData['command'] == 'bet' && $postData['bet']['gameCommand'] == 'collect' ) 
                        {
                            $postData['command'] = 'collect';
                        }
                        $aid = (string)$postData['command'];
                        switch( $aid ) 
                        {
                            case 'startGame':
                                $gameBets = $slotSettings->Bet;
                                for( $i = 0; $i < count($gameBets); $i++ ) 
                                {
                                    $gameBets[$i] = $gameBets[$i] * 100;
                                }
                                $lastEvent = $slotSettings->GetHistory();
                                $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                                $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                                $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                                $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                                $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                                $slotSettings->SetGameData($slotSettings->slotId . 'BonusSym', 0);
                                if( $lastEvent != 'NULL' ) 
                                {
                                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->bonusWin);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusSym', $lastEvent->serverResponse->BonusSym);
                                    $reels = $lastEvent->serverResponse->reelsSymbols;
                                    $curReels = '' . rand(0, 6) . ',' . $reels->reel1[0] . ',' . $reels->reel1[1] . ',' . $reels->reel1[2] . ',' . rand(0, 6);
                                    $curReels = '';
                                    $curReels .= ($reels->reel1[2] . ',' . $reels->reel2[2] . ',' . $reels->reel3[2] . ',' . $reels->reel4[2] . ',' . $reels->reel5[2]);
                                    $curReels .= (',' . $reels->reel1[1] . ',' . $reels->reel2[1] . ',' . $reels->reel3[1] . ',' . $reels->reel4[1] . ',' . $reels->reel5[1]);
                                    $curReels .= (',' . $reels->reel1[0] . ',' . $reels->reel2[0] . ',' . $reels->reel3[0] . ',' . $reels->reel4[0] . ',' . $reels->reel5[0]);
                                    $lines = $lastEvent->serverResponse->slotLines;
                                    $bet = $lastEvent->serverResponse->slotBet * 100;
                                    if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') && $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                                    {
                                    }
                                }
                                else
                                {
                                    $curReels = '' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6) . ',' . rand(0, 6);
                                    $lines = 30;
                                    $bet = $slotSettings->Bet[0] * 100;
                                }
                                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                                {
                                    $acb = 1;
                                    $fsr = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                                    $fs = 'true';
                                    $rd = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                                    $tfw = $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100;
                                }
                                else
                                {
                                    $rd = 0;
                                    $fs = 'false';
                                    $acb = 0;
                                    $fsr = 0;
                                    $tfw = 0;
                                }
                                $result_tmp[0] = '{"sgr":{"gn":"TRex","lsd":{"sid":' . rand(0, 9999999) . ',"tid":"061db09bc959482288e9452d7eb2bbda","sel":' . $lines . ',"cps":5,"dn":0.01,"nd":0.01,"ncps":0,"atb":0,"v":true,"fs":' . $fs . ',"twg":' . ($lines * $bet) . ',"swm":0,"sw":0,"swu":0,"tw":0,"fsw":0,"fsr":' . $fsr . ',"tfw":' . $tfw . ',"st":[' . $curReels . '],"swi":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"snm":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"ssm":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"sm":[' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusSym') . ',0],"acb":' . $acb . ',"rf":0,"as":[],"sp":0,"cr":"' . $postData['cr'] . '","rd":' . $rd . ',"pbb":0,"obb":' . $balanceInCents . ',"mb":false,"pwa":0},"drs":[[' . implode(',', $slotSettings->reelStrip1) . '],[' . implode(',', $slotSettings->reelStrip2) . '],[' . implode(',', $slotSettings->reelStrip3) . '],[' . implode(',', $slotSettings->reelStrip4) . '],[' . implode(',', $slotSettings->reelStrip5) . ']],"pt":[[0,0,100,400,1000],[0,10,50,100,500],[0,5,25,80,300],[0,5,20,60,200],[0,3,15,50,100],[0,0,15,30,75],[0,0,10,20,50],[0,0,10,20,50],[0,0,5,10,30],[0,0,5,10,30],[0,0,5,10,30],[0,0,5,10,50]],"cps":[1,2,3,5,10,15,20,25,30,50,75,100,150,250,500],"e":false,"ec":0,"cc":""},"un":"accessKey|' . $postData['cr'] . '|52967038","bl":' . $balanceInCents . ',"gn":"TRex","lgn":"The King of Dinosaurs","gv":0,"fs":' . $fs . ',"si":"ac7df4a24f4f441896ec13a994b7b178","dn":[0.01,0.05,0.1,0.25,0.5,1.0,2.0],"cs":"$","cd":2,"cp":true,"gs":",","ds":".","ase":[50],"gm":0,"mi":-1,"cud":0.01,"cup":[' . implode(',', $gameBets) . '],"mm":0,"e":false,"ec":0,"cc":"EN"}';
                                break;
                            case 'ping':
                                $result_tmp[0] = '{"v":' . $balanceInCents . ',"e":false,"ec":0,"cc":"EN"}';
                                break;
                            case 'spin':
                                $linesId = [];
                                $linesId[0] = [
                                    2, 
                                    2, 
                                    2, 
                                    2, 
                                    2
                                ];
                                $linesId[1] = [
                                    3, 
                                    3, 
                                    3, 
                                    3, 
                                    3
                                ];
                                $linesId[2] = [
                                    1, 
                                    1, 
                                    1, 
                                    1, 
                                    1
                                ];
                                $linesId[3] = [
                                    3, 
                                    2, 
                                    1, 
                                    2, 
                                    3
                                ];
                                $linesId[4] = [
                                    1, 
                                    2, 
                                    3, 
                                    2, 
                                    1
                                ];
                                $linesId[5] = [
                                    3, 
                                    3, 
                                    2, 
                                    3, 
                                    3
                                ];
                                $linesId[6] = [
                                    1, 
                                    1, 
                                    2, 
                                    1, 
                                    1
                                ];
                                $linesId[7] = [
                                    2, 
                                    1, 
                                    1, 
                                    1, 
                                    2
                                ];
                                $linesId[8] = [
                                    2, 
                                    3, 
                                    3, 
                                    3, 
                                    2
                                ];
                                $linesId[9] = [
                                    3, 
                                    1, 
                                    1, 
                                    1, 
                                    3
                                ];
                                $linesId[10] = [
                                    1, 
                                    3, 
                                    3, 
                                    3, 
                                    1
                                ];
                                $linesId[11] = [
                                    3, 
                                    2, 
                                    3, 
                                    2, 
                                    3
                                ];
                                $linesId[12] = [
                                    1, 
                                    2, 
                                    1, 
                                    2, 
                                    1
                                ];
                                $linesId[13] = [
                                    2, 
                                    2, 
                                    3, 
                                    2, 
                                    2
                                ];
                                $linesId[14] = [
                                    2, 
                                    2, 
                                    1, 
                                    2, 
                                    2
                                ];
                                $linesId[15] = [
                                    2, 
                                    3, 
                                    2, 
                                    3, 
                                    2
                                ];
                                $linesId[16] = [
                                    2, 
                                    1, 
                                    2, 
                                    1, 
                                    2
                                ];
                                $linesId[17] = [
                                    3, 
                                    2, 
                                    2, 
                                    2, 
                                    3
                                ];
                                $linesId[18] = [
                                    1, 
                                    2, 
                                    2, 
                                    2, 
                                    1
                                ];
                                $linesId[19] = [
                                    2, 
                                    3, 
                                    1, 
                                    3, 
                                    2
                                ];
                                $linesId[20] = [
                                    3, 
                                    3, 
                                    3, 
                                    2, 
                                    1
                                ];
                                $linesId[21] = [
                                    1, 
                                    1, 
                                    1, 
                                    2, 
                                    3
                                ];
                                $linesId[22] = [
                                    3, 
                                    2, 
                                    1, 
                                    1, 
                                    1
                                ];
                                $linesId[23] = [
                                    1, 
                                    2, 
                                    3, 
                                    3, 
                                    3
                                ];
                                $linesId[24] = [
                                    3, 
                                    3, 
                                    2, 
                                    1, 
                                    1
                                ];
                                $linesId[25] = [
                                    1, 
                                    1, 
                                    2, 
                                    3, 
                                    3
                                ];
                                $linesId[26] = [
                                    2, 
                                    3, 
                                    2, 
                                    1, 
                                    2
                                ];
                                $linesId[27] = [
                                    2, 
                                    1, 
                                    2, 
                                    3, 
                                    2
                                ];
                                $linesId[28] = [
                                    3, 
                                    2, 
                                    2, 
                                    2, 
                                    1
                                ];
                                $linesId[29] = [
                                    1, 
                                    2, 
                                    2, 
                                    2, 
                                    3
                                ];
                                $lines = $postData['sel'];
                                $betline = $postData['cps'] / 100;
                                $allbet = $betline * $lines;
                                $postData['slotEvent'] = 'bet';
                                if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                                {
                                    $postData['slotEvent'] = 'freespin';
                                }
                                if( $allbet <= 0.0001 ) 
                                {
                                    $response = '{"responseEvent":"error","responseType":"' . $postData['command'] . '","serverResponse":"invalid bet state"}';
                                    exit( $response );
                                }
                                if( $slotSettings->GetBalance() < $allbet ) 
                                {
                                    $response = '{"responseEvent":"error","responseType":"' . $postData['command'] . '","serverResponse":"invalid balance"}';
                                    exit( $response );
                                }
                                if( $postData['slotEvent'] != 'freespin' ) 
                                {
                                    if( !isset($postData['slotEvent']) ) 
                                    {
                                        $postData['slotEvent'] = 'bet';
                                    }
                                    $slotSettings->SetBalance(-1 * $allbet, $postData['slotEvent']);
                                    $bankSum = $allbet / 100 * $slotSettings->GetPercent();
                                    $slotSettings->SetBank((isset($postData['slotEvent']) ? $postData['slotEvent'] : ''), $bankSum, $postData['slotEvent']);
                                    $slotSettings->UpdateJackpots($allbet);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusSym', 0);
                                    $bonusMpl = 1;
                                }
                                else
                                {
                                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                                    $bonusMpl = $slotSettings->slotFreeMpl;
                                }
                                $winTypeTmp = $slotSettings->GetSpinSettings($postData['slotEvent'], $allbet, $lines);
                                $winType = $winTypeTmp[0];
                                $spinWinLimit = $winTypeTmp[1];
                                $balanceInCents = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                                for( $i = 0; $i <= 2000; $i++ ) 
                                {
                                    $totalWin = 0;
                                    $lineWins = [];
                                    $cWins = [];
                                    $cWinsCount = [];
                                    $cWinsMpl = [];
                                    $wild = ['0'];
                                    $scatter = '11';
                                    $reels = $slotSettings->GetReelStrips($winType, $postData['slotEvent']);
                                    $tmpReels = $reels;
                                    for( $k = 0; $k < $lines; $k++ ) 
                                    {
                                        $cWins[$k] = 0;
                                        $cWinsCount[$k] = 1;
                                        $cWinsMpl[$k] = 1;
                                    }
                                    for( $k = 0; $k < $lines; $k++ ) 
                                    {
                                        $tmpStringWin = '';
                                        for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                                        {
                                            $csym = (string)$slotSettings->SymbolGame[$j];
                                            if( $csym == $scatter || !isset($slotSettings->Paytable['SYM_' . $csym]) ) 
                                            {
                                            }
                                            else
                                            {
                                                $s = [];
                                                $s[0] = $reels['reel1'][$linesId[$k][0] - 1];
                                                $s[1] = $reels['reel2'][$linesId[$k][1] - 1];
                                                $s[2] = $reels['reel3'][$linesId[$k][2] - 1];
                                                $s[3] = $reels['reel4'][$linesId[$k][3] - 1];
                                                $s[4] = $reels['reel5'][$linesId[$k][4] - 1];
                                                if( ($s[0] == $csym || in_array($s[0], $wild)) && ($s[1] == $csym || in_array($s[1], $wild)) ) 
                                                {
                                                    $mpl = 1;
                                                    if( in_array($s[0], $wild) && in_array($s[1], $wild) ) 
                                                    {
                                                        $mpl = 1;
                                                    }
                                                    else if( in_array($s[0], $wild) || in_array($s[1], $wild) ) 
                                                    {
                                                        $mpl = $slotSettings->slotWildMpl;
                                                    }
                                                    $tmpWin = $slotSettings->Paytable['SYM_' . $csym][2] * $betline * $mpl * $bonusMpl;
                                                    if( $cWins[$k] < $tmpWin ) 
                                                    {
                                                        $cWins[$k] = $tmpWin;
                                                        $tmpStringWin = '{"line":' . $k . ',"winAmount":' . ($cWins[$k] * 100) . ',"cells":[0,' . ($linesId[$k][0] - 1) . ',1,' . ($linesId[$k][1] - 1) . '],"freespins":0,"card":' . $csym . '}';
                                                        $cWinsCount[$k] = 3;
                                                    }
                                                }
                                                if( ($s[0] == $csym || in_array($s[0], $wild)) && ($s[1] == $csym || in_array($s[1], $wild)) && ($s[2] == $csym || in_array($s[2], $wild)) ) 
                                                {
                                                    $mpl = 1;
                                                    if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) ) 
                                                    {
                                                        $mpl = 1;
                                                    }
                                                    else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) ) 
                                                    {
                                                        $mpl = $slotSettings->slotWildMpl;
                                                    }
                                                    $tmpWin = $slotSettings->Paytable['SYM_' . $csym][3] * $betline * $mpl * $bonusMpl;
                                                    if( $cWins[$k] < $tmpWin ) 
                                                    {
                                                        $cWins[$k] = $tmpWin;
                                                        $tmpStringWin = '{"line":' . $k . ',"winAmount":' . ($cWins[$k] * 100) . ',"cells":[0,' . ($linesId[$k][0] - 1) . ',1,' . ($linesId[$k][1] - 1) . ',2,' . ($linesId[$k][2] - 1) . '],"freespins":0,"card":' . $csym . '}';
                                                        $cWinsCount[$k] = 7;
                                                    }
                                                }
                                                if( ($s[0] == $csym || in_array($s[0], $wild)) && ($s[1] == $csym || in_array($s[1], $wild)) && ($s[2] == $csym || in_array($s[2], $wild)) && ($s[3] == $csym || in_array($s[3], $wild)) ) 
                                                {
                                                    $mpl = 1;
                                                    if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) && in_array($s[3], $wild) ) 
                                                    {
                                                        $mpl = 1;
                                                    }
                                                    else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) || in_array($s[3], $wild) ) 
                                                    {
                                                        $mpl = $slotSettings->slotWildMpl;
                                                    }
                                                    $tmpWin = $slotSettings->Paytable['SYM_' . $csym][4] * $betline * $mpl * $bonusMpl;
                                                    if( $cWins[$k] < $tmpWin ) 
                                                    {
                                                        $cWins[$k] = $tmpWin;
                                                        $tmpStringWin = '{"line":' . $k . ',"winAmount":' . ($cWins[$k] * 100) . ',"cells":[0,' . ($linesId[$k][0] - 1) . ',1,' . ($linesId[$k][1] - 1) . ',2,' . ($linesId[$k][2] - 1) . ',3,' . ($linesId[$k][3] - 1) . '],"freespins":0,"card":' . $csym . '}';
                                                        $cWinsCount[$k] = 15;
                                                    }
                                                }
                                                if( ($s[0] == $csym || in_array($s[0], $wild)) && ($s[1] == $csym || in_array($s[1], $wild)) && ($s[2] == $csym || in_array($s[2], $wild)) && ($s[3] == $csym || in_array($s[3], $wild)) && ($s[4] == $csym || in_array($s[4], $wild)) ) 
                                                {
                                                    $mpl = 1;
                                                    if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) && in_array($s[3], $wild) && in_array($s[4], $wild) ) 
                                                    {
                                                        $mpl = 1;
                                                    }
                                                    else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) || in_array($s[3], $wild) || in_array($s[4], $wild) ) 
                                                    {
                                                        $mpl = $slotSettings->slotWildMpl;
                                                    }
                                                    $tmpWin = $slotSettings->Paytable['SYM_' . $csym][5] * $betline * $mpl * $bonusMpl;
                                                    if( $cWins[$k] < $tmpWin ) 
                                                    {
                                                        $cWins[$k] = $tmpWin;
                                                        $tmpStringWin = '{"line":' . $k . ',"winAmount":' . ($cWins[$k] * 100) . ',"cells":[0,' . ($linesId[$k][0] - 1) . ',1,' . ($linesId[$k][1] - 1) . ',2,' . ($linesId[$k][2] - 1) . ',3,' . ($linesId[$k][3] - 1) . ',4,' . ($linesId[$k][4] - 1) . '],"freespins":0,"card":' . $csym . '}';
                                                        $cWinsCount[$k] = 31;
                                                    }
                                                }
                                            }
                                        }
                                        if( $cWins[$k] > 0 && $tmpStringWin != '' ) 
                                        {
                                            $cWinsMpl[$k] = $bonusMpl;
                                            array_push($lineWins, $tmpStringWin);
                                            $totalWin += $cWins[$k];
                                            $cWins[$k] = $cWins[$k] / $bonusMpl;
                                        }
                                    }
                                    $scattersWin = 0;
                                    $scattersStr = '';
                                    $scattersCount = 0;
                                    $scPos = [];
                                    $scRPos = [
                                        0, 
                                        1, 
                                        2, 
                                        4, 
                                        8, 
                                        16
                                    ];
                                    $swm_ = [
                                        0, 
                                        0, 
                                        0
                                    ];
                                    for( $p = 2; $p >= 0; $p-- ) 
                                    {
                                        if( $reels['reel1'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 1;
                                        }
                                        if( $reels['reel2'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 2;
                                        }
                                        if( $reels['reel3'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 4;
                                        }
                                        if( $reels['reel4'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 8;
                                        }
                                        if( $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 16;
                                        }
                                        if( $reels['reel1'][$p] == $scatter && $reels['reel2'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 3;
                                        }
                                        if( $reels['reel1'][$p] == $scatter && $reels['reel3'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 5;
                                        }
                                        if( $reels['reel2'][$p] == $scatter && $reels['reel3'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 6;
                                        }
                                        if( $reels['reel1'][$p] == $scatter && $reels['reel4'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 9;
                                        }
                                        if( $reels['reel2'][$p] == $scatter && $reels['reel4'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 10;
                                        }
                                        if( $reels['reel3'][$p] == $scatter && $reels['reel4'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 12;
                                        }
                                        if( $reels['reel1'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 17;
                                        }
                                        if( $reels['reel2'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 18;
                                        }
                                        if( $reels['reel3'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 20;
                                        }
                                        if( $reels['reel4'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 24;
                                        }
                                        if( $reels['reel1'][$p] == $scatter && $reels['reel2'][$p] == $scatter && $reels['reel3'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 7;
                                        }
                                        if( $reels['reel1'][$p] == $scatter && $reels['reel2'][$p] == $scatter && $reels['reel4'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 11;
                                        }
                                        if( $reels['reel1'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel4'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 13;
                                        }
                                        if( $reels['reel2'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel4'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 14;
                                        }
                                        if( $reels['reel1'][$p] == $scatter && $reels['reel2'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 19;
                                        }
                                        if( $reels['reel1'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 21;
                                        }
                                        if( $reels['reel2'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 22;
                                        }
                                        if( $reels['reel1'][$p] == $scatter && $reels['reel4'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 25;
                                        }
                                        if( $reels['reel2'][$p] == $scatter && $reels['reel4'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 26;
                                        }
                                        if( $reels['reel3'][$p] == $scatter && $reels['reel4'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 28;
                                        }
                                        if( $reels['reel1'][$p] == $scatter && $reels['reel2'][$p] == $scatter && $reels['reel4'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 27;
                                        }
                                        if( $reels['reel1'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel4'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 29;
                                        }
                                        if( $reels['reel2'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel4'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 30;
                                        }
                                        if( $reels['reel1'][$p] == $scatter && $reels['reel2'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 23;
                                        }
                                        if( $reels['reel1'][$p] == $scatter && $reels['reel2'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel4'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 15;
                                        }
                                        if( $reels['reel1'][$p] == $scatter && $reels['reel2'][$p] == $scatter && $reels['reel3'][$p] == $scatter && $reels['reel4'][$p] == $scatter && $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $swm_[$p] = 31;
                                        }
                                        if( $reels['reel1'][$p] == $scatter ) 
                                        {
                                            $scattersCount++;
                                        }
                                        if( $reels['reel2'][$p] == $scatter ) 
                                        {
                                            $scattersCount++;
                                        }
                                        if( $reels['reel3'][$p] == $scatter ) 
                                        {
                                            $scattersCount++;
                                        }
                                        if( $reels['reel4'][$p] == $scatter ) 
                                        {
                                            $scattersCount++;
                                        }
                                        if( $reels['reel5'][$p] == $scatter ) 
                                        {
                                            $scattersCount++;
                                        }
                                    }
                                    $scattersWin = $slotSettings->Paytable['SYM_' . $scatter][$scattersCount] * $allbet * $bonusMpl;
                                    $totalWin += $scattersWin;
                                    $expSymReels = 0;
                                    $expLine = 0;
                                    $expSymCnt = 0;
                                    $bSym = 0;
                                    $totalWinExp = 0;
                                    if( $postData['slotEvent'] == 'freespin' ) 
                                    {
                                        $bSym = $slotSettings->GetGameData($slotSettings->slotId . 'BonusSym');
                                        $reels_t = [];
                                        $reels_t['reel1'] = [
                                            0, 
                                            0, 
                                            0
                                        ];
                                        $reels_t['reel2'] = [
                                            0, 
                                            0, 
                                            0
                                        ];
                                        $reels_t['reel3'] = [
                                            0, 
                                            0, 
                                            0
                                        ];
                                        $reels_t['reel4'] = [
                                            0, 
                                            0, 
                                            0
                                        ];
                                        $reels_t['reel5'] = [
                                            0, 
                                            0, 
                                            0
                                        ];
                                        for( $r = 1; $r <= 5; $r++ ) 
                                        {
                                            for( $p = 0; $p <= 2; $p++ ) 
                                            {
                                                if( $reels['reel' . $r][$p] == $bSym ) 
                                                {
                                                    $reels['reel' . $r][0] = $bSym;
                                                    $reels['reel' . $r][1] = $bSym;
                                                    $reels['reel' . $r][2] = $bSym;
                                                    $reels_t['reel' . $r][0] = -1;
                                                    $reels_t['reel' . $r][1] = -1;
                                                    $reels_t['reel' . $r][2] = -1;
                                                    $expSymCnt++;
                                                    break;
                                                }
                                            }
                                        }
                                        $reels_t2 = [];
                                        $reels_t2['reel1'] = [
                                            0, 
                                            0, 
                                            0
                                        ];
                                        $reels_t2['reel2'] = [
                                            0, 
                                            0, 
                                            0
                                        ];
                                        $reels_t2['reel3'] = [
                                            0, 
                                            0, 
                                            0
                                        ];
                                        $reels_t2['reel4'] = [
                                            0, 
                                            0, 
                                            0
                                        ];
                                        $reels_t2['reel5'] = [
                                            0, 
                                            0, 
                                            0
                                        ];
                                        for( $r = 1; $r <= 5; $r++ ) 
                                        {
                                            for( $p = 2; $p <= 2; $p++ ) 
                                            {
                                                if( $reels['reel' . $r][$p] == $bSym ) 
                                                {
                                                    $reels_t2['reel' . $r][2] = -1;
                                                    break;
                                                }
                                            }
                                        }
                                        $totalWinExp = $slotSettings->Paytable['SYM_' . $bSym][$expSymCnt] * $betline * $lines * 100;
                                        if( $totalWinExp > 0 ) 
                                        {
                                            $expLine = $slotSettings->GetSymPositions($reels_t2);
                                            $expSymReels = $slotSettings->GetSymPositions($reels_t);
                                        }
                                        $totalWin += $totalWinExp;
                                    }
                                    if( $i > 1000 ) 
                                    {
                                        $winType = 'none';
                                    }
                                    if( $i > 1500 ) 
                                    {
                                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"' . $totalWin . ' Bad Reel Strip"}';
                                        exit( $response );
                                    }
                                    if( $slotSettings->MaxWin < ($totalWin * $slotSettings->CurrentDenom) ) 
                                    {
                                    }
                                    else
                                    {
                                        $minWin = $slotSettings->GetRandomPay();
                                        if( $i > 700 ) 
                                        {
                                            $minWin = 0;
                                        }
                                        if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($minWin * $allbet) ) 
                                        {
                                        }
                                        else if( $scattersCount >= 3 && $winType != 'bonus' ) 
                                        {
                                        }
                                        else if( $totalWin <= $spinWinLimit && $winType == 'bonus' ) 
                                        {
                                            $cBank = $slotSettings->GetBank((isset($postData['slotEvent']) ? $postData['slotEvent'] : ''));
                                            if( $cBank < $spinWinLimit ) 
                                            {
                                                $spinWinLimit = $cBank;
                                            }
                                            else
                                            {
                                                break;
                                            }
                                        }
                                        else if( $totalWin > 0 && $totalWin <= $spinWinLimit && $winType == 'win' ) 
                                        {
                                            $cBank = $slotSettings->GetBank((isset($postData['slotEvent']) ? $postData['slotEvent'] : ''));
                                            if( $cBank < $spinWinLimit ) 
                                            {
                                                $spinWinLimit = $cBank;
                                            }
                                            else
                                            {
                                                break;
                                            }
                                        }
                                        else if( $totalWin == 0 && $winType == 'none' ) 
                                        {
                                            break;
                                        }
                                    }
                                }
                                if( $totalWin > 0 ) 
                                {
                                    $slotSettings->SetBank((isset($postData['slotEvent']) ? $postData['slotEvent'] : ''), -1 * $totalWin);
                                    $slotSettings->SetBalance($totalWin);
                                }
                                $reportWin = $totalWin;
                                if( $postData['slotEvent'] == 'freespin' ) 
                                {
                                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                                }
                                else
                                {
                                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                                }
                                $fs = 0;
                                $swu = 0;
                                $swm = 0;
                                if( $scattersCount >= 3 ) 
                                {
                                    $swm = $swm_[2] + (32 * $swm_[1]) + (1024 * $swm_[0]);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusSym', rand(1, 10));
                                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $totalWin);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->slotFreeCount[$scattersCount]);
                                    $bSym = $slotSettings->GetGameData($slotSettings->slotId . 'BonusSym');
                                    $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                                    $swu = 1;
                                }
                                $winString = implode(',', $lineWins);
                                $jsSpin = '' . json_encode($reels) . '';
                                $jsJack = '' . json_encode($slotSettings->Jackpots) . '';
                                $response = '{"responseEvent":"spin","responseType":"' . $postData['slotEvent'] . '","serverResponse":{"BonusSym":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusSym') . ',"slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $balanceInCents . ',"afterBalance":' . $balanceInCents . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $winString . '],"Jackpots":' . $jsJack . ',"reelsSymbols":' . $jsSpin . '}}';
                                $slotSettings->SaveLogReport($response, $allbet, $lines, $reportWin, $postData['slotEvent']);
                                $winstring = '';
                                $reels = $tmpReels;
                                $curReels = '';
                                $curReels .= ($reels['reel1'][2] . ',' . $reels['reel2'][2] . ',' . $reels['reel3'][2] . ',' . $reels['reel4'][2] . ',' . $reels['reel5'][2]);
                                $curReels .= (',' . $reels['reel1'][1] . ',' . $reels['reel2'][1] . ',' . $reels['reel3'][1] . ',' . $reels['reel4'][1] . ',' . $reels['reel5'][1]);
                                $curReels .= (',' . $reels['reel1'][0] . ',' . $reels['reel2'][0] . ',' . $reels['reel3'][0] . ',' . $reels['reel4'][0] . ',' . $reels['reel5'][0]);
                                $acb = 0;
                                $fs_ = 'false';
                                if( $winType == 'bonus' ) 
                                {
                                    $acb = 1;
                                }
                                if( $postData['slotEvent'] == 'freespin' ) 
                                {
                                    $fs_ = 'true';
                                    $acb = 1;
                                    if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') > 0 ) 
                                    {
                                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin'));
                                    }
                                }
                                for( $ww = 0; $ww < count($cWins); $ww++ ) 
                                {
                                    $cWinsStr[$ww] = $cWins[$ww] * 100;
                                }
                                $expLineResult = [];
                                $expWinResult = [];
                                for( $ww = 0; $ww < 30; $ww++ ) 
                                {
                                    $expLineResult[$ww] = $expLine;
                                    $expWinResult[$ww] = $slotSettings->Paytable['SYM_' . $bSym][$expSymCnt] * $betline * 100;
                                }
                                $balanceInCents2 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                                if( $totalWinExp > 0 ) 
                                {
                                    $expInnfo = ',"as":[{"asi":399978113,"st":[' . $curReels . '],"swi":[' . implode(',', $expWinResult) . '],"snm":[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],"ssm":[' . implode(',', $expLineResult) . '],"swm":0,"sw":0,"swu":0,"fsw":0,"tw":' . $totalWin . '}]';
                                }
                                else
                                {
                                    $expInnfo = '';
                                }
                                $result_tmp[0] = '{"sid":' . rand(0, 9999999) . ',"md":{"sid":' . rand(0, 9999999) . ',"tid":"d9653471731a41ccb233537a5f121508","sel":30,"cps":5,"dn":0.01,"nd":0.01,"ncps":0,"atb":0,"v":true,"fs":' . $fs_ . ',"twg":' . ($lines * $betline * 100) . ',"swm":' . $swm . ',"sw":' . ($scattersWin * 100) . ',"swu":' . $swu . ',"tw":' . ($totalWin * 100) . ',"fsw":' . $fs . ',"fsr":' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) . ',"tfw":' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . ',"st":[' . $curReels . '],"swi":[' . implode(',', $cWinsStr) . '],"snm":[' . implode(',', $cWinsMpl) . '],"ssm":[' . implode(',', $cWinsCount) . '],"sm":[' . $bSym . ',' . $expSymReels . '],"acb":' . $acb . ',"rf":0' . $expInnfo . ',"sp":64,"cr":"USD","sessionId":"a60bc95e7d4e407b8bd4afb936e77256","rd":1,"pbb":' . $balanceInCents . ',"obb":' . $balanceInCents2 . ',"mb":false,"pwa":0,"pac":{}},"pcr":' . $balanceInCents . ',"cr":' . $balanceInCents2 . ',"xp":0,"lvl":{"lvl":1,"xp":0,"bc":0,"cps":5,"sc":200,"wb":0},"dl":0,"cps":[1,2,3,5,10,15,20,25,30,50,75,100,150,250,500],"e":false,"ec":0,"cc":"EN"}';
                                break;
                            case 'updatePlayerInfo':
                                $result_tmp[0] = '{"e":false,"ec":0,"cc":"EN"}';
                                break;
                        }
                        if( !isset($result_tmp[0]) ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"","serverResponse":"Invalid request state"}';
                            exit( $response );
                        }
                        $response = $result_tmp[0];
                        $slotSettings->SaveGameData();
                        $slotSettings->SaveGameDataStatic();
                        echo $response;
                    }
                    catch( \Exception $e ) 
                    {
                        if( isset($slotSettings) ) 
                        {
                            $slotSettings->InternalErrorSilent($e);
                        }
                        else
                        {
                            $strLog = '';
                            $strLog .= "\n";
                            $strLog .= ('{"responseEvent":"error","responseType":"' . $e . '","serverResponse":"InternalError","request":' . json_encode($_REQUEST) . ',"requestRaw":' . file_get_contents('php://input') . '}');
                            $strLog .= "\n";
                            $strLog .= ' ############################################### ';
                            $strLog .= "\n";
                            $slg = '';
                            if( file_exists(storage_path('logs/') . 'GameInternal.log') ) 
                            {
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
