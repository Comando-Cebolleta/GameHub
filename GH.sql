-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 20, 2026 at 06:50 PM
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

--
-- Dumping data for table `arma`
--

INSERT INTO `arma` (`id`, `arma_plantilla_id`, `nivel`) VALUES
(17, 0, 65),
(18, 9, 55),
(21, 9, 80),
(22, 2, 90),
(23, 0, 90),
(27, 5, 80),
(28, 6, 80);

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
  `pasiva` varchar(4096) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arma_plantilla`
--

INSERT INTO `arma_plantilla` (`id`, `nombre`, `imagen`, `juego`, `stats_base`, `stats_por_nivel`, `pasiva`, `tipo`) VALUES
(0, 'Lápida del Lobo', 'LapidaDelLobo.webp', 'genshin', '{\"ATK\": 46, \"ATK%\": 0.108}', '{\"ATK\": 6.3146, \"ATK%\": 0.00436}', 'Aumenta el ATQ en un 20%. Al atacar a enemigos con menos del 30% de su Vida, aumenta el ATQ de todos los miembros del equipo en un 40% durante 12 s. Este efecto solo puede ocurrir una vez cada 30 s.', 'espadon'),
(1, 'Estrella Invernal', 'EstrellaInvernal.webp', 'genshin', '{\"ATK\": 46, \"CRIT_RATE\": 0.072}', '{\"ATK\": 6.3146, \"CRIT_RATE\": 0.00291}', 'El daño infligido por la Habilidad Elemental y la Habilidad Definitiva aumenta en un 12%. Al golpear a un enemigo con un Ataque Normal, un Ataque Cargado, la Habilidad Elemental o la Habilidad Definitiva, se obtiene una acumulación de estrella del día polar que dura 12 s. Con 1/2/3/4 acumulaciones, el ATQ aumenta en un 10/20/30/48%. Las acumulaciones de estrella del día polar obtenidas con el Ataque Normal, el Ataque Cargado, la Habilidad Elemental o la Habilidad Definitiva se calculan independientemente de las demás.', 'arco'),
(2, 'Luz del Segador', 'LuzDelSegador.webp', 'genshin', '{\"ATK\": 46, \"ER\": 0.12}', '{\"ATK\": 6.3146, \"ER\": 0.00484}', 'Aumenta el ATQ en un 28% de la cantidad de Recarga de Energía que el personaje tenga por encima del 100%. El ATQ puede aumentar como máximo en un 80% de esta manera. Tras usar la Habilidad Definitiva. la Recarga de Energía aumenta en un 30% durante 12 s.', 'lanza'),
(3, 'Fulgor de las Aguas Calmas', 'FulgorDeLasAguasCalmas.webp', 'genshin', '{\"ATK\": 44, \"CRIT_DMG\": 0.192}', '{\"ATK\": 5.8539, \"CRIT_DMG\": 0.00775}', 'El daño de la Habilidad Elemental del portador de esta arma aumenta en un 8% cuando su Vida aumenta o disminuye. Este efecto dura 6s, puede acumularse hasta 3 veces y activarse una vez cada 0.2s. Cuando la Vida de otro personaje del equipo aumenta o disminuye, la Vida Máx. del portador de esta arma aumenta en un 14%. Este efecto dura 6s, puede acumularse hasta 2 veces y activarse una vez cada 0.2s. Los dos anteriores efectos pueden activarse incluso cuando el portador del arma está en tu equipo pero no en uso.', 'espada'),
(4, 'Nocturno tras el Velo', 'NocturnoTrasElVelo.webp', 'genshin', '{\"ATK\": 44, \"CRIT_DMG\": 0.192}', '{\"ATK\": 5.8539, \"CRIT_DMG\": 0.00775}', 'La Vida Máx. aumenta en un 10%. Cuando el portador de esta arma causa una Reacción Lunar o inflige daño de Reacción Lunar a un enemigo, recupera 14 pts. de Energía Elemental y obtiene el efecto de \"licor divino del mar fértil\" durante 12 s, el cual aumenta la Vida Máx. en un 14% adicional y el Daño CRIT del daño de Reacción Lunar en un 60%. El efecto de recuperación de Energía Elemental solo puede ocurrir una vez cada 18 s, y se puede activar incluso cuando el portador de esta arma está en tu equipo pero no en uso.', 'catalizador'),
(5, 'Buenas noches, que duermas bien', 'BuenasNochesQueDuermasBien.webp', 'hsr', '{\"ATK\": 21, \"EFFECT_HIT_RATE\": 0.072}', '{\"ATK\": 5.7595, \"EFFECT_HIT_RATE\": 0.00373}', 'Por cada estado negativo que tenga el enemigo, el daño infligido por el portador aumenta en un 12%. Se puede acumular hasta 3 veces. Este efecto también es válido para el Daño con el tiempo.', 'cono'),
(6, 'A donde regresan los sueños', 'ADondeRegresanLosSuenyos.webp', 'hsr', '{\"ATK\": 21, \"BREAK_EFFECT\": 0.102}', '{\"ATK\": 5.7595, \"BREAK_EFFECT\": 0.00444}', 'El efecto de Ruptura del portador aumenta en un 60%. Cuando el portador inflige Daño de Ruptura a un enemigo, este entra en el estado de Vencido durante 2 turnos. Los objetivos afectados con Vencido reciben un 24% más de Daño de Ruptura del portador y su VEL se reduce en un 20%. Los efectos del mismo tipo no se pueden acumular.', 'cono'),
(7, 'De vuelta a la tierra', 'DeVueltaALaTierra.webp', 'hsr', '{\"ATK\": 21, \"ER\": 0.124}', '{\"ATK\": 5.7595, \"ER\": 0.00572}', 'Después de que el portador lance la habilidad básica o la habilidad definitiva sobre un personaje aliado, el portador recupera 6 pts. de energía y el objetivo recibe 1 acumulación de Himno sagrado durante 3 turnos. Se puede acumular hasta 3 veces. Cada acumulación de Himno sagrado aumenta el daño en un 15%. Tras cada 2 lanzamientos de la habilidad básica o la habilidad definitiva sobre un personaje aliado, el portador recupera 1 pt. de habilidad básica.', 'cono'),
(8, 'Yo seré mi propia espada', 'YoSereMiPropiaEspada.webp', 'hsr', '{\"ATK\": 26, \"CRIT_DMG\": 0.12}', '{\"ATK\": 7.0380, \"CRIT_DMG\": 0.00714}', 'El Daño CRIT del portador aumenta en un 20%. Cuando un aliado recibe un ataque o consume PV, el portador obtiene 1 acumulación de Eclipse. Se puede acumular hasta 3 veces. Por cada acumulación, el daño que inflige el siguiente ataque del portador aumenta en un 14%. Cuando se alcanzan 3 acumulaciones, el ataque actual ignora un 12% de la DEF del objetivo. Este efecto se elimina después de que el portador lance un ataque.', 'cono'),
(9, 'Que arda el alba', 'QueArdaElAlba.webp', 'hsr', '{\"ATK\": 31, \"CRIT_DMG\": 0.12}', '{\"ATK\": 8.3038, \"CRIT_DMG\": 0.00714}', 'La VEL base del portador aumenta en 12 y este ignora un 18% de la DEF del objetivo cuando inflige daño. Después de que el portador lance su habilidad definitiva, obtiene Sol abrasador, el cual se disipa al comenzar el turno. Cuando tiene Sol abrasador, el daño que inflige el portador aumenta en un 60%.', 'cono');

-- --------------------------------------------------------

--
-- Table structure for table `artefacto`
--

CREATE TABLE `artefacto` (
  `id` int(11) NOT NULL,
  `artefacto_plantilla_id` int(11) DEFAULT NULL,
  `estadisticas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`estadisticas`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artefacto`
--

INSERT INTO `artefacto` (`id`, `artefacto_plantilla_id`, `estadisticas`) VALUES
(77, 2, '{\"main_stat\":{\"name\":\"HP\",\"value\":7.4},\"sub_stats\":[{\"name\":\"PYRO_DMG_BONUS\",\"value\":55.0},{\"name\":\"ATK\",\"value\":55.0},{\"name\":\"PYRO_DMG_BONUS\",\"value\":11.0},{\"name\":\"PYRO_DMG_BONUS\",\"value\":22.0}]}'),
(78, 0, '{\"main_stat\":{\"name\":\"ATK\",\"value\":55.0},\"sub_stats\":[{\"name\":\"ELECTRO_DMG_BONUS\",\"value\":55.0},{\"name\":\"DEF%\",\"value\":55.0},{\"name\":\"PYRO_DMG_BONUS\",\"value\":44.0},{\"name\":\"DENDRO_DMG_BONUS\",\"value\":44.0}]}'),
(79, 3, '{\"main_stat\":{\"name\":\"HP\",\"value\":44.0},\"sub_stats\":[{\"name\":\"ATK%\",\"value\":44.0},{\"name\":\"PYRO_DMG_BONUS\",\"value\":44.0},{\"name\":\"DEF\",\"value\":44.0},{\"name\":\"ELECTRO_DMG_BONUS\",\"value\":44.0}]}'),
(80, 4, '{\"main_stat\":{\"name\":\"ANEMO_DMG_BONUS\",\"value\":44.0},\"sub_stats\":[{\"name\":\"DEF%\",\"value\":44.0},{\"name\":\"DEF\",\"value\":44.0},{\"name\":\"DEF%\",\"value\":44.0},{\"name\":\"ER\",\"value\":44.0}]}'),
(81, 1, '{\"main_stat\":{\"name\":\"ER\",\"value\":44.0},\"sub_stats\":[{\"name\":\"DEF%\",\"value\":44.0},{\"name\":\"GEO_DMG_BONUS\",\"value\":44.0},{\"name\":\"CRYO_DMG_BONUS\",\"value\":44.0},{\"name\":\"GEO_DMG_BONUS\",\"value\":44.0}]}'),
(82, 5, '{\"main_stat\":{\"name\":\"HP\",\"value\":44.0},\"sub_stats\":[{\"name\":\"BREAK_EFFECT\",\"value\":44.0},{\"name\":\"ER\",\"value\":44.0},{\"name\":\"BREAK_EFFECT\",\"value\":44.0},{\"name\":\"ER\",\"value\":44.0}]}'),
(83, 6, '{\"main_stat\":{\"name\":\"ATK\",\"value\":44.0},\"sub_stats\":[{\"name\":\"EFFECT_HIT_RATE\",\"value\":44.0},{\"name\":\"PHYSICAL_DMG_BONUS\",\"value\":44.0},{\"name\":\"EFFECT_RES\",\"value\":44.0},{\"name\":\"ER\",\"value\":44.0}]}'),
(84, 7, '{\"main_stat\":{\"name\":\"HP\",\"value\":44.0},\"sub_stats\":[{\"name\":\"DEF%\",\"value\":44.0},{\"name\":\"FIRE_DMG_BONUS\",\"value\":44.0},{\"name\":\"EFFECT_RES\",\"value\":44.0},{\"name\":\"BREAK_EFFECT\",\"value\":44.0}]}'),
(85, 8, '{\"main_stat\":{\"name\":\"HP\",\"value\":44.0},\"sub_stats\":[{\"name\":\"EFFECT_HIT_RATE\",\"value\":44.0},{\"name\":\"PHYSICAL_DMG_BONUS\",\"value\":44.0},{\"name\":\"SPD\",\"value\":44.0},{\"name\":\"SPD\",\"value\":44.0}]}'),
(86, 9, '{\"main_stat\":{\"name\":\"BREAK_EFFECT\",\"value\":44.0},\"sub_stats\":[{\"name\":\"DEF%\",\"value\":44.0},{\"name\":\"EFFECT_HIT_RATE\",\"value\":44.0},{\"name\":\"EFFECT_HIT_RATE\",\"value\":44.0},{\"name\":\"LIGHTNING_DMG_BONUS\",\"value\":44.0}]}'),
(87, 10, '{\"main_stat\":{\"name\":\"HP\",\"value\":44.0},\"sub_stats\":[{\"name\":\"SPD\",\"value\":44.0},{\"name\":\"HP%\",\"value\":44.0},{\"name\":\"ATK%\",\"value\":44.0},{\"name\":\"ICE_DMG_BONUS\",\"value\":44.0}]}'),
(99, 5, '{\"main_stat\":{\"name\":\"HP\",\"value\":450.0},\"sub_stats\":[{\"name\":\"CRIT_RATE\",\"value\":0.034},{\"name\":\"CRIT_DMG\",\"value\":0.18899999999999997},{\"name\":\"ATK%\",\"value\":0.045},{\"name\":\"HP%\",\"value\":0.047}]}'),
(100, 6, '{\"main_stat\":{\"name\":\"ATK\",\"value\":244.0},\"sub_stats\":[{\"name\":\"CRIT_RATE\",\"value\":0.043},{\"name\":\"CRIT_DMG\",\"value\":0.125},{\"name\":\"ATK%\",\"value\":0.127},{\"name\":\"DEF%\",\"value\":0.051}]}'),
(101, 7, '{\"main_stat\":{\"name\":\"CRIT_DMG\",\"value\":0.688},\"sub_stats\":[{\"name\":\"CRIT_RATE\",\"value\":0.064},{\"name\":\"HP%\",\"value\":0.107},{\"name\":\"HP\",\"value\":24.0},{\"name\":\"ATK%\",\"value\":0.047}]}'),
(102, 8, '{\"main_stat\":{\"name\":\"SPD\",\"value\":26.0},\"sub_stats\":[{\"name\":\"HP\",\"value\":100.0},{\"name\":\"DEF\",\"value\":7.2},{\"name\":\"EFFECT_HIT_RATE\",\"value\":0.027000000000000003},{\"name\":\"EFFECT_RES\",\"value\":0.051}]}'),
(103, 9, '{\"main_stat\":{\"name\":\"PHYSICAL_DMG_BONUS\",\"value\":0.546},\"sub_stats\":[{\"name\":\"ATK\",\"value\":24.0},{\"name\":\"EFFECT_HIT_RATE\",\"value\":0.045},{\"name\":\"EFFECT_RES\",\"value\":0.107},{\"name\":\"SPD\",\"value\":2.0}]}'),
(104, 10, '{\"main_stat\":{\"name\":\"ATK%\",\"value\":0.267},\"sub_stats\":[{\"name\":\"BREAK_EFFECT\",\"value\":0.084},{\"name\":\"HP\",\"value\":21.0},{\"name\":\"HP%\",\"value\":0.044000000000000004},{\"name\":\"CRIT_DMG\",\"value\":0.106}]}'),
(105, 2, '{\"main_stat\":{\"name\":\"HP\",\"value\":560.0},\"sub_stats\":[{\"name\":\"CRIT_RATE\",\"value\":0.10300000000000001},{\"name\":\"CRIT_DMG\",\"value\":0.07400000000000001},{\"name\":\"ER\",\"value\":0.040999999999999995},{\"name\":\"EM\",\"value\":18.0}]}'),
(106, 0, '{\"main_stat\":{\"name\":\"ATK\",\"value\":231.0},\"sub_stats\":[{\"name\":\"CRIT_RATE\",\"value\":0.025},{\"name\":\"CRIT_DMG\",\"value\":0.147},{\"name\":\"ATK%\",\"value\":0.067},{\"name\":\"DEF\",\"value\":23.0}]}'),
(107, 3, '{\"main_stat\":{\"name\":\"ER\",\"value\":0.457},\"sub_stats\":[{\"name\":\"EM\",\"value\":39.0},{\"name\":\"CRIT_DMG\",\"value\":0.081},{\"name\":\"CRIT_RATE\",\"value\":0.043},{\"name\":\"ATK\",\"value\":19.0}]}'),
(108, 4, '{\"main_stat\":{\"name\":\"ELECTRO_DMG_BONUS\",\"value\":0.34600000000000003},\"sub_stats\":[{\"name\":\"ER\",\"value\":0.10400000000000001},{\"name\":\"DEF%\",\"value\":0.037000000000000005},{\"name\":\"HP%\",\"value\":0.125},{\"name\":\"ATK\",\"value\":23.0}]}'),
(109, 1, '{\"main_stat\":{\"name\":\"CRIT_RATE\",\"value\":0.299},\"sub_stats\":[{\"name\":\"ER\",\"value\":0.057},{\"name\":\"CRIT_DMG\",\"value\":0.071},{\"name\":\"ATK\",\"value\":49.0},{\"name\":\"DEF%\",\"value\":0.047}]}'),
(110, 2, '{\"main_stat\":{\"name\":\"HP\",\"value\":32.0},\"sub_stats\":[{\"name\":\"ATK%\",\"value\":0.32},{\"name\":\"EM\",\"value\":43.0},{\"name\":\"ATK\",\"value\":43.0},{\"name\":\"DEF\",\"value\":3.0}]}'),
(111, 0, '{\"main_stat\":{\"name\":\"ATK\",\"value\":435.0},\"sub_stats\":[{\"name\":\"CRIT_RATE\",\"value\":0.034},{\"name\":\"CRIT_DMG\",\"value\":0.069},{\"name\":\"HP\",\"value\":43.0},{\"name\":\"ATK%\",\"value\":0.145}]}'),
(112, 3, '{\"main_stat\":{\"name\":\"HP%\",\"value\":0.43},\"sub_stats\":[{\"name\":\"DEF\",\"value\":32.0},{\"name\":\"ATK%\",\"value\":0.05},{\"name\":\"EM\",\"value\":3.0},{\"name\":\"DEF%\",\"value\":0.43}]}'),
(113, 4, '{\"main_stat\":{\"name\":\"PYRO_DMG_BONUS\",\"value\":0.43},\"sub_stats\":[{\"name\":\"HP%\",\"value\":0.047},{\"name\":\"HP\",\"value\":134.0},{\"name\":\"CRIT_DMG\",\"value\":0.043},{\"name\":\"ATK%\",\"value\":0.043}]}'),
(114, 1, '{\"main_stat\":{\"name\":\"EM\",\"value\":432.0},\"sub_stats\":[{\"name\":\"ATK%\",\"value\":0.01},{\"name\":\"DEF\",\"value\":3.0},{\"name\":\"ER\",\"value\":0.32},{\"name\":\"HP\",\"value\":3.0}]}'),
(140, 5, '{\"main_stat\":{\"name\":\"HP\",\"value\":240.0},\"sub_stats\":[{\"name\":\"BREAK_EFFECT\",\"value\":0.10300000000000001},{\"name\":\"HP%\",\"value\":0.034},{\"name\":\"DEF\",\"value\":18.0},{\"name\":\"SPD\",\"value\":2.0}]}'),
(141, 6, '{\"main_stat\":{\"name\":\"ATK\",\"value\":238.0},\"sub_stats\":[{\"name\":\"BREAK_EFFECT\",\"value\":0.08900000000000001},{\"name\":\"DEF\",\"value\":23.0},{\"name\":\"EFFECT_RES\",\"value\":0.047},{\"name\":\"CRIT_DMG\",\"value\":0.076}]}'),
(142, 7, '{\"main_stat\":{\"name\":\"HP%\",\"value\":0.433},\"sub_stats\":[{\"name\":\"HP\",\"value\":19.0},{\"name\":\"EFFECT_HIT_RATE\",\"value\":0.025},{\"name\":\"SPD\",\"value\":4.0},{\"name\":\"BREAK_EFFECT\",\"value\":0.14300000000000002}]}'),
(143, 8, '{\"main_stat\":{\"name\":\"SPD\",\"value\":26.0},\"sub_stats\":[{\"name\":\"BREAK_EFFECT\",\"value\":0.08800000000000001},{\"name\":\"EFFECT_RES\",\"value\":0.08800000000000001},{\"name\":\"EFFECT_HIT_RATE\",\"value\":0.08800000000000001},{\"name\":\"CRIT_RATE\",\"value\":0.035}]}'),
(144, 9, '{\"main_stat\":{\"name\":\"HP%\",\"value\":0.451},\"sub_stats\":[{\"name\":\"BREAK_EFFECT\",\"value\":0.11900000000000001},{\"name\":\"HP\",\"value\":21.0},{\"name\":\"SPD\",\"value\":2.0},{\"name\":\"CRIT_DMG\",\"value\":0.055999999999999994}]}'),
(145, 10, '{\"main_stat\":{\"name\":\"BREAK_EFFECT\",\"value\":0.278},\"sub_stats\":[{\"name\":\"ATK\",\"value\":100.0},{\"name\":\"EFFECT_HIT_RATE\",\"value\":0.023},{\"name\":\"SPD\",\"value\":2.0},{\"name\":\"DEF\",\"value\":27.0}]}'),
(146, 5, '{\"main_stat\":{\"name\":\"HP\",\"value\":222.0},\"sub_stats\":[{\"name\":\"EFFECT_HIT_RATE\",\"value\":0.04},{\"name\":\"DEF%\",\"value\":0.06},{\"name\":\"BREAK_EFFECT\",\"value\":0.07},{\"name\":\"DEF\",\"value\":2.0}]}'),
(147, 6, '{\"main_stat\":{\"name\":\"ATK\",\"value\":244.0},\"sub_stats\":[{\"name\":\"DEF\",\"value\":32.0},{\"name\":\"ATK%\",\"value\":0.07},{\"name\":\"CRIT_RATE\",\"value\":0.05},{\"name\":\"EFFECT_HIT_RATE\",\"value\":0.09}]}'),
(148, 18, '{\"main_stat\":{\"name\":\"EFFECT_HIT_RATE\",\"value\":0.23},\"sub_stats\":[{\"name\":\"ATK\",\"value\":23.0},{\"name\":\"DEF\",\"value\":43.0},{\"name\":\"EFFECT_RES\",\"value\":0.025},{\"name\":\"CRIT_RATE\",\"value\":0.079}]}'),
(149, 19, '{\"main_stat\":{\"name\":\"SPD\",\"value\":26.0},\"sub_stats\":[{\"name\":\"ATK%\",\"value\":0.044000000000000004},{\"name\":\"DEF%\",\"value\":0.044000000000000004},{\"name\":\"BREAK_EFFECT\",\"value\":0.078},{\"name\":\"DEF\",\"value\":23.0}]}'),
(150, 20, '{\"main_stat\":{\"name\":\"FIRE_DMG_BONUS\",\"value\":0.27899999999999997},\"sub_stats\":[{\"name\":\"ATK\",\"value\":100.0},{\"name\":\"EFFECT_HIT_RATE\",\"value\":0.099},{\"name\":\"SPD\",\"value\":4.0},{\"name\":\"EFFECT_RES\",\"value\":0.047}]}'),
(151, 21, '{\"main_stat\":{\"name\":\"BREAK_EFFECT\",\"value\":0.284},\"sub_stats\":[{\"name\":\"DEF%\",\"value\":0.073},{\"name\":\"EFFECT_RES\",\"value\":0.049},{\"name\":\"CRIT_DMG\",\"value\":0.127},{\"name\":\"DEF\",\"value\":28.0}]}');

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
(0, 0, 0, 'Emblema2.webp', 'genshin'),
(1, 1, 0, 'Emblema5.webp', 'genshin'),
(2, 2, 0, 'Emblema1.webp', 'genshin'),
(3, 3, 0, 'Emblema3.webp', 'genshin'),
(4, 4, 0, 'Emblema4.webp', 'genshin'),
(5, 5, 1, 'Relojero1.webp', 'hsr'),
(6, 6, 1, 'Relojero2.webp', 'hsr'),
(7, 7, 1, 'Relojero3.webp', 'hsr'),
(8, 8, 1, 'Relojero4.webp', 'hsr'),
(9, 9, 2, 'Estacion1.webp', 'hsr'),
(10, 10, 2, 'Estacion2.webp', 'hsr'),
(11, 0, 3, 'Bruja2.webp', 'genshin'),
(12, 1, 3, 'Bruja5.webp', 'genshin'),
(13, 2, 3, 'Bruja1.webp', 'genshin'),
(14, 3, 3, 'Bruja3.webp', 'genshin'),
(15, 4, 3, 'Bruja4.webp', 'genshin'),
(16, 5, 4, 'Pionera1.webp', 'hsr'),
(17, 6, 4, 'Pionera2.webp', 'hsr'),
(18, 7, 4, 'Pionera3.webp', 'hsr'),
(19, 8, 4, 'Pionera4.webp', 'hsr'),
(20, 9, 5, 'Glamoth1.webp', 'hsr'),
(21, 10, 5, 'Glamoth2.webp', 'hsr');

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

--
-- Dumping data for table `comentario`
--

INSERT INTO `comentario` (`id`, `cuerpo`, `fecha_publicacion`, `post_id`, `user_id`) VALUES
(1, 'AAA', '2026-02-11 12:56:10', 14, 17);

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
('DoctrineMigrations\\Version20260114111608', '2026-01-14 12:16:13', 41),
('DoctrineMigrations\\Version20260116123733', '2026-01-16 13:37:41', 529),
('DoctrineMigrations\\Version20260120091550', '2026-01-21 11:36:33', 1984),
('DoctrineMigrations\\Version20260122110205', '2026-01-22 12:02:12', 66),
('DoctrineMigrations\\Version20260128092152', '2026-01-28 10:21:59', 81),
('DoctrineMigrations\\Version20260202090004', '2026-02-02 10:00:11', 165),
('DoctrineMigrations\\Version20260202092211', '2026-02-02 10:22:18', 47),
('DoctrineMigrations\\Version20260205073814', '2026-02-05 08:38:21', 115),
('DoctrineMigrations\\Version20260209150106', '2026-02-09 16:01:14', 1229),
('DoctrineMigrations\\Version20260209150343', '2026-02-09 16:03:46', 64),
('DoctrineMigrations\\Version20260219075027', '2026-02-19 08:50:35', 69),
('DoctrineMigrations\\Version20260219091221', '2026-02-19 10:12:26', 576),
('DoctrineMigrations\\Version20260220153544', '2026-02-20 16:35:57', 563);

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

--
-- Dumping data for table `habilidad`
--

INSERT INTO `habilidad` (`id`, `personaje_plantilla_id`, `nombre`, `efectos`) VALUES
(1, 1, 'Espada templada', 'Realiza hasta 4 tajos de espada consecutivos. Ataque Cargado consume aguante para realizar golpes continuos.'),
(2, 1, 'Filo ardiente', 'Da un tajo hacia delante que inflige Daño Pyro. Esta habilidad se puede utilizar 3 veces consecutivas.'),
(3, 1, 'Amanecer', 'Lanza un fénix de fuego que inflige gran Daño Pyro y empuja a los enemigos, imbuyendo el arma en Pyro durante un tiempo.'),
(4, 2, 'Corte de torrentes', 'Realiza hasta 6 disparos consecutivos con arco. El Ataque Cargado inflige Daño Hydro y aplica el estado de Obstrucción al flujo.'),
(5, 2, 'Legado del mal: Olas furiosas', 'Cambia al modo cuerpo a cuerpo, infligiendo Daño Hydro con sus dagas. Los golpes aplican o detonan el efecto de Obstrucción al flujo.'),
(6, 2, 'Caos: Obliteración', 'Desata un ataque devastador. A distancia: Lanza una flecha mágica Hydro. Cuerpo a cuerpo: Realiza un corte amplio que inflige gran Daño Hydro.'),
(7, 3, 'Estilo Genryuu', 'Realiza hasta 5 ataques rápidos con la lanza. El ataque cargado consume aguante para realizar un golpe ascendente.'),
(8, 3, 'Trascendencia: Presagio maligno', 'Libera un fragmento de su eutimia que inflige Daño Electro y otorga un ojo que realiza ataques coordinados junto al personaje activo.'),
(9, 3, 'Técnica secreta: Verdad onírica', 'Desata el Musou no Hitotachi, infligiendo daño Electro masivo y cambiando a espada tachi durante un tiempo, regenerando energía para el equipo.'),
(10, 4, 'Convite del solista', 'Realiza hasta 4 ataques consecutivos. El ataque cargado cambia su arché entre Ousía y Pneuma, cambiando el efecto de su habilidad elemental.'),
(11, 4, 'Salón Solitaire', 'Invoca a los miembros del salón. Ousía: Infligen daño Hydro y consumen vida del equipo. Pneuma: Cura al personaje activo periódicamente.'),
(12, 4, 'Colgorio de todo el pueblo', 'Despierta el impulso de que el mundo es un escenario, aumentando el daño de todo el equipo en función de los cambios de vida (curación o daño) de los aliados.'),
(13, 5, 'Nana Letal', 'Envía plumas formadas por lágrimas que infligen Daño Hydro. Los enemigos golpeados ven reducida su velocidad de movimiento.'),
(14, 5, 'Velo Seráfico', 'Crea un escudo de agua bendita que absorbe daño. Al romperse, cura a los aliados cercanos basándose en la vida máxima de Columbina.'),
(15, 5, 'Réquiem del Anochecer', 'Canta una melodía que invoca una lluvia de proyectiles Hydro, durmiendo a los enemigos débiles e infligiendo daño masivo a los que despiertan.'),
(16, 6, 'Tiro helado', 'Inflige un 50% del ATQ de Pela como Daño de Hielo a un enemigo.'),
(17, 6, 'Congelación', 'Elimina un estado positivo de un enemigo e inflige Daño de Hielo. Si tiene éxito, recupera energía adicional.'),
(18, 6, 'Supresión de zona', 'Inflige Daño de Hielo a todos los enemigos y tiene una probabilidad base del 100% de aplicar \"Análisis\", reduciendo su Defensa durante 2 turnos.'),
(19, 7, 'Orden: Bombardeo aéreo', 'Inflige Daño de Fuego a un enemigo. Consume HP del usuario.'),
(20, 7, 'Crisálida de fuego', 'Entra en el estado de Combustión completa. Aumenta la velocidad y mejora el Ataque Básico.'),
(21, 7, 'Núcleo de la estrella', 'Aplica Debilidad de Fuego a los enemigos y aumenta el efecto de Ruptura.'),
(22, 8, 'Sermón de la virtud', 'Inflige Daño Imaginario a un enemigo equivalente al 100% del ATQ. Genera un punto de habilidad si el enemigo tiene desventajas.'),
(23, 8, 'Bendición del Orden', 'Otorga el estado \"Disciplina\" a un aliado, aumentando su Daño Crítico y haciendo que su próxima acción avance un 100%.'),
(24, 8, 'Sinfonía del Gran Día', 'Recupera energía para todos los aliados (excepto él mismo) y aumenta el ATQ y la eficiencia de ruptura de todo el equipo durante 3 turnos.'),
(25, 9, 'Brillo de la luna', 'Inflige Daño de Hielo a un enemigo y obtiene una acumulación de Sizigia para entrar en el estado de Transmigración.'),
(26, 9, 'Destello trascendental', 'Inflige gran Daño de Hielo a un enemigo y daño adyacente a los cercanos. Consume vida de los aliados para potenciar su propio ATQ.'),
(27, 9, 'Sueño de la flor efímera', 'Inflige Daño de Hielo masivo a un enemigo y a los adyacentes. Se considera daño de Habilidad Definitiva y otorga una acumulación de Sizigia.'),
(28, 10, 'Golpe sísmico', 'Golpea el suelo infligiendo Daño Físico a un enemigo y tiene probabilidad de aplicar Sangrado.'),
(29, 10, 'Fractura de realidad', 'Consume el 10% de sus PV para infligir Daño Físico a todos los enemigos. El daño aumenta cuanto menor sea la vida actual de Phainon.'),
(30, 10, 'Colapso estelar', 'Entra en estado de \"Berserker\", aumentando su velocidad y ataque, pero recibiendo más daño. Sus ataques básicos se convierten en golpes de área.');

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
  `dupe_num` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personaje`
--

INSERT INTO `personaje` (`id`, `user_id`, `arma_id`, `personaje_plantilla_id`, `nivel`, `dupe_num`, `nombre`) VALUES
(19, 18, 17, 1, 70, 3, 'DILUC 1'),
(20, 18, 18, 9, 55, 4, 'Jingliu 1'),
(23, 17, 21, 10, 80, 2, 'Dios creo en ti'),
(24, 17, 22, 3, 90, 1, 'La Xogun'),
(25, 17, 23, 1, 90, 6, 'Ayuda por favor'),
(29, 17, 27, 6, 80, 6, 'Prueba nuclear'),
(30, 17, 28, 7, 70, 2, 'Kebab Mixto');

-- --------------------------------------------------------

--
-- Table structure for table `personaje_artefacto`
--

CREATE TABLE `personaje_artefacto` (
  `personaje_id` int(11) NOT NULL,
  `artefacto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personaje_artefacto`
--

INSERT INTO `personaje_artefacto` (`personaje_id`, `artefacto_id`) VALUES
(19, 77),
(19, 78),
(19, 79),
(19, 80),
(19, 81),
(20, 82),
(20, 83),
(20, 84),
(20, 85),
(20, 86),
(20, 87),
(23, 99),
(23, 100),
(23, 101),
(23, 102),
(23, 103),
(23, 104),
(24, 105),
(24, 106),
(24, 107),
(24, 108),
(24, 109),
(25, 110),
(25, 111),
(25, 112),
(25, 113),
(25, 114),
(29, 140),
(29, 141),
(29, 142),
(29, 143),
(29, 144),
(29, 145),
(30, 146),
(30, 147),
(30, 148),
(30, 149),
(30, 150),
(30, 151);

-- --------------------------------------------------------

--
-- Table structure for table `personaje_habilidad`
--

CREATE TABLE `personaje_habilidad` (
  `personaje_id` int(11) NOT NULL,
  `habilidad_id` int(11) NOT NULL,
  `nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personaje_habilidad`
--

INSERT INTO `personaje_habilidad` (`personaje_id`, `habilidad_id`, `nivel`) VALUES
(20, 25, 10),
(20, 26, 10),
(20, 27, 8),
(23, 28, 3),
(23, 29, 3),
(23, 30, 8),
(24, 7, 7),
(24, 8, 8),
(24, 9, 10),
(25, 1, 4),
(25, 2, 4),
(25, 3, 8),
(29, 16, 4),
(29, 17, 8),
(29, 18, 10),
(30, 19, 3),
(30, 20, 7),
(30, 21, 10);

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
  `senda` varchar(255) DEFAULT NULL,
  `icono` varchar(255) DEFAULT NULL,
  `tipo_arma` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personaje_plantilla`
--

INSERT INTO `personaje_plantilla` (`id`, `juego`, `nombre`, `stats_base`, `stats_por_nivel`, `imagen`, `elemento`, `senda`, `icono`, `tipo_arma`) VALUES
(1, 'genshin', 'Diluc', '{\r\n        \"HP\": 1011, \"ATK\": 26, \"DEF\": 61, \"EM\": 0, \"ER\": 1.0, \r\n        \"CRIT_RATE\": 0.05, \"CRIT_DMG\": 0.50, \r\n        \"PYRO_DMG_BONUS\": 0, \"HYDRO_DMG_BONUS\": 0, \"ELECTRO_DMG_BONUS\": 0, \r\n        \"CRYO_DMG_BONUS\": 0, \"ANEMO_DMG_BONUS\": 0, \"GEO_DMG_BONUS\": 0, \r\n        \"DENDRO_DMG_BONUS\": 0, \"HEAL_BONUS\": 0\r\n    }', '{\r\n        \"HP\": 134.494, \"ATK\": 3.471, \"DEF\": 8.123, \r\n        \"CRIT_RATE\": 0.00215, \"CRIT_DMG\": 0\r\n    }', 'Diluc.webp', 'pyro', NULL, 'Diluc_Icon.webp', 'espadon'),
(2, 'genshin', 'Tartaglia', '{\r\n        \"HP\": 1020, \"ATK\": 23, \"DEF\": 63, \"EM\": 0, \"ER\": 1.0, \r\n        \"CRIT_RATE\": 0.05, \"CRIT_DMG\": 0.50, \r\n        \"PYRO_DMG_BONUS\": 0, \"HYDRO_DMG_BONUS\": 0, \"ELECTRO_DMG_BONUS\": 0, \r\n        \"CRYO_DMG_BONUS\": 0, \"ANEMO_DMG_BONUS\": 0, \"GEO_DMG_BONUS\": 0, \r\n        \"DENDRO_DMG_BONUS\": 0, \"HEAL_BONUS\": 0\r\n    }', '{\r\n        \"HP\": 135.764, \"ATK\": 3.123, \"DEF\": 8.449, \r\n        \"HYDRO_DMG_BONUS\": 0.00323\r\n    }', 'Tartaglia.webp', 'hydro', NULL, 'Tartaglia_Icon.webp', 'arco'),
(3, 'genshin', 'Raiden Shogun', '{\r\n        \"HP\": 1005, \"ATK\": 26, \"DEF\": 61, \"EM\": 0, \"ER\": 1.0, \r\n        \"CRIT_RATE\": 0.05, \"CRIT_DMG\": 0.50, \r\n        \"PYRO_DMG_BONUS\": 0, \"HYDRO_DMG_BONUS\": 0, \"ELECTRO_DMG_BONUS\": 0, \r\n        \"CRYO_DMG_BONUS\": 0, \"ANEMO_DMG_BONUS\": 0, \"GEO_DMG_BONUS\": 0, \r\n        \"DENDRO_DMG_BONUS\": 0, \"HEAL_BONUS\": 0\r\n    }', '{\r\n        \"HP\": 133.730, \"ATK\": 3.494, \"DEF\": 8.179, \r\n        \"ER\": 0.00359, \"ELECTRO_DMG_BONUS\": 0.00143\r\n    }', 'Raiden_Shogun.webp', 'electro', NULL, 'Raiden_Shogun_Icon.webp', 'lanza'),
(4, 'genshin', 'Furina', '{\r\n        \"HP\": 1192, \"ATK\": 61, \"DEF\": 54, \"EM\": 0, \"ER\": 1.0, \r\n        \"CRIT_RATE\": 0.05, \"CRIT_DMG\": 0.50, \r\n        \"PYRO_DMG_BONUS\": 0, \"HYDRO_DMG_BONUS\": 0, \"ELECTRO_DMG_BONUS\": 0, \r\n        \"CRYO_DMG_BONUS\": 0, \"ANEMO_DMG_BONUS\": 0, \"GEO_DMG_BONUS\": 0, \r\n        \"DENDRO_DMG_BONUS\": 0, \"HEAL_BONUS\": 0\r\n    }', '{\r\n        \"HP\": 158.595, \"ATK\": 2.528, \"DEF\": 7.213, \r\n        \"CRIT_RATE\": 0.00215, \"ELECTRO_DMG_BONUS\": 0.00143\r\n    }', 'Furina.webp', 'hydro', NULL, 'Furina_Icon.webp', 'espada'),
(5, 'genshin', 'Columbina', '{\r\n        \"HP\": 1144, \"ATK\": 7, \"DEF\": 40, \"EM\": 0, \"ER\": 1.0, \r\n        \"CRIT_RATE\": 0.05, \"CRIT_DMG\": 0.50, \r\n        \"PYRO_DMG_BONUS\": 0, \"HYDRO_DMG_BONUS\": 0, \"ELECTRO_DMG_BONUS\": 0, \r\n        \"CRYO_DMG_BONUS\": 0, \"ANEMO_DMG_BONUS\": 0, \"GEO_DMG_BONUS\": 0, \r\n        \"DENDRO_DMG_BONUS\": 0, \"HEAL_BONUS\": 0\r\n    }', '{\r\n        \"HP\": 152.258, \"ATK\": 1.000, \"DEF\": 5.337, \r\n        \"CRIT_RATE\": 0.00215\r\n    }', 'Columbina.webp', 'hydro', NULL, 'Columbina_Icon.webp', 'catalizador'),
(6, 'hsr', 'Pela', '{\r\n        \"HP\": 134, \"ATK\": 74, \"DEF\": 63, \"BREAK_EFFECT\": 0, \"SPD\": 105, \r\n        \"EFFECT_HIT_RATE\": 0, \"EFFECT_RES\": 0, \"ER\": 1.0, \r\n        \"CRIT_RATE\": 0.05, \"CRIT_DMG\": 0.50, \r\n        \"PHYSICAL_DMG_BONUS\": 0, \"FIRE_DMG_BONUS\": 0, \"ICE_DMG_BONUS\": 0, \r\n        \"LIGHTNING_DMG_BONUS\": 0, \"WIND_DMG_BONUS\": 0, \"QUANTUM_DMG_BONUS\": 0, \"IMAGINARY_DMG_BONUS\": 0, \"HEAL_BONUS\": 0\r\n    }', '{\r\n        \"HP\": 10.797, \"ATK\": 5.974, \"DEF\": 5.063, \r\n        \"ICE_DMG_BONUS\": 0.00179, \"EFFECT_HIT_RATE\": 0.00316\r\n    }', 'Pela.webp', 'hielo', 'nihilidad', 'Pela_Icon.webp', 'cono'),
(7, 'hsr', 'Firefly', '{\r\n        \"HP\": 110, \"ATK\": 71, \"DEF\": 105, \"BREAK_EFFECT\": 0, \"SPD\": 104, \r\n        \"EFFECT_HIT_RATE\": 0, \"EFFECT_RES\": 0, \"ER\": 1.0, \r\n        \"CRIT_RATE\": 0.05, \"CRIT_DMG\": 0.50, \r\n        \"PHYSICAL_DMG_BONUS\": 0, \"FIRE_DMG_BONUS\": 0, \"ICE_DMG_BONUS\": 0, \r\n        \"LIGHTNING_DMG_BONUS\": 0, \"WIND_DMG_BONUS\": 0, \"QUANTUM_DMG_BONUS\": 0, \"IMAGINARY_DMG_BONUS\": 0, \"HEAL_BONUS\": 0\r\n    }', '{\r\n        \"HP\": 8.911, \"ATK\": 5.721, \"DEF\": 8.493, \r\n        \"BREAK_EFFECT\": 0.00401, \"FIRE_DMG_BONUS\": 0.00234\r\n    }', 'Firefly.webp', 'fuego', 'destruccion', 'Firefly_Icon.webp', 'cono'),
(8, 'hsr', 'Sunday', '{\r\n        \"HP\": 168, \"ATK\": 87, \"DEF\": 72, \"BREAK_EFFECT\": 0, \"SPD\": 96, \r\n        \"EFFECT_HIT_RATE\": 0, \"EFFECT_RES\": 0, \"ER\": 1.0, \r\n        \"CRIT_RATE\": 0.05, \"CRIT_DMG\": 0.50, \r\n        \"PHYSICAL_DMG_BONUS\": 0, \"FIRE_DMG_BONUS\": 0, \"ICE_DMG_BONUS\": 0, \r\n        \"LIGHTNING_DMG_BONUS\": 0, \"WIND_DMG_BONUS\": 0, \"QUANTUM_DMG_BONUS\": 0, \"IMAGINARY_DMG_BONUS\": 0, \"HEAL_BONUS\": 0\r\n    }', '{\r\n        \"HP\": 13.582, \"ATK\": 7.000, \"DEF\": 5.835, \r\n        \"ER\": 0.00687\r\n    }', 'Sunday.webp', 'imaginario', 'armonia', 'Sunday_Icon.webp', 'cono'),
(9, 'hsr', 'Jingliu', '{\r\n        \"HP\": 195, \"ATK\": 92, \"DEF\": 66, \"BREAK_EFFECT\": 0, \"SPD\": 96, \r\n        \"EFFECT_HIT_RATE\": 0, \"EFFECT_RES\": 0, \"ER\": 1.0, \r\n        \"CRIT_RATE\": 0.05, \"CRIT_DMG\": 0.50, \r\n        \"PHYSICAL_DMG_BONUS\": 0, \"FIRE_DMG_BONUS\": 0, \"ICE_DMG_BONUS\": 0, \r\n        \"LIGHTNING_DMG_BONUS\": 0, \"WIND_DMG_BONUS\": 0, \"QUANTUM_DMG_BONUS\": 0, \"IMAGINARY_DMG_BONUS\": 0, \"HEAL_BONUS\": 0\r\n    }', '{\r\n        \"HP\": 15.696, \"ATK\": 7.430, \"DEF\": 5.303, \r\n        \"CRIT_DMG\": 0.00587, \"ICE_DMG_BONUS\": 0.00229\r\n    }', 'Jingliu.webp', 'hielo', 'destruccion', 'Jingliu_Icon.webp', 'cono'),
(10, 'hsr', 'Phainon', '{\r\n        \"HP\": 195, \"ATK\": 79, \"DEF\": 95, \"BREAK_EFFECT\": 0, \"SPD\": 94, \r\n        \"EFFECT_HIT_RATE\": 0, \"EFFECT_RES\": 0, \"ER\": 1.0, \r\n        \"CRIT_RATE\": 0.05, \"CRIT_DMG\": 0.50, \r\n        \"PHYSICAL_DMG_BONUS\": 0, \"FIRE_DMG_BONUS\": 0, \"ICE_DMG_BONUS\": 0, \r\n        \"LIGHTNING_DMG_BONUS\": 0, \"WIND_DMG_BONUS\": 0, \"QUANTUM_DMG_BONUS\": 0, \"IMAGINARY_DMG_BONUS\": 0, \"HEAL_BONUS\": 0\r\n    }', '{\r\n        \"HP\": 15.696, \"ATK\": 6.367, \"DEF\": 7.696, \r\n        \"CRIT_RATE\": 0.00308, \"PHYSICAL_DMG_BONUS\": 0.00253\r\n    }', 'Phainon.webp', 'fisico', 'destruccion', 'Phainon_Icon.webp', 'cono');

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
(4, 'caliz', 'Cáliz de Eonothem'),
(5, 'cabeza', 'Cabeza'),
(6, 'manos', 'Manos'),
(7, 'torso', 'Torso'),
(8, 'pies', 'Piernas'),
(9, 'esfera', 'Esfera de plano'),
(10, 'cuerda', 'Cuerda de unión');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `cuerpo` longtext NOT NULL,
  `fecha_publicacion` datetime NOT NULL,
  `visitas` int(11) DEFAULT NULL,
  `juego` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `titulo`, `cuerpo`, `fecha_publicacion`, `visitas`, `juego`) VALUES
(12, 17, 'Patata', '<figure class=\"image\"><img style=\"aspect-ratio:232/218;\" src=\"/uploads/blog/images2-696e0ce2b9666.jpg\" width=\"232\" height=\"218\"></figure><p>Ostia un lobo que guapo</p><ul><li>a</li><li>b</li><li>c</li><li>e</li><li>d</li></ul><figure class=\"image\"><img style=\"aspect-ratio:208/242;\" src=\"/uploads/blog/images-696e0cf998508.jpg\" width=\"208\" height=\"242\"></figure><p>Y otro tú</p><p>&nbsp;</p>', '2026-01-19 11:52:49', 0, 'genshin'),
(13, 17, 'Patata', '<figure class=\"image\"><img style=\"aspect-ratio:564/846;\" src=\"/uploads/blog/Cerveza-696e0da2bdcbe.webp\" width=\"564\" height=\"846\"></figure><p>dwadwadaw</p>', '2026-01-19 11:55:36', 0, 'hsr'),
(14, 17, 'Hola', '<figure class=\"image\"><img style=\"aspect-ratio:232/218;\" src=\"/uploads/blog/images2-696e0deb3e731.jpg\" width=\"232\" height=\"218\"></figure>', '2026-01-19 11:56:45', 0, 'hsr'),
(15, 17, 'Leche', '<p>Me gusta la fruta</p><ul><li>Platano</li><li>Manzana</li><li>Pera</li></ul>', '2026-02-01 20:46:39', 0, 'genshin');

-- --------------------------------------------------------

--
-- Table structure for table `set_artefactos`
--

CREATE TABLE `set_artefactos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `juego` varchar(255) NOT NULL,
  `efectos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`efectos`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `set_artefactos`
--

INSERT INTO `set_artefactos` (`id`, `nombre`, `imagen`, `juego`, `efectos`) VALUES
(0, 'Emblema del Destino', '', 'genshin', '{\n  \"2\": \"Recarga de Energía +20%.\",\n  \"4\": \"Aumenta el daño infligido con la Habilidad Definitiva en una cantidad equivalente al 25% de la Recarga de Energía. Se puede obtener un aumento del 75% como máximo.\"\n}\n'),
(1, 'Relojero de maquinaciones oníricas', '', 'hsr', '{\n  \"2\": \"+16% Efecto de Ruptura.\",\n  \"4\": \"+30% Efecto de Ruptura al equipo durante 2 turnos al usar la Habilidad Definitiva sobre un aliado.\"\n}\n'),
(2, 'Estación sellaespacios', '', 'hsr', '{\n  \"2\": \"+12% ATQ y +12% de ATQ adicional si el personaje tiene 120 o más de VEL.\"\n}\n'),
(3, 'Bruja Carmesí en Llamas', NULL, 'genshin', '{\"2\":\"Bono de Da\\u00f1o Pyro +15%.\",\"4\":\"Aumenta el da\\u00f1o causado por Sobrecarga, Quemadura y Crepitar en un 40%, y el de Vaporizaci\\u00f3n y Derretido en un 15%. El uso de una Habilidad Elemental aumenta los efectos del conjunto de 2 piezas en un 50% durante 10 s. Puede acumularse hasta un m\\u00e1ximo de 3 veces.\"}'),
(4, 'Buceadora pionera del agua muerta', NULL, 'hsr', '{\"2\":\"El da\\u00f1o infligido a los enemigos afectados por estados negativos aumenta en un 12%.\",\"4\":\"La Prob. CRIT aumenta en un 4%. El Da\\u00f1o CRIT que el portador inflige a los enemigos que tengan 2\\/3 o m\\u00e1s estados negativos aumenta en un 8%\\/12%. Cuando el portador aplica un estado negativo a un enemigo, los efectos mencionados aumentan en un 100% durante 1 turno.\"}'),
(5, 'Glamoth, frente del firmamento', NULL, 'hsr', '{\"2\":\"El ATQ del portador aumenta en un 12%. Cuando su VEL es igual o superior a 135\\/160, el da\\u00f1o que inflige aumenta en un 12%\\/18%.\"}');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(17, 'Jose', 'aludua2859@ieselcaminas.org', '[\"ROLE_ADMIN\"]', '$2y$13$opHNEpykEPBG.r17rL.ad.WzheOI4AJnPH/y7b7BHdOBKhu0h4b9m', '697fab8018075.jpg', '2026-01-29', 1),
(18, 'Eri', 'e@e.com', '[]', '$2y$13$zz4l2fiiFNO4pjRs2N/t7umi1ZMZt0yr5so.rMTl01EQHVRI21wQO', NULL, '2026-02-09', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `artefacto`
--
ALTER TABLE `artefacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personaje`
--
ALTER TABLE `personaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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