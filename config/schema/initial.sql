CREATE TABLE `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `block_url` varchar(200) NOT NULL,
  `addr` varchar(100) NOT NULL,
  `landing_url` varchar(200) NOT NULL,
  `comment` text NOT NULL,
  `reported_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `landings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `landing_url` varchar(200) CHARACTER SET utf8 NOT NULL,
  `approved` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
