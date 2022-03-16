<?php
class ChartController
{
    function __destruct()
    {
        
    }

    function Top()
    {
        $arr = $_POST;
        $titel = $_SERVER['HTTP_TITEL'];
        $bottomtext = $_SERVER['HTTP_BOTTOM'];
        $page = "<html>";
        $page .="<body>";
        $page .="<h1 style='text-align:center;'>". strip_tags($titel)."</h1>";
        $page .= "<div style='display:flex;flex-direction:row;justify-content: space-evenly;width:900px;
        height:500;border:1px solid black;transform:rotate(180deg);'>";
        $color = array("red","yellow","lightblue","green","gray","coral","pink");
        reset($color);
        //Kastar om ordingen i arrayen för att få allt att funka grafiskt.
        $arr = array_reverse($arr,true);
        //Högsta värdet sparas
        $max = $this->MaxNumber($arr);
        //Ritar ut staplarna
        foreach ($arr as $key => $value) {
            $page .= "<div class='" . strip_tags($key) . "'style='height: ". (int)(($value/$max)*475)."px;width:75px;
            background-color: ". current($color).";border:1px solid black;transform:rotate(180deg);'><p>".strip_tags($key)." (".strip_tags($value).")</p></div>";
            next($color);
        }
        $page .= "</div>";
        $page .= "<h2 atyle='text-align: left;'>".  strip_tags($bottomtext) ."</h2>";
        $page .= "</body></html>";
        return $page;
    }
    function Left()
    {
        $arr = $_POST;
        $titel = $_SERVER['HTTP_TITEL'];
        $bottomtext = $_SERVER['HTTP_BOTTOM'];
        $page = "<html>";
        $page .="<h1 style='text-align:center;'>". strip_tags($titel)."</h1>";
        $page .= "<body style='display:flex;flex-direction:column;flex-wrap:wrap;align-items:left;width:900px;
        height:auto;border:1px solid black'>";
        $color = array("red","yellow","lightblue","lightgreen","gray","coral","pink","whitesmoke");
        reset($color);
        //Max värdet i stapeln för att rita ut det korrekt.
        $max = $this->MaxNumber($arr);
        foreach ($arr as $key => $value) {
            $page .= "<div class='" .  strip_tags($key) . "'style='width: ". (($value/$max)*875)."px;height:50px;
            background-color: ". current($color).";border:1px solid black'>". strip_tags($key)." (". strip_tags($value).")</div>";
            next($color);
        }
        $page .= "<h2 atyle='text-align: left;'>".  strip_tags($bottomtext) ."</h2>";
        $page .= "</body></html>";
        return $page;
    }

    private function MaxNumber($arr)
    {
        $max = 0;
        foreach ($arr as $key => $value) {
            if (!is_numeric($value))
            {
                throw new ErrorException("Fel värden");
            }
            if ($value > $max)
            {
                $max = $value;
            }
        }
        return $max;
    }
}
?>