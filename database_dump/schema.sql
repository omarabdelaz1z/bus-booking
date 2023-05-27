--
-- PostgreSQL database dump
--

-- Dumped from database version 14.7 (Ubuntu 14.7-0ubuntu0.22.04.1)
-- Dumped by pg_dump version 14.7 (Ubuntu 14.7-0ubuntu0.22.04.1)

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: bookings; Type: TABLE; Schema: public; Owner: kool
--

CREATE TABLE public.bookings (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    trip_id bigint NOT NULL,
    seat_id bigint NOT NULL,
    source bigint NOT NULL,
    destination bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.bookings OWNER TO kool;

--
-- Name: bookings_id_seq; Type: SEQUENCE; Schema: public; Owner: kool
--

CREATE SEQUENCE public.bookings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bookings_id_seq OWNER TO kool;

--
-- Name: bookings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kool
--

ALTER SEQUENCE public.bookings_id_seq OWNED BY public.bookings.id;


--
-- Name: buses; Type: TABLE; Schema: public; Owner: kool
--

CREATE TABLE public.buses (
    id bigint NOT NULL,
    name character varying(20) NOT NULL,
    capacity integer DEFAULT 12 NOT NULL
);


ALTER TABLE public.buses OWNER TO kool;

--
-- Name: buses_id_seq; Type: SEQUENCE; Schema: public; Owner: kool
--

CREATE SEQUENCE public.buses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.buses_id_seq OWNER TO kool;

--
-- Name: buses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kool
--

ALTER SEQUENCE public.buses_id_seq OWNED BY public.buses.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: kool
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO kool;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: kool
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO kool;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kool
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: kool
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO kool;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: kool
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_access_tokens_id_seq OWNER TO kool;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kool
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: seats; Type: TABLE; Schema: public; Owner: kool
--

CREATE TABLE public.seats (
    id bigint NOT NULL,
    bus_id bigint NOT NULL,
    number character varying(10) NOT NULL
);


ALTER TABLE public.seats OWNER TO kool;

--
-- Name: seats_id_seq; Type: SEQUENCE; Schema: public; Owner: kool
--

CREATE SEQUENCE public.seats_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seats_id_seq OWNER TO kool;

--
-- Name: seats_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kool
--

ALTER SEQUENCE public.seats_id_seq OWNED BY public.seats.id;


--
-- Name: station_trip; Type: TABLE; Schema: public; Owner: kool
--

CREATE TABLE public.station_trip (
    id bigint NOT NULL,
    trip_id bigint NOT NULL,
    station_id bigint NOT NULL,
    sequence integer NOT NULL
);


ALTER TABLE public.station_trip OWNER TO kool;

--
-- Name: station_trip_id_seq; Type: SEQUENCE; Schema: public; Owner: kool
--

CREATE SEQUENCE public.station_trip_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.station_trip_id_seq OWNER TO kool;

--
-- Name: station_trip_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kool
--

ALTER SEQUENCE public.station_trip_id_seq OWNED BY public.station_trip.id;


--
-- Name: stations; Type: TABLE; Schema: public; Owner: kool
--

CREATE TABLE public.stations (
    id smallint NOT NULL,
    name character varying(20) NOT NULL
);


ALTER TABLE public.stations OWNER TO kool;

--
-- Name: stations_id_seq; Type: SEQUENCE; Schema: public; Owner: kool
--

CREATE SEQUENCE public.stations_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.stations_id_seq OWNER TO kool;

--
-- Name: stations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kool
--

ALTER SEQUENCE public.stations_id_seq OWNED BY public.stations.id;


--
-- Name: trips; Type: TABLE; Schema: public; Owner: kool
--

CREATE TABLE public.trips (
    id bigint NOT NULL,
    source bigint NOT NULL,
    destination bigint NOT NULL,
    bus_id bigint NOT NULL
);


ALTER TABLE public.trips OWNER TO kool;

--
-- Name: trips_id_seq; Type: SEQUENCE; Schema: public; Owner: kool
--

CREATE SEQUENCE public.trips_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.trips_id_seq OWNER TO kool;

--
-- Name: trips_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kool
--

ALTER SEQUENCE public.trips_id_seq OWNED BY public.trips.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: kool
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(30) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL
);


ALTER TABLE public.users OWNER TO kool;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: kool
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO kool;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kool
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: bookings id; Type: DEFAULT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.bookings ALTER COLUMN id SET DEFAULT nextval('public.bookings_id_seq'::regclass);


--
-- Name: buses id; Type: DEFAULT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.buses ALTER COLUMN id SET DEFAULT nextval('public.buses_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: seats id; Type: DEFAULT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.seats ALTER COLUMN id SET DEFAULT nextval('public.seats_id_seq'::regclass);


--
-- Name: station_trip id; Type: DEFAULT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.station_trip ALTER COLUMN id SET DEFAULT nextval('public.station_trip_id_seq'::regclass);


--
-- Name: stations id; Type: DEFAULT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.stations ALTER COLUMN id SET DEFAULT nextval('public.stations_id_seq'::regclass);


--
-- Name: trips id; Type: DEFAULT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.trips ALTER COLUMN id SET DEFAULT nextval('public.trips_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: bookings; Type: TABLE DATA; Schema: public; Owner: kool
--

COPY public.bookings (id, user_id, trip_id, seat_id, source, destination, created_at, updated_at) FROM stdin;
1	1	1	1	1	3	\N	\N
2	1	1	1	5	7	\N	\N
3	1	1	2	1	3	\N	\N
4	1	1	3	1	3	\N	\N
5	1	1	4	1	3	\N	\N
6	1	1	5	1	3	\N	\N
\.


--
-- Data for Name: buses; Type: TABLE DATA; Schema: public; Owner: kool
--

COPY public.buses (id, name, capacity) FROM stdin;
1	G1	12
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: kool
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2014_10_12_000000_create_users_table	1
2	2019_12_14_000001_create_personal_access_tokens_table	1
3	2023_05_25_000000_create_buses_table	1
4	2023_05_25_201524_create_stations_table	1
5	2023_05_25_205908_create_trips_table	1
6	2023_05_26_060413_create_station_trip_table	1
7	2023_05_26_062723_create_seats_table	1
8	2023_05_26_132747_create_bookings_table	1
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: kool
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
4	App\\Models\\User	2	auth_token	70b3887c3bb50f4f7aa96a33e999a0e36c010339f692f1cde0cc7cdc3f2aa6cb	["*"]	2023-05-27 13:47:09	\N	2023-05-27 13:10:31	2023-05-27 13:47:09
\.


--
-- Data for Name: seats; Type: TABLE DATA; Schema: public; Owner: kool
--

COPY public.seats (id, bus_id, number) FROM stdin;
1	1	S7
2	1	S9
3	1	S5
4	1	S4
5	1	S2
6	1	S11
7	1	S10
8	1	S6
9	1	S12
10	1	S1
11	1	S8
12	1	S3
\.


--
-- Data for Name: station_trip; Type: TABLE DATA; Schema: public; Owner: kool
--

COPY public.station_trip (id, trip_id, station_id, sequence) FROM stdin;
1	1	2	1
2	1	3	2
3	1	4	3
4	1	5	4
5	1	6	5
6	2	9	1
7	2	10	2
8	2	11	3
9	2	12	4
10	2	13	5
11	3	16	1
12	3	17	2
13	3	18	3
14	3	19	4
15	3	20	5
16	4	23	1
17	4	24	2
18	4	25	3
19	4	26	4
\.


--
-- Data for Name: stations; Type: TABLE DATA; Schema: public; Owner: kool
--

COPY public.stations (id, name) FROM stdin;
1	cairo
2	giza
3	alexandria
4	dakahlia
5	red-sea
6	beheira
7	fayoum
8	gharbiya
9	ismailia
10	menofia
11	minya
12	qaliubiya
13	new-valley
14	suez
15	aswan
16	assiut
17	beni-suef
18	port-said
19	damietta
20	sharkia
21	south-sinai
22	kafr-sheikh
23	matrouh
24	luxor
25	qena
26	north-sinai
27	sohag
\.


--
-- Data for Name: trips; Type: TABLE DATA; Schema: public; Owner: kool
--

COPY public.trips (id, source, destination, bus_id) FROM stdin;
1	1	7	1
2	8	14	1
3	15	21	1
4	22	27	1
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: kool
--

COPY public.users (id, name, email, password) FROM stdin;
1	Rebeka Gleichner	torey.kris@example.net	$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
2	kool	koo@example.com	$2y$10$vcMqbLutLZO66tFw52UyPeQtDCfeL.YlNsa4GuJowKQgH/uGGZJAW
\.


--
-- Name: bookings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kool
--

SELECT pg_catalog.setval('public.bookings_id_seq', 7, true);


--
-- Name: buses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kool
--

SELECT pg_catalog.setval('public.buses_id_seq', 1, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kool
--

SELECT pg_catalog.setval('public.migrations_id_seq', 8, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kool
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 4, true);


--
-- Name: seats_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kool
--

SELECT pg_catalog.setval('public.seats_id_seq', 12, true);


--
-- Name: station_trip_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kool
--

SELECT pg_catalog.setval('public.station_trip_id_seq', 19, true);


--
-- Name: stations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kool
--

SELECT pg_catalog.setval('public.stations_id_seq', 27, true);


--
-- Name: trips_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kool
--

SELECT pg_catalog.setval('public.trips_id_seq', 4, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kool
--

SELECT pg_catalog.setval('public.users_id_seq', 2, true);


--
-- Name: bookings bookings_pkey; Type: CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.bookings
    ADD CONSTRAINT bookings_pkey PRIMARY KEY (id);


--
-- Name: buses buses_pkey; Type: CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.buses
    ADD CONSTRAINT buses_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: seats seats_bus_id_number_unique; Type: CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.seats
    ADD CONSTRAINT seats_bus_id_number_unique UNIQUE (bus_id, number);


--
-- Name: seats seats_number_unique; Type: CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.seats
    ADD CONSTRAINT seats_number_unique UNIQUE (number);


--
-- Name: seats seats_pkey; Type: CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.seats
    ADD CONSTRAINT seats_pkey PRIMARY KEY (id);


--
-- Name: station_trip station_trip_pkey; Type: CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.station_trip
    ADD CONSTRAINT station_trip_pkey PRIMARY KEY (id);


--
-- Name: stations stations_pkey; Type: CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.stations
    ADD CONSTRAINT stations_pkey PRIMARY KEY (id);


--
-- Name: trips trips_pkey; Type: CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.trips
    ADD CONSTRAINT trips_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: kool
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: station_trip_trip_id_station_id_sequence_index; Type: INDEX; Schema: public; Owner: kool
--

CREATE INDEX station_trip_trip_id_station_id_sequence_index ON public.station_trip USING btree (trip_id, station_id, sequence);


--
-- Name: stations_name_index; Type: INDEX; Schema: public; Owner: kool
--

CREATE INDEX stations_name_index ON public.stations USING btree (name);


--
-- Name: bookings bookings_destination_foreign; Type: FK CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.bookings
    ADD CONSTRAINT bookings_destination_foreign FOREIGN KEY (destination) REFERENCES public.stations(id);


--
-- Name: bookings bookings_seat_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.bookings
    ADD CONSTRAINT bookings_seat_id_foreign FOREIGN KEY (seat_id) REFERENCES public.seats(id);


--
-- Name: bookings bookings_source_foreign; Type: FK CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.bookings
    ADD CONSTRAINT bookings_source_foreign FOREIGN KEY (source) REFERENCES public.stations(id);


--
-- Name: bookings bookings_trip_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.bookings
    ADD CONSTRAINT bookings_trip_id_foreign FOREIGN KEY (trip_id) REFERENCES public.trips(id);


--
-- Name: bookings bookings_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.bookings
    ADD CONSTRAINT bookings_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id);


--
-- Name: seats seats_bus_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.seats
    ADD CONSTRAINT seats_bus_id_foreign FOREIGN KEY (bus_id) REFERENCES public.buses(id);


--
-- Name: station_trip station_trip_station_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.station_trip
    ADD CONSTRAINT station_trip_station_id_foreign FOREIGN KEY (station_id) REFERENCES public.stations(id);


--
-- Name: station_trip station_trip_trip_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.station_trip
    ADD CONSTRAINT station_trip_trip_id_foreign FOREIGN KEY (trip_id) REFERENCES public.trips(id);


--
-- Name: trips trips_bus_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.trips
    ADD CONSTRAINT trips_bus_id_foreign FOREIGN KEY (bus_id) REFERENCES public.buses(id);


--
-- Name: trips trips_destination_foreign; Type: FK CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.trips
    ADD CONSTRAINT trips_destination_foreign FOREIGN KEY (destination) REFERENCES public.stations(id);


--
-- Name: trips trips_source_foreign; Type: FK CONSTRAINT; Schema: public; Owner: kool
--

ALTER TABLE ONLY public.trips
    ADD CONSTRAINT trips_source_foreign FOREIGN KEY (source) REFERENCES public.stations(id);


--
-- PostgreSQL database dump complete
--

