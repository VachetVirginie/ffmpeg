# Ffmpeg
![FFmpeg logo](https://i1.wp.com/www.softwarert.com/wp-content/uploads/2017/08/ffmpeg-logo.png?resize=396%2C160&ssl=1)

## Ressources:
### FFMPEG Documentation
https://ffmpeg.org/ffmpeg.html
### FFMPEG Tuto sur youtube
https://www.youtube.com/playlist?list=PL-jO1Uomc5sdlqcl5TuAA2Z7U7r2dzsxX
### FFMPEG pour Flutter
https://flutterawesome.com/ffmpeg-plugin-for-flutter-supports-ios-and-android/
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
###  Ajouter une img (elements dans les params)
```sh
ffmpeg -i inputfile1.mp4 -i inputfile2.jpg -filter_complex "[1] scale=w=200:h=100 [tmp]; [0][tmp] overlay=x=10:y=10" outputfile.mp4
```
    [1]: selects inputfile2.jpg
    scale Scale an inputfile to specified size
        w width of inputfile
        h height of inputfile
    overlay Overlay image on inputfile
        x x-coordinate to start image overlay
        y y-coordinate to start image overlay

###  Ajouter 2 imgs et le score:
```sh
ffmpeg -i video0.mkv -i ../img/logo.png -i ../img/scoreboard.png -filter_complex "[0:v]drawtext=fontfile=font.ttf:text='01':fontcolor=black@1.0:fontsize=24:x=20:y=259, drawtext=fontfile=font.ttf:text='02':fontcolor=black@1.0:fontsize=24:x=500:y=500[text];[text][1:v]overlay=215:0[ol1];[ol1][2:v]overlay=400:300[filtered]" -map "[filtered]" -codec:v libx264 -codec:a copy output.mkv
```
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


















   
