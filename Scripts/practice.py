from inspect import Traceback
from xmlrpc.client import ResponseError
import requests
from bs4 import BeautifulSoup
import numpy as np
import pandas as pd
import mysql.connector

independent_r1 = requests.get('https://www.bbc.co.uk/sport/football')
coverpage_independent = independent_r1.content
soup_independent = BeautifulSoup(coverpage_independent,'html5lib')
all_cover_articles = soup_independent.find_all('div',class_='gs-c-promo-body gs-u-mt@m gel-1/2@xs gel-1/1@m')

#scrap only 5 articles
number_of_articles = 10

#empty list
title_independent = []
author_independent = []
links_independent = []
articles_independent = []
all_publish_date = []

for n in np.arange(3,number_of_articles):
    #getting the links
    try:
      link = all_cover_articles[n].find('a')['href']
      links_independent.append(link)
    except IndexError:
        pass

    #getting the tiles
    try:
      title = all_cover_articles[n].find('a').get_text()
      title_independent.append(title)
    except IndexError:
        pass
    
    #go to inside the detail view of news
    try:
      article = requests.get("https://www.bbc.co.uk"+link)
      coverpage_sub_articles = article.content
      soup_sub_article = BeautifulSoup(coverpage_sub_articles, 'html5lib')
    except:
       pass
    try:
        body = soup_sub_article.find_all('div', class_='qa-story-body story-body gel-pica gel-10/12@m gel-7/8@l gs-u-ml0@l')
        x = body[0].find_all('p')
    except IndexError:
        pass

    # Unifying the paragraphs
    list_paragraphs = []
    for p in np.arange(0, len(x)):
        paragraph = x[p].get_text()
        list_paragraphs.append(paragraph)
        final_article = " ".join(list_paragraphs)

    articles_independent.append(final_article)


    #publish date
    try:
        date_publish_baseline = soup_sub_article.find_all('span', class_='gs-c-timestamp gs-o-bullet gs-o-bullet- story-info__timestamp qa-timestamp')
        all_publish_date.append(date_publish_baseline[0].get_text())
    except IndexError:
        pass
    # saving data to Mysql Database
    db = mysql.connector.connect(user="root", database="newsdochdb")
    cursor = db.cursor()
    try:
        add_news = ("INSERT IGNORE INTO news"
                    "(ArticleID, CategoryID, SiteName,  Headline, ArticleText, ArticleDate) "
                    "VALUES (%s, %s, %s, %s, %s , %s)")
        data_news = (link,"2", 'bbc',title, final_article, date_publish_baseline[0].get_text())
        #insertion
        cursor.execute(add_news,data_news)
    except IndexError:
        pass

    db.commit()
    cursor.close()
    db.close()