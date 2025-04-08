import requests as rq
from bs4 import BeautifulSoup
import numpy as np
import pandas as pd
import mysql.connector
from urllib3 import Retry

sky_r1 = rq.get('https://www.skysports.com/boxing')
coverpage_sky = sky_r1.content
soup_sky = BeautifulSoup(coverpage_sky,'html5lib')
skyboxing_cover_articles = soup_sky.find_all('h4',class_='news-list__headline')

#scrap only 5 articles
number_of_articles = 15

#empty list
title_skyboxing = []
links_skyboxing = []
articles_sky = []
all_publish_date = []


for n in np.arange(0,number_of_articles):
   try:
      link_sky_boxing = skyboxing_cover_articles[n].find('a')['href']
      links_skyboxing.append(link_sky_boxing)
   except IndexError:
        pass

    #getting the tiles
   try:
      title = skyboxing_cover_articles[n].find('a').get_text()
      title_skyboxing.append(title)
   except IndexError:
        pass
      

 # saving data to Mysql Database
   db = mysql.connector.connect(user="root", database="newsdochdb")
   cursor = db.cursor()

   add_news = ("INSERT IGNORE INTO news"
                "(ArticleID, CategoryID, SiteName,  Headline, ArticleText, ArticleDate) "
                "VALUES (%s, %s, %s, %s, %s , %s)")
   data_news = (link_sky_boxing,"3", 'sky',title,"Link for more information", "Latest")
    #insertion
   cursor.execute(add_news,data_news)
   db.commit()
   cursor.close()
   db.close()