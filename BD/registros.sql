-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2020 a las 00:46:13
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `bitacora_id` int(11) NOT NULL,
  `bitacora_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `bitacora_fecha` date NOT NULL,
  `bitacora_horaInicio` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `bitacora_horaFin` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `bitacora_tipoUsuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `bitacora_ano` int(4) NOT NULL,
  `bitacora_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(10) NOT NULL,
  `cliente_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_dni` varchar(8) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_celular` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_direccion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_correo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `compra_id` int(11) NOT NULL,
  `compra_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `compra_tipoComprobante` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `compra_serie` varchar(7) COLLATE utf8_spanish2_ci NOT NULL,
  `compra_numComprobante` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `compra_fecha` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `compra_impuesto` int(11) NOT NULL,
  `compra_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `compra_id_proveedor` int(11) NOT NULL,
  `compra_id_usuario` int(11) NOT NULL,
  `compra_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante`
--

CREATE TABLE `comprobante` (
  `comprobante_id` int(10) NOT NULL,
  `comprobante_nombre` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `comprobante_letraSerie` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `comprobante_serie` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `comprobante_numero` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `comprobante_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `comprobante`
--

INSERT INTO `comprobante` (`comprobante_id`, `comprobante_nombre`, `comprobante_letraSerie`, `comprobante_serie`, `comprobante_numero`, `comprobante_estado`) VALUES
(1, 'Boleta', 'BLT', '01', '000000', 1),
(2, 'Factura', 'FTC', '01', '0000000', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `detalleCompra_id` int(11) NOT NULL,
  `detalleCompra_cantidad` int(11) NOT NULL DEFAULT 1,
  `detalleCompra_precioC` decimal(11,2) NOT NULL DEFAULT 0.00,
  `detalleCompra_id_compra` int(11) NOT NULL,
  `detalleCompra_id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `detalleVenta_id` int(11) NOT NULL,
  `detalleVenta_cantidad` int(11) NOT NULL DEFAULT 1,
  `detalleVenta_precioV` decimal(10,2) NOT NULL DEFAULT 0.00,
  `detalleVenta_descuento` decimal(10,2) NOT NULL DEFAULT 0.00,
  `detalleVenta_id_venta` int(11) NOT NULL,
  `detalleVenta_id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `empresa_id` int(10) NOT NULL,
  `empresa_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_ruc` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_celular` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_correo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_impuesto` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_impuestoValor` int(11) NOT NULL,
  `empresa_moneda` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_simbolo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_logo` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`empresa_id`, `empresa_nombre`, `empresa_ruc`, `empresa_celular`, `empresa_direccion`, `empresa_correo`, `empresa_impuesto`, `empresa_impuestoValor`, `empresa_moneda`, `empresa_simbolo`, `empresa_logo`) VALUES
(1, 'CONFIGURAR', '000000000000', '000000000', 'SIN DIRECCÓN', 'corre@example.com', 'IGV', 18, 'SOLES', 'S/.', '../Assets/images/iconos/default-company.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_compra`
--

CREATE TABLE `historial_compra` (
  `hc_id` int(100) NOT NULL,
  `hc_id_compra` int(11) NOT NULL,
  `hc_producto` int(11) NOT NULL,
  `hc_id_lote` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `hc_fechaVe` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_venta`
--

CREATE TABLE `historial_venta` (
  `hv_id` int(10) NOT NULL,
  `hv_id_venta` int(11) NOT NULL,
  `hv_cantidad` int(11) NOT NULL,
  `hv_fechaVencimiento` date NOT NULL,
  `hv_id_lote` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `hv_id_proveedor` int(11) NOT NULL,
  `hv_id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `lab_id` int(10) NOT NULL,
  `lab_codigo` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `lab_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`lab_id`, `lab_codigo`, `lab_nombre`) VALUES
(1, 'LAB-4449181', 'PROCAPS'),
(2, 'LAB-4954312', 'ROXFARMA'),
(3, 'LAB-2251553', 'OQPHARMA'),
(4, 'LAB-6660034', 'ALKOFARMA'),
(5, 'LAB-4985435', 'TEVA'),
(6, 'LAB-7258896', 'PORTUGAL'),
(7, 'LAB-9853267', 'B.BRAUN'),
(8, 'LAB-2492008', 'FARMINDUSTRIA'),
(9, 'LAB-3967669', 'IQFARMA'),
(10, 'LAB-86423110', 'LMB H. COLICHÓN'),
(11, 'LAB-86275311', 'MEDROCK'),
(12, 'LAB-23594512', 'CIFARMA'),
(13, 'LAB-21796013', 'INDUFAR'),
(14, 'LAB-88554314', 'ABBOTT'),
(15, 'LAB-39441215', 'PFIZER'),
(16, 'LAB-33993416', 'SANOFI'),
(17, 'LAB-05900917', 'FARMEDIC'),
(18, 'LAB-44905818', 'CAFERMA'),
(19, 'LAB-26976919', 'QUILAB'),
(20, 'LAB-75504420', 'COASPHARMA'),
(21, 'LAB-02425021', 'GENFAR'),
(22, 'LAB-93722922', 'CONTAC'),
(23, 'LAB-91699723', 'BMC FARMA'),
(24, 'LAB-37850424', 'TERBONOVA'),
(25, 'LAB-54929025', 'INTRADEVCO'),
(26, 'LAB-99834626', 'INFERMED'),
(27, 'LAB-40496427', 'ALPHARMA.CO'),
(28, 'LAB-79533828', 'MEDIFARMA'),
(29, 'LAB-59780629', 'INTIPHARMA'),
(30, 'LAB-56073830', 'SYNTOFARMA'),
(31, 'LAB-95920331', 'DROKASA PERÚ'),
(33, 'LAB-09814432', 'GEMEFAR'),
(34, 'LAB-89919833', 'MARFAN'),
(35, 'LAB-60829734', 'QUILLA PHARMA'),
(36, 'LAB-67222135', 'GABBLAN'),
(37, 'LAB-86761636', 'NATURGEN'),
(38, 'LAB-38309237', 'BONAPHARM'),
(39, 'LAB-57355338', 'MEGALABS'),
(40, 'LAB-05116539', 'SWISS GARNIER'),
(41, 'LAB-96024940', 'GENOMMA LAB.'),
(42, 'LAB-75077941', 'INDUQUÍMICA'),
(43, 'LAB-88620642', 'DROPESAC'),
(44, 'LAB-64200443', 'SHERFARMA'),
(45, 'LAB-60336344', 'TERVOL'),
(46, 'LAB-55591645', 'DAEWON'),
(47, 'LAB-74562846', 'GRUNENTHAL'),
(48, 'LAB-76212947', 'BAGO'),
(49, 'LAB-68418348', 'LUDBER'),
(50, 'LAB-15829749', 'PERUFARMA'),
(51, 'LAB-63087250', 'PHIL INTER PHARMA'),
(52, 'LAB-39820351', 'PHARMED CORPORATION'),
(53, 'LAB-23864052', 'FARVET'),
(54, 'LAB-44915353', 'PHARMETIQUE'),
(55, 'LAB-17894354', 'BAYER'),
(56, 'LAB-11731255', 'ALBIS'),
(57, 'LAB-68392656', 'CIPA'),
(58, 'LAB-17276357', 'LIPHARMA'),
(59, 'LAB-43393558', 'HERSIL'),
(60, 'LAB-56598359', 'MEDA'),
(61, 'LAB-50689960', 'EUROFARMA'),
(62, 'LAB-44447361', 'PHARMAGEN'),
(63, 'LAB-23648562', 'DIPHA'),
(64, 'LAB-06847263', 'LABOT'),
(65, 'LAB-77998564', 'DANY'),
(66, 'LAB-34918165', 'PAKFARMA'),
(67, 'LAB-48775066', 'LANSIER'),
(68, 'LAB-26558967', 'TUINIES'),
(69, 'LAB-29253268', 'LUSA'),
(70, 'LAB-82563569', 'SOFTYS'),
(71, 'LAB-44339570', 'CKF INDUSTRIAL'),
(72, 'LAB-50349071', 'FAMILIA'),
(73, 'LAB-26687572', 'EXELTIS'),
(74, 'LAB-86870773', 'P&G'),
(75, 'LAB-60495674', 'THE ACME'),
(76, 'LAB-68120075', 'JPS'),
(77, 'LAB-25255876', 'SMA S.A.C'),
(78, 'LAB-90012677', 'JOHNSON´S'),
(79, 'LAB-80235478', 'OMYGAD'),
(80, 'LAB-58219979', 'STEVIA'),
(81, 'LAB-0667461', 'GES FARMA'),
(82, 'LAB-5746732', 'LABOGEN'),
(83, 'LAB-7612573', 'LABORATORIO VICTOR DROGUERIA'),
(84, 'LAB-3809194', 'PHARMA GEN'),
(85, 'LAB-9249355', 'GALENO'),
(86, 'LAB-5187536', 'EUROFARMA'),
(87, 'LAB-8908537', 'PORTUGAL'),
(88, 'LAB-7111938', 'FARMAINDUSTRIA'),
(89, 'LAB-6681889', 'BIOTECH'),
(90, 'LAB-60376110', 'SIEGFRIED'),
(91, 'LAB-88358111', 'IQFARMA'),
(92, 'LAB-01567212', 'RECARGA MOVIL'),
(93, 'LAB-97741813', 'Pharmed Corporation E.S.C.'),
(94, 'LAB-13872714', 'POLICLINICO VELASQUEZ'),
(95, 'LAB-05712915', 'Genfar'),
(96, 'LAB-81230716', 'Medrock'),
(97, 'LAB-30157517', 'Panalab'),
(98, 'LAB-54132818', 'Sanofi'),
(99, 'LAB-71294319', 'Novax'),
(100, 'LAB-83822420', 'ITC FARMACEUTICA'),
(101, 'LAB-90923521', 'Ache'),
(102, 'LAB-08757422', 'Faes Farma'),
(103, 'LAB-60892723', 'Zambon'),
(104, 'LAB-10376424', 'Teva'),
(105, 'LAB-22501325', 'Roche'),
(106, 'LAB-85554726', 'Bayer'),
(107, 'LAB-44244927', 'GSK'),
(108, 'LAB-36761428', 'MediSur'),
(109, 'LAB-71048729', 'Quilab'),
(110, 'LAB-52749930', 'ITALFARMACO'),
(111, 'LAB-02397631', 'Genomina Lab'),
(112, 'LAB-22761532', 'JPS Distribuciones'),
(113, 'LAB-12866133', 'Linea DCI'),
(114, 'LAB-92837134', 'MediFarma'),
(115, 'LAB-55020735', 'LABOT'),
(116, 'LAB-95178736', 'JPS'),
(117, 'LAB-09784937', 'AC Farma S.A.'),
(118, 'LAB-24429238', 'OQFARMA'),
(119, 'LAB-75799039', 'Laboratorio Ferrer'),
(120, 'LAB-16604140', 'Laboratorio Vitalis'),
(121, 'LAB-86586041', 'Laboratorio Grunenthal'),
(122, 'LAB-15329142', 'Laboratorio MSD'),
(123, 'LAB-64880743', 'Lab. Altia'),
(124, 'LAB-29662444', 'Lab. Deutsche Pharma S.A.C'),
(125, 'LAB-49108645', 'Nordic Pharmaceutical Company S.A.C.'),
(126, 'LAB-83341446', 'SherFARMA'),
(127, 'LAB-32657747', 'Lab. Reyoung Pharmaceutical'),
(128, 'LAB-38820248', 'Lab. CARNOT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `lote_id` int(10) NOT NULL,
  `lote_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `lote_cantUnitario` int(11) NOT NULL DEFAULT 1,
  `lote_fechaVencimiento` date NOT NULL,
  `lote_id_producto` int(11) NOT NULL,
  `lote_id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `present_id` int(10) NOT NULL,
  `present_codigo` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `present_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`present_id`, `present_codigo`, `present_nombre`) VALUES
(1, 'PRE-9121281', 'OVULOS'),
(2, 'PRE-5023802', 'JARABE'),
(3, 'PRE-8096503', 'TABLETAS'),
(4, 'PRE-3687864', 'CREMA'),
(5, 'PRE-5084015', 'UNI TOMA'),
(6, 'PRE-8021506', 'GEL'),
(7, 'PRE-2998067', 'CAPSULAS'),
(8, 'PRE-2707558', 'AMPOLLA'),
(9, 'PRE-4123789', 'FRASCO AMPOLLA'),
(10, 'PRE-56236810', 'TEST'),
(11, 'PRE-88356211', 'FRASCO DE MUESTRA ESTERIL'),
(12, 'PRE-45356812', 'LATA'),
(13, 'PRE-69441013', 'SOBRE'),
(14, 'PRE-22035914', 'CAPSULAS BLANDAS'),
(15, 'PRE-74843115', 'PAÑAL'),
(16, 'PRE-73148416', 'GOTAS OFTALMICAS'),
(17, 'PRE-39252017', 'GOTAS ORALES'),
(18, 'PRE-87826618', 'LITRO'),
(19, 'PRE-46518419', 'MEDIO LITRO'),
(20, 'PRE-67328520', 'CENTIMETROS CUBICOS'),
(21, 'PRE-47072921', 'PAQUETE'),
(22, 'PRE-69946522', 'ROLLO'),
(23, 'PRE-58113423', 'VIAL'),
(24, 'PRE-22326324', 'COMPRIMIDOS RECUBIERTOS'),
(25, 'PRE-92901125', 'SACHET'),
(26, 'PRE-90190826', 'UNGUENTO'),
(27, 'PRE-52954727', 'TABLETAS DE LIBERACION RETARDADA'),
(28, 'PRE-4892032', 'GOTAS'),
(29, 'PRE-7486376', 'GRAGEAS'),
(30, 'PRE-9394487', 'EFERVECENTE'),
(31, 'PRE-2440548', 'POMADA'),
(32, 'PRE-1848569', 'GEL/CREMA'),
(33, 'PRE-49794510', 'TABLETA'),
(34, 'PRE-15799011', 'SOLUCION ORAL'),
(35, 'PRE-41190512', 'BOTELLA DE 1 LITRO'),
(36, 'PRE-40764713', 'BOTELLA DE 1/2 LITRO'),
(37, 'PRE-02448114', 'TABLETA RECUBIERTA'),
(38, 'PRE-91002315', 'ANTITUSIVO'),
(39, 'PRE-70496716', 'ANTIALERGICO'),
(40, 'PRE-63148517', 'ANTIHISTAMINICO'),
(41, 'PRE-31086918', 'AMPOLLA RECUBIERTAS'),
(42, 'PRE-75985719', 'RECARGA MOVIL'),
(43, 'PRE-77770420', 'Tabletas Recubiertas'),
(44, 'PRE-72470321', 'Curaciones'),
(45, 'PRE-60840222', 'Inyectable'),
(46, 'PRE-00667223', 'Helado'),
(47, 'PRE-80973924', 'Topico'),
(48, 'PRE-28088225', 'Medicina General'),
(49, 'PRE-55368826', 'Comprimidos'),
(50, 'PRE-44643727', 'Comprimidos Recubiertos'),
(51, 'PRE-17332128', 'Capsulas Blandas'),
(52, 'PRE-76781529', 'Ampollas Bebibles'),
(53, 'PRE-05544930', 'Tabletas Masticables'),
(54, 'PRE-28943531', 'OQFARMA S.A.C.'),
(55, 'PRE-54394332', 'Tabletas Recubiertas Gastrorresistentes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `prod_id` int(10) NOT NULL,
  `prod_codigo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `prod_codigoin` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `prod_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `prod_concentracion` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `prod_adicional` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `prod_imagen` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `prod_precioC` decimal(10,2) NOT NULL DEFAULT 0.00,
  `prod_precioV` decimal(10,2) NOT NULL DEFAULT 0.00,
  `prod_porcentaje` int(5) NOT NULL DEFAULT 0,
  `prod_id_lab` int(11) NOT NULL,
  `prod_id_tipo` int(11) NOT NULL,
  `prod_id_present` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`prod_id`, `prod_codigo`, `prod_codigoin`, `prod_nombre`, `prod_concentracion`, `prod_adicional`, `prod_imagen`, `prod_precioC`, `prod_precioV`, `prod_porcentaje`, `prod_id_lab`, `prod_id_tipo`, `prod_id_present`) VALUES
(1, '7751349104517', '009243411', 'VAXIGEL', '500 +100000 UI', 'METRONIDAZOL + NISTAFEN', '../Assets/images/producto/medicamento.png', '1.80', '2.52', 40, 1, 1, 1),
(2, '7750281001663', '001978052', 'NISTAFEM', '500 +100000', 'METRONIDAZOL +NISTATINA', '../Assets/images/producto/medicamento.png', '2.35', '2.98', 40, 2, 1, 1),
(3, '7840653000742', '007316963', 'CLINOMIN', 'DIHIDROXIPROGESTERONA 150 mg + ENANTATO DE ESTRADIOL 10 mg', 'ANTICONCEPTIVO', '../Assets/images/producto/medicamento.png', '10.00', '20.00', 40, 13, 1, 8),
(4, '7750942435011', '004899704', 'AMOXICILINA', '500 mg', 'ANTIBIOTICO', '../Assets/images/producto/medicamento.png', '0.22', '0.50', 40, 9, 3, 3),
(5, '7754662000351', '007744985', 'EVA TEST', 'LAPICERO', 'PRUEBA PARA DIAGNOSTICO D EEMBARAZO', '../Assets/images/producto/medicamento.png', '4.00', '8.00', 40, 3, 1, 10),
(6, '7754662000634', '000769386', 'CONTROL GYN', 'TIRA', 'PRUEBA PARA DIAGNOSTICO DE EMBARAZO', '../Assets/images/producto/medicamento.png', '1.00', '5.00', 40, 3, 1, 10),
(7, '7753820001704', '008973537', 'CEFTRIAXONA', '1 gr.', 'ANTIBIOTICO CEFALOSPORINA 3ra GENERACION', '../Assets/images/producto/medicamento.png', '2.30', '4.00', 40, 62, 4, 23),
(8, '7702134335548', '007961288', 'PONSTAN', '200 mg. NAPROXENO SODICO', 'TRATAMIENTO DOLORES MENSTRUALES', '../Assets/images/producto/medicamento.png', '0.90', '1.50', 40, 15, 1, 3),
(9, '7752692000310', '008450549', 'DROKSE', 'MEDROXIPROGESTERONA 150', 'ANTICONCEPTIVO 3 MESES', '../Assets/images/producto/medicamento.png', '13.00', '25.09', 40, 66, 1, 8),
(10, '7750215009147', '0057038910', 'DOXICICLINA', '100 mg:', 'ANTIBACTERIANO SISTEMICO', '../Assets/images/producto/medicamento.png', '0.22', '0.50', 40, 6, 4, 7),
(11, '7750215001721', '0070528811', 'CLORFENAMINA MALEATO', '4 mg.', 'ANTIHISTAMINICO', '../Assets/images/producto/medicamento.png', '0.05', '0.50', 40, 6, 4, 3),
(12, '7730698004532', '0030885012', 'PLIDAN COMPUESTO NF', 'PARGEVERINA CLORHIDRATO 10mg. CLONIXINATO DE LISINA 125mg.', 'ANTIESPASMODICO', '../Assets/images/producto/medicamento.png', '1.00', '1.50', 40, 39, 4, 7),
(13, '7750304005531', '0009153813', 'DEXAMETASONA', '4 mg:', 'CORTICOIDE', '../Assets/images/producto/medicamento.png', '0.25', '99999999.99', 40, 8, 5, 3),
(14, '7702605151660', '0055453614', 'PARACETAMOL', '500 mg:', 'ANALGESICO - ANTIPERICO', '../Assets/images/producto/medicamento.png', '0.20', '0.50', 40, 21, 4, 3),
(15, '7702605151196', '0085152815', 'IBUPROFENO', '400 mg', 'ANTIINFLAMATORIO', '../Assets/images/producto/medicamento.png', '0.10', '0.50', 40, 21, 4, 3),
(16, '8906014102377', '0036175616', 'DIPHADIC LONG 75', 'DICLOFENACO 75 mg/3ml', 'ANALGESICO', '../Assets/images/producto/medicamento.png', '0.80', '1.50', 40, 63, 4, 8),
(17, '7751128000627', '0035226017', 'PENICILINA G PROCAINICA', '1000 000 UI', 'ANTIBIOTICO', '../Assets/images/producto/medicamento.png', '2.00', '3.00', 40, 64, 5, 23),
(18, '7750500001160', '0011516718', 'BENCILPENICILINA BENZATINICA', '1200 000 UI', 'ANTIBIOTICO', '../Assets/images/producto/medicamento.png', '2.00', '3.00', 40, 65, 5, 23),
(19, '7750304000178', '0086222519', 'CEFADROXILO', '250 mg / 5 ml', 'POLVO PARA SUSPENCION ORAL', '../Assets/images/producto/medicamento.png', '9.50', '15.01', 40, 8, 2, 2),
(20, '7750215004722', '0065751820', 'DICLOXACILINA', '500 mg', 'ANTIBACTERIANO', '../Assets/images/producto/medicamento.png', '0.28', '0.31', 40, 6, 5, 7),
(21, '7759307014502', '0082025221', 'MEJORAX', '500 MG', 'PARACETAMOL', '../Assets/images/producto/medicamento.png', '0.35', '0.50', 40, 28, 4, 3),
(22, '7751257014175', '0025243222', 'ANTIGRIPINA PLUS', 'PARACETAMOL FENILEFRINA CLORFENAMINA', '500', '../Assets/images/producto/medicamento.png', '0.34', '1.00', 40, 19, 4, 24),
(23, '123456', '009186531', 'DEXAMETASONA', '4 MG', 'Vía Oral', '../Assets/images/producto/medicamento.png', '20.00', '1.00', 0, 81, 6, 24),
(24, '1083119', '000661612', 'AMBROXOL JARABE', '30MG/5ML', 'MUCOLITICO', '../Assets/images/producto/medicamento.png', '12.00', '12.00', 40, 86, 14, 27),
(25, '1076569', '001495493', 'AMOXICILINA JARABE', '250MG/5ML', 'ANTIBACTERIANO', '../Assets/images/producto/medicamento.png', '20.00', '10.00', 0, 86, 15, 27),
(26, '1128279', '000971664', 'CETIRIZINA', '5MG/5ML', 'JARABE', '../Assets/images/producto/medicamento.png', '10.00', '9.00', 40, 86, 6, 27),
(27, '1045709', '009705215', 'CLORFENAMINA MALEATO / JARABE', '2MG/5ML', 'ANTIALERGICO', '../Assets/images/producto/medicamento.png', '10.00', '10.00', 40, 86, 6, 27),
(28, '987', '003686996', 'AMPOLLA DE 38', 'ML', 'AMP', '../Assets/images/producto/medicamento.png', '28.00', '38.00', 40, 82, 6, 41),
(29, '456178', '005938517', 'AMPOLLA DE 25', 'ML', 'AMP', '../Assets/images/producto/medicamento.png', '14.00', '25.00', 0, 82, 6, 41),
(30, '1470', '000639658', 'AMPOLLA DE 30', 'ML', 'AMP', '../Assets/images/producto/medicamento.png', '15.00', '30.00', 40, 82, 6, 41),
(31, '1086329', '001418959', 'DEXTROMETORFANO JARABE', '15MG/5ML', 'JARABE', '../Assets/images/producto/medicamento.png', '10.00', '10.00', 40, 86, 6, 38),
(32, '105379', '0085988310', 'DICLOXACILINA JARABE', '250MG/5ML', 'LAB. PORTUGAL', '../Assets/images/producto/medicamento.png', '10.00', '10.00', 40, 86, 15, 27),
(33, '10916918', '0064576111', 'DICLOXACILINA JARABE / IQFARMA', '250MG/5ML', 'LAB. IQFARMA', '../Assets/images/producto/medicamento.png', '9.00', '9.50', 0, 90, 15, 27),
(34, '1040959', '0032386312', 'LORATADINA / JARABE / LAB. PORTUGAL', '5MG/5ML', 'LAB. PORTUGAL', '../Assets/images/producto/medicamento.png', '7.00', '10.00', 0, 86, 18, 27),
(35, '116489', '0079075013', 'PARACETAMOL /JARABE / LAB. PORTUGAL', '120MG/5ML', 'LAB. PORTUGAL', '../Assets/images/producto/medicamento.png', '7.15', '10.00', 0, 86, 9, 27),
(36, '1090029', '0067480314', 'PARACETAMOL / GOTAS /LAB. PORTUGAL', '100MG/10ML', 'LAB. PORTUGAL', '../Assets/images/producto/medicamento.png', '10.00', '11.50', 0, 86, 9, 25),
(37, '1084729', '0077827215', 'AMPICILINA / CAP. / LAB. PORTUGAL', '500MG', 'ANTIBITICO DE AMPLIO ESPECTRO', '../Assets/images/producto/medicamento.png', '10.00', '1.00', 40, 86, 15, 26),
(38, '1044979', '0090742416', 'AMOXICILINA / CAP. / LAB. PORTUGAL', '500 MG', 'BACTERICIDA', '../Assets/images/producto/medicamento.png', '10.00', '1.00', 0, 86, 15, 26),
(39, '2065850', '0093623817', 'AZITROMICINA / CAP. / LAB. PORTUGAL', '500 MG', 'ANTIBIOTICO', '../Assets/images/producto/medicamento.png', '100.00', '4.00', 0, 86, 15, 24),
(40, '1236955', '0035026018', 'RECARGA MOVIL', 'Movistar', 'Movistar', '../Assets/images/producto/medicamento.png', '5.00', '5.00', 0, 91, 19, 42),
(41, '1031809', '0083453919', 'ATORVASTATINA / LAB. PORTUGAL', '10 mg', 'Agente Modificador de Lipídos', '../Assets/images/producto/medicamento.png', '10.00', '1.00', 0, 86, 6, 33),
(42, '1121326', '0048610320', 'Amlodipino / Lab. Portugal', '5 mg', 'TB', '../Assets/images/producto/medicamento.png', '10.00', '0.30', 0, 86, 6, 24),
(43, '1091908', '0006634121', 'Captopril / Lab. Portugal', '25 mg', 'TB', '../Assets/images/producto/medicamento.png', '20.00', '0.30', 0, 86, 6, 33),
(44, '1051409', '0072404922', 'Acido Folico / Lab. Portugal', '0.5 mg', 'TB', '../Assets/images/producto/medicamento.png', '10.00', '0.50', 0, 86, 6, 24),
(45, '2013320', '0070165123', 'Clorfernamina Maleato / Tabletas', '4 mg', 'Tabletas', '../Assets/images/producto/medicamento.png', '10.00', '1.00', 0, 86, 18, 24),
(46, '1114058', '0040740524', 'Celecoxib / Cap.', '200 mg', 'Capsula', '../Assets/images/producto/medicamento.png', '10.00', '1.00', 0, 86, 10, 26),
(47, '44555', '0020146225', 'RECARGA CLARO', 'Claro', 'Claro', '../Assets/images/producto/medicamento.png', '5.00', '5.00', 0, 91, 19, 42),
(48, '1035539', '0036521226', 'Eritromicina / TB.', '500 mg', 'Tb. Rec.', '../Assets/images/producto/medicamento.png', '100.00', '3.50', 0, 86, 15, 43),
(49, '120333', '0047126527', 'Ampolla de 28', 'ML', 'AMP', '../Assets/images/producto/medicamento.png', '28.00', '28.00', 0, 82, 6, 41),
(50, '1478522', '0040260928', 'AMPOLLA DE 60', 'ML', 'AMP', '../Assets/images/producto/medicamento.png', '60.00', '60.00', 0, 82, 6, 41),
(51, '14785236444', '0035776729', 'Curacion', 'Medica', 'CC', '../Assets/images/producto/medicamento.png', '20.00', '20.00', 0, 82, 20, 44),
(52, '12010222', '0090895730', 'Inyectable', 'Topico', 'INY', '../Assets/images/producto/medicamento.png', '6.00', '6.00', 0, 82, 20, 45),
(53, '1073629', '0094131631', 'Dolo Neuro Press Forte', '151 mg', 'Tb. Rec.', '../Assets/images/producto/medicamento.png', '4.50', '4.50', 0, 92, 8, 37),
(54, '120000', '0060206932', 'Helado', 'Crema/ Hielo', 'Ice', '../Assets/images/producto/medicamento.png', '3.00', '3.00', 0, 82, 21, 46),
(55, '4444', '0061582033', 'Tratamiento', 'Medico', 'TTT', '../Assets/images/producto/medicamento.png', '85.00', '85.00', 0, 82, 22, 48),
(56, '44444', '0043233934', 'Consulta Medica', 'Enfermería', 'C-M', '../Assets/images/producto/medicamento.png', '50.00', '50.00', 40, 93, 23, 48),
(57, '11111', '0082113035', 'Laboratorio Clinico', 'Pruebas', 'LAB.', '../Assets/images/producto/medicamento.png', '100.00', '100.00', 40, 93, 24, 48),
(58, '7441000', '0075301836', 'Ibuprofeno / Genfar', '400 mg', 'GENFAR', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 94, 7, 37),
(59, '1111111', '0079211637', 'Dolo Quimagesico-C50', '550 mg', 'Cap.', '../Assets/images/producto/medicamento.png', '3.50', '3.50', 0, 87, 8, 26),
(60, '111159', '0024033038', 'Migralivia', '565 mg', 'Tab.', '../Assets/images/producto/medicamento.png', '20.00', '1.50', 0, 95, 25, 24),
(61, '11750', '0009834139', 'Urzac Flex', '7,5 mg', 'Meloxicam y Mesilato', '../Assets/images/producto/medicamento.png', '4.00', '4.00', 0, 96, 10, 24),
(62, '0388', '0020111540', 'Buscapina', '510 mg', '(Paracetamol y Hioscina B.)', '../Assets/images/producto/medicamento.png', '2.50', '2.50', 0, 97, 6, 49),
(63, '1111418', '0028754941', 'Novalgeze', '10 mg', '(Keterolaco)', '../Assets/images/producto/medicamento.png', '2.00', '2.00', 0, 98, 8, 37),
(64, '010003', '0027178242', 'Novalgina', '500 mg', '(Metamizol Sódico)', '../Assets/images/producto/medicamento.png', '2.00', '2.00', 0, 97, 9, 24),
(65, '968000', '0018717643', 'NatalBen-Supra', '500 mg', 'Minerales y Omega 3', '../Assets/images/producto/medicamento.png', '2.00', '2.50', 0, 99, 6, 51),
(66, '11122748', '0089356344', 'BioBroncol', '530 mg', '(Cefalexina+Ambroxol)', '../Assets/images/producto/medicamento.png', '3.50', '3.50', 40, 90, 15, 26),
(67, '105600629', '0058115045', 'Welton', '240 ml', '(Tiamina+Piridoxina+Ciproheptadina)', '../Assets/images/producto/medicamento.png', '55.00', '55.00', 0, 103, 6, 27),
(68, '1904361', '0061260946', 'Sintocalmy', '300 mg', '(Passiflora Incarnata)', '../Assets/images/producto/medicamento.png', '5.00', '5.00', 0, 100, 6, 50),
(69, '0220', '0015887347', 'Flutox', '120 ml', '(Cloperastina Fendizoato)', '../Assets/images/producto/medicamento.png', '40.00', '40.00', 0, 102, 14, 27),
(70, '313000', '0006086048', 'Potenciator', '5 g', '(Aspartato de Arginina)', '../Assets/images/producto/medicamento.png', '5.00', '5.00', 0, 101, 26, 52),
(71, '036036', '0053135849', 'Monurol', '3 g', '(Fosfomicina)', '../Assets/images/producto/medicamento.png', '10.00', '25.00', 40, 102, 27, 34),
(72, '20319250', '0032779150', 'AproForte', '550 mg', '(Naproxeno Sódico)', '../Assets/images/producto/medicamento.png', '3.50', '3.50', 0, 88, 8, 43),
(73, '149200', '0028724951', 'Bactrim Forte', '800mg + 160mg', '(Sulfametoxazol+Trimetoprima)', '../Assets/images/producto/medicamento.png', '3.00', '3.00', 0, 104, 28, 49),
(74, '059800', '0046852752', 'Bactrim Niños', '400mg+80mg', '(Sulfametoxazol+Trimetoprima)', '../Assets/images/producto/medicamento.png', '2.50', '2.50', 0, 104, 28, 49),
(75, '11005698', '0008104953', 'Apronax', '550 mg', '(Naproxeno Sódico)', '../Assets/images/producto/medicamento.png', '3.50', '3.50', 0, 105, 8, 37),
(76, '10600409', '0031262654', 'Nastiflu-Antigripal', '500 mg', 'Tb.', '../Assets/images/producto/medicamento.png', '2.50', '2.50', 40, 103, 29, 24),
(77, '2005000092', '0003314655', 'Panadol Forte', '500+65MG', '(Paracetamol+Cafeina)', '../Assets/images/producto/medicamento.png', '2.50', '2.50', 40, 106, 25, 24),
(78, '019016', '0057741956', 'Efetamol', '1 g', '(Paracetamol 1000 mg)', '../Assets/images/producto/medicamento.png', '5.00', '5.00', 40, 109, 8, 30),
(79, '1010099', '0094275157', 'CHAO', '500mg+15mg', '(Paracetamol+Dextrometorfano+Clorfenima)', '../Assets/images/producto/medicamento.png', '3.50', '3.50', 40, 110, 25, 33),
(80, '1905000005', '0077153058', 'Panadol Antigripal', '151 mg', 'NF', '../Assets/images/producto/medicamento.png', '3.50', '3.50', 40, 106, 29, 24),
(81, '1904000097', '0087908659', 'Panadol Celeste', '500 mg', '(Paracetamol)', '../Assets/images/producto/medicamento.png', '3.00', '3.00', 40, 106, 8, 24),
(82, '010101', '0073797560', 'Rolod Cox', '15 mg', '(Meloxicam)', '../Assets/images/producto/medicamento.png', '2.50', '2.50', 40, 88, 10, 33),
(83, '10412900', '0054599061', 'Cimocal', '500 mg', '(Ciprofloxacino)', '../Assets/images/producto/medicamento.png', '3.00', '3.00', 40, 95, 15, 37),
(84, '10771900', '0012399962', 'Claritromax', '500 mg', '(Claritromicina)', '../Assets/images/producto/medicamento.png', '4.00', '4.50', 40, 107, 15, 43),
(85, '10863900', '0007294163', 'Clindamed', '300 mg', '(Clindamicina)', '../Assets/images/producto/medicamento.png', '3.50', '3.50', 40, 95, 15, 26),
(86, '10602239', '0035449564', 'Repriman', '500 mg', '(Metamizol Sodico)', '../Assets/images/producto/medicamento.png', '1.50', '1.50', 40, 108, 9, 49),
(87, '448120', '0010977565', 'CB- ZADOL', '250+250 mg', '(Paracetamol+Acido Acetiolsalicilico)', '../Assets/images/producto/medicamento.png', '2.50', '2.50', 40, 88, 25, 24),
(88, '2021340', '0013551366', 'Clotrimazol /Tabletas Vaginales', '500 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '2.50', '2.50', 40, 86, 15, 28),
(89, '1070849', '0094989267', 'Keterolaco /TB', '10 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 86, 8, 24),
(90, '1022479', '0032893468', 'Ciprofloxacino / TB', '500 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '2.50', '3.00', 40, 86, 15, 37),
(91, '11131049', '0025226069', 'Cloranfenicol / TB', '500 mgf', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 86, 28, 26),
(92, '108079700', '0009921570', 'Fluconazol / Cap.', '150 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '1.50', '2.00', 40, 86, 30, 26),
(93, '101465900', '0030909671', 'Furazolidona / Tb.', '100 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 86, 28, 33),
(94, '106494900', '0032492372', 'Dimenhidrinato / Tb', '50 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 86, 31, 33),
(95, '111378800', '0091055273', 'Loperamida / Tb.', '2 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 86, 28, 24),
(96, '011066999', '0059762974', 'Loratadina / Tb.', '10 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 86, 18, 33),
(97, '2012090', '0071956875', 'Terbinafina / Crema', '20 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '8.00', '8.00', 40, 86, 33, 32),
(98, '103238900', '0054293276', 'Metformina Clorhidrato', '850 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 86, 34, 43),
(99, '00201610', '0001008277', 'Prednisona /Tab.', '20 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 86, 37, 33),
(100, '002027592', '0098034878', 'Prednisona / TB', '50 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 86, 37, 24),
(101, '0101031469', '0062384079', 'Meloxicam / Tb.', '15 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 86, 10, 24),
(102, '10924080', '0055452680', 'Metrodinazol /Tb.', '500 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 86, 35, 33),
(103, '2046080', '0077572981', 'Paracetamol / TB.', '500 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 86, 8, 24),
(104, '1072479', '0058909582', 'Sulfametoxazol+Trimetoprima', '800mg+160mg', 'Tb.', '../Assets/images/producto/medicamento.png', '100.00', '1.00', 40, 86, 28, 24),
(105, '1092112800', '0095532283', 'Omeprazol', '20 mg', 'Capsulas', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 86, 38, 26),
(106, '10712489', '0037450484', 'Ranitidina / Tb.', '300 mg', 'TB.', '../Assets/images/producto/medicamento.png', '100.00', '1.00', 40, 86, 38, 24),
(107, '1060798', '0005348685', 'Tetraciclina', '500 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '1.50', '1.50', 40, 86, 15, 26),
(108, '201020800', '0002709086', 'Diclofenaco / TB.', '50 mg', 'Lab. IQFARMA', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 90, 8, 24),
(109, '201572600', '0030577287', 'Alprazolam /TB.', '0.5 mg', 'Tab.', '../Assets/images/producto/medicamento.png', '1.50', '2.00', 40, 87, 39, 24),
(110, '11199237', '0067029988', 'Cefadrina /JB', '250 mg/ 5ml', 'JB', '../Assets/images/producto/medicamento.png', '8.00', '8.00', 40, 87, 15, 27),
(111, '20175510', '0092670389', 'Azitromicina /JB', '200 mg/5 ml', 'JB', '../Assets/images/producto/medicamento.png', '12.50', '13.00', 40, 87, 15, 27),
(112, '10542459', '0041989090', 'Cetirizina /Jarabe', '5 mg/ 5 ml', 'Lab. Farmaindustria', '../Assets/images/producto/medicamento.png', '9.00', '9.50', 40, 87, 18, 27),
(113, '109089900', '0034559091', 'Dolodran Extra Forte', '50+500 mg', 'Forte', '../Assets/images/producto/medicamento.png', '2.50', '2.50', 40, 86, 8, 37),
(114, '10823438', '0011643192', 'Captopril / Lab. Farmaindustria', '25 mg', 'Farm. Indus', '../Assets/images/producto/medicamento.png', '0.40', '0.40', 40, 87, 6, 24),
(115, '1018151900', '0025592493', 'Cetirizina / Tab.', '10 mg', 'Farm. Indus.', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 87, 18, 24),
(116, '10246478', '0041697994', 'Clonazepam / Tab.', '0,5 mg', 'Tab.', '../Assets/images/producto/medicamento.png', '100.00', '2.50', 40, 87, 39, 24),
(117, '108204900', '0000165295', 'Alerliv', '5 mg', '(Levocetirizina)', '../Assets/images/producto/medicamento.png', '3.00', '3.50', 40, 86, 18, 37),
(118, '1105351800', '0093389996', 'Enalapril / Tab. / Farma Industria', '10 mg', 'Tab. Farma Industria', '../Assets/images/producto/medicamento.png', '100.00', '0.50', 40, 86, 6, 33),
(119, '1111110026', '0049560597', 'Sulfato Ferroso / Tab.', '300 mg', 'S.V.', '../Assets/images/producto/medicamento.png', '1.00', '1.50', 40, 93, 26, 24),
(120, '1092782900', '0063647098', 'Naproxeno Sodico / Tab. / Farma Industria', '550 mg', 'Via Oral', '../Assets/images/producto/medicamento.png', '120.00', '1.00', 40, 87, 7, 24),
(121, '1020293900', '0000955699', 'Furosemida / Tab.', '40 mg', 'Via Oral', '../Assets/images/producto/medicamento.png', '150.00', '1.00', 40, 87, 6, 24),
(122, '1079075900', '00695000100', 'Ketoconazol / Crema', '2 %', '10 mg', '../Assets/images/producto/medicamento.png', '8.00', '8.00', 40, 87, 30, 32),
(123, '106762590', '00933153101', 'Simeticona /Tb. / 80 mg', 'Via Oral', 'Adultos', '../Assets/images/producto/medicamento.png', '2.50', '2.50', 40, 87, 6, 53),
(124, '10668549', '00710211102', 'Simeticona / Tb. / 40 mg', 'Via Oral', 'Niños', '../Assets/images/producto/medicamento.png', '140.00', '2.00', 40, 87, 6, 53),
(125, '10834248', '00940804103', 'Lincomicina / Tb.', '500 mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '2.00', '2.00', 40, 87, 15, 26),
(126, '191092', '00526007104', 'Paracetamol / Tb. / JPS Distrib.', '500 mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '120.00', '1.20', 0, 111, 9, 24),
(127, '20309940', '00857592105', 'Paracetamol / Tb. / Quilab', '500 mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '110.00', '1.50', 40, 108, 9, 24),
(128, '1045079', '00585653106', 'Gripaliv', '500+5+4MG', '(Paracetamol+Clorfenamina+Fenilefrina)', '../Assets/images/producto/medicamento.png', '400.00', '2.50', 40, 86, 29, 33),
(129, '1020808', '00230375107', 'Gabapentina', '300 mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '100.00', '2.50', 40, 81, 6, 26),
(130, '1094899', '00604758108', 'Losartan /Tb. / Labogen', '50 mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '100.00', '1.00', 40, 81, 6, 24),
(131, '11112500930', '00043047109', 'Dicloxacilina / Tb. / IQFARMA', '500 mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '411.00', '2.00', 40, 90, 15, 26),
(132, '10922669', '00583009110', 'Aciclovir / TB', '800 mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '500.00', '5.00', 40, 90, 15, 24),
(133, '10408327', '00691636111', 'Acido Folico', '0,5 mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '104.00', '1.00', 40, 90, 26, 37),
(134, '20102500', '00833071112', 'Fenazopiridina', '100 mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '500.00', '1.50', 40, 90, 27, 24),
(135, '11230299', '00821264113', 'Albendazol /Tb.', '200 mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '100.00', '2.50', 40, 90, 35, 24),
(136, '11022497', '00681830114', 'Metoclopramida', '10 mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '55.00', '1.00', 40, 90, 6, 24),
(137, '10819649', '00534070115', 'Cefalexina / Cap.', '500 mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '20.00', '1.50', 40, 90, 15, 26),
(138, '101089', '00542901116', 'Tamsulosina', '0,4 mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '20.00', '1.00', 40, 112, 27, 24),
(139, '101109', '00145742117', 'Hioscina Butil Bromuro', '10 mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '30.00', '1.50', 40, 95, 7, 33),
(140, '110537', '00928032118', 'Clorfenamina M. / Tb. / Medrock', '4 mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '15.00', '1.50', 40, 95, 18, 24),
(141, '111017', '00252688119', 'Ketoconazol / Tb. / Medrock', '200 mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '20.00', '2.50', 40, 95, 30, 24),
(142, '1230069946464', '00430112120', 'Medida de Presión Arterial', 'Topico', 'P/A', '../Assets/images/producto/medicamento.png', '5.00', '5.00', 40, 93, 6, 47),
(143, '4545445', '00553685121', 'Medida de Glucosa', 'Topico', 'Glucosa', '../Assets/images/producto/medicamento.png', '10.00', '10.00', 0, 93, 20, 47),
(144, '55555', '00496593122', 'Clorfenamina /Tb. / Lab. Portugal', '4 mg', 'Lab. Portugal', '../Assets/images/producto/medicamento.png', '1.00', '1.00', 40, 86, 18, 24),
(145, '10609900', '00353921123', 'Colageno Hidrolizado', '10 gramos', '(Camu Camu+Maltodextrina)', '../Assets/images/producto/medicamento.png', '2.50', '2.50', 0, 93, 26, 30),
(146, '60511418', '00553249124', 'Cefalogen /Amp.', '1 gramo', '(Ceftriaxona)', '../Assets/images/producto/medicamento.png', '28.00', '28.00', 40, 85, 15, 41),
(147, '114800', '00770903125', 'Gaseovet CB / Cap. Blandas', '125 mg', '(Simeticona)', '../Assets/images/producto/medicamento.png', '1.50', '1.50', 40, 113, 41, 51),
(148, '18075200', '00957334126', 'Amoxicilina + Ácido Clavulánico / JPS', '500 + 125 mg', '(Lab. JPS)', '../Assets/images/producto/medicamento.png', '6.00', '6.00', 40, 111, 15, 37),
(149, '1108569', '00862929127', 'Medicort / AMP', '4 mg x 2 ml', 'AMP.', '../Assets/images/producto/medicamento.png', '20.00', '20.00', 40, 113, 42, 41),
(150, '112575700', '00190094128', 'Amoxidin 7/250', '250 mg/5 ml', '(Amoxicilina)', '../Assets/images/producto/medicamento.png', '0.00', '0.00', 40, 113, 15, 27),
(151, '110248800', '00959107129', 'Dequazol Oral 500', '500 mg', '(Metrodinazol)', '../Assets/images/producto/medicamento.png', '4.50', '4.50', 40, 113, 15, 24),
(152, '20020700', '00093454130', 'Dexametasona / AMP', '4mg/2ml', 'Solución Inyectable', '../Assets/images/producto/medicamento.png', '3.00', '3.00', 0, 114, 42, 41),
(153, '181000100', '00702190131', 'Clorfenamina / AMP', '10mg/1 ml', 'Solución Inyectable', '../Assets/images/producto/medicamento.png', '3.00', '3.00', 40, 114, 18, 41),
(154, '1090062000', '00032003132', 'LEXIN', '250mg/5ml', 'Polvo Para Suspensión Oral', '../Assets/images/producto/medicamento.png', '45.00', '45.00', 0, 116, 15, 27),
(155, '091915000', '00717756133', 'Micotres-Forte', '1%', '20 g', '../Assets/images/producto/medicamento.png', '15.00', '15.00', 40, 88, 30, 32),
(156, '18032200', '00709048134', 'Cloranfenicol /AMP', '1 gramo', 'Polvo para Solución Inyectable', '../Assets/images/producto/medicamento.png', '12.00', '12.00', 40, 115, 28, 41),
(157, '200022300', '00928925135', 'CEFATRIAX /AMP', '1 gramo', 'Polvo para Solución Inyectable', '../Assets/images/producto/medicamento.png', '5.00', '6.00', 40, 117, 15, 41),
(158, '180101000', '00056984136', 'HYOS-B20', '20mg/ml', 'Solución Inyectable', '../Assets/images/producto/medicamento.png', '6.00', '5.00', 40, 115, 43, 41),
(159, '1802001000', '00580463137', 'Ampicilina /AMP', '1 gramo', 'Polvo para solución Inyectable', '../Assets/images/producto/medicamento.png', '5.50', '5.00', 40, 83, 15, 41),
(160, '1050338000', '00861319138', 'Glidiabet', '5mg', '(Glibenclamida)', '../Assets/images/producto/medicamento.png', '2.80', '2.50', 40, 118, 34, 49),
(161, '191595000', '00939370139', 'Clindamicina /AMP', '600mg/4ml', 'Solución Inyectable', '../Assets/images/producto/medicamento.png', '5.50', '5.50', 0, 119, 15, 40),
(162, '201965000', '00029370140', 'Ranitidina /AMP', '50mg/2ml', 'Solución Inyectable', '../Assets/images/producto/medicamento.png', '11.00', '10.50', 40, 119, 38, 41),
(163, '180882000', '00425533141', 'Gentaphax', '160mg/2ml', '(Gentamicina/IM-IV)', '../Assets/images/producto/medicamento.png', '8.00', '6.00', 40, 111, 15, 41),
(164, '031059000', '00942787142', 'Janumet', '50mg/500mg', '(Sitaglipina+Clorhidrato de metformina)', '../Assets/images/producto/medicamento.png', '70.00', '5.00', 40, 121, 34, 50),
(165, '1062838000', '00676938143', 'Dolinex-Retard', '100mg', '(Ketoprofeno)', '../Assets/images/producto/medicamento.png', '5.00', '2.50', 0, 98, 8, 37),
(166, '01174000', '00027365144', 'Afumix', '37.5mg', '(Fluconazol+Tinidazol)', '../Assets/images/producto/medicamento.png', '1.50', '1.50', 40, 122, 30, 24),
(167, '108299000', '00298947145', 'Calmagesic', '37,5mg', '(Tramadol+Paracetamol)', '../Assets/images/producto/medicamento.png', '10.00', '3.50', 40, 95, 10, 43),
(168, '190507000', '00155374146', 'Cefuroxima', '500mg', 'Vía Oral', '../Assets/images/producto/medicamento.png', '10.00', '2.50', 40, 83, 15, 37),
(169, '01066000', '00807646147', 'Tramal', '100mg/2ml', 'Solución Inyectable', '../Assets/images/producto/medicamento.png', '15.00', '10.00', 40, 120, 8, 41),
(170, '000000000000', '00004182148', 'SEA-BAND', '2 unidades', '(Banda para mujeres embarazadas)', '../Assets/images/producto/medicamento.png', '1.50', '2.00', 40, 93, 20, 48),
(171, '10904929000', '00592823149', 'PURINOR', '100 ml', '(Tiamina+Orotato de Potasio+ Adenina+Pantenol+Piridoxina)', '../Assets/images/producto/medicamento.png', '80.00', '49.50', 40, 123, 26, 27),
(172, '01010000', '00491158150', 'Bisacolax', '5mg', '(Bisacodilo)', '../Assets/images/producto/medicamento.png', '4.00', '2.50', 40, 88, 44, 55),
(173, '9002362000', '00236067151', 'Pirantel', '250mg/5ml', 'SE USA PARA PARASITOS', '../Assets/images/producto/medicamento.png', '10.50', '10.50', 0, 94, 35, 27),
(174, '009001000', '00689830152', 'Sinuflux-D', '500mg', '(Fenilefrina+Clorfenamina+Paracetamol)', '../Assets/images/producto/medicamento.png', '10.00', '2.50', 40, 88, 29, 37),
(175, '107318000', '00448826153', 'MYCTRIM-FORTE', '800mg+160mg', '(Sulfametoxazol+Trimetoprima)', '../Assets/images/producto/medicamento.png', '5.00', '2.50', 40, 95, 28, 33),
(176, '11108099000', '00762762154', 'Purinator- AF', '100mg', '(Orotato de Potasio+Tiamina+Acido Folico+Calcio)', '../Assets/images/producto/medicamento.png', '10.00', '3.50', 40, 123, 45, 33),
(177, '0003802000', '00820143155', 'LEXFLONOR-500', '500 mg', '(Levofloxacino)', '../Assets/images/producto/medicamento.png', '15.00', '5.00', 40, 124, 15, 33),
(178, '123', '00175523156', 'DEXAMETASONA', '12', '12', '../Assets/images/producto/medicamento.png', '0.20', '0.28', 40, 84, 19, 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `proved_id` int(10) NOT NULL,
  `proved_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `proved_nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `proved_tipoDocumento` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `proved_numDocumento` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `proved_celular` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `proved_correo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `proved_direccion` varchar(250) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`proved_id`, `proved_codigo`, `proved_nombre`, `proved_tipoDocumento`, `proved_numDocumento`, `proved_celular`, `proved_correo`, `proved_direccion`) VALUES
(1, 'PROV-9529701', 'PHARMA DROUG CORP', 'RUC', '20601217369', '949514578', 'PARMA@HOTMAIL.COM', 'CALLE 33 MZ E7 L 11 AH PROGRESIVA MUNICIPAL'),
(2, 'PROV-7147382', 'MIDHCO', 'RUC', '20605412701', '945988329', 'MIDHCOFACTURACION@HOTMAIL.COM', 'JR LIBERTAD 642'),
(3, 'PROV-1943053', 'VICTOR DROGUERIA', 'DNI', '12345678', '999999999', 'VICTOR123@GMAIL.COM', 'AV. LOS GIRASOLES'),
(4, 'PROV-9302364', 'CAPON CENTER', 'RUC', '202020202', '987654321', 'CAPONCENTER@GMAIL.COM', 'AV. CAPON CENTER'),
(5, 'PROV-3508155', 'Policlinico Velasquez', 'RUC', '1601594781', '123458777', 'Polivelasquez@gmail.com', 'Mz a Lote 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `tipo_id` int(10) NOT NULL,
  `tipo_codigo` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`tipo_id`, `tipo_codigo`, `tipo_nombre`) VALUES
(1, 'CATE-6763941', 'GINECOLOGICO'),
(2, 'CATE-9083872', 'PEDIATRICO'),
(3, 'CATE-0254893', 'UROLOGIA'),
(4, 'CATE-5855054', 'MEDICINA INTERNA'),
(5, 'CATE-5932815', 'INFECTOLOGIA'),
(6, 'CATE-9132741', 'MEDICINA INTERNA'),
(7, 'CATE-6794332', 'ANTIFLAMATORIOS'),
(8, 'CATE-5036483', 'ANALGESICOS'),
(9, 'CATE-0168694', 'ANTIPIRETICOS'),
(10, 'CATE-6244995', 'Antirreumatico'),
(11, 'CATE-5621386', 'ANTICOAGULANTES'),
(12, 'CATE-9411467', 'BARRA'),
(13, 'CATE-8658288', 'ANTICONCEPTIVOS'),
(14, 'CATE-2586509', 'MUCOLITICO'),
(15, 'CATE-09999910', 'ANTIBITICO'),
(16, 'CATE-49916011', 'DESCONGESTIONANTE'),
(17, 'CATE-21713712', 'ANTITUSIVO'),
(18, 'CATE-33268413', 'ANTIHISTAMINICO'),
(19, 'CATE-21598414', 'RECARGA MOVIL'),
(20, 'CATE-06983615', 'Topico'),
(21, 'CATE-86074016', 'Helado'),
(22, 'CATE-94709717', 'Tratamiento'),
(23, 'CATE-76965518', 'Consulta Medica'),
(24, 'CATE-84104119', 'Laboratorio Clinico'),
(25, 'CATE-40384220', 'Antimigraña'),
(26, 'CATE-27715021', 'Suplemento Vitaminico'),
(27, 'CATE-69041522', 'Vias Urinarias'),
(28, 'CATE-29981623', 'Antidiarreico'),
(29, 'CATE-07979424', 'AntiGripal'),
(30, 'CATE-69564925', 'Antimicotico'),
(31, 'CATE-80319126', 'Antiemetico'),
(32, 'CATE-46651627', 'Antivertiginoso'),
(33, 'CATE-36554128', 'Antifungico'),
(34, 'CATE-65430629', 'Antihiperglicemico'),
(35, 'CATE-97304330', 'Antiparasitario'),
(36, 'CATE-74016631', 'Antihelmíntico'),
(37, 'CATE-83248132', 'Inmunosupresor'),
(38, 'CATE-56559233', 'Antiulceroso/ Gastritis'),
(39, 'CATE-43638034', 'Ansiolitico'),
(41, 'CATE-92613135', 'Antiflatulento'),
(42, 'CATE-06296036', 'Corticosteroide'),
(43, 'CATE-84333037', 'Antiespasmódico'),
(44, 'CATE-94216538', 'Laxante'),
(45, 'CATE-53929139', 'Suplemento Dietetico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(10) NOT NULL,
  `usuario_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_apellido` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_fechanacimiento` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_profesion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_dni` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_celular` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_genero` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_cargo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_descripcion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_login` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_contrasena` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_perfil` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_codigo`, `usuario_nombre`, `usuario_apellido`, `usuario_fechanacimiento`, `usuario_profesion`, `usuario_dni`, `usuario_celular`, `usuario_genero`, `usuario_cargo`, `usuario_descripcion`, `usuario_login`, `usuario_contrasena`, `usuario_perfil`, `usuario_estado`) VALUES
(1, 'USU-8458881', 'Administrador', 'Administrador', '1982-05-05', 'Administrador', '4567891', '963852741', 'Masculino', 'Administrador', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout', 'admin', 'STEzZWowVG9UaFZFQU5mMXhVcGx5QT09', '../Assets/images/avatar/masculino.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `venta_id` int(11) NOT NULL,
  `venta_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `venta_id_comprobante` int(11) NOT NULL,
  `venta_serie` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `venta_numComprobante` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `venta_fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `venta_impuesto` int(11) NOT NULL,
  `venta_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `venta_id_usuario` int(11) NOT NULL,
  `venta_id_cliente` int(11) NOT NULL,
  `venta_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`bitacora_id`),
  ADD KEY `bitacora_id_usuario` (`bitacora_id_usuario`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`compra_id`),
  ADD KEY `compra_id_proveedor` (`compra_id_proveedor`),
  ADD KEY `compra_id_usuario` (`compra_id_usuario`);

--
-- Indices de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD PRIMARY KEY (`comprobante_id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`detalleCompra_id`),
  ADD KEY `detalleCompra_id_compra` (`detalleCompra_id_compra`),
  ADD KEY `detalleCompra_id_producto` (`detalleCompra_id_producto`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`detalleVenta_id`),
  ADD KEY `detalleVenta_id_venta` (`detalleVenta_id_venta`),
  ADD KEY `detalleVenta_id_producto` (`detalleVenta_id_producto`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`empresa_id`);

--
-- Indices de la tabla `historial_compra`
--
ALTER TABLE `historial_compra`
  ADD PRIMARY KEY (`hc_id`),
  ADD KEY `hc_id_compra` (`hc_id_compra`);

--
-- Indices de la tabla `historial_venta`
--
ALTER TABLE `historial_venta`
  ADD PRIMARY KEY (`hv_id`),
  ADD KEY `hv_id_venta` (`hv_id_venta`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`lab_id`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`lote_id`),
  ADD KEY `lote_id_producto` (`lote_id_producto`),
  ADD KEY `lote_id_proveedor` (`lote_id_proveedor`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`present_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `prod_id_lab` (`prod_id_lab`),
  ADD KEY `prod_id_tipo` (`prod_id_tipo`),
  ADD KEY `prod_id_present` (`prod_id_present`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`proved_id`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`tipo_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`venta_id`),
  ADD KEY `venta_id_usuario` (`venta_id_usuario`),
  ADD KEY `venta_id_cliente` (`venta_id_cliente`),
  ADD KEY `venta_id_comprobante` (`venta_id_comprobante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `bitacora_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `compra_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  MODIFY `comprobante_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `detalleCompra_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `detalleVenta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `empresa_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `historial_compra`
--
ALTER TABLE `historial_compra`
  MODIFY `hc_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_venta`
--
ALTER TABLE `historial_venta`
  MODIFY `hv_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `lab_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `lote_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `present_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `prod_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `proved_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `tipo_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `venta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`bitacora_id_usuario`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`compra_id_proveedor`) REFERENCES `proveedor` (`proved_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`compra_id_usuario`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`detalleCompra_id_compra`) REFERENCES `compra` (`compra_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`detalleCompra_id_producto`) REFERENCES `producto` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`detalleVenta_id_venta`) REFERENCES `venta` (`venta_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`detalleVenta_id_producto`) REFERENCES `producto` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_compra`
--
ALTER TABLE `historial_compra`
  ADD CONSTRAINT `historial_compra_ibfk_1` FOREIGN KEY (`hc_id_compra`) REFERENCES `compra` (`compra_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_venta`
--
ALTER TABLE `historial_venta`
  ADD CONSTRAINT `historial_venta_ibfk_1` FOREIGN KEY (`hv_id_venta`) REFERENCES `venta` (`venta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `lote_ibfk_1` FOREIGN KEY (`lote_id_proveedor`) REFERENCES `proveedor` (`proved_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lote_ibfk_2` FOREIGN KEY (`lote_id_producto`) REFERENCES `producto` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`prod_id_lab`) REFERENCES `laboratorio` (`lab_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`prod_id_tipo`) REFERENCES `tipo_producto` (`tipo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`prod_id_present`) REFERENCES `presentacion` (`present_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`venta_id_usuario`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`venta_id_cliente`) REFERENCES `cliente` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_4` FOREIGN KEY (`venta_id_comprobante`) REFERENCES `comprobante` (`comprobante_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
