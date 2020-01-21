<?php
$duration = 20;

$goals = [['timecode' => 2, 'team' => 'blue'], ['timecode' => 4, 'team' => 'orange'], ['timecode' => 6, 'team' => 'blue'], ['timecode' => 10, 'team' => 'blue'], ];

$str = '';
foreach (['blue', 'orange'] as $color)
{
    $goalsOrange = array_filter($goals, function ($goal) use ($color)
    {
        return $goal['team'] === $color;
    });

    $debut = 0;
    $score = 0;

    foreach ($goalsOrange as $key => $goal)
    {
        if ($color === 'blue')
        {
            $xTeam = "x=w-tw-210:y=h-th-30";
            $xScore = "x=w-tw-180:y=h-th-30";
        }
        if ($color === 'orange')
        {
            $xTeam = "x=w-tw-390:y=h-th-30";
            $xScore = "x=w-tw-340:y=h-th-30";
        }

        $str .= sprintf("drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=%s:enable='between(t,%s,	%s)':fontsize=40:%s,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=%s:enable='between(t,%s,%s)':fontsize=40:%s,", $color, $debut, $duration, $xTeam, $score, $debut, $goal['timecode'], $xScore);
        
        $score++;
        $debut = $goal['timecode'];
    }
    
    if ($color === 'blue')
    {
        $xTeam = "x=w-tw-210:y=h-th-30";
        $xScore = "x=w-tw-180:y=h-th-30";

    }
    if ($color === 'orange')
    {
        $xTeam = "x=w-tw-390:y=h-th-30";
        $xScore = "x=w-tw-340:y=h-th-30";
    }

  $last = sprintf(
"drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=%s:enable='between(t,%s,%s)':fontsize=40:%s,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=%s:enable='between(t,%s,%s)':fontsize=40:%s", $color, $debut, $duration, $xTeam, $score, $goal['timecode'], $duration, $xScore);

}
          

$ffmpeg = 'ffmpeg -i logoScore.mkv -vf "';
$timer = ',drawtext=fontfile=FreeSans.ttf:expansion=normal:text=\'%{pts\:gmtime\:0\:%H\\\\\\\\\:%M}\':fontcolor=white:fontsize=40:x=1140:y=660"';
$end = ' -codec:a copy video.mkv';

$cmdB .= $ffmpeg . $str . $last . $timer . $end;
var_dump($cmdB);

?>
