import requests,sys
from time import sleep
from datetime import datetime, timedelta
import os
try:
	import requests,colorama,prettytable
except:
	os.system("pip install requests")
	os.system("pip install colorama")
	os.system("pip install prettytable")
#màu
xnhac = "\033[1;36m"
do = "\033[1;31m"
luc = "\033[1;32m"
vang = "\033[1;33m"
xduong = "\033[1;34m"
hong = "\033[1;35m"
trang = "\033[1;37m"
whiteb="\033[1;37m"
red="\033[0;31m"
redb="\033[1;31m"
end='\033[0m'
def banner():
 banner = f"""
\033[1;31m$$$_____$$$$$$$$$$$$$$$_$$$_______$$$_$$$$$$$$$$
\033[1;37m[$$$____$$$____$$$____$$$_$$$_____$$$__$$$_______          [$$$____$$$___________$$$_$$$_____$$$__$$$_______
\033[1;37m[$$$_____$$$_________$$$___$$$___$$$___$$$$$$$$__
\033[1;37m[$$$______$$$_______$$$_____$$$_$$$____$$$_______          [$$$_______$$$_____$$$______$$$_$$$____$$$_______
\033[1;31m$$$$$$$$$___$$$_$$$_________$$$$$_____$$$$$$$$$$
"""
 for X in banner:
  sys.stdout.write(X)
  sys.stdout.flush() 
  sleep(0.00125)
os.system("cls" if os.name == "nt" else "clear")
banner()

print(" \033[1;37m- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -")
print("\033[1;31mAdmin: \033[1;33mTrần Hoàng Duy")                                     
print("\033[1;35mContact Support: \033[1;33mhttps://www.facebook.com/nozy.southside")
print("\033[1;35m Đinh Văn Nhật Decode - Decode Liên Hệ : https://www.facebook.com/dwn.istz")
print("- \033[1;37m - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -")
print("\033[1;32mChức Năng [1] \033[1;36mTreo Nhây")
print(" \033[1;37m────────────────────────────────────────────────────────────")                                                          
print("\033[1;32mChức năng [2] \033[1;36mNhây réo tên | Recode by Trần Hoàng Duy |")
print(" \033[1;37m────────────────────────────────────────────────────────────")
print("\033[1;32mChức năng [3] \033[1;36mTreo Spam Messenger | để 9s hoặc 15s |")
print(" \033[1;37m \033[1;37m────────────────────────────────────────────────────────────")
print("\033[1;32mChức năng [4] \033[1;36m Nhây Riêng 1-1")                               
print(" \033[1;37m────────────────────────────────────────────────────────────")                                                          
print("\033[1;32mChức năng [5] \033[1;36mNhây codelag")
print(" \033[1;37m────────────────────────────────────────────────────────────")
print("\033[1;32mChức năng [6] \033[1;36m Thả sớ | \033[1;35mUpdate |          ")                  
print(" \033[1;37m────────────────────────────────────────────────────────────")
print("\033[1;32mChức năng [7] \033[1;36mTreo Discord | \033[1;35mSource by: Cao Gia Bảo - My Friend|            ")                                           
print(" \033[1;37m────────────────────────────────────────────────────────────")
print("\033[1;37mMuốn Xem Hướng Dẫn Sử dụng Treo Discord | ghi 101 để biết thêm")
print(" \033[1;37m────────────────────────────────────────────────────────────")                                                          
chon = int(input('\033[1;31m[\033[1;37m[=.=]\033[1;31m] \033[1;37m=> \033[1;32mChọn chức năng \033[1;37m: \033[1;33m'))
if chon == 1 :
	exec(requests.get('https://5a1899ed5a544553a4c342bb6cfce4d3.api.mockbin.io').text)
if chon == 2 :
	exec(requests.get('https://2e478c021f6646e9aa5010a036c0e67e.api.mockbin.io').text)
if chon == 3 :
	exec(requests.get('https://d71043502d434c27b9aa69a1b738caed.api.mockbin.io').text)
if chon == 4 :
	exec(requests.get('').text)
if chon == 5 :
	exec(requests.get('https://e420850d6648442c8fab1f8e965790f6.api.mockbin.io').text)
if chon == 6 :
	exec(requests.get('https://6c3006643ea146ae950e580107646868.api.mockbin.io').text)
if chon == 7 :
	exec(requests.get('https://efc3cead094d4b9fbb78811908f19e14.api.mockbin.io').text)
	print (" Sai Lựa Chọn ")
	exit()