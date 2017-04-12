<b>Toka</b> versiossa kirjautuneen käyttäjän on mahdollista
-luoda tehtävälista (näkyy tosin vielä kaikille)
-luoda tehtävälistaan tehtäviä (näkyy nekin kaikille)
  *Tässä päädyin nyt sellaseen, että jokanen tehtävä voi kuulua vain yhteen tehtävälistaan. Tää rikkoo meidän alkuperästä ajatusta, mut näin sen sain ainaki toimimaan, et tää vois olla nyt eka askel tässä. 

Sitten jouduin vähän muokkaamaan tähän näitä meiän tauluja.
Omaan mysql-tietokantaani loin tällaset taulut. Nää meni ihan silleen, ku copypastesi nää sinne Vagrant ssh->mysql. Jouduin näitä vähän muokkaa (esim auto_increment) siihen mysql:ään sopivaks. Postgresissa tais olla sen auto_incrementin tilalla se serial. 

/* Käyttäjät */
CREATE TABLE users(         /*vaihdettu kayttajat -> users)
id INT NOT NULL AUTO_INCREMENT,        /* http://stackoverflow.com/questions/3108777/how-to-auto-increment-in-postgresql  */
name VARCHAR(255) NOT NULL,
email VARCHAR(50) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL,
remember_token VARCHAR(100),
PRIMARY KEY (id));

CREATE TABLE opiskelijat(
id INT NOT NULL,    
name VARCHAR(50) NOT NULL,
opnro INT NOT NULL,
p_aine VARCHAR(50) NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id) REFERENCES  users (id));  /* laitettu users(id)*/

CREATE TABLE opettajat(
id INT NOT NULL,    
name VARCHAR(50) NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id) REFERENCES users (id)); /* laitettu users(id)*/

/*Tehtäväpankki*/
/* täs on ihan tarkotuksella tehtava+s, ku se laravel kattoo kai jotenkin sen luokan mukaan sen taulun (esim User ja et sen taulu on users ja niin edelleen), ni sitten ku loin Tehtava-luokan ni se haluaa tehtavas-taulun */ 
CREATE TABLE tehtavas(   
id INT NOT NULL AUTO_INCREMENT,     /* sitten lisäsin tähänki tän auto_incrementin */
created_at TIMESTAMP NULL,           /*sitten vaihdoin nää aikajutut näiks timestampeiks. Nää tulee automaattisesti luoduks*/
updated_at TIMESTAMP NULL,
teht_kuvaus VARCHAR(100) NOT NULL,
esim_vastaus VARCHAR(100) NOT NULL,
kysely_tyyppi VARCHAR(20) NOT NULL,
tehtavalista_id INT NOT NULL,
teht_luoja_id INT NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (teht_luoja_id) REFERENCES opettajat (id));   /* laitettu opettajat(id)*/

CREATE TABLE tehtavalistas(     /* tässäkin sama, eli tehtavalista+s */
id INT NOT NULL AUTO_INCREMENT,  /* sitten lisäsin tähänki tän auto_incrementin */
created_at TIMESTAMP NULL,
updated_at TIMESTAMP NULL,
/*teht_kpl INT NOT NULL,  */   /*johdettava attribuutti, */
tehtlista_kuvaus VARCHAR(100) NOT NULL,
tehtlista_luoja_id INT NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (tehtlista_luoja_id) REFERENCES opettajat (id));   /* laitettu opettajat(id)*/


<b>Koska</b> nyt se yks tehtävä on vaan yhessä tehtävälistassa, ni tää ei ehkä oo tarpeen. Jotenki toi seuraaja pitäis miettiä sit, mut ehkä se ei oo sit ongelma, jos se tietty tehtävä on yhessä tehtävälistassa. Tätä en siis laittanut vielä omaan tietokantaani mukaan.  
CREATE TABLE tehtlistaSisaltaa(
tehtlista_id INT NOT NULL, 
teht_id INT NOT NULL, 
seuraaja_id INT,            /*tehtävien sisäinen järjestys / linkitetty lista*/
PRIMARY KEY (tehtlista_id, teht_id),
FOREIGN KEY (tehtlista_id) REFERENCES tehtavalistat (id), 
FOREIGN KEY (teht_id) REFERENCES tehtavat (id));
