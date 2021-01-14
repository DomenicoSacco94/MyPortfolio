# -*- coding: utf-8 -*-
import requests
import json
import time
import os

"""
ENG

This library allows the remote control of a computer with a Telegram Bot. It becomes possible to execute some simple commands using the Bot or another computer having Telegram Installed.
I think that remote controlling a PC through Telegram itself is not a safe mean of access, this because the name of the BOT is public and so anyone can acess it. Therefore i decided to make commands executable only if a correct password is entered.
Expanding this work could be possible to control a network of elaborators, using different access levels for which
different commands are reserved.
"""

"""
ITA

Questa libreria implementa il controllo in remoto dell'elaboratore per mezzo di un apposito Bot Telegram. Diventa possibile eseguire alcuni semplici comandi shell attraverso il proprio smartphone o un altro elaboratore dotato di Telegram.
Tuttavia ritengo che la possibilita' di controllare un PC attraverso un Bot Telegram sia comunque un mezzo poco sicuro, in quanto il nome del Bot è pubblico e chiunque può accedervi. Pertanto ho deciso di far in modo di eseguire i comandi inviati soltanto se preceduti da una password.
Volendo, è possibile quindi creare un canale di comunicazione con l'elaboratore, o anche una rete di elaboratori, con diversi livelli di accesso rispetto ai quali eseguire i differenti comandi.
Alcune utili operazioni:
sensors stato temperatura
shutdown -h now spegnimento totale, con l'hard switch
shutdown now spegnimento parziale, soft switch
"""

def send_mex(text):
    mexURL="https://api.telegram.org/bot376684113:AAHMyP7sS3Vqve378VPtbdiaNNkkSOqGbos/sendMessage?chat_id=271703089&text=" + text
    requests.get(mexURL)

def get_pwd(message):
    try:
        return message[0:message.index("-")]
    except:
        return -1


def check_updates(last_id,arg):
    try:
        respURL="https://api.telegram.org/bot376684113:AAHMyP7sS3Vqve378VPtbdiaNNkkSOqGbos/getUpdates"+"?offset="+str(last_id)
        f=requests.get(respURL)
        content=f.content
        msg=json.loads(content)
        msg.get("result")
        msg2=msg.get("result")
        message=msg2[-1].get("message").get("text")        
        #print(message)
        if arg==1 and get_pwd(message)=="20032017":
            #print("YOU WROTE: " + message)
            f=os.popen(message[message.index("-")+1:])
            content=f.read()
            send_mex(content)
        else:
        	if arg==1:
        		send_mex("PASSWORD REQUIRED")
               
        L=[]
        for x in msg2:
            L.append(x.get("update_id"))
        last_id=max(L)
        return last_id
    except:
        return last_id
        pass

def start():
	last_id=0
	last_id=check_updates(last_id,0)
	while True:
        	time.sleep(15)
        	last_id=check_updates(last_id,1)
        	last_id+=1
