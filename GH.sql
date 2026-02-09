-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Temps de generació: 09-02-2026 a les 09:41:09
-- Versió del servidor: 8.0.36-2ubuntu3
-- Versió de PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `GH`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `arma`
--

CREATE TABLE `arma` (
  `id` int NOT NULL,
  `arma_plantilla_id` int DEFAULT NULL,
  `nivel` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `arma`
--

INSERT INTO `arma` (`id`, `arma_plantilla_id`, `nivel`) VALUES
(16, 9, 32),
(17, 0, 65),
(18, 9, 55);

-- --------------------------------------------------------

--
-- Estructura de la taula `arma_plantilla`
--

CREATE TABLE `arma_plantilla` (
  `id` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `juego` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stats_base` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `stats_por_nivel` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `pasiva` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ;

--
-- Bolcament de dades per a la taula `arma_plantilla`
--

INSERT INTO `arma_plantilla` (`id`, `nombre`, `imagen`, `juego`, `stats_base`, `stats_por_nivel`, `pasiva`, `tipo`) VALUES
(0, 'Lápida del Lobo', NULL, 'genshin', '{\"ATK\":608,\"ATK%\":0.49}', '{\"ATK\":16,\"ATK%\":0.012}', 'Aumenta el ATQ del portador. Al golpear a enemigos con poca vida, incrementa aún más el daño durante un tiempo.', 'espadon'),
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
-- Estructura de la taula `artefacto`
--

CREATE TABLE `artefacto` (
  `id` int NOT NULL,
  `artefacto_plantilla_id` int DEFAULT NULL,
  `estadisticas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ;

--
-- Bolcament de dades per a la taula `artefacto`
--

INSERT INTO `artefacto` (`id`, `artefacto_plantilla_id`, `estadisticas`) VALUES
(71, 5, '{\"main_stat\":{\"name\":\"HP\",\"value\":32.0},\"sub_stats\":[{\"name\":\"PHYSICAL_DMG_BONUS\",\"value\":3232.0},{\"name\":\"ER\",\"value\":32.0},{\"name\":\"HP%\",\"value\":32.0},{\"name\":\"ATK\",\"value\":32.0}]}'),
(72, 6, '{\"main_stat\":{\"name\":\"ATK\",\"value\":32.0},\"sub_stats\":[{\"name\":\"FIRE_DMG_BONUS\",\"value\":32.0},{\"name\":\"EFFECT_HIT_RATE\",\"value\":32.0},{\"name\":\"DEF%\",\"value\":32.0},{\"name\":\"ATK\",\"value\":32.0}]}'),
(73, 7, '{\"main_stat\":{\"name\":\"HP\",\"value\":32.0},\"sub_stats\":[{\"name\":\"ER\",\"value\":32.0},{\"name\":\"SPD\",\"value\":43.0},{\"name\":\"EFFECT_RES\",\"value\":54.0},{\"name\":\"EFFECT_RES\",\"value\":54.0}]}'),
(74, 8, '{\"main_stat\":{\"name\":\"HP\",\"value\":32.0},\"sub_stats\":[{\"name\":\"BREAK_EFFECT\",\"value\":32.0},{\"name\":\"EFFECT_RES\",\"value\":5.0},{\"name\":\"BREAK_EFFECT\",\"value\":5.0},{\"name\":\"EFFECT_HIT_RATE\",\"value\":54.0}]}'),
(75, 9, '{\"main_stat\":{\"name\":\"HP\",\"value\":54.0},\"sub_stats\":[{\"name\":\"HP%\",\"value\":54.0},{\"name\":\"DEF\",\"value\":54.0},{\"name\":\"HP%\",\"value\":54.0},{\"name\":\"EFFECT_HIT_RATE\",\"value\":54.0}]}'),
(76, 10, '{\"main_stat\":{\"name\":\"HP\",\"value\":54.0},\"sub_stats\":[{\"name\":\"BREAK_EFFECT\",\"value\":54.0},{\"name\":\"ATK%\",\"value\":54.0},{\"name\":\"ATK\",\"value\":54.0},{\"name\":\"DEF%\",\"value\":54.0}]}'),
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
(87, 10, '{\"main_stat\":{\"name\":\"HP\",\"value\":44.0},\"sub_stats\":[{\"name\":\"SPD\",\"value\":44.0},{\"name\":\"HP%\",\"value\":44.0},{\"name\":\"ATK%\",\"value\":44.0},{\"name\":\"ICE_DMG_BONUS\",\"value\":44.0}]}');

-- --------------------------------------------------------

--
-- Estructura de la taula `artefacto_plantilla`
--

CREATE TABLE `artefacto_plantilla` (
  `id` int NOT NULL,
  `pieza_tipo_id` int DEFAULT NULL,
  `set_artefactos_id` int DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `juego` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `artefacto_plantilla`
--

INSERT INTO `artefacto_plantilla` (`id`, `pieza_tipo_id`, `set_artefactos_id`, `imagen`, `juego`) VALUES
(0, 0, 0, NULL, 'genshin'),
(1, 1, 0, NULL, 'genshin'),
(2, 2, 0, NULL, 'genshin'),
(3, 3, 0, NULL, 'genshin'),
(4, 4, 0, NULL, 'genshin'),
(5, 5, 1, NULL, 'hsr'),
(6, 6, 1, NULL, 'hsr'),
(7, 7, 1, NULL, 'hsr'),
(8, 8, 1, NULL, 'hsr'),
(9, 9, 2, NULL, 'hsr'),
(10, 10, 2, NULL, 'hsr');

-- --------------------------------------------------------

--
-- Estructura de la taula `comentario`
--

CREATE TABLE `comentario` (
  `id` int NOT NULL,
  `cuerpo` varchar(4096) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_publicacion` datetime NOT NULL,
  `post_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Bolcament de dades per a la taula `doctrine_migration_versions`
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
('DoctrineMigrations\\Version20260205073814', '2026-02-05 08:38:21', 115);

-- --------------------------------------------------------

--
-- Estructura de la taula `dupe`
--

CREATE TABLE `dupe` (
  `id` int NOT NULL,
  `personaje_plantilla_id` int DEFAULT NULL,
  `numero` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `efectos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `equipo`
--

CREATE TABLE `equipo` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `equipo_personaje`
--

CREATE TABLE `equipo_personaje` (
  `personaje_id` int NOT NULL,
  `equipo_id` int NOT NULL,
  `posicion` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `habilidad`
--

CREATE TABLE `habilidad` (
  `id` int NOT NULL,
  `personaje_plantilla_id` int DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `efectos` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `habilidad`
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
-- Estructura de la taula `like`
--

CREATE TABLE `like` (
  `user_id` int NOT NULL,
  `post_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `personaje`
--

CREATE TABLE `personaje` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `arma_id` int DEFAULT NULL,
  `personaje_plantilla_id` int DEFAULT NULL,
  `nivel` int NOT NULL,
  `dupe_num` int NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `personaje`
--

INSERT INTO `personaje` (`id`, `user_id`, `arma_id`, `personaje_plantilla_id`, `nivel`, `dupe_num`, `nombre`) VALUES
(18, 17, 16, 7, 32, 3, 'dw'),
(19, 18, 17, 1, 70, 3, 'DILUC 1'),
(20, 18, 18, 9, 55, 4, 'Jingliu 1');

-- --------------------------------------------------------

--
-- Estructura de la taula `personaje_artefacto`
--

CREATE TABLE `personaje_artefacto` (
  `personaje_id` int NOT NULL,
  `artefacto_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `personaje_artefacto`
--

INSERT INTO `personaje_artefacto` (`personaje_id`, `artefacto_id`) VALUES
(18, 71),
(18, 72),
(18, 73),
(18, 74),
(18, 75),
(18, 76),
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
(20, 87);

-- --------------------------------------------------------

--
-- Estructura de la taula `personaje_habilidad`
--

CREATE TABLE `personaje_habilidad` (
  `personaje_id` int NOT NULL,
  `habilidad_id` int NOT NULL,
  `nivel` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `personaje_habilidad`
--

INSERT INTO `personaje_habilidad` (`personaje_id`, `habilidad_id`, `nivel`) VALUES
(20, 25, 10),
(20, 26, 10),
(20, 27, 8);

-- --------------------------------------------------------

--
-- Estructura de la taula `personaje_plantilla`
--

CREATE TABLE `personaje_plantilla` (
  `id` int NOT NULL,
  `juego` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stats_base` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `stats_por_nivel` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elemento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `senda` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_arma` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ;

--
-- Bolcament de dades per a la taula `personaje_plantilla`
--

INSERT INTO `personaje_plantilla` (`id`, `juego`, `nombre`, `stats_base`, `stats_por_nivel`, `imagen`, `elemento`, `senda`, `icono`, `tipo_arma`) VALUES
(1, 'genshin', 'Diluc', '{\n \"HP\":12981,\"ATK\":335,\"DEF\":784,\"EM\":0,\"ER\":1.00,\n \"CRIT_RATE\":0.05,\"CRIT_DMG\":0.50,\n \"PYRO_DMG_BONUS\":0.466,\"HYDRO_DMG_BONUS\":0,\"ELECTRO_DMG_BONUS\":0,\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\n \"HEAL_BONUS\":0\n}', '{\r\n \"HP\":210,\"ATK\":8,\"DEF\":14,\"EM\":0,\"ER\":0.01,\r\n \"CRIT_RATE\":0.002,\"CRIT_DMG\":0.01,\r\n \"PYRO_DMG_BONUS\":0.01,\"HYDRO_DMG_BONUS\":0,\"ELECTRO_DMG_BONUS\":0,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'pyro', NULL, NULL, 'espadon'),
(2, 'genshin', 'Tartaglia', '{\r\n \"HP\":13103,\"ATK\":301,\"DEF\":815,\"EM\":0,\"ER\":1.00,\r\n \"CRIT_RATE\":0.05,\"CRIT_DMG\":0.50,\r\n \"PYRO_DMG_BONUS\":0,\"HYDRO_DMG_BONUS\":0.466,\"ELECTRO_DMG_BONUS\":0,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', '{\r\n \"HP\":215,\"ATK\":7,\"DEF\":15,\"EM\":0,\"ER\":0.01,\r\n \"CRIT_RATE\":0.002,\"CRIT_DMG\":0.01,\r\n \"PYRO_DMG_BONUS\":0,\"HYDRO_DMG_BONUS\":0.01,\"ELECTRO_DMG_BONUS\":0,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'hydro', NULL, NULL, 'arco'),
(3, 'genshin', 'Raiden Shogun', '{\n \"HP\":12907,\"ATK\":337,\"DEF\":789,\"EM\":0,\"ER\":1.32,\n \"CRIT_RATE\":0.05,\"CRIT_DMG\":0.50,\n \"PYRO_DMG_BONUS\":0,\"HYDRO_DMG_BONUS\":0,\"ELECTRO_DMG_BONUS\":0.466,\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\n \"HEAL_BONUS\":0\n}', '{\r\n \"HP\":205,\"ATK\":8,\"DEF\":14,\"EM\":0,\"ER\":0.015,\r\n \"CRIT_RATE\":0.002,\"CRIT_DMG\":0.01,\r\n \"PYRO_DMG_BONUS\":0,\"HYDRO_DMG_BONUS\":0,\"ELECTRO_DMG_BONUS\":0.01,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'electro', NULL, NULL, 'lanza'),
(4, 'genshin', 'Furina', '{\r\n \"HP\":15307,\"ATK\":243,\"DEF\":712,\"EM\":0,\"ER\":1.00,\r\n \"CRIT_RATE\":0.05,\"CRIT_DMG\":0.50,\r\n \"PYRO_DMG_BONUS\":0,\"HYDRO_DMG_BONUS\":0.466,\"ELECTRO_DMG_BONUS\":0,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', '{\r\n \"HP\":260,\"ATK\":6,\"DEF\":13,\"EM\":0,\"ER\":0.01,\r\n \"CRIT_RATE\":0.002,\"CRIT_DMG\":0.01,\r\n \"PYRO_DMG_BONUS\":0,\"HYDRO_DMG_BONUS\":0.01,\"ELECTRO_DMG_BONUS\":0,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'hydro', NULL, NULL, 'espada'),
(5, 'genshin', 'Columbina', '{\r\n \"HP\":14000,\"ATK\":320,\"DEF\":760,\"EM\":80,\"ER\":1.10,\r\n \"CRIT_RATE\":0.10,\"CRIT_DMG\":0.60,\r\n \"PYRO_DMG_BONUS\":0,\"HYDRO_DMG_BONUS\":0.466,\"ELECTRO_DMG_BONUS\":0,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', '{\r\n \"HP\":230,\"ATK\":9,\"DEF\":15,\"EM\":5,\"ER\":0.012,\r\n \"CRIT_RATE\":0.003,\"CRIT_DMG\":0.012,\r\n \"PYRO_DMG_BONUS\":0,\"HYDRO_DMG_BONUS\":0.01,\"ELECTRO_DMG_BONUS\":0,\r\n \"CRYO_DMG_BONUS\":0,\"ANEMO_DMG_BONUS\":0,\"GEO_DMG_BONUS\":0,\"DENDRO_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'hydro', NULL, NULL, 'catalizador'),
(6, 'hsr', 'Pela', '{\r\n \"HP\":1047,\"ATK\":476,\"DEF\":463,\"BREAK_EFFECT\":0.25,\"SPD\":105,\r\n \"EFFECT_HIT_RATE\":0.20,\"EFFECT_RES\":0.10,\"ER\":1.00,\r\n \"CRIT_RATE\":0.05,\"CRIT_DMG\":0.50,\r\n \"PHYSICAL_DMG_BONUS\":0,\"FIRE_DMG_BONUS\":0,\"ICE_DMG_BONUS\":0.20,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', '{\r\n \"HP\":42,\"ATK\":19,\"DEF\":18,\"BREAK_EFFECT\":0.01,\"SPD\":2,\r\n \"EFFECT_HIT_RATE\":0.008,\"EFFECT_RES\":0.006,\"ER\":0.01,\r\n \"CRIT_RATE\":0.003,\"CRIT_DMG\":0.012,\r\n \"PHYSICAL_DMG_BONUS\":0,\"FIRE_DMG_BONUS\":0,\"ICE_DMG_BONUS\":0.005,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'hielo', 'nihilidad', NULL, 'cono'),
(7, 'hsr', 'Firefly', '{\n \"HP\":1378,\"ATK\":523,\"DEF\":485,\"BREAK_EFFECT\":0.30,\"SPD\":103,\n \"EFFECT_HIT_RATE\":0.15,\"EFFECT_RES\":0.10,\"ER\":1.00,\n \"CRIT_RATE\":0.05,\"CRIT_DMG\":0.50,\n \"PHYSICAL_DMG_BONUS\":0,\"FIRE_DMG_BONUS\":0.20,\"ICE_DMG_BONUS\":0,\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0,\n \"HEAL_BONUS\":0\n}', '{\r\n \"HP\":55,\"ATK\":21,\"DEF\":19,\"BREAK_EFFECT\":0.012,\"SPD\":2,\r\n \"EFFECT_HIT_RATE\":0.007,\"EFFECT_RES\":0.006,\"ER\":0.01,\r\n \"CRIT_RATE\":0.003,\"CRIT_DMG\":0.012,\r\n \"PHYSICAL_DMG_BONUS\":0,\"FIRE_DMG_BONUS\":0.005,\"ICE_DMG_BONUS\":0,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'fuego', 'destruccion', NULL, 'cono'),
(8, 'hsr', 'Sunday', '{\r\n \"HP\":1120,\"ATK\":412,\"DEF\":502,\"BREAK_EFFECT\":0.20,\"SPD\":106,\r\n \"EFFECT_HIT_RATE\":0.25,\"EFFECT_RES\":0.12,\"ER\":1.05,\r\n \"CRIT_RATE\":0.05,\"CRIT_DMG\":0.50,\r\n \"PHYSICAL_DMG_BONUS\":0,\"FIRE_DMG_BONUS\":0,\"ICE_DMG_BONUS\":0,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0.20,\r\n \"HEAL_BONUS\":0\r\n}', '{\r\n \"HP\":45,\"ATK\":16,\"DEF\":20,\"BREAK_EFFECT\":0.01,\"SPD\":2,\r\n \"EFFECT_HIT_RATE\":0.01,\"EFFECT_RES\":0.007,\"ER\":0.012,\r\n \"CRIT_RATE\":0.002,\"CRIT_DMG\":0.01,\r\n \"PHYSICAL_DMG_BONUS\":0,\"FIRE_DMG_BONUS\":0,\"ICE_DMG_BONUS\":0,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0.005,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'imaginario', 'armonia', NULL, 'cono'),
(9, 'hsr', 'Jingliu', '{\r\n \"HP\":1436,\"ATK\":592,\"DEF\":436,\"BREAK_EFFECT\":0.22,\"SPD\":100,\r\n \"EFFECT_HIT_RATE\":0.10,\"EFFECT_RES\":0.08,\"ER\":1.00,\r\n \"CRIT_RATE\":0.05,\"CRIT_DMG\":0.60,\r\n \"PHYSICAL_DMG_BONUS\":0,\"FIRE_DMG_BONUS\":0,\"ICE_DMG_BONUS\":0.20,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', '{\r\n \"HP\":58,\"ATK\":24,\"DEF\":17,\"BREAK_EFFECT\":0.011,\"SPD\":2,\r\n \"EFFECT_HIT_RATE\":0.006,\"EFFECT_RES\":0.005,\"ER\":0.01,\r\n \"CRIT_RATE\":0.003,\"CRIT_DMG\":0.015,\r\n \"PHYSICAL_DMG_BONUS\":0,\"FIRE_DMG_BONUS\":0,\"ICE_DMG_BONUS\":0.005,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'hielo', 'destruccion', NULL, 'cono'),
(10, 'hsr', 'Phainon', '{\r\n \"HP\":1500,\"ATK\":560,\"DEF\":470,\"BREAK_EFFECT\":0.28,\"SPD\":102,\r\n \"EFFECT_HIT_RATE\":0.12,\"EFFECT_RES\":0.10,\"ER\":1.00,\r\n \"CRIT_RATE\":0.08,\"CRIT_DMG\":0.55,\r\n \"PHYSICAL_DMG_BONUS\":0.20,\"FIRE_DMG_BONUS\":0,\"ICE_DMG_BONUS\":0,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', '{\r\n \"HP\":60,\"ATK\":22,\"DEF\":18,\"BREAK_EFFECT\":0.013,\"SPD\":2,\r\n \"EFFECT_HIT_RATE\":0.007,\"EFFECT_RES\":0.006,\"ER\":0.01,\r\n \"CRIT_RATE\":0.003,\"CRIT_DMG\":0.014,\r\n \"PHYSICAL_DMG_BONUS\":0.005,\"FIRE_DMG_BONUS\":0,\"ICE_DMG_BONUS\":0,\r\n \"LIGHTNING_DMG_BONUS\":0,\"WIND_DMG_BONUS\":0,\"QUANTUM_DMG_BONUS\":0,\"IMAGINARY_DMG_BONUS\":0,\r\n \"HEAL_BONUS\":0\r\n}', NULL, 'fisico', 'destruccion', NULL, 'cono');

-- --------------------------------------------------------

--
-- Estructura de la taula `pieza_tipo`
--

CREATE TABLE `pieza_tipo` (
  `id` int NOT NULL,
  `codigo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `pieza_tipo`
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
-- Estructura de la taula `post`
--

CREATE TABLE `post` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cuerpo` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_publicacion` datetime NOT NULL,
  `visitas` int DEFAULT NULL,
  `juego` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `post`
--

INSERT INTO `post` (`id`, `user_id`, `titulo`, `cuerpo`, `fecha_publicacion`, `visitas`, `juego`) VALUES
(12, NULL, 'Patata', '<figure class=\"image\"><img style=\"aspect-ratio:232/218;\" src=\"/uploads/blog/images2-696e0ce2b9666.jpg\" width=\"232\" height=\"218\"></figure><p>Ostia un lobo que guapo</p><ul><li>a</li><li>b</li><li>c</li><li>e</li><li>d</li></ul><figure class=\"image\"><img style=\"aspect-ratio:208/242;\" src=\"/uploads/blog/images-696e0cf998508.jpg\" width=\"208\" height=\"242\"></figure><p>Y otro tú</p><p>&nbsp;</p>', '2026-01-19 11:52:49', 0, 'genshin'),
(13, NULL, 'Patata', '<figure class=\"image\"><img style=\"aspect-ratio:564/846;\" src=\"/uploads/blog/Cerveza-696e0da2bdcbe.webp\" width=\"564\" height=\"846\"></figure><p>dwadwadaw</p>', '2026-01-19 11:55:36', 0, 'hsr'),
(14, NULL, 'Hola', '<figure class=\"image\"><img style=\"aspect-ratio:232/218;\" src=\"/uploads/blog/images2-696e0deb3e731.jpg\" width=\"232\" height=\"218\"></figure>', '2026-01-19 11:56:45', 0, 'hsr'),
(15, 17, 'Leche', '<p>Me gusta la fruta</p><ul><li>Platano</li><li>Manzana</li><li>Pera</li></ul>', '2026-02-01 20:46:39', 0, 'genshin');

-- --------------------------------------------------------

--
-- Estructura de la taula `set_artefactos`
--

CREATE TABLE `set_artefactos` (
  `id` int NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `juego` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `efectos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `set_artefactos`
--

INSERT INTO `set_artefactos` (`id`, `nombre`, `imagen`, `juego`, `efectos`) VALUES
(0, 'Emblema del Destino', '', 'genshin', 'Cosas de recarga'),
(1, 'Relojero de maquinaciones oníricas', '', 'hsr', 'Cosas de ruptura'),
(2, 'Estación sellaespacios', '', 'hsr', 'Cosas de ataque');

-- --------------------------------------------------------

--
-- Estructura de la taula `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `user_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_perfil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `is_verified` tinyint(1) NOT NULL
) ;

--
-- Bolcament de dades per a la taula `user`
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
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `arma`
--
ALTER TABLE `arma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1F4DB7603F28BF78` (`arma_plantilla_id`);

--
-- Índexs per a la taula `arma_plantilla`
--
ALTER TABLE `arma_plantilla`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `artefacto`
--
ALTER TABLE `artefacto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4A5DDABC4B44F0C4` (`artefacto_plantilla_id`);

--
-- Índexs per a la taula `artefacto_plantilla`
--
ALTER TABLE `artefacto_plantilla`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BA3F7E33C6862B` (`pieza_tipo_id`),
  ADD KEY `IDX_BA3F7EC07AB4E2` (`set_artefactos_id`);

--
-- Índexs per a la taula `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4B91E7024B89032C` (`post_id`),
  ADD KEY `IDX_4B91E702A76ED395` (`user_id`);

--
-- Índexs per a la taula `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Índexs per a la taula `dupe`
--
ALTER TABLE `dupe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D5DDF9D21F22B4C7` (`personaje_plantilla_id`);

--
-- Índexs per a la taula `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C49C530BA76ED395` (`user_id`);

--
-- Índexs per a la taula `equipo_personaje`
--
ALTER TABLE `equipo_personaje`
  ADD PRIMARY KEY (`personaje_id`,`equipo_id`),
  ADD KEY `IDX_ED7A2DF7121EFAFB` (`personaje_id`),
  ADD KEY `IDX_ED7A2DF723BFBED` (`equipo_id`);

--
-- Índexs per a la taula `habilidad`
--
ALTER TABLE `habilidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4D2A2AF71F22B4C7` (`personaje_plantilla_id`);

--
-- Índexs per a la taula `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`user_id`,`post_id`),
  ADD KEY `IDX_AC6340B3A76ED395` (`user_id`),
  ADD KEY `IDX_AC6340B34B89032C` (`post_id`);

--
-- Índexs per a la taula `personaje`
--
ALTER TABLE `personaje`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_53A410888D7F0B5D` (`arma_id`),
  ADD KEY `IDX_53A41088A76ED395` (`user_id`),
  ADD KEY `IDX_53A410881F22B4C7` (`personaje_plantilla_id`);

--
-- Índexs per a la taula `personaje_artefacto`
--
ALTER TABLE `personaje_artefacto`
  ADD PRIMARY KEY (`personaje_id`,`artefacto_id`),
  ADD KEY `IDX_62E96A79121EFAFB` (`personaje_id`),
  ADD KEY `IDX_62E96A79C408C2D2` (`artefacto_id`);

--
-- Índexs per a la taula `personaje_habilidad`
--
ALTER TABLE `personaje_habilidad`
  ADD PRIMARY KEY (`personaje_id`,`habilidad_id`),
  ADD KEY `IDX_659E9A32121EFAFB` (`personaje_id`),
  ADD KEY `IDX_659E9A32621AA5D6` (`habilidad_id`);

--
-- Índexs per a la taula `personaje_plantilla`
--
ALTER TABLE `personaje_plantilla`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `pieza_tipo`
--
ALTER TABLE `pieza_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5A8A6C8DA76ED395` (`user_id`);

--
-- Índexs per a la taula `set_artefactos`
--
ALTER TABLE `set_artefactos`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `arma`
--
ALTER TABLE `arma`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la taula `artefacto`
--
ALTER TABLE `artefacto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `personaje`
--
ALTER TABLE `personaje`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la taula `post`
--
ALTER TABLE `post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la taula `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `arma`
--
ALTER TABLE `arma`
  ADD CONSTRAINT `FK_1F4DB7603F28BF78` FOREIGN KEY (`arma_plantilla_id`) REFERENCES `arma_plantilla` (`id`);

--
-- Restriccions per a la taula `artefacto`
--
ALTER TABLE `artefacto`
  ADD CONSTRAINT `FK_4A5DDABC4B44F0C4` FOREIGN KEY (`artefacto_plantilla_id`) REFERENCES `artefacto_plantilla` (`id`);

--
-- Restriccions per a la taula `artefacto_plantilla`
--
ALTER TABLE `artefacto_plantilla`
  ADD CONSTRAINT `FK_BA3F7E33C6862B` FOREIGN KEY (`pieza_tipo_id`) REFERENCES `pieza_tipo` (`id`),
  ADD CONSTRAINT `FK_BA3F7EC07AB4E2` FOREIGN KEY (`set_artefactos_id`) REFERENCES `set_artefactos` (`id`);

--
-- Restriccions per a la taula `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `FK_4B91E7024B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_4B91E702A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Restriccions per a la taula `dupe`
--
ALTER TABLE `dupe`
  ADD CONSTRAINT `FK_D5DDF9D21F22B4C7` FOREIGN KEY (`personaje_plantilla_id`) REFERENCES `personaje_plantilla` (`id`);

--
-- Restriccions per a la taula `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `FK_C49C530BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Restriccions per a la taula `equipo_personaje`
--
ALTER TABLE `equipo_personaje`
  ADD CONSTRAINT `FK_ED7A2DF7121EFAFB` FOREIGN KEY (`personaje_id`) REFERENCES `personaje` (`id`),
  ADD CONSTRAINT `FK_ED7A2DF723BFBED` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`);

--
-- Restriccions per a la taula `habilidad`
--
ALTER TABLE `habilidad`
  ADD CONSTRAINT `FK_4D2A2AF71F22B4C7` FOREIGN KEY (`personaje_plantilla_id`) REFERENCES `personaje_plantilla` (`id`);

--
-- Restriccions per a la taula `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `FK_AC6340B34B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `FK_AC6340B3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Restriccions per a la taula `personaje`
--
ALTER TABLE `personaje`
  ADD CONSTRAINT `FK_53A410881F22B4C7` FOREIGN KEY (`personaje_plantilla_id`) REFERENCES `personaje_plantilla` (`id`),
  ADD CONSTRAINT `FK_53A410888D7F0B5D` FOREIGN KEY (`arma_id`) REFERENCES `arma` (`id`),
  ADD CONSTRAINT `FK_53A41088A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Restriccions per a la taula `personaje_artefacto`
--
ALTER TABLE `personaje_artefacto`
  ADD CONSTRAINT `FK_62E96A79121EFAFB` FOREIGN KEY (`personaje_id`) REFERENCES `personaje` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_62E96A79C408C2D2` FOREIGN KEY (`artefacto_id`) REFERENCES `artefacto` (`id`) ON DELETE CASCADE;

--
-- Restriccions per a la taula `personaje_habilidad`
--
ALTER TABLE `personaje_habilidad`
  ADD CONSTRAINT `FK_659E9A32121EFAFB` FOREIGN KEY (`personaje_id`) REFERENCES `personaje` (`id`),
  ADD CONSTRAINT `FK_659E9A32621AA5D6` FOREIGN KEY (`habilidad_id`) REFERENCES `habilidad` (`id`);

--
-- Restriccions per a la taula `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_5A8A6C8DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;