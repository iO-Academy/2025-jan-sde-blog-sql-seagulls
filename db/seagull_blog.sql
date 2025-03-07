# ************************************************************
# Sequel Ace SQL dump
# Version 20086
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 11.7.2-MariaDB-ubu2404)
# Database: seagull_blog
# Generation Time: 2025-03-07 09:36:21 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `category`)
VALUES
	(1,'news'),
	(2,'gaming'),
	(3,'films'),
	(4,'tv'),
	(5,'science_nature');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` varchar(200) DEFAULT NULL,
  `date_posted` date NOT NULL,
  `time_posted` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `username_id`, `post_id`, `content`, `date_posted`, `time_posted`)
VALUES
	(1,2,2,'sifkgbskfgbskfgbsfhgsk','2025-01-22','10:00:00'),
	(2,2,1,'tsogbsfkjgsfgsf','2025-02-02','09:00:00'),
	(11,2,1,'gdfgudfhghdfhgiduhg','2025-03-06','15:50:31'),
	(12,2,1,'gdfgudfhghdfhgiduhg','2025-03-06','15:50:36'),
	(13,2,1,'gdfgudfhghdfhgiduhg','2025-03-06','15:50:42'),
	(14,2,2,'ggdfsgdfgdfsgdsfg','2025-03-06','15:58:00'),
	(15,2,2,'ggdfsgdfgdfsgdsfg','2025-03-06','15:58:08'),
	(16,2,2,'ggdfsgdfgdfsgdsfg','2025-03-06','15:59:02'),
	(17,2,2,'ggdfsgdfgdfsgdsfg','2025-03-06','15:59:05'),
	(18,2,2,'ggdfsgdfgdfsgdsfg','2025-03-06','15:59:20'),
	(19,2,1,'fghfghdfhfhfg','2025-03-06','16:03:57'),
	(20,2,1,'fghfghdfhfhfg','2025-03-06','16:05:38'),
	(21,2,1,'fghfghdfhfhfg','2025-03-06','16:05:43'),
	(22,2,1,'gdfgsdfgdfsg','2025-03-06','16:22:39'),
	(23,2,1,'giodfjgiojdg','2025-03-06','16:26:16'),
	(24,2,1,'gfdhghdfuhguifdhg','2025-03-06','16:26:37'),
	(25,2,1,'gdfhuhguihdfgiuh','2025-03-06','16:27:03'),
	(26,2,1,'gdfhuhguihdfgiuh','2025-03-06','16:27:06');

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table likes_dislikes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `likes_dislikes`;

CREATE TABLE `likes_dislikes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `posts_id` int(11) unsigned NOT NULL,
  `users_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

LOCK TABLES `likes_dislikes` WRITE;
/*!40000 ALTER TABLE `likes_dislikes` DISABLE KEYS */;

INSERT INTO `likes_dislikes` (`id`, `posts_id`, `users_id`)
VALUES
	(28,1,2),
	(29,2,2);

/*!40000 ALTER TABLE `likes_dislikes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `username_id` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `date_posted` date NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `dislikes` int(11) NOT NULL DEFAULT 0,
  `time_posted` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `title`, `username_id`, `content`, `date_posted`, `category_id`, `likes`, `dislikes`, `time_posted`)
VALUES
	(1,'Seagulls are awesome!','1','Seagulls are often seen as mere beachside scavengers, but they are truly remarkable birds. One of the most impressive aspects of seagulls is their adaptability. Whether they\'re living near bustling cities or remote coastlines, seagulls can thrive in diverse environments. Their ability to find food in a wide variety of settings, from garbage dumps to oceanic shores, showcases their resourcefulness and intelligence.\nSeagulls are also great for the environment. They play a crucial role in controlling pest populations by feeding on insects, small animals, and even dead fish. Their scavenging helps to clean up areas, preventing the spread of disease. Seagulls also serve as an important part of the food chain, providing nourishment to predators higher up, such as large birds of prey.','2025-03-03',1,11,11,'10:40:22'),
	(2,'SQL is awesome!','2','SQL is the best','2025-02-01',2,56,1,'15:22:00'),
	(6,'The Secret Life of Seagulls: More Than Just Beach Thieves','2','Seagulls are one of the most recognizable birds in the world, often associated with sandy beaches, crashing waves, and stolen French fries. But beyond their reputation as opportunistic snack thieves, these intelligent and highly adaptable birds have fascinating lives that many people overlook. Let’s take a closer look at the world of seagulls and discover why they deserve more credit than they often get.\r\n\r\nMasters of Adaptation\r\n\r\nSeagulls belong to the Laridae family, and they can be found all over the world, from coastal shores to urban landscapes. Unlike many bird species that rely solely on a specific habitat, seagulls thrive in a variety of environments. They have learned to coexist with humans, often nesting on rooftops and scavenging for food in city streets. Their ability to adapt to changing conditions makes them one of nature’s great survivors.\r\n\r\nSmart and Social Creatures\r\n\r\nSeagulls are surprisingly intelligent birds. Studies have shown that they use tools, such as dropping shellfish onto rocks to crack them open. They also have strong social structures and exhibit teamwork when hunting or scavenging for food. Some species even engage in a behavior called “foot paddling,” where they stomp their feet on wet sand to trick worms into surfacing, making them easy prey.\r\n\r\nCommunication and Parenting\r\n\r\nSeagulls are highly communicative birds, using a range of calls and body language to interact with one another. They are also dedicated parents, with both male and female gulls taking turns incubating eggs and feeding their chicks. Young seagulls remain with their parents for several months, learning essential survival skills before venturing out on their own.\r\n\r\nThe Misunderstood Opportunists\r\n\r\nMany people view seagulls as a nuisance, particularly in areas where they have become accustomed to human food. However, their scavenging behavior is actually an important part of the ecosystem. Seagulls help clean up dead fish and organic waste, preventing the spread of disease. Their presence in coastal areas is a natural part of the environment, and their interactions with humans are simply a testament to their ability to adapt.\r\n\r\nHow to Coexist with Seagulls\r\n\r\nIf you frequent the beach or live near the coast, here are a few ways to peacefully coexist with seagulls:\r\n\r\nDon’t feed them. Feeding seagulls encourages aggressive behavior and disrupts their natural foraging habits.\r\n\r\nSecure your food. If you’re eating outdoors, keep your snacks covered to avoid attracting unwanted attention.\r\n\r\nRespect their space. Seagulls are wild animals, and disturbing their nests can lead to defensive behavior.\r\n\r\nFinal Thoughts\r\n\r\nSeagulls may have a reputation for being pesky, but they are remarkable birds with impressive intelligence, adaptability, and ecological importance. The next time you see a seagull, take a moment to appreciate its resilience and resourcefulness. Who knows? Maybe there’s more to their beachside antics than meets the eye!','2025-03-04',0,1,0,'15:15:00'),
	(7,'Seagulls and SQL: Unexpected Parallels in Nature and Data Management','2','Seagulls are one of the most recognizable birds in the world, often associated with sandy beaches, crashing waves, and stolen French fries. But beyond their reputation as opportunistic snack thieves, these intelligent and highly adaptable birds share some surprising similarities with the world of SQL (Structured Query Language). Both excel in efficiency, adaptability, and problem-solving. Let’s take a closer look at what seagulls and SQL have in common and why both are crucial in their respective domains.\r\n\r\nMasters of Adaptation\r\n\r\nSeagulls belong to the Laridae family and thrive in diverse environments, from coastal shores to bustling cities. Their ability to find food and shelter in ever-changing conditions makes them resilient survivors. Similarly, SQL is a universal language in database management, capable of working across different platforms and industries. Whether handling financial data, organizing customer information, or powering an e-commerce site, SQL adapts to various use cases just as seagulls adjust to different habitats.\r\n\r\nEfficient and Resourceful\r\n\r\nSeagulls are natural problem solvers, using creative techniques to obtain food, such as dropping shellfish onto rocks to crack them open. Their ability to find the most effective way to secure a meal mirrors SQL’s approach to retrieving data efficiently. SQL queries are designed to optimize performance, filtering large datasets with commands like SELECT, JOIN, and INDEX to ensure quick and accurate data retrieval. Just as seagulls maximize their energy use, SQL streamlines database operations.\r\n\r\nCommunication and Structure\r\n\r\nSeagulls rely on a structured system of calls and body language to coordinate with one another, whether warning of danger or guiding young chicks. Similarly, SQL serves as a structured communication tool between users and databases, providing clear, standardized commands to retrieve or modify information. Without structure, both seagull flocks and databases would be chaotic and inefficient.\r\n\r\nThe Misunderstood Opportunists\r\n\r\nSeagulls are often seen as pests due to their habit of scavenging human food, but in reality, they play a crucial ecological role by cleaning up organic waste. Likewise, SQL can seem daunting or overly complex to those unfamiliar with it, yet it is fundamental to organizing, securing, and managing data. Both seagulls and SQL are often underestimated despite their valuable contributions.\r\n\r\nBest Practices for Working with Seagulls and SQL\r\n\r\nIf you want to appreciate both seagulls and SQL, here are some best practices:\r\n\r\nOptimize efficiency. Seagulls use minimal energy for maximum results, just as SQL queries should be written to retrieve data with the least processing power.\r\n\r\nFollow logical structure. Seagulls communicate within their flock using consistent patterns, while SQL databases require well-structured schemas for reliable data management.\r\n\r\nRespect their role. Seagulls contribute to the environment, and SQL is the backbone of modern data-driven applications—both deserve recognition.\r\n\r\nFinal Thoughts\r\n\r\nAt first glance, seagulls and SQL seem to have little in common, but a deeper look reveals shared qualities of adaptability, efficiency, and structure. Seagulls are natural survivors in a dynamic world, and SQL enables businesses to navigate the vast ocean of data. The next time you see a seagull in action or write an SQL query, take a moment to appreciate their strategic intelligence!','2025-03-04',0,0,0,'15:16:52');

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` char(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `password`, `email`)
VALUES
	(1,'sqlseagulls','sqlseagulls','sqlseagulls@gmail.com'),
	(2,'seagulls','seagulls','seagulls@aol.com'),
	(3,'seagull2','seagull2','seagulls@seagulls.com'),
	(4,'newseagull','seagull','seagulls@seagulls.com'),
	(5,'anothernewseagull','seagulls','seagulls@seagulls.com');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
