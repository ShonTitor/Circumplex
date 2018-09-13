import sys, subprocess, chardet
files = sys.argv[1:]

def filename(f) :
    f = f.split(".")
    return ".".join(f[:-1])

def utf8_srt(file_path):
    with open(file_path,'rb+') as f:
        s = f.read()
        f.truncate()
    s = str(s,chardet.detect(s)['encoding'])
    with open(file_path,'wb') as f:
        f.write(s.encode("utf-8"))

for file in files :
    fi = filename(file)
    try:
        utf8_srt("input/"+fi+".srt")
        subprocess.run('ffmpeg -i "input/'+file+'" -f mp4 -vcodec h264 -acodec aac -vf subtitles="input/'+fi+'.srt" -movflags +faststart "videos/'+fi+'.mp4"')
    except:
        subprocess.run('ffmpeg -i "input/'+file+'" -f mp4 -vcodec h264 -acodec aac -movflags +faststart "videos/'+fi+'.mp4"')
