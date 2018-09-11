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
-- Name: bateau; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bateau (
    idbateau integer NOT NULL,
    nom character varying(50) NOT NULL,
    longueur real NOT NULL,
    largeur real NOT NULL
);


ALTER TABLE public.bateau OWNER TO postgres;

--
-- Name: bateau_idbateau_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.bateau_idbateau_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bateau_idbateau_seq OWNER TO postgres;

--
-- Name: bateau_idbateau_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.bateau_idbateau_seq OWNED BY public.bateau.idbateau;


--
-- Name: client; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.client (
    idclient integer NOT NULL,
    nom character varying(50) NOT NULL,
    prenom character varying(50) NOT NULL,
    idbateau integer
);


ALTER TABLE public.client OWNER TO postgres;

--
-- Name: client_idclient_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.client_idclient_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.client_idclient_seq OWNER TO postgres;

--
-- Name: client_idclient_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.client_idclient_seq OWNED BY public.client.idclient;


--
-- Name: emplacement; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.emplacement (
    idemplacement integer NOT NULL,
    idclient integer,
    idreservation integer,
    longueur double precision,
    largeur double precision,
    estdisponible boolean
);


ALTER TABLE public.emplacement OWNER TO postgres;

--
-- Name: emplacement_idemplacement_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.emplacement_idemplacement_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.emplacement_idemplacement_seq OWNER TO postgres;

--
-- Name: emplacement_idemplacement_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.emplacement_idemplacement_seq OWNED BY public.emplacement.idemplacement;


--
-- Name: reservation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.reservation (
    idreservation integer NOT NULL,
    datedebut date NOT NULL,
    datefin date NOT NULL,
    idclient integer
);


ALTER TABLE public.reservation OWNER TO postgres;

--
-- Name: reservation_idreservation_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.reservation_idreservation_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reservation_idreservation_seq OWNER TO postgres;

--
-- Name: reservation_idreservation_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.reservation_idreservation_seq OWNED BY public.reservation.idreservation;


--
-- Name: service; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.service (
    idservice integer NOT NULL,
    contientelectricite boolean,
    contientvidange boolean,
    contientessence boolean,
    idreservation integer,
    idemplacement integer
);


ALTER TABLE public.service OWNER TO postgres;

--
-- Name: service_idservice_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.service_idservice_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_idservice_seq OWNER TO postgres;

--
-- Name: service_idservice_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.service_idservice_seq OWNED BY public.service.idservice;


--
-- Name: bateau idbateau; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bateau ALTER COLUMN idbateau SET DEFAULT nextval('public.bateau_idbateau_seq'::regclass);


--
-- Name: client idclient; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client ALTER COLUMN idclient SET DEFAULT nextval('public.client_idclient_seq'::regclass);


--
-- Name: emplacement idemplacement; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emplacement ALTER COLUMN idemplacement SET DEFAULT nextval('public.emplacement_idemplacement_seq'::regclass);


--
-- Name: reservation idreservation; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reservation ALTER COLUMN idreservation SET DEFAULT nextval('public.reservation_idreservation_seq'::regclass);


--
-- Name: service idservice; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service ALTER COLUMN idservice SET DEFAULT nextval('public.service_idservice_seq'::regclass);


--
-- Data for Name: bateau; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bateau (idbateau, nom, longueur, largeur) FROM stdin;
\.


--
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.client (idclient, nom, prenom, idbateau) FROM stdin;
\.


--
-- Data for Name: emplacement; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.emplacement (idemplacement, idclient, idreservation, longueur, largeur, estdisponible) FROM stdin;
\.


--
-- Data for Name: reservation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.reservation (idreservation, datedebut, datefin, idclient) FROM stdin;
\.


--
-- Data for Name: service; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.service (idservice, contientelectricite, contientvidange, contientessence, idreservation, idemplacement) FROM stdin;
\.


--
-- Name: bateau_idbateau_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.bateau_idbateau_seq', 1, false);


--
-- Name: client_idclient_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.client_idclient_seq', 1, false);


--
-- Name: emplacement_idemplacement_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.emplacement_idemplacement_seq', 1, false);


--
-- Name: reservation_idreservation_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.reservation_idreservation_seq', 1, false);


--
-- Name: service_idservice_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.service_idservice_seq', 1, false);


--
-- Name: bateau bateau_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bateau
    ADD CONSTRAINT bateau_pkey PRIMARY KEY (idbateau);


--
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (idclient);


--
-- Name: emplacement emplacement_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emplacement
    ADD CONSTRAINT emplacement_pkey PRIMARY KEY (idemplacement);


--
-- Name: reservation reservation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_pkey PRIMARY KEY (idreservation);


--
-- Name: service service_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service
    ADD CONSTRAINT service_pkey PRIMARY KEY (idservice);


--
-- Name: client client_idbateau_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_idbateau_fkey FOREIGN KEY (idbateau) REFERENCES public.bateau(idbateau);


--
-- Name: emplacement emplacement_idclient_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emplacement
    ADD CONSTRAINT emplacement_idclient_fkey FOREIGN KEY (idclient) REFERENCES public.client(idclient);


--
-- Name: emplacement emplacement_idreservation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emplacement
    ADD CONSTRAINT emplacement_idreservation_fkey FOREIGN KEY (idreservation) REFERENCES public.reservation(idreservation);


--
-- Name: reservation reservation_idclient_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reservation
    ADD CONSTRAINT reservation_idclient_fkey FOREIGN KEY (idclient) REFERENCES public.client(idclient);


--
-- Name: service service_idemplacement_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service
    ADD CONSTRAINT service_idemplacement_fkey FOREIGN KEY (idemplacement) REFERENCES public.emplacement(idemplacement);


--
-- Name: service service_idreservation_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service
    ADD CONSTRAINT service_idreservation_fkey FOREIGN KEY (idreservation) REFERENCES public.reservation(idreservation);


--
-- PostgreSQL database dump complete
--

