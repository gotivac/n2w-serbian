<?php

    header('Content-Type: text/html; charset=utf-8');
    function number_to_words($broj)
    {

        /*************************************************************
        Rewritten in PHP by Gotivac 2013.
        Original by NDragan, written in FoxPro.
        **************************************************************/

        If ($broj == 0) $rez = "nula";

        $imebr = array();
        $imebr[1] = "jedan";
        $imebr[2] = "dva";
        $imebr[3] = "tri";
        $imebr[4] = "četiri";
        $imebr[5] = "pet";
        $imebr[6] = "šest";
        $imebr[7] = "sedam";
        $imebr[8] = "osam";
        $imebr[9] = "devet";


        $rez = "";
        $celi = floor($broj);

        $dec = (($broj - $celi) * 100) % 100;
        $cbr = strval($celi);

        $duzina = 16 - strlen($cbr);

        $cbroj = "";
        for ($i=1;$i<$duzina;$i++)
        {
            $cbroj .= "0";
        }

        $cbroj .= $cbr;


        for ($i=1;$i<=15;$i=$i+3)
        {
            $tric = substr($cbroj, $i-1, 3);

            $trojka = intval($tric);
            if ($tric != '000')
            {                                                     
                $cs=intval(substr($tric,0,1));
                $cd=intval(substr($tric,1,1));
                $cj=intval(substr($tric,2,1));
                switch($cs)
                {
                    case 0:
                        break;
                    case 1:
                        break;
                    case 2:
                        $rez = $rez . "dve";
                        break;
                    default:
                        $rez = $rez . $imebr[$cs];

                }

                switch($cs)
                {
                    case 0:
                        break;
                    case 1:
                        $rez .= "stotinu";
                        break;
                    case 2:
                        $rez .= "stotine";
                        break;
                    case 3:
                        $rez .= "stotine";
                        break;
                    case 4:
                        $rez .= "stotine";
                        break;
                    default:
                        $rez .= "stotina";
                        break;
                }


                if ($cj == 0)
                {
                    $sl1 = "";
                }
                else
                {
                    $sl1 = $imebr[$cj];
                }


                switch ($cd)
                {
                    case 4:
                        $rez .= "četr";
                        break;
                    case 6:
                        $rez .= "šez";
                        break;
                    case 5:
                        $rez .="pe";
                        break;
                    case 9:
                        $rez .= "deve";
                        break;
                    case 2:
                        $rez .= $imebr[$cd];
                        break;
                    case 3:
                        $rez .= $imebr[$cd];
                        break;
                    case 7:
                        $rez .= $imebr[$cd];
                        break;
                    case 8:
                        $rez .= $imebr[$cd];
                        break;
                    case 1:
                    $sl1 = "";
                    switch($cj)
                    {
                        case 0:
                            $rez .= "deset";
                            break;
                        case 1:
                            $rez .= "jeda";
                            break;
                        case 4:
                            $rez .= "četr";
                            break;
                        default:
                            $rez .= $imebr[$cj];
                    }
                    if ($cj > 0) $rez .= "naest";

                }

                if ($cd > 1) $rez .= "deset";


                if (($i == 4 || $i == 10) && $cd != 1)
                {
                    if ($cj == 1)
                    {
                        $sl1 = "jedna";
                    }
                    if ($cj == 2)
                    {
                        $sl1 = "dve";
                    }
                }


                $rez .= $sl1;
                switch ($i)

                {
                    case 1:
                        $rez .= "bilion";
                        if ($cj > 1 || $cd == 1) $rez .= "a";
                        break;
                    case 4:
                        $rez .= "milijard";
                        if (($trojka % 100 > 11) && ($trojka % 100 < 19))
                        {
                            $rez .= "i";
                        }
                        else
                        {
                            if ($cj == 1) $rez .= "a";
                            if ($cj > 4) $rez .="i";
                            if ($cj > 1) $rez .="e";
                        }
                        break;
                    case 7:
                        $rez .= "milion";
                        if ((($trojka % 100 > 11) && ($trojka % 100 < 19)) || $cj != 1) $rez.="a";
                        break;
                    case 10:
                        $rez .= "hiljad";
                        if ((($trojka % 100 > 11) && ($trojka % 100 < 19)) || $cj == 1)
                        {
                            $rez .= "a";
                        }
                        else if ($trojka == 1)
                            {
                                $rez .= "u";
                            }
                            else if ($cj > 4 || $cj == 0)
                                {
                                    $rez .= "a";
                                }
                                else if ($cj > 1)
                                    {
                                        $rez .= "e";
                                    }
                                    break;
                    default:
                        break;

                }
            }
        }

        $slovima = $rez . " i " . strval($dec) . "/100";
        return $slovima;

    }

    if(isset($_POST['num']))
    {
        echo '
        '.htmlspecialchars($_POST['num']).' = '.number_to_words($_POST['num']).'<p>
        <a href="'.$_SERVER['PHP_SELF'].'">try again</a>';
    }else{
        echo '
        <form method="post" action="'.$_SERVER['PHP_SELF'].'">
        <input type="text" name="num">
        <input type="submit" value="spell number">
        </form>';
    }
?>
