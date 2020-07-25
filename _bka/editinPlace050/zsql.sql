CREATE TABLE kriteriaBA
CREATE TABLE kriteriaPT
CREATE TABLE kriteriaKsel
CREATE TABLE kriteriaKsih

CREATE TABLE kriteria (
id_art int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
id VARCHAR(25) NOT NULL,
new_content VARCHAR(250) NOT NULL,
old_content VARCHAR(250) NOT NULL,
form_type VARCHAR(50) NOT NULL,
old_option VARCHAR(250) NOT NULL,
new_option VARCHAR(250) NOT NULL,
old_option_text VARCHAR(250) NOT NULL,
new_option_text VARCHAR(250) NOT NULL,
id_daftar MEDIUMINT NOT NULL,
username varchar(20) NOT NULL,
kp varchar(15) NOT NULL ,
regist_date DATETIME NOT NULL,
UNIQUE (id),
PRIMARY KEY(id_art));


CREATE TABLE ulasanBA
CREATE TABLE ulasanPT
CREATE TABLE ulasanKsel
CREATE TABLE ulasanKsih


CREATE TABLE ulasan (
id_art int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
id VARCHAR(25) NOT NULL,
form_type VARCHAR(50) NOT NULL,
old_content VARCHAR(250) NOT NULL,
new_content VARCHAR(250) NOT NULL,
old_option VARCHAR(250) NOT NULL,
new_option VARCHAR(250) NOT NULL,
old_option_text VARCHAR(250) NOT NULL,
new_option_text VARCHAR(250) NOT NULL,
id_daftar MEDIUMINT NOT NULL,
username varchar(20) NOT NULL,
kp varchar(15) NOT NULL ,
regist_date DATETIME NOT NULL,
UNIQUE (id),
PRIMARY KEY(id_art));


CREATE TABLE needstatement (
id_art int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
id VARCHAR(25) NOT NULL,
new_content VARCHAR(250) NOT NULL,
old_content VARCHAR(250) NOT NULL,
form_type VARCHAR(50) NOT NULL,
old_option VARCHAR(250) NOT NULL,
new_option VARCHAR(250) NOT NULL,
old_option_text VARCHAR(250) NOT NULL,
new_option_text VARCHAR(250) NOT NULL,
id_daftar MEDIUMINT NOT NULL,
username varchar(20) NOT NULL,
kp varchar(15) NOT NULL ,
regist_date DATETIME NOT NULL,
UNIQUE (id),
PRIMARY KEY(id_art));


CREATE TABLE mydrawings (
id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
daftar_id MEDIUMINT NOT NULL,
tajuk VARCHAR(250) NOT NULL,
nombor VARCHAR(100) NOT NULL,
kategori VARCHAR(15) NOT NULL,
peti VARCHAR(50) NOT NULL,
tarikh date NOT NULL,
username varchar(20) NOT NULL,
kp varchar(15) NOT NULL ,
regist_date DATETIME NOT NULL,
pelukis varchar(100) NOT NULL,
UNIQUE (daftar_id,tajuk,nombor,kategori),
PRIMARY KEY(id));

CREATE TABLE lotsite (
id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
daftar_id MEDIUMINT NOT NULL,
gridX FLOAT(10,2) NOT NULL,
gridY FLOAT(10,2) NOT NULL,
xy text NOT NULL,
ze text NOT NULL,
regist_date DATETIME NOT NULL,
tprojek VARCHAR(250) NOT NULL,
UNIQUE (daftar_id),
PRIMARY KEY(id));


CREATE TABLE infoFIXED (
id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
class_id VARCHAR(50) NOT NULL,
element_id VARCHAR(50) NULL,
update_value VARCHAR(250) NOT NULL,
original_html VARCHAR(250) NOT NULL,
daftar_id MEDIUMINT NOT NULL,
username varchar(20) NOT NULL,
kp varchar(15) NOT NULL ,
regist_date DATETIME NOT NULL,
UNIQUE (element_id),
PRIMARY KEY(id));


CREATE TABLE infoPROGRESS (
id int(12) UNSIGNED NOT NULL AUTO_INCREMENT,
class_id VARCHAR(50) NOT NULL,
element_id VARCHAR(50) NULL,
update_value VARCHAR(250) NOT NULL,
original_html VARCHAR(250) NOT NULL,
daftar_id MEDIUMINT NOT NULL,
username varchar(20) NOT NULL,
kp varchar(15) NOT NULL ,
regist_date DATETIME NOT NULL,
UNIQUE (element_id),
PRIMARY KEY(id));





