import glob, os
from pydub import AudioSegment
AudioSegment.ffmpeg = "C:/ffmpeg/bin/ffmpeg"
work_dir="C:/Users/domis/Desktop/ARTIFICIAL_INTELLIGENCE/py_scripts/"
i=0;
for file in glob.glob("*.mp3"):
    print(file)
    sound = AudioSegment.from_mp3(work_dir + file)
    sound.export(work_dir + str(i) + ".wav", format="wav")
    i=i+1
