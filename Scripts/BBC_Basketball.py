import requests as rq
from bs4 import BeautifulSoup
import numpy as np
import pandas as pd
import mysql.connector
from urllib3 import Retry

bbc_r1 = rq.get('https://www.bbc.co.uk/sport/basketball')
coverpage_bbc = bbc_r1.content
soup_bbc = BeautifulSoup(coverpage_bbc,'html5lib')
bbcbasketball_cover_articles = soup_bbc.find_all('div',class_='gs-c-promo gs-t-sport gs-c-promo--stacked@m gs-c-promo--inline gs-o-faux-block-link gs-u-pb gs-u-pb++@m gs-c-promo--flex')

#scrap only 5 articles
number_of_articles = 30

#empty list
title_bbcbasketball = []
links_bbcbasketball = []
articles_bbc = []
all_publish_date = []

try:
    for n in np.arange(0,number_of_articles):
        #getting the links
        link_bbc_basketball = bbcbasketball_cover_articles[n].find('a')['href']
        links_bbcbasketball.append(link_bbc_basketball)

        #getting the tiles
        title = bbcbasketball_cover_articles[n].find('a').get_text()
        title_bbcbasketball.append(title)

        #go to inside the detail view of news
        article = rq.get("https://www.bbc.co.uk"+link_bbc_basketball)
        coverpage_sub_articles = article.content
        soup_sub_article = BeautifulSoup(coverpage_sub_articles, 'html5lib')
        body = soup_sub_article.find_all('div', class_='qa-story-body story-body gel-pica gel-10/12@m gel-7/8@l gs-u-ml0@l gs-u-pb++')
        x = body[0].find_all('p')

        # Unifying the paragraphs
        list_paragraphs = []
        for p in np.arange(0, len(x)):
            paragraph = x[p].get_text()
            list_paragraphs.append(paragraph)
            final_article = " ".join(list_paragraphs)

        articles_bbc.append(final_article)

        #publish date
        date_publish_baseline = soup_sub_article.find_all('span', class_='gs-c-timestamp gs-o-bullet gs-o-bullet- story-info__timestamp qa-timestamp')
        all_publish_date.append(date_publish_baseline[0].get_text())
    

    # saving data to Mysql Database
        db = mysql.connector.connect(user="root", database="newsdochdb")
        cursor = db.cursor()

        add_news = ("INSERT IGNORE INTO news"
                    "(ArticleID, CategoryID, SiteName,  Headline, ArticleText, ArticleDate) "
                    "VALUES (%s, %s, %s, %s, %s , %s)")
        data_news = ("https://www.bbc.co.uk"+link_bbc_basketball,"4", 'bbc',title, final_article, date_publish_baseline[0].get_text())
        #insertion
        cursor.execute(add_news,data_news)
except:
    pass

db.commit()
cursor.close()
db.close()