import requests as rq
from bs4 import BeautifulSoup
import numpy as np
import pandas as pd
import mysql.connector

bbc_r1 = rq.get('https://www.bbc.co.uk/news/business')
coverpage_bbc = bbc_r1.content
soup_bbc = BeautifulSoup(coverpage_bbc,'html5lib')
bbcBusiness_cover_articles = soup_bbc.find_all('div',class_='gs-c-promo gs-t-News nw-c-promo gs-o-faux-block-link gs-u-pb gs-u-pb+@m nw-p-default gs-c-promo--inline gs-c-promo--stacked@m gs-c-promo--flex')

#scrap only 5 articles
number_of_articles = 10

#empty list
title_bbcBusiness = []
links_bbcBusiness = []
articles_bbc = []
all_publish_date = []

for n in np.arange(0,number_of_articles):
    #getting the links
    link_bbc_business = bbcBusiness_cover_articles[n].find('a')['href']
    links_bbcBusiness.append(link_bbc_business)

    #getting the tiles
    title = bbcBusiness_cover_articles[n].find('a').get_text()
    title_bbcBusiness.append(title)

    #go to inside the detail view of news
    article = rq.get("https://www.bbc.co.uk"+link_bbc_business)
    coverpage_sub_articles = article.content
    soup_sub_article = BeautifulSoup(coverpage_sub_articles, 'html5lib')
    body = soup_sub_article.find_all('div', class_='ssrcss-rgov1k-MainColumn e1sbfw0p0')
    x = body[0].find_all('p')

    # Unifying the paragraphs
    list_paragraphs = []
    for p in np.arange(0, len(x)):
        paragraph = x[p].get_text()
        list_paragraphs.append(paragraph)
        final_article = " ".join(list_paragraphs)

    articles_bbc.append(final_article)

    #publish date
    date_publish_baseline = soup_sub_article.find_all('span', class_='ssrcss-8g95ls-MetadataSnippet ecn1o5v2')
    all_publish_date.append(date_publish_baseline[0].get_text())
 

 # saving data to Mysql Database
    db = mysql.connector.connect(user="root", database="newsdochdb")
    cursor = db.cursor()

    add_news = ("INSERT IGNORE INTO news"
                "(ArticleID, CategoryID, SiteName,  Headline, ArticleText, ArticleDate) "
                "VALUES (%s, %s, %s, %s, %s , %s)")
    data_news = ("https://www.bbc.co.uk"+link_bbc_business,"5", 'bbc',title, final_article, date_publish_baseline[0].get_text())
    #insertion
    cursor.execute(add_news,data_news)

    db.commit()
    cursor.close()
    db.close()