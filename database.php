CREATE DATABASE phpcrud;
use phpcrud;

CREATE TABLE IF NOT EXISTS `contacts` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  	`name` varchar(255) NOT NULL,
  	`email` varchar(255) NOT NULL,
  	`phone` varchar(13) NOT NULL,
  	`title` varchar(255) NOT NULL,
  	`created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `title`, `created`) VALUES
(1, 'John Doe', 'johndoe@example.com', '2026550143', 'Lawyer', '2019-05-08 17:32:00'),
(2, 'David Deacon', 'daviddeacon@example.com', '2025550121', 'Employee', '2019-05-08 17:28:44'),
(3, 'Sam White', 'samwhite@example.com', '2004550121', 'Employee', '2019-05-08 17:29:27'),
(4, 'Colin Chaplin', 'colinchaplin@example.com', '2022550178', 'Supervisor', '2019-05-08 17:29:27'),
(5, 'Ricky Waltz', 'rickywaltz@example.com', '7862342390', '', '2019-05-09 19:16:00'),
(6, 'Arnold Hall', 'arnoldhall@example.com', '5089573579', 'Manager', '2019-05-09 19:17:00'),
(7, 'Toni Adams', 'alvah1981@example.com', '2603668738', '', '2019-05-09 19:19:00'),
(8, 'Donald Perry', 'donald1983@example.com', '7019007916', 'Employee', '2019-05-09 19:20:00'),
(9, 'Joe McKinney', 'nadia.doole0@example.com', '6153353674', 'Employee', '2019-05-09 19:20:00'),
(10, 'Angela Horst', 'angela1977@example.com', '3094234980', 'Assistant', '2019-05-09 19:21:00'),
(11, 'James Jameson', 'james1965@example.com', '4002349823', 'Assistant', '2019-05-09 19:32:00'),
(12, 'Daniel Deacon', 'danieldeacon@example.com', '5003423549', 'Manager', '2019-05-09 19:33:00');





CREATE TABLE IF NOT EXISTS `revistas` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  	`namer` varchar(50) NOT NULL,
  	`ano` int NOT NULL,
  	`edicao` int NOT NULL,
  	`datacadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  	`foto` varchar (30) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO `revistas` (`id`, `namer`, `ano`, `edicao`, `datacadastro`, `foto`) VALUES
(1, 'Vogue', '2023', '34356787', '2023-01-08 17:28:44', 'vogue.jpeg'),
(2, 'Capricho', '2022', '25389670', '2023-01-08 17:28:44', 'capricho.jpeg'),
(3, 'Veja!', '2022', '35415798', '2023-01-08 17:28:44', 'veja.jpeg'),
(4, 'Hello Mr.', '2023', '2022550178', '2023-01-08 17:28:44', 'hellomr.jpeg'),
(5, 'Superinteressante', '2022', '35738092', '2023-01-08 17:28:44', 'superinteressante.jpeg'),
(6, 'Revista Istoé', '2021', '587081278', '2023-01-08 17:28:44', 'istoe.jpeg'),
(7, 'The Economist', '2020', '97804515', '2023-01-08 17:28:44', 'economist.jpeg'),
(8, 'Time', '2019', '762890198', '2023-01-08 17:28:44', 'time.jpeg'),
(9, 'Caras', '2021', '10298467', '2023-01-08 17:28:44', 'caras.jpeg'),
(10, 'People', '2020', '726198372', '2023-01-08 17:28:44', 'people.jpeg'),
(11, 'Recreio', '2023', '73928503', '2023-01-08 17:28:44', 'recreio.jpeg'),
(12, 'Vanity Fair', '2022', '190283749', '2023-01-08 17:28:44', 'vanityfair.jpeg');