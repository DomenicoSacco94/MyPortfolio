# -*- coding: utf-8 -*-
import requests
import json
import time
import os
import shutil
import glob
BOT_ID="386909513:AAGZmcZiako7kN-Z7b2EVzp0KNnZ8a1DNL0"
WORK_DIR="C:\\Users\\Domenico\\Desktop\\telegram-work\\"

def merge_AudioVideo(chat_id):
    AUDIO_PATH=WORK_DIR + "\\" + str(chat_id) + "\\" + "downloaded2.mp4"
    VIDEO_PATH=WORK_DIR + "\\" + str(chat_id) + "\\" + "extracted_audio.m4a"
    VIDEO_PATH2=WORK_DIR + "\\" + str(chat_id) + "\\" + "downloaded3.mp4"
    os.system("ffmpeg -i " + VIDEO_PATH + " -i " + AUDIO_PATH + " -vcodec copy -acodec copy " + VIDEO_PATH2)

def folder(chat_id):
    folderpath = os.path.join('.//', str(chat_id))
    if not os.path.exists(folderpath):
        os.makedirs(folderpath)
        print ('Created:' + folderpath)
        

def send_mex(text,chat_id):
    mexURL="https://api.telegram.org/bot"+BOT_ID+"/sendMessage?chat_id="+chat_id+"&text=" + text
    requests.get(mexURL)

def sendImage(path,file_id,chat_id):
    print("sending document")
    url = "https://api.telegram.org/bot"+BOT_ID+"/sendDocument";
    files = {'document': open(path, 'rb')}
    data = {'chat_id' : chat_id}
    r= requests.post(url, files=files, data=data)
    print(r.content)

def process_img(img,command,chat_id):
    send_mex("ACKED COMMAND \"" + command + "\"",chat_id)
    listed_command=0;
    os.chdir(WORK_DIR)
    if "SUPER_RES-" in command[:-1]:
       print("YOU WANT RES_FACTOR="+ command[-1])
       os.system(WORK_DIR + "SUPER_RES " + chat_id + " " +  command[-1])
       listed_dommand=1
       sendImage(WORK_DIR + "\\" + str(chat_id) + "\\" + "downloaded2.jpg",img,chat_id)
       print("IMAGE SENT")
    if "FAST_RES" in command:
        print("FAST SUPER RESOLUTION ALGORITHM")
        os.system(WORK_DIR + "FAST_RES " + " " + chat_id)
        listed_dommand=1
        sendImage(WORK_DIR + "\\" + str(chat_id) + "\\" + "downloaded2.jpg",img,chat_id)
        print("IMAGE SENT")
    if command=="HELP":
        send_mex("This is a bot built for the image processing project of Sacco Domenico\n\nAvailable commands are the following ones:\n\n--PATCH_RES-[2-3-4]\n(Algorithm of super_resolution for your image)\n\n--SUPER_RES-[2-3-4]\n(Algorithm of super_resolution for your image, neural network)\n\n--GET_TEXT\n(Automatic translation to Italian)\n\n--FAST_RES\n(Fast 2x super resolution and denoising)",chat_id)
        listed_command=1
    if "VIDEO_PROCESS" in command:
        print("VIDEO PROCESSING ALGORITHM")
        os.system(WORK_DIR + "VIDEO_PROCESS " + " " + chat_id)
        listed_dommand=1
        merge_AudioVideo(chat_id)
        sendImage(WORK_DIR + "\\" + str(chat_id) + "\\" + "downloaded3.mp4",img,chat_id)
    if "PATCH_RES-" in command[:-1]:
       print("YOU WANT RES_FACTOR="+ command[-1])
       os.system(WORK_DIR + "PATCH_RES " + command[-1] + " " + chat_id)
       listed_dommand=1
       sendImage(WORK_DIR + "\\" + str(chat_id) + "\\" + "downloaded2.jpg",img,chat_id)
       print("IMAGE SENT")
    if listed_command==0 and img!=0:
        send_mex("\"" + command + "\"" + "IS AN UNREGISTERED OR UNAVAILABLE COMMAND",chat_id)
    
def getImage(message):
    raw=0
    print(message.get('message'))
    raw = message.get('message').get('document').get("file_id")
    print("---")
    chat_id=str(message.get('message').get('from').get("id"))
    print("####" + str(chat_id) + "####");
    path = raw
    j=requests.get("https://api.telegram.org/bot" + BOT_ID + "/getFile?file_id=" + path)
    file_path=json.loads(j.content).get("result").get("file_path")
    print(file_path)
    j=requests.get("https://api.telegram.org/file/bot"+ BOT_ID + "/" + file_path)
    if j.status_code == 200:
        print("Ok")
        DF=glob.glob("./*")
        print(DF)
        if ".//" + str(chat_id) not in DF:
            folder(chat_id)
            print("DIRECTORY MADE")
        print("READY 2 OPEN")
        f=open(WORK_DIR + "\\" + str(chat_id) + "\\" + "downloaded.jpg","wb")
        f.write(j.content)
        f.close()
        img=1
        #\n\nType \"HELP\" for the command list"
        send_mex("What do you wish to do?",chat_id)
    else:
        print("ISSUES")
    return raw

def getVideo(message):
    raw=0
    print(message.get('message'))
    raw = message.get('message').get('video').get("file_id")
    print("---")
    chat_id=str(message.get('message').get('chat').get("id"))
    print("####" + str(chat_id) + "####");
    path = raw
    j=requests.get("https://api.telegram.org/bot" + BOT_ID + "/getFile?file_id=" + path)
    file_path=json.loads(j.content).get("result").get("file_path")
    print(file_path)
    j=requests.get("https://api.telegram.org/file/bot"+ BOT_ID + "/" + file_path)
    if j.status_code == 200:
        print("Ok")
        DF=glob.glob("./*")
        print(DF)
        if ".//" + str(chat_id) not in DF:
            folder(chat_id)
            print("DIRECTORY MADE")
        print("READY 2 OPEN")
        f=open(WORK_DIR + "\\" + str(chat_id) + "\\" + "downloaded.mp4","wb")
        f.write(j.content)
        f.close()
        img=1
        #\n\nType \"HELP\" for the command list"
        send_mex("What do you wish to do?",chat_id)
    else:
        print("ISSUES")
    return raw
    
def check_updates(last_id,arg):
    #try:
        respURL="https://api.telegram.org/bot"+BOT_ID+"/getUpdates?offset="+str(last_id)
        f=requests.get(respURL)
        content=f.content
        msg=json.loads(content)
        msg2=msg.get("result")
        img=0
        #print(msg2)
        try:
            img=getImage(msg2[-1])
        except:
            try:
                img=getVideo(msg2[-1])
            except:
                pass
        try:
            print("-----" + msg2[-1].get("message").get("text") + "------");
            chat_id=str(msg2[-1].get("message").get('from').get("id"))
            process_img(img,msg2[-1].get("message").get("text"),chat_id)
        except:
            try:
                chat_id=str(msg2[-1].get("message").get('chat').get("id"))
                process_img(img,msg2[-1].get("message").get("text"),chat_id)
            except:
                pass
        #try:
        
        #except:
            #pass
        L=[]
        if len(msg2)>0:
            for x in msg2:
                L.append(x.get("update_id"))
            last_id2=max(L)
            print(last_id2,last_id)
            return last_id2
        else:
            return last_id
    #except:
        #pass
        #return last_id

def start():
    last_id=check_updates(0,0)
    while True:
            time.sleep(1)
            last_id=check_updates(last_id,1)
            last_id+=1

while True:
    start()
