<b>Toka</b> versiossa kirjautuneen käyttäjän on mahdollista </br>
-luoda tehtävälista (näkyy tosin vielä kaikille) </br>
-luoda tehtävälistaan tehtäviä (näkyy nekin kaikille)</br>
  *Tässä päädyin nyt sellaseen, että jokanen tehtävä voi kuulua vain yhteen tehtävälistaan. Tää rikkoo meidän alkuperästä ajatusta, mut näin sen sain ainaki toimimaan, et tää vois olla nyt eka askel tässä. 
</br>
</br>
<i>Sitten jouduin vähän muokkaamaan tähän näitä meiän tauluja.</i> </br>
Omaan mysql-tietokantaani loin tällaset taulut. Nää meni ihan silleen, ku copypastesi nää sinne Vagrant ssh->mysql. Jouduin näitä vähän muokkaa (esim auto_increment) siihen mysql:ään sopivaks. Postgresissa tais olla sen auto_incrementin tilalla se serial. 
</br>
</br>
/* Käyttäjät */   /* vaihdettu kayttajat -> users */ </br>
CREATE TABLE users(       
id INT NOT NULL AUTO_INCREMENT, 
name VARCHAR(255) NOT NULL,
email VARCHAR(50) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL,
remember_token VARCHAR(100),
PRIMARY KEY (id));
</br>
</br>
CREATE TABLE opiskelijat(
id INT NOT NULL,    
name VARCHAR(50) NOT NULL,
opnro INT NOT NULL,
p_aine VARCHAR(50) NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id) REFERENCES  users (id));    </br>/* laitettu users(id)*/
</br>
</br>
CREATE TABLE opettajat(
id INT NOT NULL,    
name VARCHAR(50) NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id) REFERENCES users (id));    </br>/* laitettu users(id)*/
</br>
</br>
</br>/*Tehtäväpankki*/
</br>/* täs on ihan tarkotuksella tehtava+s, ku se laravel kattoo kai jotenkin sen luokan mukaan sen taulun (esim User ja et sen taulu </br>on users ja niin edelleen), ni sitten ku loin Tehtava-luokan ni se haluaa tehtavas-taulun */ 
</br>/* sitten lisäsin tähänki tän auto_incrementin */
</br>/*sitten vaihdoin nää aikajutut näiks timestampeiks. Nää tulee automaattisesti luoduks*/
</br>
CREATE TABLE tehtavas(   
id INT NOT NULL AUTO_INCREMENT,     
created_at TIMESTAMP NULL,           
updated_at TIMESTAMP NULL,
teht_kuvaus VARCHAR(100) NOT NULL,
esim_vastaus VARCHAR(100) NOT NULL,
kysely_tyyppi VARCHAR(20) NOT NULL,
tehtavalista_id INT NOT NULL,
teht_luoja_id INT NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (teht_luoja_id) REFERENCES opettajat (id));      </br>/* laitettu opettajat(id)*/
</br>
</br>
</br>/* tässäkin sama, eli tehtavalista+s */
</br>/* sitten lisäsin tähänki tän auto_incrementin */
</br>
CREATE TABLE tehtavalistas(     
id INT NOT NULL AUTO_INCREMENT,  
created_at TIMESTAMP NULL,
updated_at TIMESTAMP NULL,
tehtlista_kuvaus VARCHAR(100) NOT NULL,
tehtlista_luoja_id INT NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (tehtlista_luoja_id) REFERENCES opettajat (id));     </br>/* laitettu opettajat(id)*/
</br>
</br>
<b>Koska</b> nyt se yks tehtävä on vaan yhessä tehtävälistassa, ni tää ei ehkä oo tarpeen. Jotenki toi seuraaja pitäis miettiä sit, mut ehkä se ei oo sit ongelma, jos se tietty tehtävä on yhessä tehtävälistassa. Tätä en siis laittanut vielä omaan tietokantaani mukaan.  
</br>
</br>CREATE TABLE tehtlistaSisaltaa(
</br>tehtlista_id INT NOT NULL, 
</br>teht_id INT NOT NULL, 
</br>seuraaja_id INT,            /*tehtävien sisäinen järjestys / linkitetty lista*/
</br>PRIMARY KEY (tehtlista_id, teht_id),
</br>FOREIGN KEY (tehtlista_id) REFERENCES tehtavalistat (id), 
</br>FOREIGN KEY (teht_id) REFERENCES tehtavat (id));
