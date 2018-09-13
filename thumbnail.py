import sys, subprocess
files = sys.argv[1:]

def filename(f) :
    f = f.split(".")
    return ".".join(f[:-1])

for file in files :
    subprocess.run('ffmpeg -n -i "videos/'+file+'" -ss 00:00:01 -frames:v 1 "images/'+filename(file)+'.png"')
    pass
