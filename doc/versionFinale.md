# FFmpeg
![FFmpeg logo](https://i1.wp.com/www.softwarert.com/wp-content/uploads/2017/08/ffmpeg-logo.png?resize=396%2C160&ssl=1)

## Ressources:

[Documentation](https://ffmpeg.org/ffmpeg.html)

[Tuto sur youtube](https://www.youtube.com/playlist?list=PL-jO1Uomc5sdlqcl5TuAA2Z7U7r2dzsxX)

[FFMPEG pour Flutter](https://flutterawesome.com/ffmpeg-plugin-for-flutter-supports-ios-and-android/)
###  Installation:

```sh
apt install ffmpeg
```
# Ajouter logo + scores  dynamiques
## 1ere CMD:
### Servant à ajouter les imgs sur la video. 
```sh
ffmpeg -i video0.mkv -i ../img/logo.png -i ../img/sb.png -filter_complex "[0:v][1:v]overlay=10:main_h-overlay_h-10[tmp];[tmp][2:v]overlay=x=(main_w-overlay_w):y=(main_h-overlay_h)" logoScore.mkv
```

#### ffmpeg -i =
utilise l’option ‘-i’ pour declarer les fichiers d’entrée. Chacun des deux fichiers d'entrée est fourni en tant que paramètre après l'option «-i».
#### video0.mkv =
videoEnEntre.mkv -i img1-i img2 
#### -filter_complex =  
Le paramètre après l'option –filter_complex (entre guillemets) consiste en une série de filtres complexes séparés par des points-virgules.
#### "[0:v][1:v] = 
[0: v] représente le flux vidéo d'entrée. Le nombre à gauche de «:» représente le numéro d'entrée (commençant par 0) en fonction de l'ordre dans lequel ils sont fournis avec le paramètre «-i». 
##### overlay=10:main_h-overlay_h-10[tmp];[tmp][2:v]overlay=x=(main_w-overlay_w):y=(main_h-overlay_h)"=
positionnement des images :
Dans ces exemples on utilise  5 pixels de padding
#### En haut à gauche
overlay=5:5
#### En haut à droite
overlay=main_w-overlay_w-5:5

or with the shortened options:

overlay=W-w-5:5

#### En bas à droite

With 5 pixels of padding:

overlay=main_w-overlay_w-5:main_h-overlay_h-5

or with the shortened options:

overlay=W-w-5:H-h-5

#### En bas à gauche

With 5 pixels of padding:

overlay=5:main_h-overlay_h

or with the shortened options:

overlay=5:H-h-5


#### logoScore.mkv =
videoEnSortie.mkv


## 1ere CMD:
### Servant à ajouter les textes et le timer. 
```sh
ffmpeg -i logoScore.mkv -vf "drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=OM:fontsize=40:x=w-tw-420:y=h-th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=1:enable='between(t,0,3)':fontsize=40:x=w-tw-340:y=h-th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=2:enable='between(t,3,8)':fontsize=40:x=w-tw-340:y=h-th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=4:enable='between(t,10,12)':fontsize=40:x=w-tw-340:y=h-th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=2:fontsize=40:x=w-tw-170:y=h-th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=OL:fontsize=40:x=w-tw-240:y=h-th-30,drawtext=fontfile=fontfile=FreeSans.ttf:expansion=normal: text='%{pts\:gmtime\:0\:%H\\\\\:%M}': fontcolor=white:fontsize=40: x=1140: y=660" -codec:a copy video.mkv
```
#### drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=OM:fontsize=40:x=w-tw-420:y=h-th-30, =
font color en toute lettre ou en hexa,
#### fontfile =
celles presentes par defaut, on peut en ajouter une en mettant à cet endroit le chemin vers la font: fontfile=/usr/share/fonts/truetype/open-sans/OpenSans-Regular.ttf
#### text =
texte que nous souhaitons afficher
#### fontsize =
taille de la police
#### :x=w-tw-420:y=h-th-30 =
positionnement

### drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=1:enable='between(t,0,3)':fontsize=40:x=w-tw-340:y=h-th-30, =

#### text=1:enable='between(t,0,3)' =
1 s'affiche de la seconde 0 à la seconde 3

#### text='%{pts\:gmtime\:0\:%H\\\\\:%M}' =
 afficher le temps ecoulé de la vidéo (ici heure et minute)
 text='%{gmtime\:%H\\\\\:%M\\\\\:%S}' -> heure minute seconde



