import requests, re, time, os
from bs4 import BeautifulSoup

def choc(cookie):
	headers = {
		"Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
		"Accept-Language": "vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5",
		"Cache-Control": "max-age=0",
		"Cookie": cookie,
		"Dpr": "2.8125",
		"Sec-Ch-Prefers-Color-Scheme": "dark",
		"Sec-Ch-Ua": '"Not_A Brand";v="8", "Chromium";v="120"',
		"Sec-Ch-Ua-Full-Version-List": '"Not_A Brand";v="8.0.0.0", "Chromium";v="120.0.6099.116"',
		"Sec-Ch-Ua-Mobile": "?1",
		"Sec-Ch-Ua-Model": '"SM-A145F"',
		"Sec-Ch-Ua-Platform": '"Android"',
		"Sec-Ch-Ua-Platform-Version": '"14.0.0"',
		"Sec-Fetch-Dest": "document",
		"Sec-Fetch-Mode": "navigate",
		"Sec-Fetch-Site": "none",
		"Sec-Fetch-User": "?1",
		"Upgrade-Insecure-Requests": "1",
		"Viewport-Width": "980",
		"User-Agent": "Mozilla/5.0 (Linux; Android 14; SAMSUNG SM-A145F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36"
	}
	huy = requests.get(f"https://mbasic.facebook.com/pokes/", headers=headers).text
	try:
		soup = BeautifulSoup(huy, "html.parser")
		huy = soup.find_all("div", id=re.compile(r"^poke_live_item_"))
	except:
		return
	for i in huy:
		try:
			_huy = i.find("a", class_="cg ba bc be bb")
		except:
			return
		if _huy:
			try:
				u = _huy.get("href")
				if u != None:
					h = requests.get(f"https://mbasic.facebook.com{u}", headers=headers, allow_redirects=True).url
					uid = h.split("poke_target%3D")[1].split("%26")[0]
					status = h.split("poke_status%3D")[1].split("%26")[0]
					print(f"{uid} -> {status}")
			except:
				return

os.system("clear")
cookie = input("Nhập cookie FB: ")
while True:
	choc(cookie)
	time.sleep(30)