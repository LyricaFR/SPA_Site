--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.19
-- Dumped by pg_dump version 9.6.17

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: animal; Type: TABLE; Schema: public; Owner: kquach01
--

CREATE TABLE public.animal (
    id_animal integer NOT NULL,
    nom character varying(25) NOT NULL,
    sexe character(1) NOT NULL,
    signe_distinct character varying(100),
    age integer NOT NULL,
    date_deces date,
    fourriere character varying(25) NOT NULL,
    espece character varying(50) DEFAULT '?'::character varying NOT NULL,
    id_refuge integer,
    date_inscription date,
    id_particulier integer,
    date_adoption date,
    CONSTRAINT comparaison_date CHECK ((date_inscription <= date_adoption)),
    CONSTRAINT contrainte_date_deces CHECK ((date_deces >= date_inscription)),
    CONSTRAINT contrainte_date_deces2 CHECK ((date_deces >= date_adoption))
);


ALTER TABLE public.animal OWNER TO kquach01;

--
-- Name: employe; Type: TABLE; Schema: public; Owner: kquach01
--

CREATE TABLE public.employe (
    matricule integer NOT NULL,
    nom character varying(25) NOT NULL,
    prenom character varying(25) NOT NULL,
    adresse character varying(100) NOT NULL,
    telephone character(10) NOT NULL,
    securite_sociale character(13) NOT NULL,
    login character varying(25) NOT NULL,
    mdp character varying(25) NOT NULL
);


ALTER TABLE public.employe OWNER TO kquach01;

--
-- Name: id_animal_seq; Type: SEQUENCE; Schema: public; Owner: kquach01
--

CREATE SEQUENCE public.id_animal_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.id_animal_seq OWNER TO kquach01;

--
-- Name: particulier; Type: TABLE; Schema: public; Owner: kquach01
--

CREATE TABLE public.particulier (
    id_particulier integer NOT NULL,
    nom character varying(25) NOT NULL,
    prenom character varying(25) NOT NULL,
    telephone character(10) NOT NULL,
    adresse character varying(100) NOT NULL
);


ALTER TABLE public.particulier OWNER TO kquach01;

--
-- Name: profession; Type: TABLE; Schema: public; Owner: kquach01
--

CREATE TABLE public.profession (
    id_profession integer NOT NULL,
    intitule character varying(25) NOT NULL
);


ALTER TABLE public.profession OWNER TO kquach01;

--
-- Name: refuge; Type: TABLE; Schema: public; Owner: kquach01
--

CREATE TABLE public.refuge (
    id_refuge integer NOT NULL,
    nom character varying(25) NOT NULL,
    adresse character varying(100) NOT NULL,
    telephone character(10) NOT NULL,
    capacite integer NOT NULL,
    id_ville integer,
    matricule integer
);


ALTER TABLE public.refuge OWNER TO kquach01;

--
-- Name: soin; Type: TABLE; Schema: public; Owner: kquach01
--

CREATE TABLE public.soin (
    id_soin integer NOT NULL,
    date_soin date NOT NULL,
    id_type integer,
    id_animal integer,
    matricule integer
);


ALTER TABLE public.soin OWNER TO kquach01;

--
-- Name: transfert; Type: TABLE; Schema: public; Owner: kquach01
--

CREATE TABLE public.transfert (
    id_transfert integer NOT NULL,
    date_depart date NOT NULL,
    date_arrive date,
    id_destination integer,
    id_origin integer,
    id_animal integer,
    CONSTRAINT comparaison_date CHECK ((date_depart <= date_arrive))
);


ALTER TABLE public.transfert OWNER TO kquach01;

--
-- Name: travaille; Type: TABLE; Schema: public; Owner: kquach01
--

CREATE TABLE public.travaille (
    id_profession integer NOT NULL,
    id_refuge integer NOT NULL,
    matricule integer NOT NULL
);


ALTER TABLE public.travaille OWNER TO kquach01;

--
-- Name: type_soin; Type: TABLE; Schema: public; Owner: kquach01
--

CREATE TABLE public.type_soin (
    id_type integer NOT NULL,
    intitule character varying(25) NOT NULL,
    rappel integer
);


ALTER TABLE public.type_soin OWNER TO kquach01;

--
-- Name: ville; Type: TABLE; Schema: public; Owner: kquach01
--

CREATE TABLE public.ville (
    id_ville integer NOT NULL,
    nom character varying(25) NOT NULL,
    code_postale character(5) NOT NULL
);


ALTER TABLE public.ville OWNER TO kquach01;

--
-- Data for Name: animal; Type: TABLE DATA; Schema: public; Owner: kquach01
--

INSERT INTO public.animal VALUES (5, 'Miki', 'F', NULL, 2, NULL, '12', 'Shiba Inu', 5, '2018-10-01', NULL, NULL);
INSERT INTO public.animal VALUES (7, 'Max', 'M', NULL, 4, NULL, '4', 'Golden Retriever', 2, '2018-04-15', NULL, NULL);
INSERT INTO public.animal VALUES (6, 'Fenegan', 'M', 'Hétérochromie', 1, NULL, '3', 'Samoyède', 1, '2020-04-23', 3, '2020-09-12');
INSERT INTO public.animal VALUES (2, 'Rolo', 'M', 'Tâche sur le cou', 8, NULL, '1', 'Chihuahua', 1, '2020-11-23', NULL, NULL);
INSERT INTO public.animal VALUES (1, 'Meg', 'F', NULL, 15, '2020-08-21', '5', 'Labrador', 3, '2010-07-05', 1, '2013-07-17');
INSERT INTO public.animal VALUES (3, 'Pog', 'M', NULL, 6, NULL, '11', 'Cavalier', 2, '2018-11-06', NULL, NULL);
INSERT INTO public.animal VALUES (4, 'Mila', 'F', 'Tache noir sur oeil droit', 5, NULL, '4', 'Labrador', 4, '2017-06-18', 3, '2019-01-25');
INSERT INTO public.animal VALUES (10, 'Pola', 'F', NULL, 13, '2019-06-14', '4', 'Thai', 1, '2011-01-02', 2, '2011-09-17');
INSERT INTO public.animal VALUES (8, 'Pikmin', 'M', NULL, 6, NULL, '7', 'Husky', 5, '2016-11-03', 5, '2017-03-17');
INSERT INTO public.animal VALUES (9, 'Kali', 'F', NULL, 2, NULL, '5', 'Labrador', 3, '2019-08-15', 4, '2019-12-11');
INSERT INTO public.animal VALUES (11, 'Phil', 'F', NULL, 4, NULL, '2', 'Canis lupus', 4, '2017-04-28', NULL, NULL);
INSERT INTO public.animal VALUES (12, 'Snow', 'M', 'Albinisme', 3, NULL, '1', 'Berger allemand', 5, '2019-03-14', 5, '2019-05-21');
INSERT INTO public.animal VALUES (13, 'Epona', 'F', NULL, 7, NULL, '3', 'Border collie', 1, '2015-06-24', 6, '2016-02-01');
INSERT INTO public.animal VALUES (14, 'Hover', 'M', 'Albinisme', 17, '2019-08-24', '1', 'Chien', 2, '2008-04-14', 2, '2008-07-26');


--
-- Data for Name: employe; Type: TABLE DATA; Schema: public; Owner: kquach01
--

INSERT INTO public.employe VALUES (1, 'Chirac', 'Jacques', '44 Rue du President 85100 Nancy', '563645856 ', '1234567891234', 'jchirac', 'chiracj');
INSERT INTO public.employe VALUES (2, 'Bourpalet', 'Sasha', '25 Rue de Pikachu 41500 Pokemon', '642335561 ', '2234567891234', 'sbourpalet', 'bourpalets');
INSERT INTO public.employe VALUES (3, 'Kent', 'Clark', '10 Rue de Superman 78800 Smallville', '101015221 ', '3234567891234', 'ckent', 'kentc');
INSERT INTO public.employe VALUES (4, 'Dupuit', 'Bill', '2 Rue de la fête 14560 Ajaccio', '788442266 ', '4234567891234', 'bdupuit', 'dupuitb');
INSERT INTO public.employe VALUES (5, 'Jean', 'Bon', '6 Rue de Gauche 99400 Toulouse', '888442266 ', '5234567891234', 'bjean', 'jeanb');
INSERT INTO public.employe VALUES (7, 'Pierre', 'Paul', '11 Rue de Jacque 90500 Paris', '188442266 ', '7234567891234', 'ppierre', 'pierrep');
INSERT INTO public.employe VALUES (8, 'Ader', 'Clement', '13 Rue de Canard 10500 Paris', '288442266 ', '8234567891234', 'cader', 'aderc');
INSERT INTO public.employe VALUES (9, 'Rose', 'Pierrot', '17 Rue du Papillon 11500 Marseille', '388442266 ', '9234567891234', 'prose', 'rosep');
INSERT INTO public.employe VALUES (10, 'DuJardin', 'Jean', '99 Rue du Soleil 71500 Besancon', '488442266 ', '9334567891234', 'jdujardin', 'dujardinj');
INSERT INTO public.employe VALUES (11, 'Jacques', 'Rousseau', '3 Rue Margaret Folie 78646 Versailles', '0742849163', '9334567991235', 'rjacques', 'jacquesr');
INSERT INTO public.employe VALUES (12, 'Mauri', 'Yo', '6 Rue de la joie 45120 Marne-Sous-Bois', '4525434537', '1945465727257', 'ymauri', 'mauriy');
INSERT INTO public.employe VALUES (6, 'Chateau', 'Clemence', '78 Rue de l étoile 88500 Marne', '988442266 ', '6234567891234', 'cchateau', 'chateauc');
INSERT INTO public.employe VALUES (13, 'Robert', 'Milan', '24 Rue Eiffel 75003 Paris', '0697154236', '1985264221113', 'mrobert', 'robertm');
INSERT INTO public.employe VALUES (14, 'Timbre', 'Gilbert', '20 Rue George Boenne 94100', '0641478523', '1946337666441', 'gtimbre', 'timbreg');
INSERT INTO public.employe VALUES (15, 'Panne', 'Mélanie', '3 Rue de Charles Pommier 75006', '0741569357', '2649766134421', 'mpanne', 'pannem');
INSERT INTO public.employe VALUES (16, 'Mona', 'Valérie', '21 Rue Antoine Martin 92400', '0764533946', '1789421644211', 'vmona', 'monav');
INSERT INTO public.employe VALUES (17, 'Grégorie', 'Pauline', '12 Rue du pommier 91300', '0684214455', '8712245373453', 'pgrégorie', 'grégoriep');
INSERT INTO public.employe VALUES (19, 'Marine', 'Albert', '12 Allée Charles de Gaules 94260 Nice', '0695432157', '2946326161212', 'amarine', 'marinea');
INSERT INTO public.employe VALUES (18, 'Parain', 'Julie', '28 Rue des cerisiers 93600 Aulnay', '0641352174', '4277946463434', 'jparain', 'parainj');
INSERT INTO public.employe VALUES (20, 'Jonathan', 'John', '24 Rue des enchère 97400', '0678742424', '1576751212454', 'jjonathan', 'jonathanj');


--
-- Name: id_animal_seq; Type: SEQUENCE SET; Schema: public; Owner: kquach01
--

SELECT pg_catalog.setval('public.id_animal_seq', 1, false);


--
-- Data for Name: particulier; Type: TABLE DATA; Schema: public; Owner: kquach01
--

INSERT INTO public.particulier VALUES (1, 'Dupont', 'Charles', '179815050 ', '9 Rue du Poisson 06100 Nice');
INSERT INTO public.particulier VALUES (2, 'Leclerc', 'Pascal', '645562711 ', '4 Rue du Chien 35700 Rennes');
INSERT INTO public.particulier VALUES (3, 'Lee', 'Xiao', '699994563 ', '10 Rue du Cheval 75001 Paris');
INSERT INTO public.particulier VALUES (4, 'Ho', 'Xavier', '782147691 ', '16 Rue du Lapin 13001 Marseille');
INSERT INTO public.particulier VALUES (5, 'De Rive', 'Geralt', '641103689 ', '12 Rue du Chat 67200 Strasbourg');
INSERT INTO public.particulier VALUES (6, 'Van', 'Link', '0682415793', '12 Rue Pierre Edouard 78646 Versailles');


--
-- Data for Name: profession; Type: TABLE DATA; Schema: public; Owner: kquach01
--

INSERT INTO public.profession VALUES (1, 'Gerant');
INSERT INTO public.profession VALUES (2, 'Soigneur');
INSERT INTO public.profession VALUES (3, 'Nettoyeur');
INSERT INTO public.profession VALUES (4, 'Veterinaire');


--
-- Data for Name: refuge; Type: TABLE DATA; Schema: public; Owner: kquach01
--

INSERT INTO public.refuge VALUES (1, 'SPA1', '5 Rue du Chaton', '0646562636', 150, 4, 1);
INSERT INTO public.refuge VALUES (2, 'SPA2', '4 Rue du Chaton', '0666462636', 120, 2, 2);
INSERT INTO public.refuge VALUES (3, 'SPA3', '8 Rue du Chimpanze', '0666462637', 80, 3, 3);
INSERT INTO public.refuge VALUES (4, 'SPA4', '6 rue des horloges', '0748592211', 135, 4, 4);
INSERT INTO public.refuge VALUES (5, 'SPA5', '15 rue du ciel', '0686766656', 60, 5, 5);


--
-- Data for Name: soin; Type: TABLE DATA; Schema: public; Owner: kquach01
--

INSERT INTO public.soin VALUES (2, '2021-10-05', 2, 2, 2);
INSERT INTO public.soin VALUES (1, '2021-09-03', 1, 1, 1);
INSERT INTO public.soin VALUES (3, '2021-01-01', 1, 6, 8);
INSERT INTO public.soin VALUES (5, '2020-12-02', 1, 2, 8);
INSERT INTO public.soin VALUES (4, '2008-04-29', 1, 14, 12);
INSERT INTO public.soin VALUES (6, '2018-11-18', 1, 3, 12);


--
-- Data for Name: transfert; Type: TABLE DATA; Schema: public; Owner: kquach01
--

INSERT INTO public.transfert VALUES (5, '2019-04-15', '2019-04-16', 5, 1, 12);
INSERT INTO public.transfert VALUES (6, '2019-10-08', '2019-10-12', 3, 4, 9);
INSERT INTO public.transfert VALUES (7, '2011-06-21', '2011-06-24', 1, 3, 10);
INSERT INTO public.transfert VALUES (1, '2009-06-21', '2009-07-01', 3, 1, 1);
INSERT INTO public.transfert VALUES (2, '2018-11-14', '2018-11-16', 5, 3, 5);
INSERT INTO public.transfert VALUES (3, '2017-01-08', '2017-01-09', 4, 1, 8);
INSERT INTO public.transfert VALUES (4, '2017-01-19', '2017-01-21', 5, 4, 8);
INSERT INTO public.transfert VALUES (8, '2018-12-14', '2018-12-17', 2, 1, 7);
INSERT INTO public.transfert VALUES (9, '2018-12-28', '2019-01-01', 4, 5, 3);
INSERT INTO public.transfert VALUES (10, '2018-11-26', '2018-11-29', 5, 1, 3);
INSERT INTO public.transfert VALUES (11, '2019-07-15', '2019-07-20', 2, 4, 3);


--
-- Data for Name: travaille; Type: TABLE DATA; Schema: public; Owner: kquach01
--

INSERT INTO public.travaille VALUES (1, 1, 1);
INSERT INTO public.travaille VALUES (1, 2, 2);
INSERT INTO public.travaille VALUES (1, 3, 3);
INSERT INTO public.travaille VALUES (1, 4, 4);
INSERT INTO public.travaille VALUES (1, 5, 5);
INSERT INTO public.travaille VALUES (3, 1, 7);
INSERT INTO public.travaille VALUES (3, 5, 6);
INSERT INTO public.travaille VALUES (4, 3, 10);
INSERT INTO public.travaille VALUES (2, 1, 8);
INSERT INTO public.travaille VALUES (3, 2, 9);
INSERT INTO public.travaille VALUES (2, 4, 11);
INSERT INTO public.travaille VALUES (4, 2, 12);
INSERT INTO public.travaille VALUES (2, 2, 13);
INSERT INTO public.travaille VALUES (2, 5, 14);
INSERT INTO public.travaille VALUES (4, 5, 15);
INSERT INTO public.travaille VALUES (2, 2, 16);
INSERT INTO public.travaille VALUES (3, 4, 17);
INSERT INTO public.travaille VALUES (2, 3, 18);
INSERT INTO public.travaille VALUES (4, 4, 19);
INSERT INTO public.travaille VALUES (2, 5, 20);


--
-- Data for Name: type_soin; Type: TABLE DATA; Schema: public; Owner: kquach01
--

INSERT INTO public.type_soin VALUES (1, 'Vaccin', 90);
INSERT INTO public.type_soin VALUES (2, 'Sterilisation', NULL);
INSERT INTO public.type_soin VALUES (3, 'Contrôle', NULL);


--
-- Data for Name: ville; Type: TABLE DATA; Schema: public; Owner: kquach01
--

INSERT INTO public.ville VALUES (1, 'Paris', '75001');
INSERT INTO public.ville VALUES (2, 'Marseille', '13001');
INSERT INTO public.ville VALUES (3, 'Nice', '6100 ');
INSERT INTO public.ville VALUES (4, 'Strasbourg', '67200');
INSERT INTO public.ville VALUES (5, 'Rennes', '35700');
INSERT INTO public.ville VALUES (6, 'Versailles', '78646');


--
-- Name: animal animal_pkey; Type: CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.animal
    ADD CONSTRAINT animal_pkey PRIMARY KEY (id_animal);


--
-- Name: employe employe_login_key; Type: CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.employe
    ADD CONSTRAINT employe_login_key UNIQUE (login);


--
-- Name: employe employe_pkey; Type: CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.employe
    ADD CONSTRAINT employe_pkey PRIMARY KEY (matricule);


--
-- Name: employe employe_securite_sociale_key; Type: CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.employe
    ADD CONSTRAINT employe_securite_sociale_key UNIQUE (securite_sociale);


--
-- Name: employe employe_telephone_key; Type: CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.employe
    ADD CONSTRAINT employe_telephone_key UNIQUE (telephone);


--
-- Name: particulier particulier_pkey; Type: CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.particulier
    ADD CONSTRAINT particulier_pkey PRIMARY KEY (id_particulier);


--
-- Name: particulier particulier_telephone_key; Type: CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.particulier
    ADD CONSTRAINT particulier_telephone_key UNIQUE (telephone);


--
-- Name: profession profession_pkey; Type: CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.profession
    ADD CONSTRAINT profession_pkey PRIMARY KEY (id_profession);


--
-- Name: refuge refuge_adresse_key; Type: CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.refuge
    ADD CONSTRAINT refuge_adresse_key UNIQUE (adresse);


--
-- Name: refuge refuge_pkey; Type: CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.refuge
    ADD CONSTRAINT refuge_pkey PRIMARY KEY (id_refuge);


--
-- Name: refuge refuge_telephone_key; Type: CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.refuge
    ADD CONSTRAINT refuge_telephone_key UNIQUE (telephone);


--
-- Name: soin soin_pkey; Type: CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.soin
    ADD CONSTRAINT soin_pkey PRIMARY KEY (id_soin);


--
-- Name: transfert transfert_pkey; Type: CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.transfert
    ADD CONSTRAINT transfert_pkey PRIMARY KEY (id_transfert);


--
-- Name: travaille travaille_pkey; Type: CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.travaille
    ADD CONSTRAINT travaille_pkey PRIMARY KEY (id_profession, id_refuge, matricule);


--
-- Name: type_soin type_soin_pkey; Type: CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.type_soin
    ADD CONSTRAINT type_soin_pkey PRIMARY KEY (id_type);


--
-- Name: ville ville_pkey; Type: CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.ville
    ADD CONSTRAINT ville_pkey PRIMARY KEY (id_ville);


--
-- Name: animal animal_id_particulier_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.animal
    ADD CONSTRAINT animal_id_particulier_fkey FOREIGN KEY (id_particulier) REFERENCES public.particulier(id_particulier) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: animal animal_id_refuge_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.animal
    ADD CONSTRAINT animal_id_refuge_fkey FOREIGN KEY (id_refuge) REFERENCES public.refuge(id_refuge) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: refuge refuge_id_ville_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.refuge
    ADD CONSTRAINT refuge_id_ville_fkey FOREIGN KEY (id_ville) REFERENCES public.ville(id_ville) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: refuge refuge_matricule_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.refuge
    ADD CONSTRAINT refuge_matricule_fkey FOREIGN KEY (matricule) REFERENCES public.employe(matricule) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: soin soin_id_animal_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.soin
    ADD CONSTRAINT soin_id_animal_fkey FOREIGN KEY (id_animal) REFERENCES public.animal(id_animal) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: soin soin_id_type_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.soin
    ADD CONSTRAINT soin_id_type_fkey FOREIGN KEY (id_type) REFERENCES public.type_soin(id_type) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: soin soin_matricule_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.soin
    ADD CONSTRAINT soin_matricule_fkey FOREIGN KEY (matricule) REFERENCES public.employe(matricule) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: transfert transfert_id_animal_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.transfert
    ADD CONSTRAINT transfert_id_animal_fkey FOREIGN KEY (id_animal) REFERENCES public.animal(id_animal) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: transfert transfert_id_destination_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.transfert
    ADD CONSTRAINT transfert_id_destination_fkey FOREIGN KEY (id_destination) REFERENCES public.refuge(id_refuge) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: transfert transfert_id_origin_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.transfert
    ADD CONSTRAINT transfert_id_origin_fkey FOREIGN KEY (id_origin) REFERENCES public.refuge(id_refuge) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: travaille travaille_id_profession_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.travaille
    ADD CONSTRAINT travaille_id_profession_fkey FOREIGN KEY (id_profession) REFERENCES public.profession(id_profession) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: travaille travaille_id_refuge_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.travaille
    ADD CONSTRAINT travaille_id_refuge_fkey FOREIGN KEY (id_refuge) REFERENCES public.refuge(id_refuge) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: travaille travaille_matricule_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kquach01
--

ALTER TABLE ONLY public.travaille
    ADD CONSTRAINT travaille_matricule_fkey FOREIGN KEY (matricule) REFERENCES public.employe(matricule) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

