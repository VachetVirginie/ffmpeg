# Ffmpeg
![FFmpeg logo](https://i1.wp.com/www.softwarert.com/wp-content/uploads/2017/08/ffmpeg-logo.png?resize=396%2C160&ssl=1)

## Ressources:

[Documentation](https://ffmpeg.org/ffmpeg.html)

[Tuto sur youtube](https://www.youtube.com/playlist?list=PL-jO1Uomc5sdlqcl5TuAA2Z7U7r2dzsxX)

[FFMPEG pour Flutter](https://flutterawesome.com/ffmpeg-plugin-for-flutter-supports-ios-and-android/)
###  Installation:

```sh
apt install ffmpeg
```
### Les filtres
ffmpeg dispose  d'une base importante de filtres qui permettent de modifier le contenu de
chaque flux, comme changer la résolution, modifier le volume d'une piste, incruster un logo etc....
```sh
ffmpeg -filters
```
Il est possible de voir les options disponibles d'un filtre spécifique comme par exemple avec scale :
```sh
ffmpeg -h filter=scale
```
### Ajouter logo + scores  dynamiques
1ere CMD:
```sh
ffmpeg -i video0.mkv -i ../img/logo.png -i ../img/sb.png -filter_complex "[0:v][1:v]overlay=10:main_h-overlay_h-10[tmp];[tmp][2:v]overlay=x=(main_w-overlay_w):y=(main_h-overlay_h)" logoScore.mkv
```

2e CMD:
```sh
ffmpeg -i logoScore.mkv -vf "drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=OM:fontsize=40:x=w-tw-420:y=h-th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=1:enable='between(t,0,3)':fontsize=40:x=w-tw-340:y=h-th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=2:enable='between(t,3,8)':fontsize=40:x=w-tw-340:y=h-th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=4:enable='between(t,10,12)':fontsize=40:x=w-tw-340:y=h-th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=2:fontsize=40:x=w-tw-170:y=h-th-30,drawtext=fontcolor=white:fontfile=FreeSans.ttf:text=OL:fontsize=40:x=w-tw-240:y=h-th-30,drawtext=fontfile=fontfile=FreeSans.ttf:expansion=normal: text='%{pts\:gmtime\:0\:%H\\\\\:%M}': fontcolor=white:fontsize=40: x=1140: y=660" -codec:a copy video.mkv
```

### Ajouter une image depuis un txt 
```sh
ffmpeg -i video0.mkv -f concat -safe 0 -i img.txt -filter_complex "[1] scale=w=200:h=100 [tmp]; [0][tmp] overlay=x=10:y=10" outputfile2.mp4
```

###  Ajouter une img (elements dans les params)
```sh
ffmpeg -i inputfile1.mp4 -i inputfile2.jpg -filter_complex "[1] scale=w=200:h=100 [tmp]; [0][tmp] overlay=x=10:y=10" outputfile.mp4
```
     i permet d'indiquer tous les fichiers à traiter en entrée
     filter_complex permet d'utiliser les filtres disponibles
    [1]: selects inputfile2.jpg
    scale Scale an inputfile to specified size
        w width of inputfile
        h height of inputfile
    overlay Overlay image on inputfile
        x x-coordinate to start image overlay
        y y-coordinate to start image overlay

###  Ajouter 2 imgs et le score:
```sh
ffmpeg -i video0.mkv -i ../img/logo.png -i ../img/scoreboard.png -filter_complex "[0:v]drawtext=fontfile=font.ttf:text='01':fontcolor=red@1.0:fontsize=40:x=830:y=60, drawtext=text=font.ttf:text='02':fontcolor=red@1.0:fontsize=40:x=1010:y=60[text];[text]overlay=10:main_h-overlay_h-10[ol1];[ol1][2:v]overlay=main_w-overlay_w-0:0[filtered]" -map "[filtered]" -codec:v libx264 -codec:a copy outgtgtgt.mkv
```
Pour utiliser le filtre overlay, il suffit de lui indiquer les positions horizontale et verticale à utliser pour insérer l'image ou la vidéo.
###  Logo location

Top left corner
```sh
ffmpeg –i inputvideo.avi -vf "movie=watermarklogo.png [watermark]; [in][watermark] overlay=10:10 [out]" outputvideo.flv
```
Top right corner
```sh
ffmpeg –i inputvideo.avi -vf "movie=watermarklogo.png [watermark]; [in][watermark] overlay=main_w-overlay_w-10:10 [out]" outputvideo.flv
```
Bottom left corner
```sh
ffmpeg –i inputvideo.avi -vf "movie=watermarklogo.png [watermark]; [in][watermark] overlay=10:main_h-overlay_h-10 [out]" outputvideo.flv
```
Bottom right corner
```sh
ffmpeg –i inputvideo.avi -vf "movie=watermarklogo.png [watermark]; [in][watermark] overlay=(main_w-overlay_w-10)/2:(main_h-overlay_h-10)/2 [out]" outputvideo.flv
```
Center 
```sh
ffmpeg -i video0.mkv -i ../img/maillot-blue.png -filter_complex "overlay=10:10" outvideo.mkv
```
###  Ajouter du texte
```sh
ffmpeg -i video.mp4 -filter:v drawtext="fontfile=e\:/font/segoeui.ttf:text='Hello World':fontcolor=white@1.0:fontsize=30:y=h/2:x=0"-y output.mp4
```
### Texte centré 
```sh
ffmpeg -i "video0.mkv" -vf drawtext="fontfile=/usr/share/fonts/truetype/open-sans/OpenSans-Regular.ttf:text='Title of this Video':x=(w-tw)/2:y=(h-th)/2"  test_edited.mkv
```
### Lister font dispo:
Possibilité d'en rajouter d'autres en passant en param la font comme en css

```sh
ls /usr/share/fonts/truetype/freefont/
```
FreeMonoBoldOblique.ttf  FreeMonoBold.ttf  FreeMonoOblique.ttf  FreeMono.ttf  FreeSansBoldOblique.ttf  FreeSansBold.ttf  FreeSansOblique.ttf  FreeSans.ttf  FreeSerifBoldItalic.ttf  FreeSerifBold.ttf  FreeSerifItalic.ttf  FreeSerif.ttf


### Timmer video
```sh
ffmpeg -i "video0.mkv" -vf "drawtext=fontfile=OpenSans-Regular.ttf:text='%{eif\:$duration-t\:d}':fontcolor=white:fontsize=24:x=w-tw-20:y=th:box=1:boxcolor=black@0.5:boxborderw=10,format=yuv420p" -c:v libx264 -c:a copy -movflags +faststart outputZA.mp4
```

###  Ajouter du texte avec des params de temps:
```sh
ffmpeg -i video0.mkv -filter_complex "drawtext=text='Summer Video':enable='between(t,15,20)',fade=t=in:start_time=15:d=0.5:alpha=1,fade=t=out:start_time=19.5:d=0.5:alpha=1[fg];[0][fg]overlay=format=auto,format=yuv420p" -c:a copy output.mp4
```

### Multiline scrolling text from text file
```sh
ffmpeg -i invideo.mkv -vf "[in]drawtext=fontfile=c\÷:÷windows/Fonts/arial.ttf:fonts=40:fontcolor=blue:x(w-text_w)/2:y=h/2:textfile="hello.txt"
```
## Ajouter texte et image
```sh
ffmpeg -i video0.mkv -i scoreboard.png -filter_complex "[0:v][1:v]overlay=10:10,drawtext=text='Hello World',logo.png" -c:a copy -movflags +faststart output.mkv
```
###  Ajouter un filtre de telle à telle sec:
```sh
ffmpeg -i inVideo.mkv -q 6 -filter_complex " smartblur(nomFiltre) = lr = 5 : enable = 'between(t,5,10)'" outVideo.mkv
```
+ t = Timestamp en secondes
+ n = numéro d'image actuel
+ w,h width et height de la video
+ between(x,min,max) = retourne 1 si x est entre ou egal à min et max

###  Add scrolling text to the video from txt file
    ffmpeg -i output.mp4 -filter_complex \
    "[0]split[txt][orig];[txt]drawtext=fontfile=tahoma.ttf:fontsize=55:fontcolor=white:x=(w-text_w)/2+20:y=h-20*t:textfile='yourfile.txt':bordercolor=black:line_spacing=20:borderw=3[txt];[orig]crop=iw:50:0:0[orig];[txt][orig]overlay" \
    -c:v libx264 -y -preset ultrafast -t 20 output_scrolling.mp4
