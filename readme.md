<b>Kolmas</b> versio sisältää nyt sellasta, että  </br>
-vain opettaja voi luoda tehtävälistan </br>
-ja halutessaan poistaa tai muokata tehtävälistaa(tehtävälistan kuvausta siis)</br>
-ja lisätä omaan tehtävälistaansa tehtäviä, tai sitten poistaa tai muokata niitä </br>
  *kaikki nämä on silleen, että opettaja voi vaan tehdä muutoksia omiin tehtävälistoihin ja tehtäviin </br>
-sitten vain opettajat voivat tarkastella tehtävälistoja (kaikkien ja sitten myös vaan omia)

</br> 
</br>
opiskelija kun kirjautuu sisälle, niin tällä hetkellä hän ei nää muuta kuin etusivun ja voi kirjautua ulos. 

</br> 
</br>
lisäsin myös admin ominaisuuden, niin tällön meidän users-taulu sai taas uuden muodon: </br>
CREATE TABLE users(
id INT NOT NULL AUTO_INCREMENT, 
admin BOOLEAN DEFAULT FALSE NOT NULL,
name VARCHAR(255) NOT NULL,
email VARCHAR(50) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL,
remember_token VARCHAR(100),
PRIMARY KEY (id));   

</br> 
</br>
se siis luo automaattisesti kaikille 0 arvon et ei oo admin. se pitää käydä sitä käsin päivittämässä sinne tietokantaan, et kelle sen oikeuden haluaa antaa. 
</br> 
Admin pystyy nyt sitten kaikkien tehtävälistoja ja tehtäviä tarkastelee ja poistaa ja muokkaamaan. Äsken huomasin, että se ei toimi kunnolla, jos admin yrittää luoda tehtävälistan, tai sitten luoda tehtävän. Täytyy ne viel korjata. Muut toiminnallisuudet näyttäis toimivan. <b>PÄIVITYS!</b> Tää adminin luontiongelmahomma johtu siitä, että en ollut laittanut sitä adminia opettajat-tauluun. Elikä ku sen lisäs sinne kans, niin noi luonnit toimi.  
