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
    $str .= 'drawtext=fontcolor=white:fontfile=FreeSans.ttf:text='.$color.':enable=\'between(t,'.$debut.',	'.$duration.')\':fontsize=40:x=w-tw-210:y=h-th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text='.$score.':enable=\'between(t,'.$debut.','.$goal['timecode'].')\':fontsize=40:x=w-tw-180:y=h-th-30,';
    }

      $score++;
      $debut = $goal['timecode'];
  }
    if ($color === 'blue'){
   $blue .= 'drawtext=fontcolor=white:fontfile=FreeSans.ttf:text='.$color.':enable=\'between(t,'.$debut.','.$duration.')\':fontsize=40:x=w-tw-210:y=h-th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text='.$score.':enable=\'between(t,'.$goal['timecode'].','.$duration.')\':fontsize=40:x=w-tw-180:y=h-th-30';
    }

}
$timer .= ',drawtext=fontfile=FreeSans.ttf:expansion=normal:text=\'%{pts\:gmtime\:0\:%H\\\\\:%M}\':fontcolor=white:fontsize=40:x=1140:y=660"';
$cmdB .= "ffmpeg -i video0.mkv -vf \" $str $orange $blue -codec:a copy video.mkv";
var_dump($cmdB);

?>

