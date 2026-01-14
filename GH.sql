-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 14, 2026 at 12:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `GH`
--

-- --------------------------------------------------------

--
-- Table structure for table `arma`
--

CREATE TABLE `arma` (
  `id` int(11) NOT NULL,
  `arma_plantilla_id` int(11) DEFAULT NULL,
  `nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `arma_plantilla`
--

CREATE TABLE `arma_plantilla` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `juego` varchar(30) NOT NULL,
  `stats_base` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`stats_base`)),
  `stats_por_nivel` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`stats_por_nivel`)),
  `pasiva` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `arma_plantilla`
--

INSERT INTO `arma_plantilla` (`id`, `nombre`, `imagen`, `juego`, `stats_base`, `stats_por_nivel`, `pasiva`, `tipo`) VALUES
(0, 'Lápida del Lobo', NULL, 'genshin', '{\"ATK\":608,\"ATK%\":0.49}', '{\"ATK\":16,\"ATK%\":0.012}', 'Aumenta el ATQ del portador. Al golpear a enemigos con poca vida, incrementa aún más el daño durante un tiempo.', 'espadón'),
(1, 'Estrella Invernal', NULL, 'genshin', '{\"ATK\":608,\"CRIT_DMG\":0.33}', '{\"ATK\":15,\"CRIT_DMG\":0.009}', 'Los ataques normales y cargados aumentan el daño del portador de forma acumulativa.', 'arco'),
(2, 'Luz del Segador', NULL, 'genshin', '{\"ATK\":674,\"ER\":0.36}', '{\"ATK\":18,\"ER\":0.01}', 'Convierte la Recarga de Energía excedente en ATQ y aumenta el daño de la habilidad definitiva.', 'lanza'),
(3, 'Fulgor de las Aguas Calmas', NULL, 'genshin', '{\"ATK\":542,\"CRIT_DMG\":0.88}', '{\"ATK\":14,\"CRIT_DMG\":0.02}', 'Aumenta la vida máxima y el daño elemental del portador cuando se consume vida.', 'espada'),
(4, 'Velo de la Nocturnidad', NULL, 'genshin', '{\"ATK\":674,\"CRIT_RATE\":0.22}', '{\"ATK\":18,\"CRIT_RATE\":0.006}', 'Otorga bonificaciones de daño según el estado del portador dentro o fuera del campo.', 'catalizador'),
(5, 'Buenas noches que duermas bien', NULL, 'hsr', '{\"ATK\":476,\"ATK%\":0.24}', '{\"ATK\":12,\"ATK%\":0.008}', 'Aumenta el daño infligido a enemigos afectados por estados negativos.', 'cono'),
(6, 'A donde regresan los sueños', NULL, 'hsr', '{\"HP\":1058,\"ATK%\":0.18}', '{\"HP\":38,\"ATK%\":0.006}', 'Incrementa la vida máxima y potencia el daño de los aliados tras usar la habilidad definitiva.', 'cono'),
(7, 'De vuelta a la tierra', NULL, 'hsr', '{\"DEF\":529,\"ER\":0.20}', '{\"DEF\":20,\"ER\":0.007}', 'Reduce el daño recibido y restaura energía al inicio del turno.', 'cono'),
(8, 'Yo seré mi propia espada', NULL, 'hsr', '{\"ATK\":635,\"CRIT_DMG\":0.36}', '{\"ATK\":22,\"CRIT_DMG\":0.01}', 'Aumenta el daño crítico y mejora los ataques tras consumir vida.', 'cono'),
(9, 'Que arda el alba', NULL, 'hsr', '{\"ATK\":582,\"CRIT_RATE\":0.24}', '{\"ATK\":20,\"CRIT_RATE\":0.007}', 'Incrementa la probabilidad crítica y el daño infligido al comienzo del combate.', 'cono');

-- --------------------------------------------------------

--
-- Table structure for table `artefacto`
--

CREATE TABLE `artefacto` (
  `id` int(11) NOT NULL,
  `artefacto_plantilla_id` int(11) DEFAULT NULL,
  `estadisticas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`estadisticas`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artefacto_plantilla`
--

CREATE TABLE `artefacto_plantilla` (
  `id` int(11) NOT NULL,
  `pieza_tipo_id` int(11) DEFAULT NULL,
  `set_artefactos_id` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `juego` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artefacto_plantilla`
--

INSERT INTO `artefacto_plantilla` (`id`, `pieza_tipo_id`, `set_artefactos_id`, `imagen`, `juego`) VALUES
(0, 0, 0, NULL, 'genshin'),
(1, 1, 0, NULL, 'genshin'),
(2, 2, 0, NULL, 'genshin'),
(3, 3, 0, NULL, 'genshin'),
(4, 4, 0, NULL, 'genshin');

-- --------------------------------------------------------

--
-- Table structure for table `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `cuerpo` varchar(4096) NOT NULL,
  `fecha_publicacion` datetime NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20251219170048', '2025-12-19 18:00:58', 205),
('DoctrineMigrations\\Version20251219173418', '2025-12-19 18:34:35', 1013),
('DoctrineMigrations\\Version20251219175006', '2025-12-19 18:50:10', 2052),
('DoctrineMigrations\\Version20251219191417', '2025-12-19 20:14:22', 2603),
('DoctrineMigrations\\Version20251219192638', '2025-12-19 20:26:48', 226),
('DoctrineMigrations\\Version20251222131038', '2025-12-22 14:10:46', 934),
('DoctrineMigrations\\Version20251222142622', '2025-12-22 15:26:33', 1885),
('DoctrineMigrations\\Version20251222161610', '2025-12-22 17:16:18', 89),
('DoctrineMigrations\\Version20251227152112', '2025-12-27 16:21:20', 104),
('DoctrineMigrations\\Version20260109092407', '2026-01-09 10:24:16', 293),
('DoctrineMigrations\\Version20260109104813', '2026-01-09 11:48:23', 70),
('DoctrineMigrations\\Version20260109111950', '2026-01-09 12:19:56', 19),
('DoctrineMigrations\\Version20260111170514', '2026-01-11 18:05:31', 141),
('DoctrineMigrations\\Version20260111172126', '2026-01-11 18:21:32', 80),
('DoctrineMigrations\\Version20260112083015', '2026-01-12 09:30:21', 103),
('DoctrineMigrations\\Version20260114110952', '2026-01-14 12:09:58', 1460),
('DoctrineMigrations\\Version20260114111359', '2026-01-14 12:14:02', 653),
('DoctrineMigrations\\Version20260114111608', '2026-01-14 12:16:13', 41);

-- --------------------------------------------------------

--
-- Table structure for table `dupe`
--

CREATE TABLE `dupe` (
  `id` int(11) NOT NULL,
  `personaje_plantilla_id` int(11) DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `efectos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipo`
--

CREATE TABLE `equipo` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipo_personaje`
--

CREATE TABLE `equipo_personaje` (
  `personaje_id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `posicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `habilidad`
--

CREATE TABLE `habilidad` (
  `id` int(11) NOT NULL,
  `personaje_plantilla_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `efectos` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `juego_pieza_tipo`
--

CREATE TABLE `juego_pieza_tipo` (
  `juego` varchar(255) NOT NULL,
  `pieza_tipo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `juego_pieza_tipo`
--

INSERT INTO `juego_pieza_tipo` (`juego`, `pieza_tipo_id`) VALUES
('genshin', 0),
('genshin', 1),
('genshin', 2),
('genshin', 3),
('genshin', 4);

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE `like` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personaje`
--

CREATE TABLE `personaje` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `arma_id` int(11) DEFAULT NULL,
  `personaje_plantilla_id` int(11) DEFAULT NULL,
  `nivel` int(11) NOT NULL,
  `dupe_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personaje_artefacto`
--

CREATE TABLE `personaje_artefacto` (
  `personaje_id` int(11) NOT NULL,
  `artefacto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personaje_habilidad`
--

CREATE TABLE `personaje_habilidad` (
  `personaje_id` int(11) NOT NULL,
  `habilidad_id` int(11) NOT NULL,
  `nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personaje_plantilla`
--

CREATE TABLE `personaje_plantilla` (
  `id` int(11) NOT NULL,
  `juego` varchar(30) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `stats_base` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`stats_base`)),
  `stats_por_nivel` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`stats_por_nivel`)),
  `imagen` varchar(255) DEFAULT NULL,
  `elemento` varchar(255) DEFAULT NULL,
  `senda` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personaje_plantilla`
--

INSERT INTO `personaje_plantilla` (`id`, `juego`, `nombre`, `stats_base`, `stats_por_nivel`, `imagen`, `elemento`, `senda`) VALUES
(1, 'genshin', 'Diluc', '{\n \"HP\":12981,\"ATK\":335,\"DEF\":784,\"EM\":0,\"ER\":1.00,\n \"CRIT_RATE\":0.05,\"CRIT_DMG\":0.50,\n \"PYRO_DMG_BONUS\":0.466,\"HYDRO_DMG_BONUS\":0,\"ELECTRO_DMG_BONUS\":0,\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\n \"HEAL_BONUS\":0\n}', '{\r\n \"HP\":210,\"ATK\":8,\"DEF\":14,\"EM\":0,\"ER\":0.01,\r\n \"CRIT_RATE\":0.002,\"CRIT_DMG\":0.01,\r\n \"PYRO_DMG_BONUS\":0.01,\"HYDRO_DMG_BONUS\":0,\"ELECTRO_DMG_BONUS\":0,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'pyro', NULL),
(2, 'genshin', 'Tartaglia', '{\r\n \"HP\":13103,\"ATK\":301,\"DEF\":815,\"EM\":0,\"ER\":1.00,\r\n \"CRIT_RATE\":0.05,\"CRIT_DMG\":0.50,\r\n \"PYRO_DMG_BONUS\":0,\"HYDRO_DMG_BONUS\":0.466,\"ELECTRO_DMG_BONUS\":0,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', '{\r\n \"HP\":215,\"ATK\":7,\"DEF\":15,\"EM\":0,\"ER\":0.01,\r\n \"CRIT_RATE\":0.002,\"CRIT_DMG\":0.01,\r\n \"PYRO_DMG_BONUS\":0,\"HYDRO_DMG_BONUS\":0.01,\"ELECTRO_DMG_BONUS\":0,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'hydro', NULL),
(3, 'genshin', 'Raiden Shogun', '{\r\n \"HP\":12907,\"ATK\":337,\"DEF\":789,\"EM\":0,\"ER\":1.32,\r\n \"CRIT_RATE\":0.05,\"CRIT_DMG\":0.50,\r\n \"PYRO_DMG_BONUS\":0,\"HYDRO_DMG_BONUS\":0,\"ELECTRO_DMG_BONUS\":0.466,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', '{\r\n \"HP\":205,\"ATK\":8,\"DEF\":14,\"EM\":0,\"ER\":0.015,\r\n \"CRIT_RATE\":0.002,\"CRIT_DMG\":0.01,\r\n \"PYRO_DMG_BONUS\":0,\"HYDRO_DMG_BONUS\":0,\"ELECTRO_DMG_BONUS\":0.01,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'electro', NULL),
(4, 'genshin', 'Furina', '{\r\n \"HP\":15307,\"ATK\":243,\"DEF\":712,\"EM\":0,\"ER\":1.00,\r\n \"CRIT_RATE\":0.05,\"CRIT_DMG\":0.50,\r\n \"PYRO_DMG_BONUS\":0,\"HYDRO_DMG_BONUS\":0.466,\"ELECTRO_DMG_BONUS\":0,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', '{\r\n \"HP\":260,\"ATK\":6,\"DEF\":13,\"EM\":0,\"ER\":0.01,\r\n \"CRIT_RATE\":0.002,\"CRIT_DMG\":0.01,\r\n \"PYRO_DMG_BONUS\":0,\"HYDRO_DMG_BONUS\":0.01,\"ELECTRO_DMG_BONUS\":0,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'hydro', NULL),
(5, 'genshin', 'Columbina', '{\r\n \"HP\":14000,\"ATK\":320,\"DEF\":760,\"EM\":80,\"ER\":1.10,\r\n \"CRIT_RATE\":0.10,\"CRIT_DMG\":0.60,\r\n \"PYRO_DMG_BONUS\":0,\"HYDRO_DMG_BONUS\":0.466,\"ELECTRO_DMG_BONUS\":0,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', '{\r\n \"HP\":230,\"ATK\":9,\"DEF\":15,\"EM\":5,\"ER\":0.012,\r\n \"CRIT_RATE\":0.003,\"CRIT_DMG\":0.012,\r\n \"PYRO_DMG_BONUS\":0,\"HYDRO_DMG_BONUS\":0.01,\"ELECTRO_DMG_BONUS\":0,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'hydro', NULL),
(6, 'hsr', 'Pela', '{\r\n \"HP\":1047,\"ATK\":476,\"DEF\":463,\"BREAK_EFFECT\":0.25,\"SPD\":105,\r\n \"EFFECT_HIT_RATE\":0.20,\"EFFECT_RES\":0.10,\"ER\":1.00,\r\n \"CRIT_RATE\":0.05,\"CRIT_DMG\":0.50,\r\n \"PHYSICAL_DMG_BONUS\":0,\"FIRE_DMG_BONUS\":0,\"ICE_DMG_BONUS\":0.20,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', '{\r\n \"HP\":42,\"ATK\":19,\"DEF\":18,\"BREAK_EFFECT\":0.01,\"SPD\":2,\r\n \"EFFECT_HIT_RATE\":0.008,\"EFFECT_RES\":0.006,\"ER\":0.01,\r\n \"CRIT_RATE\":0.003,\"CRIT_DMG\":0.012,\r\n \"PHYSICAL_DMG_BONUS\":0,\"FIRE_DMG_BONUS\":0,\"ICE_DMG_BONUS\":0.005,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'hielo', 'nihilidad'),
(7, 'hsr', 'Firefly', '{\r\n \"HP\":1378,\"ATK\":523,\"DEF\":485,\"BREAK_EFFECT\":0.30,\"SPD\":103,\r\n \"EFFECT_HIT_RATE\":0.15,\"EFFECT_RES\":0.10,\"ER\":1.00,\r\n \"CRIT_RATE\":0.05,\"CRIT_DMG\":0.50,\r\n \"PHYSICAL_DMG_BONUS\":0,\"FIRE_DMG_BONUS\":0.20,\"ICE_DMG_BONUS\":0,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', '{\r\n \"HP\":55,\"ATK\":21,\"DEF\":19,\"BREAK_EFFECT\":0.012,\"SPD\":2,\r\n \"EFFECT_HIT_RATE\":0.007,\"EFFECT_RES\":0.006,\"ER\":0.01,\r\n \"CRIT_RATE\":0.003,\"CRIT_DMG\":0.012,\r\n \"PHYSICAL_DMG_BONUS\":0,\"FIRE_DMG_BONUS\":0.005,\"ICE_DMG_BONUS\":0,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'fuego', 'destruccion'),
(8, 'hsr', 'Sunday', '{\r\n \"HP\":1120,\"ATK\":412,\"DEF\":502,\"BREAK_EFFECT\":0.20,\"SPD\":106,\r\n \"EFFECT_HIT_RATE\":0.25,\"EFFECT_RES\":0.12,\"ER\":1.05,\r\n \"CRIT_RATE\":0.05,\"CRIT_DMG\":0.50,\r\n \"PHYSICAL_DMG_BONUS\":0,\"FIRE_DMG_BONUS\":0,\"ICE_DMG_BONUS\":0,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0.20,\r\n \"HEAL_BONUS\":0\r\n}', '{\r\n \"HP\":45,\"ATK\":16,\"DEF\":20,\"BREAK_EFFECT\":0.01,\"SPD\":2,\r\n \"EFFECT_HIT_RATE\":0.01,\"EFFECT_RES\":0.007,\"ER\":0.012,\r\n \"CRIT_RATE\":0.002,\"CRIT_DMG\":0.01,\r\n \"PHYSICAL_DMG_BONUS\":0,\"FIRE_DMG_BONUS\":0,\"ICE_DMG_BONUS\":0,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0.005,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'imaginario', 'armonia'),
(9, 'hsr', 'Jingliu', '{\r\n \"HP\":1436,\"ATK\":592,\"DEF\":436,\"BREAK_EFFECT\":0.22,\"SPD\":100,\r\n \"EFFECT_HIT_RATE\":0.10,\"EFFECT_RES\":0.08,\"ER\":1.00,\r\n \"CRIT_RATE\":0.05,\"CRIT_DMG\":0.60,\r\n \"PHYSICAL_DMG_BONUS\":0,\"FIRE_DMG_BONUS\":0,\"ICE_DMG_BONUS\":0.20,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', '{\r\n \"HP\":58,\"ATK\":24,\"DEF\":17,\"BREAK_EFFECT\":0.011,\"SPD\":2,\r\n \"EFFECT_HIT_RATE\":0.006,\"EFFECT_RES\":0.005,\"ER\":0.01,\r\n \"CRIT_RATE\":0.003,\"CRIT_DMG\":0.015,\r\n \"PHYSICAL_DMG_BONUS\":0,\"FIRE_DMG_BONUS\":0,\"ICE_DMG_BONUS\":0.005,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'hielo', 'destruccion'),
(10, 'hsr', 'Phainon', '{\r\n \"HP\":1500,\"ATK\":560,\"DEF\":470,\"BREAK_EFFECT\":0.28,\"SPD\":102,\r\n \"EFFECT_HIT_RATE\":0.12,\"EFFECT_RES\":0.10,\"ER\":1.00,\r\n \"CRIT_RATE\":0.08,\"CRIT_DMG\":0.55,\r\n \"PHYSICAL_DMG_BONUS\":0.20,\"FIRE_DMG_BONUS\":0,\"ICE_DMG_BONUS\":0,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', '{\r\n \"HP\":60,\"ATK\":22,\"DEF\":18,\"BREAK_EFFECT\":0.013,\"SPD\":2,\r\n \"EFFECT_HIT_RATE\":0.007,\"EFFECT_RES\":0.006,\"ER\":0.01,\r\n \"CRIT_RATE\":0.003,\"CRIT_DMG\":0.014,\r\n \"PHYSICAL_DMG_BONUS\":0.005,\"FIRE_DMG_BONUS\":0,\"ICE_DMG_BONUS\":0,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'fisico', 'destruccion');

-- --------------------------------------------------------

--
-- Table structure for table `pieza_tipo`
--

CREATE TABLE `pieza_tipo` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pieza_tipo`
--

INSERT INTO `pieza_tipo` (`id`, `codigo`, `nombre`) VALUES
(0, 'pluma', 'Pluma de la Muerte'),
(1, 'sombrero', 'Tiara de Logos'),
(2, 'flor', 'Flor de la Vida'),
(3, 'reloj', 'Arenas del Eon'),
(4, 'caliz', 'Cáliz de Eonothem');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `cuerpo` varchar(4096) NOT NULL,
  `fecha_publicacion` datetime NOT NULL,
  `visitas` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `juego` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `set_artefactos`
--

CREATE TABLE `set_artefactos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `efectos` varchar(1024) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `juego` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `set_artefactos`
--

INSERT INTO `set_artefactos` (`id`, `nombre`, `efectos`, `imagen`, `juego`) VALUES
(0, 'Emblema del Destino', 'Cosas raras de recarga de energía', '', 'genshin');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `is_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `email`, `roles`, `password`, `foto_perfil`, `fecha_registro`, `is_verified`) VALUES
(1, 'jose', 'j@j.com', '[]', '$2y$13$v6NAEXfuSnEAp5zhuCcNluUS7j5z3vUFImTDIeuehfeyl3v.8VIgu', NULL, '2025-12-22', 0),
(2, 'Jose', 'j2@j.com', '[]', '$2y$13$14tjaGh5ovZpWZLCe8OHxOCPtJZea3/b438v.8G4/ADKfZKIycMHa', NULL, '2025-12-22', 0),
(3, 'Jose', 'j23@j.com', '[]', '$2y$13$VU6VWWvkTKzGrf31/LLuSO0hfl0mEKzJ.aLLQ/1e97vfJxOjVXQEO', NULL, '2025-12-22', 0),
(4, 'Jose', 'j233@j.com', '[]', '$2y$13$1y/TRwqx4X7/Q/lsohYrb.3JS4AVtRLfCeMx2iTKr6CyDbhyTtM.y', NULL, '2025-12-22', 0),
(5, 'Jose', 'j2333@j.com', '[]', '$2y$13$/Bcy3SNPw94YCCukaAWujOMXJhUR9O7lmc.38DKalapprTZ6Llh1C', NULL, '2025-12-22', 0),
(6, 'Jose', 'j23333@j.com', '[]', '$2y$13$9lPRZYhTpJ4DdoREywa.o.23UxjbRpf0i.p/2JWPf208Iulm/DhBG', NULL, '2025-12-22', 0),
(7, 'dwafdwa', '32@drw.es', '[]', '$2y$13$m0W2PGaCmIJ8fpgU1BLLpOefQSxQRHBkquRk3LL8dFIBcA.KpW/Vq', NULL, '2025-12-22', 0),
(11, 'dwadwae', 'no.reply.gamehubsite@gmail.com', '[]', '$2y$13$xHa2ZdM4WaLRRwyyrX3F7.ASDlI56pvMHS5VBOUVoSzsIQPK/36pe', NULL, '2025-12-28', 1),
(15, 'fwafwaf', 'aluort8576@ieselcaminas.org', '[]', '$2y$13$joQkxN9xZhFwnYSWsbBw8eTC3liPdN/H1L0KZsUGBjSy5.wmJMA9O', NULL, '2026-01-08', 0),
(16, 'Jose', 'aludua2859@ieselcaminas.org', '[]', '$2y$13$ttbvYh2HR2kJeDM5mrhAcuWVTTTyc9NiesA0gdBGjqyiPKbC42mhy', NULL, '2026-01-11', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arma`
--
ALTER TABLE `arma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1F4DB7603F28BF78` (`arma_plantilla_id`);

--
-- Indexes for table `arma_plantilla`
--
ALTER TABLE `arma_plantilla`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artefacto`
--
ALTER TABLE `artefacto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4A5DDABC4B44F0C4` (`artefacto_plantilla_id`);

--
-- Indexes for table `artefacto_plantilla`
--
ALTER TABLE `artefacto_plantilla`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BA3F7E33C6862B` (`pieza_tipo_id`),
  ADD KEY `IDX_BA3F7EC07AB4E2` (`set_artefactos_id`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4B91E7024B89032C` (`post_id`),
  ADD KEY `IDX_4B91E702A76ED395` (`user_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `dupe`
--
ALTER TABLE `dupe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D5DDF9D21F22B4C7` (`personaje_plantilla_id`);

--
-- Indexes for table `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C49C530BA76ED395` (`user_id`);

--
-- Indexes for table `equipo_personaje`
--
ALTER TABLE `equipo_personaje`
  ADD PRIMARY KEY (`personaje_id`,`equipo_id`),
  ADD KEY `IDX_ED7A2DF7121EFAFB` (`personaje_id`),
  ADD KEY `IDX_ED7A2DF723BFBED` (`equipo_id`);

--
-- Indexes for table `habilidad`
--
ALTER TABLE `habilidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4D2A2AF71F22B4C7` (`personaje_plantilla_id`);

--
-- Indexes for table `juego_pieza_tipo`
--
ALTER TABLE `juego_pieza_tipo`
  ADD PRIMARY KEY (`juego`,`pieza_tipo_id`),
  ADD KEY `IDX_20F42A6333C6862B` (`pieza_tipo_id`);

--
-- Indexes for table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`user_id`,`post_id`),
  ADD KEY `IDX_AC6340B3A76ED395` (`user_id`),
  ADD KEY `IDX_AC6340B34B89032C` (`post_id`);

--
-- Indexes for table `personaje`
--
ALTER TABLE `personaje`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_53A410888D7F0B5D` (`arma_id`),
  ADD KEY `IDX_53A41088A76ED395` (`user_id`),
  ADD KEY `IDX_53A410881F22B4C7` (`personaje_plantilla_id`);

--
-- Indexes for table `personaje_artefacto`
--
ALTER TABLE `personaje_artefacto`
  ADD PRIMARY KEY (`personaje_id`,`artefacto_id`),
  ADD KEY `IDX_62E96A79121EFAFB` (`personaje_id`),
  ADD KEY `IDX_62E96A79C408C2D2` (`artefacto_id`);

--
-- Indexes for table `personaje_habilidad`
--
ALTER TABLE `personaje_habilidad`
  ADD PRIMARY KEY (`personaje_id`,`habilidad_id`),
  ADD KEY `IDX_659E9A32121EFAFB` (`personaje_id`),
  ADD KEY `IDX_659E9A32621AA5D6` (`habilidad_id`);

--
-- Indexes for table `personaje_plantilla`
--
ALTER TABLE `personaje_plantilla`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pieza_tipo`
--
ALTER TABLE `pieza_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5A8A6C8DA76ED395` (`user_id`);

--
-- Indexes for table `set_artefactos`
--
ALTER TABLE `set_artefactos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arma`
--
ALTER TABLE `arma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `artefacto`
--
ALTER TABLE `artefacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personaje`
--
ALTER TABLE `personaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arma`
--
ALTER TABLE `arma`
  ADD CONSTRAINT `FK_1F4DB7603F28BF78` FOREIGN KEY (`arma_plantilla_id`) REFERENCES `arma_plantilla` (`id`);

--
-- Constraints for table `artefacto`
--
ALTER TABLE `artefacto`
  ADD CONSTRAINT `FK_4A5DDABC4B44F0C4` FOREIGN KEY (`artefacto_plantilla_id`) REFERENCES `artefacto_plantilla` (`id`);

--
-- Constraints for table `artefacto_plantilla`
--
ALTER TABLE `artefacto_plantilla`
  ADD CONSTRAINT `FK_BA3F7E33C6862B` FOREIGN KEY (`pieza_tipo_id`) REFERENCES `pieza_tipo` (`id`),
  ADD CONSTRAINT `FK_BA3F7EC07AB4E2` FOREIGN KEY (`set_artefactos_id`) REFERENCES `set_artefactos` (`id`);

--
-- Constraints for table `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `FK_4B91E7024B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_4B91E702A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `dupe`
--
ALTER TABLE `dupe`
  ADD CONSTRAINT `FK_D5DDF9D21F22B4C7` FOREIGN KEY (`personaje_plantilla_id`) REFERENCES `personaje_plantilla` (`id`);

--
-- Constraints for table `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `FK_C49C530BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `equipo_personaje`
--
ALTER TABLE `equipo_personaje`
  ADD CONSTRAINT `FK_ED7A2DF7121EFAFB` FOREIGN KEY (`personaje_id`) REFERENCES `personaje` (`id`),
  ADD CONSTRAINT `FK_ED7A2DF723BFBED` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`);

--
-- Constraints for table `habilidad`
--
ALTER TABLE `habilidad`
  ADD CONSTRAINT `FK_4D2A2AF71F22B4C7` FOREIGN KEY (`personaje_plantilla_id`) REFERENCES `personaje_plantilla` (`id`);

--
-- Constraints for table `juego_pieza_tipo`
--
ALTER TABLE `juego_pieza_tipo`
  ADD CONSTRAINT `FK_20F42A6333C6862B` FOREIGN KEY (`pieza_tipo_id`) REFERENCES `pieza_tipo` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `FK_AC6340B34B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_AC6340B3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `personaje`
--
ALTER TABLE `personaje`
  ADD CONSTRAINT `FK_53A410881F22B4C7` FOREIGN KEY (`personaje_plantilla_id`) REFERENCES `personaje_plantilla` (`id`),
  ADD CONSTRAINT `FK_53A410888D7F0B5D` FOREIGN KEY (`arma_id`) REFERENCES `arma` (`id`),
  ADD CONSTRAINT `FK_53A41088A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `personaje_artefacto`
--
ALTER TABLE `personaje_artefacto`
  ADD CONSTRAINT `FK_62E96A79121EFAFB` FOREIGN KEY (`personaje_id`) REFERENCES `personaje` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_62E96A79C408C2D2` FOREIGN KEY (`artefacto_id`) REFERENCES `artefacto` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `personaje_habilidad`
--
ALTER TABLE `personaje_habilidad`
  ADD CONSTRAINT `FK_659E9A32121EFAFB` FOREIGN KEY (`personaje_id`) REFERENCES `personaje` (`id`),
  ADD CONSTRAINT `FK_659E9A32621AA5D6` FOREIGN KEY (`habilidad_id`) REFERENCES `habilidad` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_5A8A6C8DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;