<?php

$duration = 20;

$goals = [
    ['timecode' => 2, 'team' => 'blue'],
    ['timecode' => 4, 'team' => 'orange'],
    ['timecode' => 6, 'team' => 'blue'],
    ['timecode' => 10, 'team' => 'blue'],
];


$str = 'ffmpeg ';
foreach(['blue', 'orange'] as $color) {
  $goalsOrange = array_filter($goals, function ($goal) use ($color) {
      return $goal['team'] === $color;
  });

  $debut = 0;
  $score = 0;
  
  foreach($goalsOrange as $key => $goal) {
      $str .= 'debut='.$debut.'&fin='.$goal['timecode'].'&score='.$score;

      $score++;
      $debut = $goal['timecode'];
  }
  $str .= 'debut='.$debut.'&fin='.$duration.'&score='.$score;

  
}
var_dump($str);

//////////////////////////

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
	$str .= '"drawtext=fontcolor=white:fontfile=FreeSans.ttf:text='.$color.':enable=\'between(t,'.$debut.',	'.$duration.')\':fontsize=40:x=w-tw-420:y=h-			th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text='.$score.':enable=\'between(t,'.$debut.','.$goal['timecode'].')\':fontsize=40:x=w-tw-340:y=h-th-30",';

      $score++;
      $debut = $goal['timecode'];
  }

}
$cmd .= "ffmpeg -i video0.mkv -vf $str -codec:a copy video.mkv <br/> ";
var_dump($cmd);.mkv -vf $str -codec:a copy video.mkv <br/> ";
var_dump($cmd);



//////////////////////////////////////////////////////////////////////////////////
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
	$str .= '"drawtext=fontcolor=white:fontfile=FreeSans.ttf:text='.$color.':enable=\'between(t,'.$debut.',	'.$duration.')\':fontsize=40:x=w-tw-420:y=h-			th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text='.$score.':enable=\'between(t,'.$debut.','.$goal['timecode'].')\':fontsize=40:x=w-tw-340:y=h-th-30",';
    }
    if ($color === 'orange'){
    	$str .= '"drawtext=fontcolor=white:fontfile=FreeSans.ttf:text='.$color.':enable=\'between(t,'.$debut.',	'.$duration.')\':fontsize=40:x=w-tw-420:y=h-			th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text='.$score.':enable=\'between(t,'.$debut.','.$goal['timecode'].')\':fontsize=40:x=w-tw-340:y=h-th-30",';
    }

      $score++;
      $debut = $goal['timecode'];
  }
      if ($color === 'orange'){
    	$str .= '"drawtext=fontcolor=white:fontfile=FreeSans.ttf:text='.$color.':enable=\'between(t,'.$debut.',	'.$duration.')\':fontsize=40:x=w-tw-420:y=h-		th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text='.$score.':enable=\'between(t,'.$debut.','.$duration.')\':fontsize=40:x=w-tw-340:y=h-th-30",';
    }

}
$cmd .= "ffmpeg -i video0.mkv -vf $str -codec:a copy video.mkv <br/> ";
var_dump($cmd);