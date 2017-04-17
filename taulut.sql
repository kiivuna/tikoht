CREATE TABLE users(
id SERIAL NOT NULL,        
admin BOOLEAN DEFAULT FALSE NOT NULL,
name VARCHAR(255) NOT NULL,
email VARCHAR(50) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL,
remember_token VARCHAR(100),
created_at TIMESTAMP NULL,
updated_at TIMESTAMP NULL,
PRIMARY KEY (id));

CREATE TABLE opiskelijat(
id INT NOT NULL,    
name VARCHAR(50) NOT NULL,
opnro INT NOT NULL,
p_aine VARCHAR(50) NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id) REFERENCES  users);  

CREATE TABLE opettajat(
id INT NOT NULL,    
name VARCHAR(50) NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id) REFERENCES users); 

CREATE TABLE tehtavas(
id SERIAL NOT NULL,
created_at TIMESTAMP NULL,
updated_at TIMESTAMP NULL,
teht_kuvaus VARCHAR(100) NOT NULL,
esim_vastaus VARCHAR(100) NOT NULL,
kysely_tyyppi VARCHAR(20) NOT NULL,
tehtavalista_id INT NOT NULL,
teht_luoja_id INT NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (teht_luoja_id) REFERENCES opettajat);

CREATE TABLE tehtavalistas(
id SERIAL NOT NULL, 
created_at TIMESTAMP NULL,
updated_at TIMESTAMP NULL,
tehtlista_kuvaus VARCHAR(100) NOT NULL,
tehtlista_luoja_id INT NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (tehtlista_luoja_id) REFERENCES opettajat);

CREATE TABLE kurssis( 
id INT NOT NULL,
nimi VARCHAR(50) NOT NULL, 
opettaja_id INT NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (opettaja_id) REFERENCES opettajat);

CREATE TABLE kurssinosallistujat(
kurssi_id INT NOT NULL,
op_id INT NOT NULL,
PRIMARY KEY (kurssi_id, op_id),
FOREIGN KEY (kurssi_id) REFERENCES kurssis,
FOREIGN KEY (op_id) REFERENCES opiskelijat); 

CREATE TABLE sessios(
id SERIAL NOT NULL, 
created_at TIMESTAMP NULL,
updated_at TIMESTAMP NULL,   
tehtlista_id INT NOT NULL,            
session_luoja_id INT NOT NULL,    
kurssi_id INT NOT NULL,     
PRIMARY KEY (id),
FOREIGN KEY (tehtlista_id) REFERENCES tehtavalistas,
FOREIGN KEY (session_luoja_id) REFERENCES opettajat,
FOREIGN KEY (kurssi_id) REFERENCES kurssis);
