--
-- PostgreSQL database dump
--

-- Dumped from database version 10.5 (Ubuntu 10.5-0ubuntu0.18.04)
-- Dumped by pg_dump version 10.4

-- Started on 2018-10-05 02:43:39

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
-- TOC entry 1 (class 3079 OID 13007)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2941 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 197 (class 1259 OID 16498)
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
-- TOC entry 196 (class 1259 OID 16496)
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
-- TOC entry 2942 (class 0 OID 0)
-- Dependencies: 196
-- Name: bateau_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: webmestre
--

ALTER SEQUENCE public.bateau_id_seq OWNED BY public.bateau.id;


--
-- TOC entry 199 (class 1259 OID 16506)
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
-- TOC entry 198 (class 1259 OID 16504)
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
-- TOC entry 2943 (class 0 OID 0)
-- Dependencies: 198
-- Name: client_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: webmestre
--

ALTER SEQUENCE public.client_id_seq OWNED BY public.client.id;


--
-- TOC entry 201 (class 1259 OID 16530)
-- Name: emplacement; Type: TABLE; Schema: public; Owner: webmestre
--

CREATE TABLE public.emplacement (
    id integer NOT NULL,
    longueur double precision,
    largeur double precision,
    label text
);


ALTER TABLE public.emplacement OWNER TO webmestre;

--
-- TOC entry 200 (class 1259 OID 16528)
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
-- TOC entry 2944 (class 0 OID 0)
-- Dependencies: 200
-- Name: emplacement_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: webmestre
--

ALTER SEQUENCE public.emplacement_id_seq OWNED BY public.emplacement.id;


--
-- TOC entry 203 (class 1259 OID 16538)
-- Name: reservation; Type: TABLE; Schema: public; Owner: webmestre
--

CREATE TABLE public.reservation (
    id integer NOT NULL,
    datedebut date NOT NULL,
    datefin date NOT NULL,
    id_client integer,
    id_emplacement integer,
    id_service integer,
    id_bateau integer
);


ALTER TABLE public.reservation OWNER TO webmestre;

--
-- TOC entry 202 (class 1259 OID 16536)
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
-- TOC entry 2945 (class 0 OID 0)
-- Dependencies: 202
-- Name: reservation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: webmestre
--

ALTER SEQUENCE public.reservation_id_seq OWNED BY public.reservation.id;


--
-- TOC entry 205 (class 1259 OID 16563)
-- Name: service; Type: TABLE; Schema: public; Owner: webmestre
--

CREATE TABLE public.service (
    id integer NOT NULL,
    contientelectricite boolean,
    contientvidange boolean,
    contientessence boolean
);


ALTER TABLE public.service OWNER TO webmestre;

--
-- TOC entry 204 (class 1259 OID 16561)
-- Name: service_id_seq; Type: SEQUENCE; Schema: public; Owner: webmestre
--

CREATE SEQUENCE public.service_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_id_seq OWNER TO webmestre;

--
-- TOC entry 2946 (class 0 OID 0)
-- Dependencies: 204
-- Name: service_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: webmestre
--

ALTER SEQUENCE public.service_id_seq OWNED BY public.service.id;


--
-- TOC entry 2779 (class 2604 OID 16501)
-- Name: bateau id; Type: DEFAULT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.bateau ALTER COLUMN id SET DEFAULT nextval('public.bateau_id_seq'::regclass);


--
-- TOC entry 2780 (class 2604 OID 16509)
-- Name: client id; Type: DEFAULT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.client ALTER COLUMN id SET DEFAULT nextval('public.client_id_seq'::regclass);


--
-- TOC entry 2781 (class 2604 OID 16533)
-- Name: emplacement id; Type: DEFAULT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.emplacement ALTER COLUMN id SET DEFAULT nextval('public.emplacement_id_seq'::regclass);


--
-- TOC entry 2782 (class 2604 OID 16541)
-- Name: reservation id; Type: DEFAULT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.reservation ALTER COLUMN id SET DEFAULT nextval('public.reservation_id_seq'::regclass);


--
-- TOC entry 2783 (class 2604 OID 16566)
-- Name: service id; Type: DEFAULT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.service ALTER COLUMN id SET DEFAULT nextval('public.service_id_seq'::regclass);


--
-- TOC entry 2925 (class 0 OID 16498)
-- Dependencies: 197
-- Data for Name: bateau; Type: TABLE DATA; Schema: public; Owner: webmestre
--

COPY public.bateau (id, nom, longueur, largeur, type_bateau, id_client) FROM stdin;
1	BATEAU1	45	18	\N	\N
2	BATEAU2	45	18	\N	\N
3	aze	12	12	\N	\N
4	l\\'espadrie	12	123	\N	\N
7	le bato	10	3	voilier	\N
12	la barque sacré	3	1	barque	10
13	le paquebot	98	23	paquebot	10
15	l'intrepide	5	2	voilier	6
\.


--
-- TOC entry 2927 (class 0 OID 16506)
-- Dependencies: 199
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: webmestre
--

COPY public.client (id, nom, prenom, mail, numero, mot_de_passe, bool_gerant) FROM stdin;
2	miloud	michel	miloud@gmail.com	123456789	mdp	\N
3	salut	bonjour	salut@gmail.com	987654321	pdm	t
4	florent	flo	azzrt@azert.com	98765431	971179a4d5937b486d476ae5de648624	f
5	florent	flo	azzrt@azert.com	98765431	971179a4d5937b486d476ae5de648624	f
7	roger	ff	aze@az.com	1234	cdaa6716746fb685734abde87f1b08ad	f
8	miloud	missieur	miloud@jesaispas.com	987654321	83ea007bfdd589f29b820552b3f94260	f
9	admin	admin	admin@admin.com	123456	21232f297a57a5a743894a0e4a801fc3	t
10	FLIEDNER	Florent	florent.fli@gmail.com	695930616	63a9f0ea7bb98050796b649e85481845	f
6	azertyu	qwerty	user@user.com	12134455	ee11cbb19052e40b07aac0ca060c23ee	f
\.


--
-- TOC entry 2929 (class 0 OID 16530)
-- Dependencies: 201
-- Data for Name: emplacement; Type: TABLE DATA; Schema: public; Owner: webmestre
--

COPY public.emplacement (id, longueur, largeur, label) FROM stdin;
1	10	3	A1
2	10	3	A2
3	10	3	A3
4	10	3	B1
5	10	3	B2
\.


--
-- TOC entry 2931 (class 0 OID 16538)
-- Dependencies: 203
-- Data for Name: reservation; Type: TABLE DATA; Schema: public; Owner: webmestre
--

COPY public.reservation (id, datedebut, datefin, id_client, id_emplacement, id_service, id_bateau) FROM stdin;
68	2018-10-03	2018-10-04	6	1	144	14
\.


--
-- TOC entry 2933 (class 0 OID 16563)
-- Dependencies: 205
-- Data for Name: service; Type: TABLE DATA; Schema: public; Owner: webmestre
--

COPY public.service (id, contientelectricite, contientvidange, contientessence) FROM stdin;
144	t	t	t
145	f	f	t
146	t	f	f
147	t	f	f
148	t	f	f
\.


--
-- TOC entry 2947 (class 0 OID 0)
-- Dependencies: 196
-- Name: bateau_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmestre
--

SELECT pg_catalog.setval('public.bateau_id_seq', 15, true);


--
-- TOC entry 2948 (class 0 OID 0)
-- Dependencies: 198
-- Name: client_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmestre
--

SELECT pg_catalog.setval('public.client_id_seq', 10, true);


--
-- TOC entry 2949 (class 0 OID 0)
-- Dependencies: 200
-- Name: emplacement_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmestre
--

SELECT pg_catalog.setval('public.emplacement_id_seq', 5, true);


--
-- TOC entry 2950 (class 0 OID 0)
-- Dependencies: 202
-- Name: reservation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmestre
--

SELECT pg_catalog.setval('public.reservation_id_seq', 69, true);


--
-- TOC entry 2951 (class 0 OID 0)
-- Dependencies: 204
-- Name: service_id_seq; Type: SEQUENCE SET; Schema: public; Owner: webmestre
--

SELECT pg_catalog.setval('public.service_id_seq', 148, true);


--
-- TOC entry 2785 (class 2606 OID 16503)
-- Name: bateau bateau_pkey; Type: CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.bateau
    ADD CONSTRAINT bateau_pkey PRIMARY KEY (id);


--
-- TOC entry 2788 (class 2606 OID 16511)
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id);


--
-- TOC entry 2790 (class 2606 OID 16535)
-- Name: emplacement emplacement_pkey; Type: CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.emplacement
    ADD CONSTRAINT emplacement_pkey PRIMARY KEY (id);


--
-- TOC entry 2795 (class 2606 OID 16543)
-- Name: reservation reservation_pkey; Type: CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_pkey PRIMARY KEY (id);


--
-- TOC entry 2797 (class 2606 OID 16568)
-- Name: service service_pkey; Type: CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.service
    ADD CONSTRAINT service_pkey PRIMARY KEY (id);


--
-- TOC entry 2786 (class 1259 OID 16590)
-- Name: fki_fk_id_client; Type: INDEX; Schema: public; Owner: webmestre
--

CREATE INDEX fki_fk_id_client ON public.bateau USING btree (id_client);


--
-- TOC entry 2791 (class 1259 OID 16613)
-- Name: fki_fk_id_client_reservation; Type: INDEX; Schema: public; Owner: webmestre
--

CREATE INDEX fki_fk_id_client_reservation ON public.reservation USING btree (id_client);


--
-- TOC entry 2792 (class 1259 OID 16602)
-- Name: fki_fk_id_emplacement; Type: INDEX; Schema: public; Owner: webmestre
--

CREATE INDEX fki_fk_id_emplacement ON public.reservation USING btree (id_emplacement);


--
-- TOC entry 2793 (class 1259 OID 16619)
-- Name: fki_fk_id_service; Type: INDEX; Schema: public; Owner: webmestre
--

CREATE INDEX fki_fk_id_service ON public.reservation USING btree (id_service);


--
-- TOC entry 2798 (class 2606 OID 16585)
-- Name: bateau fk_id_client; Type: FK CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.bateau
    ADD CONSTRAINT fk_id_client FOREIGN KEY (id_client) REFERENCES public.client(id);


--
-- TOC entry 2800 (class 2606 OID 16603)
-- Name: reservation fk_id_client; Type: FK CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT fk_id_client FOREIGN KEY (id_client) REFERENCES public.client(id);


--
-- TOC entry 2801 (class 2606 OID 16608)
-- Name: reservation fk_id_client_reservation; Type: FK CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT fk_id_client_reservation FOREIGN KEY (id_client) REFERENCES public.client(id);


--
-- TOC entry 2799 (class 2606 OID 16597)
-- Name: reservation fk_id_emplacement; Type: FK CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT fk_id_emplacement FOREIGN KEY (id_emplacement) REFERENCES public.emplacement(id);


--
-- TOC entry 2802 (class 2606 OID 16614)
-- Name: reservation fk_id_service; Type: FK CONSTRAINT; Schema: public; Owner: webmestre
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT fk_id_service FOREIGN KEY (id_service) REFERENCES public.service(id);


-- Completed on 2018-10-05 02:43:42

--
-- PostgreSQL database dump complete
--

