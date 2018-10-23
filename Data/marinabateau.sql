--
-- PostgreSQL database dump
--

-- Dumped from database version 10.5 (Ubuntu 10.5-0ubuntu0.18.04)
-- Dumped by pg_dump version 10.5 (Ubuntu 10.5-0ubuntu0.18.04)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
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
-- Name: bateau; Type: TABLE; Schema: public; Owner: webmestre
--

CREATE TABLE public.bateau (
    id integer NOT NULL,
    nom character varying(50) NOT NULL,
    longueur real NOT NULL,
    largeur real NOT NULL,
    type_bateau text,
    id_client integer
);


ALTER TABLE public.bateau OWNER TO webmestre;

--
-- Name: bateau_id_seq; Type: SEQUENCE; Schema: public; Owner: webmestre
--

CREATE SEQUENCE public.bateau_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bateau_id_seq OWNER TO webmestre;

--
-- Name: bateau_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: webmestre
--

ALTER SEQUENCE public.bateau_id_seq OWNED BY public.bateau.id;


--
-- Name: client; Type: TABLE; Schema: public; Owner: webmestre
--

CREATE TABLE public.client (
    id integer NOT NULL,
    nom character varying(50) NOT NULL,
    prenom character varying(50) NOT NULL,
    mail text NOT NULL,
    numero integer,
    mot_de_passe text,
    bool_gerant boolean
);


ALTER TABLE public.client OWNER TO webmestre;

--
-- Name: client_id_seq; Type: SEQUENCE; Schema: public; Owner: webmestre
--

CREATE SEQUENCE public.client_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.client_id_seq OWNER TO webmestre;

--
-- Name: client_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: webmestre
--

ALTER SEQUENCE public.client_id_seq OWNED BY public.client.id;


--
-- Name: emplacement; Type: TABLE; Schema: public; Owner: webmestre
--

CREATE TABLE public.emplacement (
    id integer NOT NULL,
    longueur double precision,
    largeur double precision,
    label text,
    latitude double precision,
    longitude double precision
);


ALTER TABLE public.emplacement OWNER TO webmestre;

--
-- Name: emplacement_id_seq; Type: SEQUENCE; Schema: public; Owner: webmestre
--

CREATE SEQUENCE public.emplacement_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.emplacement_id_seq OWNER TO webmestre;

--
-- Name: emplacement_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: webmestre
--

ALTER SEQUENCE public.emplacement_id_seq OWNED BY public.emplacement.id;


--
-- Name: reservation; Type: TABLE; Schema: public; Owner: webmestre
--

CREATE TABLE public.reservation (
    id integer NOT NULL,
    datedebut date NOT NULL,
    datefin date NOT NULL,
    id_client integer,
    id_emplacement integer,
    id_bateau integer,
    electricite integer DEFAULT 0,
    essence integer DEFAULT 0,
    vidange integer DEFAULT 0
);


ALTER TABLE public.reservation OWNER TO webmestre;

--
-- Name: reservation_id_seq; Type: SEQUENCE; Schema: public; Owner: webmestre
--

CREATE SEQUENCE public.reservation_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reservation_id_seq OWNER TO webmestre;

--
-- Name: reservation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: webmestre
--

ALTER SEQUENCE public.reservation_id_seq OWNED BY public.reservation.id;


--
-- Name: bateau id; Type: DEFAULT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.bateau ALTER COLUMN id SET DEFAULT nextval('public.bateau_id_seq'::regclass);


--
-- Name: client id; Type: DEFAULT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.client ALTER COLUMN id SET DEFAULT nextval('public.client_id_seq'::regclass);


--
-- Name: emplacement id; Type: DEFAULT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.emplacement ALTER COLUMN id SET DEFAULT nextval('public.emplacement_id_seq'::regclass);


--
-- Name: reservation id; Type: DEFAULT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.reservation ALTER COLUMN id SET DEFAULT nextval('public.reservation_id_seq'::regclass);


--
-- Data for Name: bateau; Type: TABLE DATA; Schema: public; Owner: webmestre
--

COPY public.bateau (id, nom, longueur, largeur, type_bateau, id_client) FROM stdin;
18	l'intépide	5	2	voilier	15
19	la tempete	6	3	Yacht	15
20	la sauvage	3	1	barque	16
21	blabla	3	4	beau	17
23	le bato	3	1	zodiac	16
29	az	1	2	zaz	18
32	batoo	3	4	joli	20
33	strj	2	3	zqh'	21
35	Barki	4	2	barque	13
36	Zodzod	4	2	zodiac	13
37	pac'Beau	50	20	paqubot	13
\.


--
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: webmestre
--

COPY public.client (id, nom, prenom, mail, numero, mot_de_passe, bool_gerant) FROM stdin;
13	Roger	Berger	user@user.com	12345	ee11cbb19052e40b07aac0ca060c23ee	f
14	Hugo	Blanchard	admin@admin.com	123456	21232f297a57a5a743894a0e4a801fc3	t
15	Crud	Jerome	client2@gmail.com	12345	0a5b3913cbc9a9092311630e869b4442	f
16	Cernet	Sophie	client1@gmail.com	123	0a5b3913cbc9a9092311630e869b4442	f
17	kjehrfjhgjhg	erg	aze@gmail.com	123456789	cc8c0a97c2dfcd73caff160b65aa39e2	f
18	azerty	qwerty	azerty@gmail.com	9876532	ab4f63f9ac65152575886860dde480a1	f
19	toto	toto	toto@toto.fr	668595645	f71dbe52628a3f83a77ab494817525c6	f
21	BLANCHARD	Hugo	zaturgo@gmail.com	629073154	c4747475f139c198ac4d3719ab619236	f
20	Herkens	Antoinette	aherkens@yahoo.fr	123456789	900150983cd24fb0d6963f7d28e17f72	f
22	Florent	Flo	a@a.c	123456789	b2ff8e48c14343ca3f51fce08f4d0d12	f
\.


--
-- Data for Name: emplacement; Type: TABLE DATA; Schema: public; Owner: webmestre
--

COPY public.emplacement (id, longueur, largeur, label, latitude, longitude) FROM stdin;
2	10	3	1	48.8524680000000018	-67.5306080000000009
1	10	4	2	48.852491999999998	-67.5304280000000006
10	10	5	4	48.8525739999999971	-67.5301240000000007
5	10	3	3	48.8525360000000006	-67.530270999999999
11	10	5	5	48.8526159999999976	-67.5299339999999972
12	10	9	6	48.8526999999999987	-67.5293999999999954
13	5	2	7	48.8526999999999987	-67.5293000000000063
14	5	2	8	48.8526999999999987	-67.529200000000003
17	2	4	10	48.8526999999999987	-67.5290999999999997
18	12	15	19	48.8526999999999987	-67.5288000000000039
19	2	4	18	48.8526999999999987	-67.5285999999999973
\.


--
-- Data for Name: reservation; Type: TABLE DATA; Schema: public; Owner: webmestre
--

COPY public.reservation (id, datedebut, datefin, id_client, id_emplacement, id_bateau, electricite, essence, vidange) FROM stdin;
187	2018-10-27	2018-10-28	20	10	32	1	0	0
188	2018-10-30	2018-11-02	21	1	33	0	0	1
189	2018-11-22	2018-11-29	21	1	33	0	1	0
197	2018-10-30	2018-10-31	13	2	35	0	0	0
198	2018-10-29	2018-10-30	13	2	36	0	0	0
196	2018-10-21	2018-10-22	13	2	35	1	1	1
199	2018-12-15	2018-12-16	13	2	35	1	0	0
153	2018-10-03	2018-10-10	14	2	\N	0	0	0
\.


--
-- Name: bateau_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmestre
--

SELECT pg_catalog.setval('public.bateau_id_seq', 37, true);


--
-- Name: client_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmestre
--

SELECT pg_catalog.setval('public.client_id_seq', 22, true);


--
-- Name: emplacement_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmestre
--

SELECT pg_catalog.setval('public.emplacement_id_seq', 19, true);


--
-- Name: reservation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmestre
--

SELECT pg_catalog.setval('public.reservation_id_seq', 199, true);


--
-- Name: bateau bateau_pkey; Type: CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.bateau
    ADD CONSTRAINT bateau_pkey PRIMARY KEY (id);


--
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id);


--
-- Name: emplacement emplacement_pkey; Type: CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.emplacement
    ADD CONSTRAINT emplacement_pkey PRIMARY KEY (id);


--
-- Name: reservation reservation_pkey; Type: CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_pkey PRIMARY KEY (id);


--
-- Name: fki_fk_id_bateau; Type: INDEX; Schema: public; Owner: webmestre
--

CREATE INDEX fki_fk_id_bateau ON public.reservation USING btree (id_bateau);


--
-- Name: fki_fk_id_client; Type: INDEX; Schema: public; Owner: webmestre
--

CREATE INDEX fki_fk_id_client ON public.bateau USING btree (id_client);


--
-- Name: fki_fk_id_client_reservation; Type: INDEX; Schema: public; Owner: webmestre
--

CREATE INDEX fki_fk_id_client_reservation ON public.reservation USING btree (id_client);


--
-- Name: fki_fk_id_emplacement; Type: INDEX; Schema: public; Owner: webmestre
--

CREATE INDEX fki_fk_id_emplacement ON public.reservation USING btree (id_emplacement);


--
-- Name: reservation fk_id_bateau; Type: FK CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT fk_id_bateau FOREIGN KEY (id_bateau) REFERENCES public.bateau(id) ON DELETE CASCADE;


--
-- Name: reservation fk_id_client; Type: FK CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT fk_id_client FOREIGN KEY (id_client) REFERENCES public.client(id);


--
-- Name: bateau fk_id_client_bateau; Type: FK CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.bateau
    ADD CONSTRAINT fk_id_client_bateau FOREIGN KEY (id_client) REFERENCES public.client(id) ON DELETE CASCADE;


--
-- Name: reservation fk_id_client_reservation; Type: FK CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT fk_id_client_reservation FOREIGN KEY (id_client) REFERENCES public.client(id);


--
-- Name: reservation fk_id_emplacement; Type: FK CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT fk_id_emplacement FOREIGN KEY (id_emplacement) REFERENCES public.emplacement(id);


--
-- PostgreSQL database dump complete
--

