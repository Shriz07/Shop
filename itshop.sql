-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Sty 2021, 15:35
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `itshop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `addresses`
--

CREATE TABLE `addresses` (
  `ID_Address` int(100) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Postal_code` varchar(45) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `Home_number` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `addresses`
--

INSERT INTO `addresses` (`ID_Address`, `City`, `Postal_code`, `Street`, `Home_number`) VALUES
(4, 'Krakow', '95-500', 'Wielokwiatowa', '15'),
(5, 'Pabianice', '90-500', 'Krajowa', '12'),
(6, 'Lodz', '93-756', 'Long', '50'),
(7, 'Poznan', '56-456', 'Tulipanowa', '2'),
(8, 'Łódź', '95-500', 'Świerkowa', '12'),
(9, 'Krakow', '95-500', 'Wielokwiatowa', '12'),
(15, 'Poznan', '93-756', 'Tulipanowa', '12'),
(16, 'Warszawa', '90-090', 'Warszawska', '10'),
(17, 'Poznan', '95-500', 'Rejonowa', '43'),
(18, 'Łódź', '93-756', 'Świerkowa', '34'),
(19, 'Pabianice', '93-756', 'Świerkowa', '34');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `brands`
--

CREATE TABLE `brands` (
  `ID_Brand` int(100) NOT NULL,
  `Brand_Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `brands`
--

INSERT INTO `brands` (`ID_Brand`, `Brand_Name`) VALUES
(1, 'INTEL'),
(2, 'AMD'),
(3, 'Gigabyte'),
(4, 'HyperX'),
(5, 'SilentiumPC'),
(6, 'NVidia'),
(7, 'Crucial'),
(8, 'Thermaltake'),
(9, 'Samsung'),
(10, 'Asus'),
(11, 'bq quiet!');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart`
--

CREATE TABLE `cart` (
  `ID_Cart` int(11) NOT NULL,
  `ID_Product` int(10) NOT NULL,
  `Quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `ID_Category` int(100) NOT NULL,
  `Category_Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`ID_Category`, `Category_Name`) VALUES
(1, 'Processors'),
(2, 'Graphic Cards'),
(3, 'Motherboards'),
(4, 'Power supplies'),
(5, 'RAM'),
(6, 'Coolers'),
(7, 'Computer cases'),
(8, 'Memory');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customers`
--

CREATE TABLE `customers` (
  `ID_Customer` int(100) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ID_Address` int(100) NOT NULL,
  `Phone_number` int(100) NOT NULL,
  `Is_Admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `customers`
--

INSERT INTO `customers` (`ID_Customer`, `Name`, `Surname`, `Email`, `Password`, `ID_Address`, `Phone_number`, `Is_Admin`) VALUES
(16, 'Piotr', 'Abdul', 'test@gmail.com', '$2y$10$On5d1Zs8A.gPYeoqpbJ0VOQV4scMRXVcINx/uho8TYIAyhTu3fb8C', 4, 123321123, 0),
(17, 'Ryszard', 'Bog', 'test2@gmail.com', '$2y$10$qH018nfDEUPAQK98oVQWlugKjZpe5KDQA/CkwR3ZR7t2f0ZxLJbfy', 15, 123123123, 0),
(18, 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$kyNqpJQYV7aEMk7ekoMW1u9Ux5tWQYVBYjIINCVnWJLWFvZFLAMtq', 16, 111222333, 1),
(19, 'Janusz', 'Michalak', 'test3@gmail.com', '$2y$10$v6gWnTW5cN1dGNc3Lb2UJeG/UsxNTWtqv071xTwIyq1YyRa2/bzCu', 17, 453768567, 0),
(20, 'Barbara', 'Mike', 'test4@gmail.com', '$2y$10$xf4jQnQzPhHnhT2SFkUu4uxtdG1udbbTjo4mX4qcFVoytRwn3TVky', 18, 345321123, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ordered_products`
--

CREATE TABLE `ordered_products` (
  `ID_Order` int(11) NOT NULL,
  `ID_Product` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `ordered_products`
--

INSERT INTO `ordered_products` (`ID_Order`, `ID_Product`, `Quantity`) VALUES
(9, 18, 1),
(14, 12, 3),
(14, 9, 1),
(15, 7, 1),
(16, 5, 2),
(17, 8, 3),
(18, 10, 2),
(18, 6, 1),
(19, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `ID_Order` int(11) NOT NULL,
  `ID_Customer` int(11) NOT NULL,
  `ID_Status` int(11) NOT NULL,
  `ID_Address` int(100) NOT NULL,
  `ID_Payment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`ID_Order`, `ID_Customer`, `ID_Status`, `ID_Address`, `ID_Payment`) VALUES
(9, 17, 2, 15, 4),
(14, 19, 1, 17, 9),
(15, 20, 3, 18, 10),
(16, 20, 1, 18, 11),
(17, 20, 2, 19, 14),
(18, 20, 3, 18, 15),
(19, 20, 1, 18, 18);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payments`
--

CREATE TABLE `payments` (
  `ID_Payment` int(11) NOT NULL,
  `ID_Method` int(100) NOT NULL,
  `Is_paid` tinyint(1) NOT NULL,
  `Amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `payments`
--

INSERT INTO `payments` (`ID_Payment`, `ID_Method`, `Is_paid`, `Amount`) VALUES
(4, 2, 1, 398.89),
(9, 1, 1, 868.04),
(10, 1, 1, 46.99),
(11, 1, 1, 140),
(14, 1, 1, 662.97),
(15, 2, 1, 489.98),
(18, 1, 1, 139);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payment_methods`
--

CREATE TABLE `payment_methods` (
  `ID_Method` int(100) NOT NULL,
  `Name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `payment_methods`
--

INSERT INTO `payment_methods` (`ID_Method`, `Name`) VALUES
(1, 'Bank transfer'),
(2, 'Paypal');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `ID_Product` int(100) NOT NULL,
  `ID_Category` int(100) NOT NULL,
  `ID_Brand` int(100) NOT NULL,
  `Name` text NOT NULL,
  `Price` float NOT NULL,
  `Availability` int(100) NOT NULL,
  `Description` text NOT NULL,
  `Image` text NOT NULL,
  `Keywords` text NOT NULL,
  `Specification` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`ID_Product`, `ID_Category`, `ID_Brand`, `Name`, `Price`, `Availability`, `Description`, `Image`, `Keywords`, `Specification`) VALUES
(1, 1, 1, 'Intel Core i5-9400F', 139, 35, 'Boasting six cores and six threads, the Core i5-9400F processor from Intel has a 2.9 GHz base clock speed and a 4.1 GHz maximum boost speed. Compatible with LGA 1151 motherboard sockets, this 9th-generation Core i5 CPU has a 9MB Intel Smart Cache and supports DDR4-2666 memory, and it also supports Intel Optane memory. ', 'intel_I5_9400F.png', 'Intel, I5, processors', '<p>Number of cores: <strong>6 Cores</strong></p>\r\n<p>Number of threads: <strong>6 Threads</strong></p>\r\n<p>Clock speed: <strong>2.9 GHz (4.1 GHz in Turbo mode)</strong></p>\r\n<p>Socket: <strong>LGA 1151</strong></p>\r\n<p>Integrated graphics: <strong>No itegrated graphics</strong></p>'),
(2, 1, 1, 'Intel Core I7-10700K', 370, 20, 'The Core i7-10700K 3.8 GHz Eight-Core LGA 1200 Processor from Intel has a base clock speed of 3.8 GHz and comes with features such as Intel Optane Memory support, Intel vPro technology, Intel Boot Guard, Intel VT-d virtualization technology for directed I/O, and Intel Hyper-Threading technology. With Intel Turbo Max 3.0, the maximum turbo frequency this processor can achieve is 5.1 GHz. Additionally, this processor features 8 cores with 16 threads in an LGA 1200 socket, has 16MB of cache memory, and 16 PCIe lanes.', 'intel_I7_10700K.png', 'Intel, I7, processors', '<p>Number of cores: <strong>8 Cores</strong></p>\r\n<p>Number of threads: <strong>16 Threads</strong></p>\r\n<p>Clock speed: <strong>3.8 GHz (5.1 GHz in Turbo mode)</strong></p>\r\n<p>Socket: <strong>LGA 1200</strong></p>\r\n<p>Integrated graphics: <strong>Intel UHD Graphics 630</strong></p>'),
(4, 3, 3, 'Gigabyte B450M DS3H', 70, 50, 'Power up your gaming experience with first-, second-, and third-generation AMD Ryzen processors with the AM4 socket using the B450M DS3H AM4 Micro-ATX Motherboard from Gigabyte. Designed for small form factor systems, this Micro-ATX motherboard takes advantage of the B450 chipset to run demanding games and applications. Up to 64GB of dual-channel DDR4 RAM at 3600 MHz when overlocking can be installed across four memory slots for efficient multitasking and to run high-end games. The durable motherboard also features an M.2 SSD slot and supports up to four SATA III storage drives, which can be put into RAID 0, 1, or 10 configuration. ', 'gigabyte_DS3H.png', 'Gigabyte, motherboards, ds3h', '<p>Format: <strong>Micro-ATX</strong></p>\r\n<p>Socket: <strong>AM4</strong></p>\r\n<p>Chipset: <strong>AMD B450</strong></p>\r\n<p>Ram slots: <strong>4 x DDR4-3600 OC</strong></p>\r\n<p>Audio: <strong>Realtek ALC887 Audio</strong></p>\r\n<p>Memory ports: <strong>4x SATA III | 1x M.2</strong></p>'),
(5, 5, 7, 'Crucial 16GB DDR4', 70, 15, 'Ramp up your gaming experience by installing the 16GB Crucial Ballistix DDR4 3200 MHz UDIMM Gaming Desktop Memory Kit into your desktop computer. Featuring a low-profile design for small form factor systems and black anodized aluminum heatsinks, this 16GB memory kit includes two 8GB 288-pin DDR4-3200 non-ECC unbuffered DIMMs (UDIMM) to help drive your games and applications. Increased memory will help complex games and large levels load faster. The extra space also allows you to run demanding applications, multitask, and edit large photos and videos more efficiently.', 'crucial_16_3200.png', 'Crucial, RAM, 3200, 16GB', '<p>Capacity: <strong>16 GB</strong></p>\r\n<p>Kit configuration: <strong>2 x 8GB</strong></p>\r\n<p>Speed: <strong>3200 MHz</strong></p>\r\n<p>Memory type: <strong>DDR4</strong></p>\r\n<p>CAS Latency: <strong>CL16</strong></p>'),
(6, 2, 3, 'Gigabyte RTX 2060', 310, 20, 'Based on the Turing architecture, the Gigabyte GeForce RTX 2060 WINDFORCE OC Graphics Card brings the power of real-time ray tracing and AI to your PC games. You\'ll be able to play your favorite PC games at Full HD 1080p resolution at high frames per second (fps), such as 120 or 144 fps (depending on the game and settings). You can also run your games at QHD 1440p resolution, but will most likely be limited to 60 fps or less. The RTX 2060 is not just about high-resolution gaming. Computationally intensive programs can utilize the GPU\'s 1920 cores to accelerate tasks using CUDA or other APIs.', 'gigabyte_rtx2080.png', 'Gigabyte, graphic, rtx, 2060, geforce', '<p>Architecture: <strong>Turing</strong></p>\r\n<p>Memory: <strong>6 GB</strong></p>\r\n<p>Memory type: <strong>GDDR6</strong></p>\r\n<p>Memory intefrace: <strong>192-Bit</strong></p>\r\n<p>Cuda cores: <strong>1920</strong></p>\r\n<p>Output types: <strong>DisplayPort 1.4 | HDMI 2.0b</strong></p>'),
(7, 4, 8, 'Thermaltake Smart 80', 46.99, 40, 'Incorporating various high-quality components, the Smart Series - models are rated from 500W to 700W - saves energy through its high efficiency of up to 86% and accommodates any mainstream build with the most demanding requirements. An embedded intelligent cooling fan delivers excellent airflow at an exceptionally low noise level. Additionally, the Single +12V rail design enables non-stop usage with stable and reliable performance.', 'thermaltake_500w.png', 'Thermaltake, PSU, 500W', '<p>Output power: <strong>500 W</strong></p>\r\n<p>Efficiency: <strong>86%</strong></p>\r\n<p>Input voltage: <strong>120V AC | 230V AC</strong></p>'),
(8, 8, 9, 'Samsung 980 PRO 1TB', 220.99, 10, 'Built using their V-NAND 3-bit MLC flash technology and Elpis controller, the 1TB 980 PRO PCIe 4.0 x4 M.2 Internal SSD from Samsung offers an M.2 2280 form factor and a PCIe 4.0 x4 / NVMe 1.3 interface to deliver sequential read speeds of up to 7000 MB/s and sequential write speeds of up to 5000 MB/s. Users will also have access to encryption via TCG/Opal 2.0 and MS eDrive, while a TBW (Total Bytes Written) rating of 600TB helps ensure a long operational life.', 'Samsung_SSD_980.png', 'Samsung, SSD, 1TB', '<p>Capacity: <strong>1.0 TB</strong></p>\r\n<p>Interface: <strong>PCIe 4.0</strong></p>\r\n<p>Sequential read speed: <strong>7000 MB/s</strong></p>\r\n<p>Sequential write speed: <strong>5000 MB/s</strong></p>'),
(9, 3, 10, 'Asus X570-Plus', 160.55, 15, 'The ASUS TUF GAMING X570-PLUS AM4 ATX Motherboard is built on the AMD X570 chipset supporting second- and third-generation AMD Ryzen processors with an AM4 socket. It has four memory slots for up to 128GB of dual-channel DDR4 RAM, which can run up to 4400 MHz when overclocked. For storage, it\'s equipped with eight SATA III ports and two 22110 M.2 slots. There are two PCIe 4.0 x16 slots for graphics cards, which can run at x16/x4 when both slots are filled, and another three PCIe 4.0 x1 slots for other PCI-based hardware. Other integrated features include Realtek L8200A Gigabit LAN and Realtek ALC S1200A 8-channel HD audio.', 'Asus_X570.png', 'Motherboard, Asus, X570', '<p>Format: <strong>ATX</strong></p>\r\n<p>Socket: <strong>AM4</strong></p>\r\n<p>Chipset: <strong>AMD X570</strong></p>\r\n<p>Ram slots: <strong>4 x DDR4-4400 OC</strong></p>\r\n<p>Audio: <strong>Realtek ALC S1200A Audio</strong></p>\r\n<p>Memory ports: <strong>8x SATA III | 2x M.2</strong></p>'),
(10, 6, 11, 'Dark Rock Pro 4', 89.99, 20, '<p class=\"MsoNormal\"><span lang=\"EN-GB\" style=\"font-family: \'Arial\',sans-serif; mso-ansi-language: EN-GB;\">Built to provide immense cooling performance for overclocked systems and demanding graphics applications, the Dark Rock Pro 4 Air Cooler from be quiet! features seven 6mm copper heat pipes, a 120mm Silent Wings 3 PWM fan, and a 135mm Silent Wings PWM fan with airflow-optimized blades with speeds of 1200 / 1500 rpm, six-pole motors, and fluid-dynamic bearings.</span></p>', 'be_quiet_dark_rock_pro_4.png', 'be quiet!, Dark rock, coolers', '<p>Cooler type: <strong>CPU Air Cooler</strong></p>\r\n<p>NConnectors: <strong>4-Pin</strong></p>\r\n<p>Control method: <strong>PWM</strong></p>\r\n<p>Fan size: <strong>135nm</strong></p>\r\n<p>Fan speed: <strong>1500 rpm</strong></p>\r\n<p>Noise level: <strong>12.8 to 24.3 dBA</strong></p>'),
(11, 1, 2, 'AMD Ryzen 3 3100', 118.99, 30, '<p class=\"MsoNormal\"><span lang=\"EN-GB\" style=\"font-family: \'Arial\',sans-serif; mso-ansi-language: EN-GB;\">Designed for high-performance gaming and multitasking, the Ryzen 3 3100 Quad-Core AM4 Processor from AMD has a maximum turbo frequency of 3.9 GHz and supports PCIe 4.0 bandwidth. Additionally, this processor features four cores with eight threads in an AM4 socket with 18MB of cache memory. Having four cores allows the processor to run multiple programs simultaneously without slowing down the system, while the eight threads allow a basic ordered sequence of instructions to be passed through or processed by a single CPU core. This processor also has a TDP of 65W.</span></p>', 'ryzen_3100.png', 'Ryzen, 3100, Ryzen 3, processor', '<p>Number of cores: <strong>4 Cores</strong></p>\r\n<p>Number of threads: <strong>6 Threads</strong></p>\r\n<p>Clock speed: <strong>3.3 GHz (3.9 GHz in Turbo mode)</strong></p>\r\n<p>Socket: <strong>AM4</strong></p>\r\n<p>Integrated graphics: <strong>No itegrated graphics</strong></p>'),
(12, 1, 2, 'AMD Ryzen 5 3600X', 235.83, 30, '<p class=\"MsoNormal\"><span lang=\"EN-GB\" style=\"font-family: \'Arial\',sans-serif; mso-ansi-language: EN-GB;\">The AMD Ryzen 5 3600X 3.8 GHz Six-Core AM4 Processor is a powerful six-core processor with 12 threads, designed for socket AM4 motherboards. Built with Zen 2 architecture, the third-generation 7nm Ryzen processor offers increased performance compared to its predecessor. It has a base clock speed of 3.8 GHz and can reach a max boost clock speed of 4.4 GHz.</span></p>', 'ryzen_5.png', 'Ryzen, Ryzen 5, processors, 3600X', '<p>Number of cores: <strong>6 Cores</strong></p>\r\n<p>Number of threads: <strong>12 Threads</strong></p>\r\n<p>Clock speed: <strong>3.8 GHz (4.4 GHz in Turbo mode)</strong></p>\r\n<p>Socket: <strong>AM4</strong></p>\r\n<p>Integrated graphics: <strong>No itegrated graphics</strong></p>'),
(13, 1, 2, 'AMD Ryzen 7 3700X', 304.99, 5, '<p class=\"MsoNormal\"><span lang=\"EN-GB\" style=\"font-family: \'Arial\',sans-serif; mso-ansi-language: EN-GB;\">The AMD Ryzen 7 3700X 3.6 GHz Eight-Core AM4 Processor is a powerful eight-core processor with 16 threads, designed for socket AM4 motherboards. Built with Zen 2 architecture, the third-generation 7nm Ryzen processor offers increased performance compared to its predecessor. It has a base clock speed of 3.6 GHz and can reach a max boost clock speed of 4.4 GHz.</span></p>', 'ryzen_7.png', 'Ryzen 7, Ryzen, 3700X, processors', '<p>Number of cores: <strong>8 Cores</strong></p>\r\n<p>Number of threads: <strong>16 Threads</strong></p>\r\n<p>Clock speed: <strong>3.6 GHz (4.4 GHz in Turbo mode)</strong></p>\r\n<p>Socket: <strong>AM4</strong></p>\r\n<p>Integrated graphics: <strong>No itegrated graphics</strong></p>'),
(14, 1, 1, 'Intel Core i9-10900K', 539.99, 3, '<p class=\"MsoNormal\"><span lang=\"EN-GB\" style=\"font-family: \'Arial\',sans-serif; mso-ansi-language: EN-GB;\">The Core i9-10900K 3.7 GHz Ten-Core LGA 1200 Processor from Intel has a base clock speed of 3.7 GHz and comes with features such as Intel Optane Memory support, Intel vPro technology, Intel Boot Guard, Intel VT-d virtualization technology for directed I/O, and Intel Hyper-Threading technology. With Intel Thermal Velocity Boost, the maximum turbo frequency this processor can achieve is 5.3 GHz, or it can be boosted up to 5.2 GHz with Intel Turbo Boost Max 3.0. Additionally, this processor features 10 cores with 20 threads in an LGA 1200 socket, has 20MB of cache memory, and 16 PCIe lanes.</span></p>', 'intel_i9.png', 'Intel, i9, 10900K', '<p>Number of cores: <strong>10 Cores</strong></p>\r\n<p>Number of threads: <strong>20 Threads</strong></p>\r\n<p>Clock speed: <strong>3.7 GHz (5.3 GHz in Turbo mode)</strong></p>\r\n<p>Socket: <strong>LGA 1200</strong></p>\r\n<p>Integrated graphics: <strong>Intel UHD Graphics 630</strong></p>'),
(15, 1, 1, 'Intel Core i7-8700K', 299.99, 5, '<p class=\"MsoNormal\"><span lang=\"EN-GB\" style=\"font-family: \'Arial\',sans-serif; mso-ansi-language: EN-GB;\">The Intel Core i7-8700K 3.7 GHz 6-Core LGA 1151 Processor provides six cores with each one operating between 3.7 and 4.7 GHz for editing digital content, streaming live gameplay, and running other types of intensive tasks. If you need more performance, you can overclock the cores to function above its maximum frequency. This 8th-generation Intel Core i7-8700K processor is built on Coffee Lake architecture and armed with 12MB of cache memory.</span></p>', 'intel_i7_8700.png', 'Intel i7, 8700K, processors', '<p>Number of cores: <strong>6 Cores</strong></p>\r\n<p>Number of threads: <strong>12 Threads</strong></p>\r\n<p>Clock speed: <strong>3.7 GHz (4.7 GHz in Turbo mode)</strong></p>\r\n<p>Socket: <strong>LGA 1151</strong></p>\r\n<p>Integrated graphics: <strong>Intel UHD Graphics 630</strong></p>'),
(16, 1, 2, 'AMD Ryzen 5 3600XT', 235.83, 15, '<p class=\"MsoNormal\"><span lang=\"EN-GB\" style=\"font-family: \'Arial\',sans-serif; mso-ansi-language: EN-GB;\">The AMD Ryzen 5 3600XT 3.8 GHz 6-Core AM4 Processor is a powerful six-core processor with 12 threads, designed for socket AM4 motherboards. Built with Zen Core architecture, the 7nm Ryzen processor offers increased performance compared to its predecessor. It has a base clock speed of 3.8 GHz and can reach a max boost clock speed of 4.5 GHz. Moreover, it features 32MB of L3 cache and support for 3200 MHz DDR4 RAM. Users should pair it with an AMD X500-series motherboard to fully take advantage of PCIe 4.0. </span></p>', 'ryzen_5.png', 'Ryzen 5, 3600XT, processors', '<p>Number of cores: <strong>6 Cores</strong></p>\r\n<p>Number of threads: <strong>12 Threads</strong></p>\r\n<p>Clock speed: <strong>3.8 GHz (4.5 GHz in Turbo mode)</strong></p>\r\n<p>Socket: <strong>AM4</strong></p>\r\n<p>Integrated graphics: <strong>No itegrated graphics</strong></p>'),
(17, 1, 1, 'Intel Core i3-9100', 109.99, 10, '<p class=\"MsoNormal\"><span lang=\"EN-GB\" style=\"font-family: \'Arial\',sans-serif; mso-ansi-language: EN-GB;\">Packing in four cores and four threads, the Core i3-9100 Processor from Intel has a 3.6 GHz base clock speed and a 4.2 GHz maximum boost speed. Compatible with LGA 1151 motherboard sockets, this 9th-generation Core i3 CPU comes with a 6MB Intel Smart Cache. The processor supports both DDR4-2400 memory and Intel Optane Memory, and it also boasts an Intel UHD Graphics 630 core.</span></p>', 'intel_i3.png', 'Intel i3, 9100, processors', '<p>Number of cores: <strong>4 Cores</strong></p>\r\n<p>Number of threads: <strong>4 Threads</strong></p>\r\n<p>Clock speed: <strong>3.6 GHz (4.2 GHz in Turbo mode)</strong></p>\r\n<p>Socket: <strong>LGA 1151</strong></p>\r\n<p>Integrated graphics: <strong>Intel UHD Graphics 630</strong></p>'),
(18, 1, 1, 'Intel Core i9-9900K', 398.89, 10, '<p class=\"MsoNormal\"><span lang=\"EN-GB\" style=\"font-family: \'Arial\',sans-serif; mso-ansi-language: EN-GB;\">Only compatible with their 300-series chipset-based motherboards, the Core i9-9900K 3.6 GHz Eight-Core LGA 1151 Processor from Intel is designed for gaming, creating, and productivity. It has a base clock speed of 3.6 GHz and comes with features such as Intel Optane Memory support, AES-NI encryption, Intel vPro technology, Intel TXT, Intel Device Protection with Boot Guard, Intel VT-d virtualization technology for directed I/O, and Intel Hyper-Threading technology for 16-way multitasking. With Intel Turbo Boost Max 3.0 technology, the maximum turbo frequency this processor can achieve is 5.0 GHz.</span></p>', 'intel_i9_9900.png', 'Intel i9, 9900K, processors', '<p>Number of cores: <strong>8 Cores</strong></p>\r\n<p>Number of threads: <strong>16 Threads</strong></p>\r\n<p>Clock speed: <strong>3.6 GHz (5 GHz in Turbo mode)</strong></p>\r\n<p>Socket: <strong>LGA 1151</strong></p>\r\n<p>Integrated graphics: <strong>Intel UHD Graphics 630</strong></p>');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `statuses`
--

CREATE TABLE `statuses` (
  `ID_Status` int(11) NOT NULL,
  `Status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `statuses`
--

INSERT INTO `statuses` (`ID_Status`, `Status`) VALUES
(1, 'Payment Received'),
(2, 'Awaiting delivery'),
(3, 'Completed');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`ID_Address`);

--
-- Indeksy dla tabeli `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`ID_Brand`);

--
-- Indeksy dla tabeli `cart`
--
ALTER TABLE `cart`
  ADD KEY `ID_Cart` (`ID_Cart`),
  ADD KEY `ID_Product` (`ID_Product`);

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID_Category`);

--
-- Indeksy dla tabeli `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`ID_Customer`),
  ADD KEY `ID_Address` (`ID_Address`);

--
-- Indeksy dla tabeli `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD KEY `ID_Order` (`ID_Order`),
  ADD KEY `ID_Product` (`ID_Product`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID_Order`),
  ADD KEY `ID_Customer` (`ID_Customer`),
  ADD KEY `ID_Status` (`ID_Status`),
  ADD KEY `ID_Address` (`ID_Address`),
  ADD KEY `ID_Payment` (`ID_Payment`);

--
-- Indeksy dla tabeli `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`ID_Payment`),
  ADD KEY `ID_Method` (`ID_Method`);

--
-- Indeksy dla tabeli `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`ID_Method`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID_Product`),
  ADD KEY `ID_Category` (`ID_Category`),
  ADD KEY `ID_Brand` (`ID_Brand`);

--
-- Indeksy dla tabeli `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`ID_Status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `addresses`
--
ALTER TABLE `addresses`
  MODIFY `ID_Address` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `brands`
--
ALTER TABLE `brands`
  MODIFY `ID_Brand` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `ID_Category` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `customers`
--
ALTER TABLE `customers`
  MODIFY `ID_Customer` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `ID_Order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `payments`
--
ALTER TABLE `payments`
  MODIFY `ID_Payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `ID_Method` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `ID_Product` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `statuses`
--
ALTER TABLE `statuses`
  MODIFY `ID_Status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`ID_Cart`) REFERENCES `orders` (`ID_Order`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`ID_Product`) REFERENCES `products` (`ID_Product`);

--
-- Ograniczenia dla tabeli `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`ID_Address`) REFERENCES `addresses` (`ID_Address`);

--
-- Ograniczenia dla tabeli `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD CONSTRAINT `ordered_products_ibfk_2` FOREIGN KEY (`ID_Product`) REFERENCES `products` (`ID_Product`),
  ADD CONSTRAINT `ordered_products_ibfk_3` FOREIGN KEY (`ID_Order`) REFERENCES `orders` (`ID_Order`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ID_Customer`) REFERENCES `customers` (`ID_Customer`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`ID_Status`) REFERENCES `statuses` (`ID_Status`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`ID_Address`) REFERENCES `addresses` (`ID_Address`),
  ADD CONSTRAINT `orders_ibfk_5` FOREIGN KEY (`ID_Payment`) REFERENCES `payments` (`ID_Payment`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`ID_Method`) REFERENCES `payment_methods` (`ID_Method`);

--
-- Ograniczenia dla tabeli `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`ID_Category`) REFERENCES `categories` (`ID_Category`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`ID_Brand`) REFERENCES `brands` (`ID_Brand`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
