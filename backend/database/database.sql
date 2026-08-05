-- Travel ERP Complete Database Schema & Seed Data
-- Database Name: travel_erp

CREATE DATABASE IF NOT EXISTS `travel_erp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `travel_erp`;

SET FOREIGN_KEY_CHECKS = 0;

-- --------------------------------------------------------
-- 1. Table: roles
-- --------------------------------------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `description` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `roles` (`id`, `name`, `slug`, `description`) VALUES
(1, 'Administrator', 'admin', 'Full system access'),
(2, 'Travel Agent', 'agent', 'Manage bookings and customers'),
(3, 'Accountant', 'accountant', 'Manage payments and financial reviews');

-- --------------------------------------------------------
-- 2. Table: permissions
-- --------------------------------------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `description` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`) VALUES
(1, 'Manage Users', 'users.manage', 'Ability to create, update and delete staff/users'),
(2, 'Manage Bookings', 'bookings.manage', 'Ability to update and cancel bookings'),
(3, 'Manage Payments', 'payments.manage', 'Ability to view and verify transaction details');

-- --------------------------------------------------------
-- 3. Table: role_permissions
-- --------------------------------------------------------
DROP TABLE IF EXISTS `role_permissions`;
CREATE TABLE `role_permissions` (
  `role_id` INT NOT NULL,
  `permission_id` INT NOT NULL,
  PRIMARY KEY (`role_id`, `permission_id`),
  FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `role_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(3, 3);

-- --------------------------------------------------------
-- 4. Table: users
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(50) DEFAULT NULL,
  `role` VARCHAR(50) NOT NULL DEFAULT 'agent',
  `status` VARCHAR(50) NOT NULL DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `role`, `status`) VALUES
(1, 'Administrator', 'admin@travelerp.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+1 555-0100', 'admin', 'active');

-- --------------------------------------------------------
-- 5. Table: destinations
-- --------------------------------------------------------
DROP TABLE IF EXISTS `destinations`;
CREATE TABLE `destinations` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `country` VARCHAR(255) NOT NULL,
  `state` VARCHAR(255) DEFAULT NULL,
  `city` VARCHAR(255) DEFAULT NULL,
  `description` TEXT DEFAULT NULL,
  `short_description` VARCHAR(255) DEFAULT NULL,
  `featured_image` VARCHAR(255) DEFAULT NULL,
  `banner_image` VARCHAR(255) DEFAULT NULL,
  `best_time` VARCHAR(255) DEFAULT NULL,
  `currency` VARCHAR(50) DEFAULT NULL,
  `language` VARCHAR(100) DEFAULT NULL,
  `timezone` VARCHAR(50) DEFAULT NULL,
  `featured` TINYINT(1) DEFAULT 0,
  `status` VARCHAR(50) NOT NULL DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `destinations` (`id`, `name`, `country`, `state`, `city`, `description`, `short_description`, `featured_image`, `banner_image`, `best_time`, `currency`, `language`, `timezone`, `featured`, `status`) VALUES
(1, 'Bali', 'Indonesia', 'Bali Province', 'Denpasar', 'Bali is a popular tourist destination, which is known for its highly developed arts, including traditional and modern dance, sculpture, painting, leather, metalworking, and music.', 'Tropical paradise with rich culture and beaches', 'https://images.unsplash.com/photo-1537996194471-e657df975ab4', 'https://images.unsplash.com/photo-1537996194471-e657df975ab4', 'April to October', 'IDR', 'Indonesian, Balinese', 'GMT+8', 1, 'active'),
(2, 'Swiss Alps', 'Switzerland', 'Bernese Oberland', 'Interlaken', 'The Swiss Alps are a defining natural feature of Switzerland, offering soaring snow-capped peaks, deep valleys, pristine glaciers, and crystalline lakes.', 'Majestic mountains and alpine meadows', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb', 'December to April', 'CHF', 'German, French, Italian', 'GMT+1', 1, 'active'),
(3, 'Tokyo', 'Japan', 'Kanto', 'Tokyo', 'Tokyo is Japan\'s bustling capital, mixing ultra-modern skyscrapers with historic temples, cherry blossoms, and world-class culinary experiences.', 'Neon lights, modern technology, and heritage', 'https://images.unsplash.com/photo-1503899036084-c55cdd92da26', 'https://images.unsplash.com/photo-1503899036084-c55cdd92da26', 'March to May', 'JPY', 'Japanese', 'GMT+9', 1, 'active'),
(4, 'Rajasthan', 'India', 'Rajasthan', 'Jaipur', 'Rajasthan is India\'s largest state by area, famous for its grand palaces, rugged forts, Thar Desert dunes, and vibrant heritage.', 'Land of kings, historic forts, and palaces', 'https://images.unsplash.com/photo-1477587458883-471a5ed08bc4', 'https://images.unsplash.com/photo-1477587458883-471a5ed08bc4', 'October to March', 'INR', 'Hindi, Rajasthani', 'GMT+5:30', 0, 'active'),
(5, 'Maldives', 'Maldives', 'Male Atoll', 'Male', 'Maldives is a tropical nation in the Indian Ocean composed of 26 ring-shaped atolls, which are made up of more than 1,000 coral islands, renowned for beach resorts and lagoons.', 'Overwater bungalows and turquoise lagoons', 'https://images.unsplash.com/photo-1439066615861-d1af74d74000', 'https://images.unsplash.com/photo-1439066615861-d1af74d74000', 'November to April', 'MVR', 'Dhivehi', 'GMT+5', 1, 'active');

-- --------------------------------------------------------
-- 6. Table: tour_packages & packages (Both structures supported)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tour_packages`;
CREATE TABLE `tour_packages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `destination_id` INT NOT NULL,
  `category` VARCHAR(100) DEFAULT NULL,
  `duration` VARCHAR(100) DEFAULT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `discount_price` DECIMAL(10,2) DEFAULT 0.00,
  `max_people` INT DEFAULT 10,
  `description` TEXT DEFAULT NULL,
  `highlights` TEXT DEFAULT NULL,
  `itinerary` TEXT DEFAULT NULL,
  `included` TEXT DEFAULT NULL,
  `excluded` TEXT DEFAULT NULL,
  `featured_image` VARCHAR(255) DEFAULT NULL,
  `gallery` TEXT DEFAULT NULL,
  `featured` TINYINT(1) DEFAULT 0,
  `status` VARCHAR(50) NOT NULL DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `packages`;
CREATE TABLE `packages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `destination_id` INT NOT NULL,
  `category` VARCHAR(100) DEFAULT NULL,
  `duration` VARCHAR(100) DEFAULT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `discount_price` DECIMAL(10,2) DEFAULT 0.00,
  `max_people` INT DEFAULT 10,
  `description` TEXT DEFAULT NULL,
  `highlights` TEXT DEFAULT NULL,
  `itinerary` TEXT DEFAULT NULL,
  `included` TEXT DEFAULT NULL,
  `excluded` TEXT DEFAULT NULL,
  `featured_image` VARCHAR(255) DEFAULT NULL,
  `gallery` TEXT DEFAULT NULL,
  `featured` TINYINT(1) DEFAULT 0,
  `status` VARCHAR(50) NOT NULL DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tour_packages` (`id`, `title`, `slug`, `destination_id`, `category`, `duration`, `price`, `discount_price`, `max_people`, `description`, `highlights`, `itinerary`, `included`, `excluded`, `featured_image`, `gallery`, `featured`, `status`) VALUES
(1, 'Bali Getaway Special', 'bali-getaway-special', 1, 'Beach Holidays', '5 Days / 4 Nights', 1200.00, 1000.00, 10, 'Experience the ultimate tropical vacation in Bali with premium resorts, white sand beach tours, and traditional temple visits.', 'Kuta Beach, Ubud Monkey Forest, Uluwatu Temple Sunset, Tanah Lot Temple', '[{\"day\":1,\"title\":\"Arrival & Hotel Transfer\",\"desc\":\"Arrive at Denpasar Airport and transfer to your resort in Seminyak.\"},{\"day\":2,\"title\":\"Ubud Culture & Swing Tour\",\"desc\":\"Explore Ubud forest, take photos on swing, and visit craft villages.\"},{\"day\":3,\"title\":\"Uluwatu Sunset Temple Tour\",\"desc\":\"Visit Uluwatu temple and watch Kecak Fire Dance.\"},{\"day\":4,\"title\":\"Tanah Lot Sea Temple visit\",\"desc\":\"Explore Tanah Lot Temple situated on a rock in the sea.\"},{\"day\":5,\"title\":\"Departure\",\"desc\":\"Transfer to airport for departure.\"}]', 'Airport pickup/drop, 4-star beach resort stay, Breakfast, English guide, Entrance fees', 'Airfares, Lunch & Dinners, Travel insurance, Tips', 'https://images.unsplash.com/photo-1537996194471-e657df975ab4', '[\"https://images.unsplash.com/photo-1537996194471-e657df975ab4\",\"https://images.unsplash.com/photo-1537996194471-e657df975ab4\"]', 1, 'active'),
(2, 'Swiss Alps Adventure', 'swiss-alps-adventure', 2, 'Mountain Adventure', '7 Days / 6 Nights', 3450.00, 0.00, 8, 'A breathtaking alpine tour covering Zermatt, Interlaken, and Lucerne. Ski in winter or hike in summer.', 'Matterhorn Peak view, Glacier Express ride, Mt. Titlis cable car, Lucerne lake cruise', '[{\"day\":1,\"title\":\"Arrival in Zurich & Lucerne\",\"desc\":\"Scenic train to Lucerne and Chapel Bridge.\"},{\"day\":2,\"title\":\"Mt. Pilatus Peak Tour\",\"desc\":\"Ride boat and cogwheel railway to peak.\"},{\"day\":3,\"title\":\"Interlaken Lakes\",\"desc\":\"Scenic transfer to Interlaken.\"},{\"day\":4,\"title\":\"Jungfraujoch\",\"desc\":\"Train journey to Top of Europe at 3454m.\"},{\"day\":5,\"title\":\"Zermatt Village\",\"desc\":\"Transfer to Zermatt directly underneath Matterhorn.\"},{\"day\":6,\"title\":\"Matterhorn Glacier Paradise\",\"desc\":\"Cable car to lookout platform.\"},{\"day\":7,\"title\":\"Departure via Zurich\",\"desc\":\"Train back to Zurich Airport.\"}]', 'Swiss Travel Pass (1st class), 3/4-star boutique hotel stays, Daily breakfast, Mountain railway tickets', 'Ski gear rental, Lunch/Dinner, Personal items, Flights', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb', '[\"https://images.unsplash.com/photo-1506744038136-46273834b3fb\",\"https://images.unsplash.com/photo-1506744038136-46273834b3fb\"]', 1, 'active'),
(3, 'Tokyo Express Tour', 'tokyo-express-tour', 3, 'Cultural Tours', '5 Days / 4 Nights', 2100.00, 1850.00, 12, 'Explore the futuristic metropolis of Tokyo. From Senso-ji temple in Asakusa to Shibuya Crossing.', 'Shibuya Crossing, Senso-ji temple, Tsukiji Outer Market, Mt. Fuji day excursion', '[{\"day\":1,\"title\":\"Tokyo Arrival\",\"desc\":\"Airport transfer and welcome dinner.\"},{\"day\":2,\"title\":\"Asakusa Temple\",\"desc\":\"Visit Tokyo oldest temple and Skytree.\"},{\"day\":3,\"title\":\"Shibuya Crossing\",\"desc\":\"Walk Harajuku and Shibuya intersection.\"},{\"day\":4,\"title\":\"Mt. Fuji Day Excursion\",\"desc\":\"Bus tour to Mt Fuji and Lake Ashi cruise.\"},{\"day\":5,\"title\":\"Departure\",\"desc\":\"Transfer to Narita or Haneda Airport.\"}]', 'Professional English guide, 4-star hotel Shinjuku, Welcome dinner, Airport transfers', 'Daily lunch/dinner, International flights, Optional activities', 'https://images.unsplash.com/photo-1503899036084-c55cdd92da26', '[\"https://images.unsplash.com/photo-1503899036084-c55cdd92da26\"]', 1, 'active');

INSERT INTO `packages` SELECT * FROM `tour_packages`;

-- --------------------------------------------------------
-- 7. Table: customers
-- --------------------------------------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `first_name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `phone` VARCHAR(50) DEFAULT NULL,
  `gender` VARCHAR(20) DEFAULT NULL,
  `dob` DATE DEFAULT NULL,
  `passport` VARCHAR(50) DEFAULT NULL,
  `passport_verified` TINYINT(1) DEFAULT 0,
  `nationality` VARCHAR(100) DEFAULT NULL,
  `address` VARCHAR(255) DEFAULT NULL,
  `city` VARCHAR(100) DEFAULT NULL,
  `country` VARCHAR(100) DEFAULT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email`, `phone`, `gender`, `dob`, `passport`, `passport_verified`, `nationality`, `address`, `city`, `country`, `status`) VALUES
(1, 'John', 'Doe', 'john.doe@gmail.com', '+1 555-0199', 'Male', '1985-05-12', 'US8901234', 1, 'American', '128 Baker Street', 'London', 'United Kingdom', 'active'),
(2, 'Sarah', 'Jenkins', 'sarah.j@hotmail.com', '+44 7911 123456', 'Female', '1992-09-24', 'UK4567890', 0, 'British', '56 High Street', 'Lucerne', 'Switzerland', 'active'),
(3, 'Amit', 'Sharma', 'amit.s@gmail.com', '+91 98765 43210', 'Male', '1989-11-04', 'IN789012', 1, 'Indian', 'Block C-2, Saket', 'New Delhi', 'India', 'inactive'),
(4, 'Michael', 'Brown', 'mbrown@yahoo.com', '+1 555-0348', 'Male', '1978-02-18', 'US5612348', 1, 'American', '742 Evergreen Terrace', 'Springfield', 'United States', 'active');

-- --------------------------------------------------------
-- 8. Table: flights
-- --------------------------------------------------------
DROP TABLE IF EXISTS `flights`;
CREATE TABLE `flights` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `flight_number` VARCHAR(50) NOT NULL,
  `airline` VARCHAR(100) NOT NULL,
  `departure_airport` VARCHAR(50) DEFAULT NULL,
  `arrival_airport` VARCHAR(50) DEFAULT NULL,
  `departure_time` VARCHAR(100) DEFAULT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `flights` (`id`, `flight_number`, `airline`, `departure_airport`, `arrival_airport`, `departure_time`, `price`, `status`) VALUES
(101, 'SQ-947', 'Singapore Airlines', 'SIN', 'DPS', '10:30 AM', 450.00, 'active'),
(103, 'JL-006', 'Japan Airlines', 'JFK', 'HND', '11:45 AM', 1100.00, 'active');

-- --------------------------------------------------------
-- 9. Table: hotels
-- --------------------------------------------------------
DROP TABLE IF EXISTS `hotels`;
CREATE TABLE `hotels` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `destination_id` INT NOT NULL,
  `rating` INT DEFAULT 5,
  `address` VARCHAR(255) DEFAULT NULL,
  `price_per_night` DECIMAL(10,2) NOT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `hotels` (`id`, `name`, `destination_id`, `rating`, `address`, `price_per_night`, `status`) VALUES
(201, 'Seminyak Beach Resort & Spa', 1, 5, 'Jalan Kayu Aya, Seminyak', 220.00, 'active'),
(202, 'Hotel Interlaken', 2, 4, 'Hoheweg 74, Interlaken', 310.00, 'active'),
(203, 'Shinjuku Granbell Hotel', 3, 4, 'Kabukicho 2-14-5, Tokyo', 180.00, 'active');

-- --------------------------------------------------------
-- 10. Table: bookings
-- --------------------------------------------------------
DROP TABLE IF EXISTS `bookings`;
CREATE TABLE `bookings` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `booking_number` VARCHAR(50) NOT NULL UNIQUE,
  `customer_id` INT NOT NULL,
  `package_id` INT NOT NULL,
  `flight_id` INT DEFAULT NULL,
  `hotel_id` INT DEFAULT NULL,
  `travel_date` DATE NOT NULL,
  `persons` INT DEFAULT 1,
  `total_amount` DECIMAL(10,2) NOT NULL,
  `discount_amount` DECIMAL(10,2) DEFAULT 0.00,
  `final_amount` DECIMAL(10,2) NOT NULL,
  `payment_status` VARCHAR(50) NOT NULL DEFAULT 'pending',
  `booking_status` VARCHAR(50) NOT NULL DEFAULT 'pending',
  `notes` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`package_id`) REFERENCES `tour_packages` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`) ON DELETE SET NULL,
  FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `bookings` (`id`, `booking_number`, `customer_id`, `package_id`, `flight_id`, `hotel_id`, `travel_date`, `persons`, `total_amount`, `discount_amount`, `final_amount`, `payment_status`, `booking_status`, `notes`) VALUES
(1, 'BK-8932', 1, 1, 101, 201, '2026-06-15', 2, 2400.00, 400.00, 2000.00, 'completed', 'confirmed', 'Requesting ocean-view room if available.'),
(2, 'BK-8931', 2, 2, NULL, 202, '2026-08-10', 1, 3450.00, 0.00, 3450.00, 'pending', 'pending', 'Need Swiss rail map pass.'),
(3, 'BK-8930', 3, 4, NULL, NULL, '2026-10-05', 4, 3400.00, 200.00, 3200.00, 'failed', 'cancelled', 'Payment got rejected by card issuer twice.'),
(4, 'BK-8929', 4, 3, 103, 203, '2026-07-20', 2, 4200.00, 500.00, 3700.00, 'completed', 'confirmed', 'Wants vegetarian meals on the flights.');

-- --------------------------------------------------------
-- 11. Table: payments
-- --------------------------------------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `booking_id` INT NOT NULL,
  `customer_id` INT NOT NULL,
  `transaction_id` VARCHAR(100) NOT NULL UNIQUE,
  `amount` DECIMAL(10,2) NOT NULL,
  `payment_method` VARCHAR(100) DEFAULT NULL,
  `gateway` VARCHAR(100) DEFAULT NULL,
  `gateway_response` TEXT DEFAULT NULL,
  `payment_status` VARCHAR(50) NOT NULL DEFAULT 'pending',
  `paid_at` DATETIME DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `payments` (`id`, `booking_id`, `customer_id`, `transaction_id`, `amount`, `payment_method`, `gateway`, `gateway_response`, `payment_status`, `paid_at`) VALUES
(1, 1, 1, 'TXN-74893012', 2000.00, 'Credit Card', 'Stripe', '{\"status\":\"succeeded\",\"code\":\"ch_893A021J\"}', 'completed', '2026-05-24 10:15:30'),
(2, 4, 4, 'TXN-74892945', 3700.00, 'PayPal', 'PayPal SDK', '{\"status\":\"approved\",\"paymentId\":\"PAYID-LOKI9\"}', 'completed', '2026-05-21 14:45:10'),
(3, 3, 3, 'TXN-74892900', 3200.00, 'Credit Card', 'Razorpay', '{\"status\":\"failed\",\"error\":\"insufficient_funds\"}', 'failed', '2026-05-22 09:30:15');

-- --------------------------------------------------------
-- 12. Table: staff
-- --------------------------------------------------------
DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `phone` VARCHAR(50) DEFAULT NULL,
  `designation` VARCHAR(100) DEFAULT NULL,
  `department` VARCHAR(100) DEFAULT NULL,
  `salary` DECIMAL(10,2) DEFAULT NULL,
  `joining_date` DATE DEFAULT NULL,
  `address` VARCHAR(255) DEFAULT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `staff` (`id`, `name`, `email`, `phone`, `designation`, `department`, `salary`, `joining_date`, `address`, `status`) VALUES
(1, 'Admin Staff', 'admin@travelerp.com', '+1 555-0100', 'Administrator', 'IT Support', 5000.00, '2026-01-10', '128 Admin St', 'active'),
(2, 'Emma Watson', 'emma.w@travelerp.com', '+1 555-0102', 'Booking Agent', 'Sales & Bookings', 3200.00, '2026-02-15', '45 Park Ave', 'active'),
(3, 'Rahul Verma', 'rahul@travelerp.com', '+91 99999 88888', 'Lead Accountant', 'Finance', 4500.00, '2026-03-01', '74 Saket Ring Rd', 'active');

-- --------------------------------------------------------
-- 13. Table: albums
-- --------------------------------------------------------
DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `albums` (`id`, `name`, `description`, `status`) VALUES
(1, 'Bali Adventure', 'Photos of beaches, temples and forests in Bali', 'active'),
(2, 'Swiss Winter', 'Snowy mountain landscapes and resorts', 'active');

-- --------------------------------------------------------
-- 14. Table: gallery
-- --------------------------------------------------------
DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `type` VARCHAR(50) NOT NULL DEFAULT 'image',
  `url` VARCHAR(255) NOT NULL,
  `album_id` INT DEFAULT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'active',
  `featured` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `gallery` (`id`, `title`, `type`, `url`, `album_id`, `status`, `featured`) VALUES
(1, 'Uluwatu Sunset', 'image', 'https://images.unsplash.com/photo-1537996194471-e657df975ab4', 1, 'active', 1),
(2, 'Swiss Alp Peaks', 'image', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb', 2, 'active', 1);

-- --------------------------------------------------------
-- 15. Table: coupons
-- --------------------------------------------------------
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `code` VARCHAR(50) NOT NULL UNIQUE,
  `type` VARCHAR(50) NOT NULL DEFAULT 'fixed',
  `discount` DECIMAL(10,2) NOT NULL,
  `minimum_amount` DECIMAL(10,2) DEFAULT 0.00,
  `expiry_date` DATETIME DEFAULT NULL,
  `usage_limit` INT DEFAULT NULL,
  `used_count` INT DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `coupons` (`id`, `code`, `type`, `discount`, `minimum_amount`, `expiry_date`, `usage_limit`, `used_count`, `status`) VALUES
(1, 'WELCOME100', 'fixed', 100.00, 500.00, '2026-12-31 23:59:59', 100, 5, 1),
(2, 'SUMMER15', 'percentage', 15.00, 1000.00, '2026-09-30 23:59:59', 50, 12, 1);

-- --------------------------------------------------------
-- 16. Table: reviews
-- --------------------------------------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `customer_id` INT NOT NULL,
  `package_id` INT NOT NULL,
  `rating` INT NOT NULL,
  `comment` TEXT DEFAULT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'pending',
  `featured` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`package_id`) REFERENCES `tour_packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `reviews` (`id`, `customer_id`, `package_id`, `rating`, `comment`, `status`, `featured`) VALUES
(1, 1, 1, 5, 'Absolutely gorgeous! Highly recommend this agency.', 'approved', 1),
(2, 2, 2, 4, 'Very well organized, but the Swiss weather was cold.', 'approved', 0);

-- --------------------------------------------------------
-- 17. Table: visas
-- --------------------------------------------------------
DROP TABLE IF EXISTS `visas`;
CREATE TABLE `visas` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `country` VARCHAR(255) NOT NULL,
  `visa_type` VARCHAR(100) NOT NULL,
  `processing_time` VARCHAR(100) DEFAULT NULL,
  `validity` VARCHAR(100) DEFAULT NULL,
  `entry_type` VARCHAR(100) DEFAULT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `documents_required` TEXT DEFAULT NULL,
  `description` TEXT DEFAULT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `visas` (`id`, `country`, `visa_type`, `processing_time`, `validity`, `entry_type`, `price`, `documents_required`, `description`, `status`) VALUES
(1, 'United States', 'Tourist B1/B2', '15 Days', '10 Years', 'Multiple Entry', 160.00, 'Passport, DS-160 Confirmation, Interview Appointment', 'Standard tourist visa for visiting USA for tourism or business meetings.', 'active'),
(2, 'Schengen Area', 'Short Stay C-Type', '10 Days', '90 Days', 'Multiple Entry', 90.00, 'Passport, Flight tickets, Hotel voucher, Travel Insurance', 'Schengen travel visa covering 27 European countries.', 'active');

-- --------------------------------------------------------
-- 18. Table: banners
-- --------------------------------------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `subtitle` VARCHAR(255) DEFAULT NULL,
  `image_url` VARCHAR(255) DEFAULT NULL,
  `link_url` VARCHAR(255) DEFAULT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `banners` (`id`, `title`, `subtitle`, `image_url`, `link_url`, `status`) VALUES
(1, 'Explore the World with Us', 'Get up to 30% off on premium international packages.', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb', '/packages', 'active'),
(2, 'Adventure Awaits', 'Book custom mountain treks and camping tours today.', 'https://images.unsplash.com/photo-1537996194471-e657df975ab4', '/packages', 'active');

-- --------------------------------------------------------
-- 19. Table: pages
-- --------------------------------------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `content` TEXT DEFAULT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `status`) VALUES
(1, 'About Us', 'about', '<p>Welcome to Travel ERP agency.</p>', 'active'),
(2, 'Privacy Policy', 'privacy', '<p>Your privacy is important to us.</p>', 'active');

-- --------------------------------------------------------
-- 20. Table: news
-- --------------------------------------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `summary` VARCHAR(500) DEFAULT NULL,
  `content` TEXT DEFAULT NULL,
  `image_url` VARCHAR(255) DEFAULT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `news` (`id`, `title`, `slug`, `summary`, `content`, `image_url`, `status`) VALUES
(1, 'Travel Restrictions Lifted', 'travel-restrictions-lifted', 'Most countries have now fully lifted COVID-19 testing requirements for tourists.', 'Full content details regarding international tourism guidelines.', 'https://images.unsplash.com/photo-1503899036084-c55cdd92da26', 'active'),
(2, 'New Bali Resorts Opened', 'new-bali-resorts-opened', 'Luxury eco-friendly beach villas opened in Uluwatu.', 'Detailed announcement of premium resorts partner list.', 'https://images.unsplash.com/photo-1537996194471-e657df975ab4', 'active');

-- --------------------------------------------------------
-- 21. Table: seo_settings
-- --------------------------------------------------------
DROP TABLE IF EXISTS `seo_settings`;
CREATE TABLE `seo_settings` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `page_name` VARCHAR(100) NOT NULL UNIQUE,
  `meta_title` VARCHAR(255) DEFAULT NULL,
  `meta_description` TEXT DEFAULT NULL,
  `meta_keywords` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `seo_settings` (`id`, `page_name`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(1, 'home', 'Travel ERP | Premier Travel Management', 'Plan and book international destinations, hotels, flights, and tour packages online.', 'travel erp, tour planning, holiday bookings'),
(2, 'packages', 'Tour Packages | Best Vacation Deals', 'Browse cheap and luxury travel packages for families and couples.', 'vacation packages, group tours, discounts');

-- --------------------------------------------------------
-- 22. Table: booking_timeline
-- --------------------------------------------------------
DROP TABLE IF EXISTS `booking_timeline`;
CREATE TABLE `booking_timeline` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `booking_id` INT NOT NULL,
  `status` VARCHAR(100) NOT NULL,
  `notes` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `booking_timeline` (`id`, `booking_id`, `status`, `notes`) VALUES
(1, 1, 'Created', 'Booking BK-8932 initialized by agent.'),
(2, 1, 'Payment Completed', 'Stripe payment of $2000 verified successfully.'),
(3, 1, 'Confirmed', 'Hotel and flight bookings locked in.');

SET FOREIGN_KEY_CHECKS = 1;
