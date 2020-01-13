## Ffmpeg
![FFmpeg logo](https://i1.wp.com/www.softwarert.com/wp-content/uploads/2017/08/ffmpeg-logo.png?resize=396%2C160&ssl=1)

## Ressources:
##### FFMPEG Documentation
https://ffmpeg.org/ffmpeg.html
##### FFMPEG Tuto sur youtube
https://www.youtube.com/playlist?list=PL-jO1Uomc5sdlqcl5TuAA2Z7U7r2dzsxX
#### FFMPEG pour Flutter
https://flutterawesome.com/ffmpeg-plugin-for-flutter-supports-ios-and-android/
# Installation:

```sh
apt install ffmpeg
```
# Les filtres
ffmpeg dispose  d'une base importante de filtres qui permettent de modifier le contenu de
chaque flux, comme changer la résolution, modifier le volume d'une piste, incruster un logo etc....
```sh
ffmpeg -filters
```
Il est possible de voir les options disponibles d'un filtre spécifique comme par exemple avec scale :
```sh
ffmpeg -h filter=scale
```
# Ajouter une img (elements dans les params)
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

# Ajouter 2 imgs et le score:
```sh
ffmpeg -i video0.mkv -i ../img/logo.png -i ../img/scoreboard.png -filter_complex "[0:v]drawtext=fontfile=font.ttf:text='01':fontcolor=black@1.0:fontsize=24:x=20:y=259, drawtext=fontfile=font.ttf:text='02':fontcolor=black@1.0:fontsize=24:x=500:y=500[text];[text][1:v]overlay=215:0[ol1];[ol1][2:v]overlay=400:300[filtered]" -map "[filtered]" -codec:v libx264 -codec:a copy output.mkv
```
# Logo location

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
## Ajouter du texte
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


## Timmer video
```sh
ffmpeg -i "video0.mkv" -vf "drawtext=fontfile=OpenSans-Regular.ttf:text='%{eif\:$duration-t\:d}':fontcolor=white:fontsize=24:x=w-tw-20:y=th:box=1:boxcolor=black@0.5:boxborderw=10,format=yuv420p" -c:v libx264 -c:a copy -movflags +faststart outputZA.mp4
```

## Ajouter du texte avec des params de temps:
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
## Ajouter un filtre de telle à telle sec:
```sh
ffmpeg -i inVideo.mkv -q 6 -filter_complex " smartblur(nomFiltre) = lr = 5 : enable = 'between(t,5,10)'" outVideo.mkv
```
+ t = Timestamp en secondes
+ n = numéro d'image actuel
+ w,h width et height de la video
+ between(x,min,max) = retourne 1 si x est entre ou egal à min et max


### Obtenir des infos sur un fichier vidéo

`ffmpeg -i video.avi`

### Transformer une série d'images en vidéo

`ffmpeg -f image2 -i image%d.jpg video.mpg`\
ce qui transformera les images du répertoire courant nommées image1.jpg, image2.jpg, image3.jpg, ... en un fichier vidéo nommé video.mpg.\
Notons que %d est transformé en 1, 2, 3, 4, 5...

Si l'on a des images nommées image001.jpg, image002.jpg, image003.jpg, ... vous utiliserez la commande\
`ffmpeg -f image2 -i image%03d.jpg video.mpg`

Mais on peut aussi utiliser d'autres types de format d'images : PGM, PPM, PAM, PGMYUV, JPEG, GIF, PNG, TGA, TIFF, SGI, PTX

On peut aussi paramétrer plus finement l'export vidéo :\
`ffmpeg -r 24 -b 1800 -i image%d.bmp video.mpg`\
Ici on spécifie 24 images par seconde et un bitrate de 1800kb/s.

### Transformer une vidéo en une série images

`ffmpeg -i video.mpg image%d.jpg`\
ce qui génèrera les fichiers image1.jpg, image2.jpg, ...

Mais on peut aussi générer des images au format : PGM, PPM, PAM, PGMYUV, JPEG, GIF, PNG, TIFF, SGI. Par exemple :\
`ffmpeg -i video.mpg image%d.tif`

### Encoder une vidéo pour l'Ipod

`ffmpeg -i video_origine.avi input -acodec aac -ab 128kb -vcodec mpeg4 -b 1200kb -mbd 2 -flags +4mv+trell -aic 2 -cmp 2 -subcmp 2 -s 320x180 -title X video_finale.mp4`\
Explication :\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) la vidéo d'origine : video_origine.avi\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) le codec audio utilisé : aac\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) le bitrate audio utilisé : 128kb/s\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) le codec vidéo utilisé : mpeg4\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) le bitrate vidéo utilisé : 1200kb/s\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) la taille de la vidéo générée : 320px par 180px\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) la vidéo générée : video_finale.mp4

### Encoder une vidéo en h264 et AAC

`ffmpeg -i video_origine.avi -b 2496k -bt 1024k -acodec libfaac -ar 44100 -ab 128k -ac 2 -vcodec libx264 -r 24 -s 640x360 video_finale.avi`\
Explication :\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) la vidéo d'origine : video_origine.avi\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) le bitrate vidéo utilisé : 2496kb/s\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) la tolérance du bitrate vidéo : 1024kb/s\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) le codec audio utilisé : libfaac\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) la fréquence audio : 44100 Hz\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) le bitrate audio utilisé : 128kb/s\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) le nombre de canaux audio : 2 (stéréo)\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) le codec vidéo : libx264\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) le nombre d'images par seconde (framerate) : 24\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) la taille de la vidéo générée : 640px par 360px\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) la vidéo générée : video_finale.avi

### Encoder une vidéo pour la PSP

`ffmpeg -i video_origine.avi -b 300 -s 320x240 -vcodec xvid -ab 32 -ar 24000 -acodec aac video_finale.mp4`\
Explication :\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) la vidéo d'origine : video_origine.avi\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) le codec audio utilisé : aac\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) le bitrate audio utilisé : 32kb/s\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) le codec vidéo utilisé : xvid\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) la taille de la vidéo générée : 320px par 240px\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) la vidéo générée : video_finale.mp4

### Extraire le son d'une vidéo et l'enregistrer en mp3

`ffmpeg -i video_origine.avi -vn -ar 44100 -ac 2 -ab 192 -f mp3 son_final.mp3`\
Explication :\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) la video d'origine : video_origine.avi\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) l'échantillonnage audio : 44100 Hz\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) le bitrate audio utilisé : 192kb/s\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) le format de sortie : mp3\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) le son généré : son_final.mp3

Ou encore plus simple (mais moins de contrôle) :\
`ffmpeg -i video_origine.avi son_final.mp3`

### Convertir un son au format wav en son au format mp3

`ffmpeg -i son_origine.avi -vn -ar 44100 -ac 2 -ab 192 -f mp3 son_final.mp3`

Ou plus simple :\
`ffmpeg -i son.wav -ar 44100 son_final.mp3`

### Convertir un fichier avi en mpeg

`ffmpeg -i video_origine.avi video_finale.mpg`

### Convertir un mpeg en avi

`ffmpeg -i video_origine.mpg video_finale.avi`

### Convertir un avi en gif animé (non compressé)

`ffmpeg -i video_origine.avi gif_anime.gif`

### Associer une vidéo et un son pour créer une vidéo sonorisée

`ffmpeg -i son.wav -i video_origine.avi video_finale.mpg`

### Convertir un avi en flv

`ffmpeg -i video_origine.avi -ab 56 -ar 44100 -b 200 -r 15 -s 320x240 -f flv video_finale.flv`

### Convertir un avi en format dv

`ffmpeg -i video_origine.avi -s pal -r pal -aspect 4:3 -ar 48000 -ac 2 video_finale.dv`\
ou plus simple :\
`ffmpeg -i video_origine.avi -target pal-dv video_finale.dv`

### Convertir un avi en mpeg pour dvd

`ffmpeg -i video_origine.avi -target pal-dvd -ps 2000000000 -aspect 16:9 video_finale.mpeg`\
Quelques explications :\
-i ma_video.avi et mon fichier départ\
-target pal-dvd le format de sortie\
-ps 2000000000 la taille maximale du fichier sortie, en bits (ici 2 Gb)\
-aspect 16:9 le ratio widescreen (avec les franges en haut et en bas).

Ou plus simplement :\
`ffmpeg -i video_origine.avi -target pal-dvd video_finale.mpg`

### Compresser un avi en divx

`ffmpeg -i video_origine.avi -s 320x240 -vcodec msmpeg4v2 video_finale.avi`\
encode la video en un film en utilisant le codec microsoft mpeg4 version 2 encodé en mpeg4 divX et le son en mp3 avec une résolution vidéo de 320x240

### Compresser un film du format Ogg Theora en Mpeg dvd

`ffmpeg -i film_sortie_cinelerra.ogm -s 720x576 -vcodec mpeg2video -acodec mp3 film_terminée.mpg`

### Compresser un fichier avi en SVCD mpeg2

![-](https://www.jcartier.net/squelettes-dist/puce.gif) Pour un SVCD en format américain NTSC\
`ffmpeg -i video_origine.avi -target ntsc-svcd video_finale.mpg`\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) Pour un SVCD en format standard PAL\
`ffmpeg -i video_origine.avi -target pal-svcd video_finale.mpg`

Le tout à graver avec K3b par exemple

### Compresser un fichier avi en VCD mpeg2

![-](https://www.jcartier.net/squelettes-dist/puce.gif) Pour un VCD en format américain NTSC\
`ffmpeg -i video_origine.avi -target ntsc-vcd video_finale.mpg`\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) Pour un VCD en format standard PAL\
`ffmpeg -i video_origine.avi -target pal-vcd video_finale.mpg`

Faire de l'encodage multi-pass avec ffmpeg\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) Passage 1 :\
`ffmpeg -i fichierentree -pass 1 fichiersortie`\
![-](https://www.jcartier.net/squelettes-dist/puce.gif) Passage 2 :\
`ffmpeg -i fichierentree -pass 2 fichiersortie`\
ou\
`ffmpeg -i fichierentree -pass 2 -passlogfile ffmpeg2pass fichiersortie-2`

## Lancer plusieurs FFMpeg en simultanée, créer des files d'attente, c'est possible...

### Simultanément - Sous Linux

Facile sous Linux, il suffit de lancer les commandes avec un & Ã la fin de la ligne.

Par exemple : ffmpeg -i entre.avi sortie.flv &

Cela lance FFMpeg en tache de fond.

Vous pouvez donc en lancer un second Ã la suite...

### Simultanément - Sous Windows

Il suffit d'ouvrir plusieurs fenêtres DOS et de lancer les différentes commandes dans les différentes fenêtres

### Files d'attente - Sous Linux

Il suffit de créer un fichier contenant vos différentes commandes les unes en dessous des autres et d'exécuter ce fichier (en ayant changé le fichier pour le rendre exécutable : chmod 777).

### Files d'attente - Sous Windows

Comme sous Linux, un fichier contiendra vos différentes commandes les unes en dessous des autres et sera nommé monbatch.bat (ou monlanceur.bat ou cequevousvoulez.bat). Un double clic sur le fichier devrait faire l'affaire.





   
