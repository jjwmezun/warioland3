--
-- PostgreSQL database dump
--

-- Dumped from database version 12.5 (Ubuntu 12.5-0ubuntu0.20.04.1)
-- Dumped by pg_dump version 12.5 (Ubuntu 12.5-0ubuntu0.20.04.1)

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
-- Name: level; Type: TABLE; Schema: public; Owner: warioland3
--

CREATE TABLE public.level (
    level_id integer NOT NULL,
    level_name character varying NOT NULL,
    level_region_id integer NOT NULL,
    level_order integer NOT NULL
);


ALTER TABLE public.level OWNER TO warioland3;

--
-- Name: level_level_id_seq; Type: SEQUENCE; Schema: public; Owner: warioland3
--

ALTER TABLE public.level ALTER COLUMN level_id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.level_level_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: page; Type: TABLE; Schema: public; Owner: warioland3
--

CREATE TABLE public.page (
    page_id integer NOT NULL,
    page_title text,
    page_slug text,
    page_content text,
    page_created timestamp without time zone,
    page_updated timestamp without time zone
);


ALTER TABLE public.page OWNER TO warioland3;

--
-- Name: page_page_id_seq; Type: SEQUENCE; Schema: public; Owner: warioland3
--

ALTER TABLE public.page ALTER COLUMN page_id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.page_page_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: warioland3
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO warioland3;

--
-- Name: region; Type: TABLE; Schema: public; Owner: warioland3
--

CREATE TABLE public.region (
    region_id integer NOT NULL,
    region_name character varying NOT NULL,
    region_code character(1) NOT NULL,
    region_order integer NOT NULL
);


ALTER TABLE public.region OWNER TO warioland3;

--
-- Name: region_region_id_seq; Type: SEQUENCE; Schema: public; Owner: warioland3
--

ALTER TABLE public.region ALTER COLUMN region_id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.region_region_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Data for Name: level; Type: TABLE DATA; Schema: public; Owner: warioland3
--

COPY public.level (level_id, level_name, level_region_id, level_order) FROM stdin;
1	Out of the Woods	1	1
\.


--
-- Data for Name: page; Type: TABLE DATA; Schema: public; Owner: warioland3
--

COPY public.page (page_id, page_title, page_slug, page_content, page_created, page_updated) FROM stdin;
1	Home	home	<div class="wl3-primary-section wl3-primary-section-index wl3-index-about" id="about" style="padding-top: 106px; margin-top: -106px;"><h1>¿What is <i>Wario Land 3</i>?</h1><p><i>Wario Land 3</i> is a puzzle platformer semicollectathon for the Game Boy Color &amp; civilization’s greatest achievement.</p></div><div class="wl3-primary-section wl3-primary-section-index wl3-index-basic-info" id="basic-info" style="padding-top: 106px; margin-top: -106px;"><h2>Basic Info</h2><div class="wl3-shot wl3-index-shot"></div><h3>System</h3><p>Game Boy Color &amp; 3DS (Virtual Console).</p><h3>Developer &amp; Publisher:</h3><p>Nintendo.</p><h3>Release Dates (Game Boy Color)</h3><ul><li><strong>Japan:</strong> 2000/03/21;</li><li><strong>Europe &amp; Australia:</strong> 14 April 2000;</li><li><strong>US:</strong> May 30, 2000.</li></ul><h3>Release Dates (3DS Virtual Console)</h3><ul><li><strong>Japan:</strong> 2012/05/12;</li><li><strong>Europe &amp; Australia:</strong> 16 December 2012;</li><li><strong>US:</strong> August 29, 2013.</li></ul><h3>Alternate Titles</h3><ul><li><strong>Japan:</strong> Wario Land 3: The Mysterious Music Box (<em>Fushigi na Orgel</em>) [ワリオランド3 不思議なオルゴ～ル]</li></ul><h3>Age Ratings</h3><ul><li><strong>Japan:</strong> A (CERO)</li><li><strong>Europe:</strong> 3+ (PEGI)</li><li><strong>Australia:</strong> G (ACB)</li><li><strong>US:</strong> E (USRB)</li></ul></div><div class="wl3-primary-section wl3-primary-section-index wl3-index-story" id="story" style="padding-top: 106px; margin-top: -106px;"><h2>The Story</h2><div class="wl3-shot wl3-index-shot wl3-shot-cave"></div><p>A true tour de force worthy o’ Hemingway. Wario’s riding his personal plane that rich people always have o’er an unnamed forest when the usual inconvenience happens: his engine spontaneously combusts, causing him to crash in said forest. The game shows off Wario’s invincibility by having him bounce ’way from the vanishing debris harmlessly.</p><div class="wl3-shot wl3-index-shot wl3-shot-figure"></div><p>There he returns to his feet &amp; looks both ways, presumably in search for a mechanic to help him rebuild his plane. He soon elects to search the cave to his right—where mechanics usually dwell.</p><p>But ’stead he finds a music box there, just sitting on a pedastal—the most logical thing to happen in this story so far. Ne’er one to let treasure lie uncollected, he grabs it, only to be warped inside by some unnamed magic.</p><p>Inside we find Wario fast asleep, only to be awoken e’en mo’ quickly to find some giant face peering in @ him. Said face, called in-game “A hidden figure,” ’splains the rest in a glorious poem worthy o’ Longfellow:</p><blockquote class="verse"><p>Are you aware, Wario ?</p><p>This world is in the music box</p><p>you were peering into.</p><p>I was the god that protected this world.</p><p>But one day, a wicked being sealed away my</p><p>power, and took control of this world.</p><p>Wario,</p><p>I want you to find the 5 music boxes needed to</p><p>break the hidden seal and recover my powers.</p><p>If you find them, I’ll send you back to</p><p>your own world.</p><p>Of course, all the treasure you find is</p><p>yours to keep!</p><p>Will you help me ?</p></blockquote><p>Wario gives the hidden figure a thumbs up &amp; jogs on his way to the o’erworld map.</p></div><div class="wl3-primary-section wl3-primary-section-index wl3-index-goal" id="goal" style="padding-top: 106px; margin-top: -106px;"><h2>The Goal</h2><p>Like most Wario Land games, the goal is to collect treasure.</p><div class="wl3-primary-subsection wl3-primary-subsection-index wl3-index-goal-chestsnkeys"><h3>Chests &amp; Keys</h3><p>In this case, the treasure are certain items found in the <span class="wl3-gray">gray</span>, <span class="wl3-red">red</span>, <span class="wl3-green">green</span>, &amp; <span class="wl3-blue">blue</span> chest found in every level,</p><div class="wl3-index-chests"><div class="wl3-index-image wl3-image-chest wl3-image-gray-chest"></div><div class="wl3-index-image wl3-image-chest wl3-image-red-chest"></div><div class="wl3-index-image wl3-image-chest wl3-image-green-chest"></div><div class="wl3-index-image wl3-image-chest wl3-image-blue-chest"></div></div><p>unlocked by keys o’ matching color.</p><div class="wl3-index-keys"><div class="wl3-index-image wl3-image-key wl3-image-gray-key"></div><div class="wl3-index-image wl3-image-key wl3-image-red-key"></div><div class="wl3-index-image wl3-image-key wl3-image-green-key"></div><div class="wl3-index-image wl3-image-key wl3-image-blue-key"></div></div><p>Touch a key to collect it,</p><div class="wl3-index-image wl3-image-key-collect"></div><p>Then touch a matching chest to collect its treasure (&amp; be kicked out o’ the level).</p><div class="wl3-index-image wl3-image-chest-collect"></div><p>’Pon returning to the level, already-opened chests will be replaced with chest doors, which will exit the level without getting a treasure, but will allow you to get a reward for <a href="#music-coins">collecting all 8 music coins</a> or will allow you to complete a Time Attack challenge.</p><div class="wl3-index-image wl3-image-chest wl3-image-chest-door"></div><p>But unlike in other games, wherein the treasures are collected on the way to the goal, in this game the treasures are the goals.</p><p>As the story stated, the primary goal is to find the 5 music boxes ’mong all the treasures you collect &amp;, after that, return to “The Temple.”</p><div class="wl3-index-music-boxes"><div class="wl3-index-image wl3-image-music-box wl3-image-music-box-1"></div><div class="wl3-index-image wl3-image-music-box wl3-image-music-box-2"></div><div class="wl3-index-image wl3-image-music-box wl3-image-music-box-3"></div><div class="wl3-index-image wl3-image-music-box wl3-image-music-box-4"></div><div class="wl3-index-image wl3-image-music-box wl3-image-music-box-5"></div></div><p>However, one needs to collect all 100 treasures (4 treasures per 25 levels) to get 100%.</p></div><div class="wl3-primary-subsection wl3-primary-subsection-index wl3-index-goal-coins" id="coins"><h3>Coins</h3><p>Defeating enemies &amp; breaking blocks sometimes causes coins to fall out. You can collect up to 999 total.</p><div class="wl3-index-image wl3-image-regular-coin"></div><p>In addition to regular coins, which give 1 coin, there are rare <span class="wl3-gray">gray</span>, <span class="wl3-red">red</span>, <span class="wl3-green">green</span>, &amp; <span class="wl3-blue">blue</span> coins that give 10 coins.</p><div class="wl3-index-colored-coins"><div class="wl3-index-image wl3-image-colored-coin wl3-image-gray-coin"></div><div class="wl3-index-image wl3-image-colored-coin wl3-image-red-coin"></div><div class="wl3-index-image wl3-image-colored-coin wl3-image-green-coin"></div><div class="wl3-index-image wl3-image-colored-coin wl3-image-blue-coin"></div></div><p>The color one gets for these rare colors indicate the treasure to which one is nearest.</p><p>Coins are only used to play minigames.</p></div><div class="wl3-primary-subsection wl3-primary-subsection-index wl3-index-goal-music-coins" id="music-coins"><h3>Music Coins</h3><p>The game also has 8 music coins in each level.</p><div class="wl3-image-music-coin"></div><p>Collect all 8 in a single playthrough o’ that level, &amp; you will fill in a piece o’ a painting corresponding to that level.</p></div></div>	2020-12-20 14:39:02.224025	2020-12-20 14:39:02.224025
\.


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: warioland3
--

COPY public.password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: region; Type: TABLE DATA; Schema: public; Owner: warioland3
--

COPY public.region (region_id, region_name, region_code, region_order) FROM stdin;
1	North	N	1
2	West	W	2
3	South	S	3
4	East	E	4
\.


--
-- Name: level_level_id_seq; Type: SEQUENCE SET; Schema: public; Owner: warioland3
--

SELECT pg_catalog.setval('public.level_level_id_seq', 1, true);


--
-- Name: page_page_id_seq; Type: SEQUENCE SET; Schema: public; Owner: warioland3
--

SELECT pg_catalog.setval('public.page_page_id_seq', 1, true);


--
-- Name: region_region_id_seq; Type: SEQUENCE SET; Schema: public; Owner: warioland3
--

SELECT pg_catalog.setval('public.region_region_id_seq', 4, true);


--
-- Name: level level_level_id_key; Type: CONSTRAINT; Schema: public; Owner: warioland3
--

ALTER TABLE ONLY public.level
    ADD CONSTRAINT level_level_id_key UNIQUE (level_id);


--
-- Name: level level_level_order_key; Type: CONSTRAINT; Schema: public; Owner: warioland3
--

ALTER TABLE ONLY public.level
    ADD CONSTRAINT level_level_order_key UNIQUE (level_order);


--
-- Name: page page_page_id_key; Type: CONSTRAINT; Schema: public; Owner: warioland3
--

ALTER TABLE ONLY public.page
    ADD CONSTRAINT page_page_id_key UNIQUE (page_id);


--
-- Name: region region_region_code_key; Type: CONSTRAINT; Schema: public; Owner: warioland3
--

ALTER TABLE ONLY public.region
    ADD CONSTRAINT region_region_code_key UNIQUE (region_code);


--
-- Name: region region_region_id_key; Type: CONSTRAINT; Schema: public; Owner: warioland3
--

ALTER TABLE ONLY public.region
    ADD CONSTRAINT region_region_id_key UNIQUE (region_id);


--
-- Name: region region_region_order_key; Type: CONSTRAINT; Schema: public; Owner: warioland3
--

ALTER TABLE ONLY public.region
    ADD CONSTRAINT region_region_order_key UNIQUE (region_order);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: warioland3
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: level level_level_region_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: warioland3
--

ALTER TABLE ONLY public.level
    ADD CONSTRAINT level_level_region_id_fkey FOREIGN KEY (level_region_id) REFERENCES public.region(region_id);


--
-- PostgreSQL database dump complete
--

