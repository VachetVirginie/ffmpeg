<?php
$duration = 20;

$goals = [
    ['timecode' => 2, 'team' => 'blue'],
    ['timecode' => 4, 'team' => 'orange'],
    ['timecode' => 6, 'team' => 'blue'],
    ['timecode' => 10, 'team' => 'blue'],
];


$str = '';
foreach(['blue', 'orange'] as $color) {
  $goalsOrange = array_filter($goals, function ($goal) use ($color) {
      return $goal['team'] === $color;
  });

  $debut = 0;
  $score = 0;
  
  foreach($goalsOrange as $key => $goal) {
  	if ($color === 'blue'){
    	$str .= sprintf("drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=%s:enable='between(t,%s,%s)':fontsize=40:x=w-tw-210:y=h-th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=%s:enable='between(t,%s,%s)':fontsize=40:x=w-tw-180:y=h-th-30,",$color,$debut,$duration,$score,$debut,$goal['timecode']);
    }
    if ($color === 'orange'){
        	$str .= sprintf("drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=%s:enable='between(t,%s,%s)':fontsize=40:x=w-tw-390:y=h-th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=%s:enable='between(t,%s,%s)':fontsize=40:x=w-tw-340:y=h-th-30,",$color,$debut,$duration,$score,$debut,$goal['timecode']);
        }

      $score++;
      $debut = $goal['timecode'];
  }
    if ($color === 'blue'){
   $blue .= sprintf("drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=%s:enable='between(t,%s,%s)':fontsize=40:x=w-tw-210:y=h-th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=%s:enable='between(t,%s,%s)':fontsize=40:x=w-tw-180:y=h-th-30,",$color,$debut,$duration,$score,$goal['timecode'],$duration);
    }
        if ($color === 'orange'){
   $orange .= sprintf("drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=%s:enable='between(t,%s,%s)':fontsize=40:x=w-tw-390:y=h-th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=%s:enable='between(t,%s,%s)':fontsize=40:x=w-tw-340:y=h-th-30",$color,$debut,$duration,$score,$goal['timecode'],$duration);
    }


}
$ffmpeg ='ffmpeg -i video0.mkv -vf "';
$timer = ',drawtext=fontfile=FreeSans.ttf:expansion=normal:text=\'%{pts\:gmtime\:0\:%H\\\\\\\\\:%M}\':fontcolor=white:fontsize=40:x=1140:y=660"';
$end = ' -codec:a copy video.mkv';

$cmdB .=  $ffmpeg.$str.$blue.$orange.$timer.$end ;
var_dump($cmdB);

?>