SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9');

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `valid_until` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `firmware_ap` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `firmware_version` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `download_link` varchar(255) DEFAULT NULL,
  `date_uploaded` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `firmware_ap` (`id`, `product_name`, `firmware_version`, `description`, `download_link`, `date_uploaded`) VALUES
(1, 'Cisco Aironet 1850', '8.5.151.0', '高效能無線接入點，適用企業網路。', 'https://example.com/fw/ap1850_v851510.bin', '2025-07-02'),
(2, 'Cisco Catalyst 9115', '17.3.1', '下一代 Wi-Fi 6 接入點。', 'https://example.com/fw/cat9115_v1731.bin', '2025-07-02'),
(3, 'Cisco Aironet 1830', '8.5.130.0', '高密度環境無線接入點。', 'https://example.com/fw/ap1830_v851300.bin', '2025-07-02'),
(4, 'Cisco Catalyst 9120', '17.3.2', '企業級 Wi-Fi 6 AP，安全可靠。', 'https://example.com/fw/cat9120_v1732.bin', '2025-07-02'),
(5, 'Cisco Meraki MR42', '27.13', '雲端管理無線AP，簡單易用。', 'https://example.com/fw/mr42_v2713.bin', '2025-07-02'),
(6, 'Cisco Aironet 2800', '', '高效能企業無線接入點', 'downloads/firmware/ap/aironet2800.bin', '2025-07-03'),
(7, 'Cisco Catalyst 9100', '', '最新802.11ax無線AP，適合大規模部署', 'downloads/firmware/ap/catalyst9100.bin', '2025-07-03'),
(8, 'Cisco Meraki MR Series', '', '雲端管理無線AP，簡易配置', 'downloads/firmware/ap/merakimr.bin', '2025-07-03'),
(9, 'Cisco Aironet 1850', '', '多功能企業級無線AP', 'downloads/firmware/ap/aironet1850.bin', '2025-07-03'),
(10, 'Cisco Catalyst 9115', '', '進階無線AP，支持高密度環境', 'downloads/firmware/ap/catalyst9115.bin', '2025-07-03');

CREATE TABLE `firmware_firewall` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `firmware_version` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `download_link` varchar(255) DEFAULT NULL,
  `date_uploaded` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `firmware_firewall` (`id`, `product_name`, `firmware_version`, `description`, `download_link`, `date_uploaded`) VALUES
(1, 'Cisco ASA 5506-X', '9.12(3)12', '小型辦公室防火牆解決方案。', 'https://example.com/fw/asa5506x_v912312.bin', '2025-07-02'),
(2, 'Cisco Firepower 1010', '6.5.0', '下一代入侵防護系統。', 'https://example.com/fw/firepower1010_v650.bin', '2025-07-02'),
(3, 'Cisco ASA 5516-X', '9.12(4)14', '企業級防火牆，具高效能。', 'https://example.com/fw/asa5516x_v912414.bin', '2025-07-02'),
(4, 'Cisco Firepower 2100', '6.6.0', '高性能威脅防護平台。', 'https://example.com/fw/firepower2100_v660.bin', '2025-07-02'),
(5, 'Cisco ASA 5525-X', '9.8(2)', '中型企業防火牆設備。', 'https://example.com/fw/asa5525x_v982.bin', '2025-07-02'),
(6, 'Cisco ASA 5500-X', '', '企業級防火牆解決方案', 'downloads/firmware/firewall/asa5500x.bin', '2025-07-03'),
(7, 'Cisco Firepower 2100', '', '次世代防火牆與入侵防護系統', 'downloads/firmware/firewall/firepower2100.bin', '2025-07-03'),
(8, 'Cisco Meraki MX64', '', '雲端管理的防火牆裝置', 'downloads/firmware/firewall/merakimx64.bin', '2025-07-03'),
(9, 'Cisco Firepower 1120', '', '高性能防火牆', 'downloads/firmware/firewall/firepower1120.bin', '2025-07-03'),
(10, 'Cisco ASA 5585-X', '', '模組化防火牆平台', 'downloads/firmware/firewall/asa5585x.bin', '2025-07-03');

CREATE TABLE `firmware_router` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `firmware_version` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `download_link` varchar(255) DEFAULT NULL,
  `date_uploaded` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `firmware_router` (`id`, `product_name`, `firmware_version`, `description`, `download_link`, `date_uploaded`) VALUES
(1, 'Cisco Router 2901', 'v15.7(3)M3', '企業級路由器，支援多協定路由。', 'https://example.com/fw/router2901_v1573m3.bin', '2025-07-02'),
(2, 'Cisco Router ISR 4321', 'v17.3.3', '高效能整合路由平台，適合中小企業。', 'https://example.com/fw/ISR4321_v1733.bin', '2025-07-02'),
(3, 'Cisco Router 1941', 'v15.5(3)M', '經濟實惠的路由器，適用基本需求。', 'https://example.com/fw/router1941_v1553m.bin', '2025-07-02'),
(4, 'Cisco Router 4451', 'v16.9.5', '多核處理器高性能路由器。', 'https://example.com/fw/router4451_v1695.bin', '2025-07-02'),
(5, 'Cisco Router ASR 1001', 'v6.6.2', '高吞吐量邊緣路由解決方案。', 'https://example.com/fw/ASR1001_v662.bin', '2025-07-02'),
(6, 'Cisco ISR 4000', '', '高效能整合服務路由器，適合中大型企業', 'downloads/firmware/router/isr4000.bin', '2025-07-03'),
(7, 'Cisco Catalyst 9300', '', '企業級固定式交換路由器，支援安全與高擴展性', 'downloads/firmware/router/catalyst9300.bin', '2025-07-03'),
(8, 'Cisco Catalyst 9500', '', '核心交換路由器，適合高流量環境', 'downloads/firmware/router/catalyst9500.bin', '2025-07-03'),
(9, 'Cisco ASR 1000', '', '彈性路由器平台，提供多種連線協定支持', 'downloads/firmware/router/asr1000.bin', '2025-07-03'),
(10, 'Cisco Meraki MX', '', '雲端管理的安全路由器，具防火牆功能', 'downloads/firmware/router/merakimx.bin', '2025-07-03');

CREATE TABLE `firmware_server` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `firmware_version` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `download_link` varchar(255) DEFAULT NULL,
  `date_uploaded` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `firmware_server` (`id`, `product_name`, `firmware_version`, `description`, `download_link`, `date_uploaded`) VALUES
(1, 'Cisco UCS C220 M5', '4.0(3)', '通用型刀鋒伺服器，適合資料中心。', 'https://example.com/fw/ucs_c220m5_v403.bin', '2025-07-02'),
(2, 'Cisco UCS C240 M5', '4.0(3)', '高密度伺服器，支援大容量運算。', 'https://example.com/fw/ucs_c240m5_v403.bin', '2025-07-02'),
(3, 'Cisco UCS B200 M5', '4.1(1)', '刀鋒伺服器，靈活可擴展。', 'https://example.com/fw/ucs_b200m5_v411.bin', '2025-07-02'),
(4, 'Cisco UCS C480 ML M5', '4.0(3)', '機器學習與AI優化伺服器。', 'https://example.com/fw/ucs_c480mlm5_v403.bin', '2025-07-02'),
(5, 'Cisco UCS C220 M4', '3.2(5)', '穩定且高效能的伺服器。', 'https://example.com/fw/ucs_c220m4_v325.bin', '2025-07-02'),
(6, 'Cisco UCS C220', '', '刀片式伺服器，適合虛擬化環境', 'downloads/firmware/server/ucsc220.bin', '2025-07-03'),
(7, 'Cisco UCS B200', '', '高效能刀片伺服器', 'downloads/firmware/server/ucsb200.bin', '2025-07-03'),
(8, 'Cisco UCS C240', '', '高擴展性伺服器', 'downloads/firmware/server/ucsc240.bin', '2025-07-03'),
(9, 'Cisco UCS C480', '', '多節點伺服器平台', 'downloads/firmware/server/ucsc480.bin', '2025-07-03'),
(10, 'Cisco UCS C460', '', '高密度伺服器', 'downloads/firmware/server/ucsc460.bin', '2025-07-03');

CREATE TABLE `firmware_switch` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `firmware_version` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `download_link` varchar(255) DEFAULT NULL,
  `date_uploaded` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `firmware_switch` (`id`, `product_name`, `firmware_version`, `description`, `download_link`, `date_uploaded`) VALUES
(1, 'Cisco Catalyst 2960X', '15.2(6)E1', '企業級千兆交換器。', 'https://example.com/fw/cat2960x_v1526e1.bin', '2025-07-02'),
(2, 'Cisco Catalyst 9300', '17.3.3', '高性能企業交換平台。', 'https://example.com/fw/cat9300_v1733.bin', '2025-07-02'),
(3, 'Cisco Nexus 9000', '9.3(5)', '資料中心交換器，支援SDN。', 'https://example.com/fw/nexus9000_v935.bin', '2025-07-02'),
(4, 'Cisco Catalyst 3850', '16.6.4', '多層交換機，支援堆疊。', 'https://example.com/fw/cat3850_v1664.bin', '2025-07-02'),
(5, 'Cisco Catalyst 1000', '16.12.4', '簡化管理的小型企業交換機。', 'https://example.com/fw/cat1000_v16124.bin', '2025-07-02'),
(6, 'Cisco Catalyst 9200', '', '企業接入層交換器', 'downloads/firmware/switch/catalyst9200.bin', '2025-07-03'),
(7, 'Cisco Catalyst 9300', '', '高階接入交換器', 'downloads/firmware/switch/catalyst9300.bin', '2025-07-03'),
(8, 'Cisco Nexus 9000', '', '資料中心核心交換機', 'downloads/firmware/switch/nexus9000.bin', '2025-07-03'),
(9, 'Cisco Catalyst 9400', '', '模組化交換器平台', 'downloads/firmware/switch/catalyst9400.bin', '2025-07-03'),
(10, 'Cisco Meraki MS', '', '雲端管理交換器系列', 'downloads/firmware/switch/merakims.bin', '2025-07-03');


CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `service_type` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `member` (`id`, `name`, `gender`, `phone`, `email`, `service_type`, `password`) VALUES
(1, 'adam', '男', '0973094458', 'admin', '課程安排', '$2y$10$294CjTwqdIQ9Rbjt/gHvMOqBxhzsZt0gPMb.XhT7GFTd4sHU9Wqq6');

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `reply` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `date_posted` date DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `news` (`id`, `date_posted`, `title`, `content`, `author`) VALUES
(1, '2025-06-27', '測試', '12345678', 'jason'),
(3, '2025-06-30', '123', '123456', 'j');

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_code` varchar(50) DEFAULT NULL,
  `stock_date` date DEFAULT NULL,
  `stock_qty` int(11) DEFAULT NULL,
  `ship_date` date DEFAULT NULL,
  `ship_qty` int(11) DEFAULT NULL,
  `remain_qty` int(11) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `product_desc` TEXT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `product` (`id`, `product_name`, `product_code`, `stock_date`, `stock_qty`, `ship_date`, `ship_qty`, `remain_qty`, `category`, `product_desc`) VALUES
(1, 'Cisco ISR 4000', 'ISR4000', '2025-07-01', 100, '2025-07-02', 20, 80, '路由器', NULL),
(2, 'Cisco Catalyst 9300', 'C9300', '2025-07-01', 120, '2025-07-03', 30, 90, '路由器', NULL),
(3, 'Cisco Catalyst 9500', 'C9500', '2025-07-01', 90, '2025-07-04', 10, 80, '路由器', NULL),
(4, 'Cisco ASR 1000', 'ASR1000', '2025-07-01', 60, '2025-07-03', 5, 55, '路由器', NULL),
(5, 'Cisco Meraki MX', 'MX100', '2025-07-01', 150, '2025-07-05', 20, 130, '路由器', NULL),
(6, 'Cisco Aironet 2800', 'AIR2800', '2025-07-01', 80, '2025-07-02', 15, 65, '無線AP', NULL),
(7, 'Cisco Catalyst 9100', 'C9100', '2025-07-01', 100, '2025-07-02', 20, 80, '無線AP', NULL),
(8, 'Cisco Meraki MR', 'MR46', '2025-07-01', 75, '2025-07-03', 10, 65, '無線AP', NULL),
(9, 'Cisco Aironet 1850', 'AIR1850', '2025-07-01', 90, '2025-07-04', 5, 85, '無線AP', NULL),
(10, 'Cisco Catalyst 9115', 'C9115', '2025-07-01', 60, '2025-07-02', 10, 50, '無線AP', NULL),
(11, 'Cisco ASA 5500-X', 'ASA5500X', '2025-07-01', 70, '2025-07-03', 10, 60, '防火牆', NULL),
(12, 'Cisco Firepower 2100', 'FP2100', '2025-07-01', 50, '2025-07-04', 5, 45, '防火牆', NULL),
(13, 'Cisco Meraki MX64', 'MX64', '2025-07-01', 80, '2025-07-02', 10, 70, '防火牆', NULL),
(14, 'Cisco Firepower 1120', 'FP1120', '2025-07-01', 65, '2025-07-05', 5, 60, '防火牆', NULL),
(15, 'Cisco ASA 5585-X', 'ASA5585X', '2025-07-01', 55, '2025-07-04', 5, 50, '防火牆', NULL),
(16, 'Cisco Catalyst 9200', 'C9200', '2025-07-01', 100, '2025-07-02', 25, 75, '交換器', NULL),
(17, 'Cisco Nexus 9000', 'N9000', '2025-07-01', 120, '2025-07-03', 15, 105, '交換器', NULL),
(18, 'Cisco Catalyst 9400', 'C9400', '2025-07-01', 85, '2025-07-02', 10, 75, '交換器', NULL),
(19, 'Cisco Meraki MS', 'MS120', '2025-07-01', 60, '2025-07-04', 5, 55, '交換器', NULL),
(20, 'Cisco Catalyst 9300', 'C9300-SW', '2025-07-01', 70, '2025-07-03', 10, 60, '交換器', NULL),
(21, 'Cisco UCS C220', 'UCSC220', '2025-07-01', 50, '2025-07-03', 10, 40, '伺服器', NULL),
(22, 'Cisco UCS B200', 'UCSB200', '2025-07-01', 60, '2025-07-04', 10, 50, '伺服器', NULL),
(23, 'Cisco UCS C240', 'UCSC240', '2025-07-01', 55, '2025-07-02', 5, 50, '伺服器', NULL),
(24, 'Cisco UCS C480', 'UCSC480', '2025-07-01', 40, '2025-07-03', 5, 35, '伺服器', NULL),
(25, 'Cisco UCS C460', 'UCSC460', '2025-07-01', 45, '2025-07-04', 5, 40, '伺服器', NULL);

ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `firmware_ap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product_name` (`product_name`),
  ADD KEY `idx_firmware_version` (`firmware_version`);

ALTER TABLE `firmware_firewall`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product_name` (`product_name`),
  ADD KEY `idx_firmware_version` (`firmware_version`);

ALTER TABLE `firmware_router`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product_name` (`product_name`),
  ADD KEY `idx_firmware_version` (`firmware_version`);

ALTER TABLE `firmware_server`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product_name` (`product_name`),
  ADD KEY `idx_firmware_version` (`firmware_version`);

ALTER TABLE `firmware_switch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product_name` (`product_name`),
  ADD KEY `idx_firmware_version` (`firmware_version`);

ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `firmware_ap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `firmware_firewall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `firmware_router`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `firmware_server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `firmware_switch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;
