# Circumplex
Este programa ofrece una solución minimalista para ver videos en diversos dispositivos dentro de una red local.  
Toma los videos colocados en el directorio "input", los convierte a mp4 (por medio de FFmpeg) y los muestra con una presentación sencilla para ser accedidos fácilmente.  
![alt text](https://i.imgur.com/7WchXqu.png)
## Dependencias
Circumplex está escrito en PHP y Python 3 para sistemas operativos Windows y hace uso de FFmpeg.  
Para correrlo se puede utilizar cualquier servidor que incluya apache (WAMP, XAMP, WAPP, etc).  
Sin Python instalado no funcionarán las características para convertir videos y crear miniaturas (thumbnails).  
Circumplex depende del ejecuutable ffmpeg.exe  
Puede obtenerse aqui https://www.ffmpeg.org/  
## Uso  
Coloque los archivos de circumplex junto al ffmpeg.exe dentro del alcance de su servidor apache.  
Coloque los archivs de video en el directorio input.  
Acceda a circumplex a través de un navegador y haga click en el botón "actualizar".  
Esto convertirá a mp4 todos los videos en el directorio input de modo que puedan ser reproducidos en cualquier navegador html5.  
Tome en cuenta que esto puede tardar y utilizar un porcentaje significativo de los recursos del host.  
Tome en cuenta que el archivo original seguirá ocupando espacio.  
Una vez se complete la conversión, circumplex mostrará un enlace a cada video en su página principal. Las miniaturas se crean al actualizar la página.  
## Cambios por hacer
Función limpiar.  
Miniaturas de tamaño fijo y pequeño.  
Sistema de páginación.  
Tiempo de tomado de la miniatura dinámico.  
  
La fuente utilizada para el logo es <a href="https://www.dafont.com/256-bytes.font">256 Bytes</a> y es 100% gratuita.  
El video de muestra puede obtenerse <a href="https://standaloneinstaller.com/blog/big-list-of-sample-videos-for-testers-124.html">aqui</a>
