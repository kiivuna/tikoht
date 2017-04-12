<b>Toka</b> versiossa kirjautuneen käyttäjän on mahdollista </br>
-luoda tehtävälista (näkyy tosin vielä kaikille) </br>
-luoda tehtävälistaan tehtäviä (näkyy nekin kaikille)</br>
  *Tässä päädyin nyt sellaseen, että jokanen tehtävä voi kuulua vain yhteen tehtävälistaan. Tää rikkoo meidän alkuperästä ajatusta, mut näin sen sain ainaki toimimaan, et tää vois olla nyt eka askel tässä. 
</br>
</br>
<i>Sitten jouduin vähän muokkaamaan tähän näitä meiän tauluja.</i> </br>
Omaan mysql-tietokantaani loin tällaset taulut. Nää meni ihan silleen, ku copypastesi nää sinne Vagrant ssh->mysql. Jouduin näitä vähän muokkaa (esim auto_increment) siihen mysql:ään sopivaks. Postgresissa tais olla sen auto_incrementin tilalla se serial. 
</br>
</br>/* Käyttäjät */   /* vaihdettu kayttajat -> users */
</br>CREATE TABLE users(       
</br>id INT NOT NULL AUTO_INCREMENT, 
</br>name VARCHAR(255) NOT NULL,
</br>email VARCHAR(50) UNIQUE NOT NULL,
</br>password VARCHAR(255) NOT NULL,
</br>remember_token VARCHAR(100),
</br>PRIMARY KEY (id));
</br>
</br>CREATE TABLE opiskelijat(
</br>id INT NOT NULL,    
</br>name VARCHAR(50) NOT NULL,
</br>opnro INT NOT NULL,
</br>p_aine VARCHAR(50) NOT NULL,
</br>PRIMARY KEY (id),
</br>FOREIGN KEY (id) REFERENCES  users (id));    /* laitettu users(id)*/
</br>
</br>CREATE TABLE opettajat(
</br>id INT NOT NULL,    
</br>name VARCHAR(50) NOT NULL,
</br>PRIMARY KEY (id),
</br>FOREIGN KEY (id) REFERENCES users (id));    /* laitettu users(id)*/

</br>/*Tehtäväpankki*/
</br>/* täs on ihan tarkotuksella tehtava+s, ku se laravel kattoo kai jotenkin sen luokan mukaan sen taulun (esim User ja et sen taulu </br>on users ja niin edelleen), ni sitten ku loin Tehtava-luokan ni se haluaa tehtavas-taulun */ 
</br>/* sitten lisäsin tähänki tän auto_incrementin */
</br>/*sitten vaihdoin nää aikajutut näiks timestampeiks. Nää tulee automaattisesti luoduks*/
</br>CREATE TABLE tehtavas(   
</br>id INT NOT NULL AUTO_INCREMENT,     
</br>created_at TIMESTAMP NULL,           
</br>updated_at TIMESTAMP NULL,
</br>teht_kuvaus VARCHAR(100) NOT NULL,
</br>esim_vastaus VARCHAR(100) NOT NULL,
</br>kysely_tyyppi VARCHAR(20) NOT NULL,
</br>tehtavalista_id INT NOT NULL,
</br>teht_luoja_id INT NOT NULL,
</br>PRIMARY KEY (id),
</br>FOREIGN KEY (teht_luoja_id) REFERENCES opettajat (id));      /* laitettu opettajat(id)*/
</br>
</br>/* tässäkin sama, eli tehtavalista+s */
</br>/* sitten lisäsin tähänki tän auto_incrementin */
</br>CREATE TABLE tehtavalistas(     
</br>id INT NOT NULL AUTO_INCREMENT,  
</br>created_at TIMESTAMP NULL,
</br>updated_at TIMESTAMP NULL,
</br>tehtlista_kuvaus VARCHAR(100) NOT NULL,
</br>tehtlista_luoja_id INT NOT NULL,
</br>PRIMARY KEY (id),
</br>FOREIGN KEY (tehtlista_luoja_id) REFERENCES opettajat (id));     /* laitettu opettajat(id)*/
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
