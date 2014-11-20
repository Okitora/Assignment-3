-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 02, 2014 at 12:50 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `comp4711`
--
-- --------------------------------------------------------
--
-- Table structure for table `Attraction`
--
DROP TABLE IF EXISTS `Attraction`;
CREATE TABLE IF NOT EXISTS `Attraction` (
  `main_id` varchar(32) NOT NULL,
  `sub_id` varchar(32) NOT NULL,
  `attr_name` varchar(32) NOT NULL,
  `attr_id` varchar(32) NOT NULL,
  `contact` varchar(32) NOT NULL,
  `price` varchar(32) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `date` varchar(32) NOT NULL,
  `image_name` varchar(32) NOT NULL,
  PRIMARY KEY (`attr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `sub_cat`
--
DROP TABLE IF EXISTS `sub_cat`;
CREATE TABLE IF NOT EXISTS `sub_cat` (
  `main_id` varchar(32) NOT NULL,
  `sub_id` varchar(32) NOT NULL,
  `image_name` varchar(32) NOT NULL,
  `sub_name` varchar(32) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `main_cat`
--
DROP TABLE IF EXISTS `main_cat`;
CREATE TABLE IF NOT EXISTS `main_cat` (
  `main_id` varchar(32) NOT NULL,
  `image_name` varchar(32) NOT NULL,
  `main_name` varchar(32) NOT NULL,
  PRIMARY KEY (`main_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

-- images in /data folder in webapp
INSERT INTO `main_cat` (`main_id`, `main_name`, `image_name`) VALUES
('e', 'entertainment'	,       'Avatar480.jpg'),
('f', 'family fun'	, 'Rarotongan-Beach-Resort-.jpg'),
('s', 'shopping'	, 'rotorua-souvenir-shops.jpg'),
('t', 'eco tourism'	, 'NewZealand-Urupukapuka.jpg'),
('w', 'sight seeing'	,       '7184514_660x250.jpg');

-- images in /data folder in webapp
INSERT INTO `sub_cat` (`main_id`, `sub_id`, `sub_name`, `image_name`) VALUES
('e', 'ra'	, 'racing'		, 'Real racing 3.jpg'),
('e', 'nc'	, 'nightclub'	,       'rumours-nightclub2.jpg'),
('e', 'st'	, 'stadium'		, 'Azteca-Stadium-1024x682.jpg'),

('f', 'mo'	, 'movies',             'Auckland Civic Theatre.jpg'),
('f', 'ng'	, 'nature garden'	, '326350-svetik.jpg'),
('f', 'tp'	, 'theme park'		, 'Wet’nWild-Water-World.jpg'),

('s', 'sm'	, 'shopping mall'	, 'shopping-mall-723514.jpg'),
('s', 'df'	, 'duty free'		, 'duty-free-stores.jpg'),
('s', 'ts'	, 'tourist shops'	, 'Arts___Crafts.JPG'),

('t', 'vo'	, 'volcanoes'		, 'Tavurvur_volcano_edit.jpg'),
('t', 'bw'	, 'bird watching'	, 'Home-Page-02.jpg'),
('t', 'yc'	, 'yacht cruising'	, 'yacht2.jpg'),

('w', 'tr'	, 'trails'		, 'SkylineTrailNewZealand.jpg'),
('w', 'wt'	, 'walking tracks'	, 'p-12828-doc.jpg'),
('w', 'cw'	, 'coast walks'		, 'New Zealand Landscape.JPG');

-- images in /data folder in webapp
INSERT INTO `attraction` (`main_id`, `sub_id`, `attr_id`, `attr_name`, `contact`, `price`,`description`, `date`, `image_name`) VALUES
('e', 'ra'	, 'kkc'	, 'Kaikohe Car Club'		, '09 238 4680', '***', 
	'Kaikohe Speedway started in the Kaikohe District in 1974, on a grass track approximately 300 meters along the Ngawha Springs Road (7 km from Kaikohe). 
Kaikohe Car Club moved to its present location along State Highway 12 approximately 4kms SE of in Kaikohe 1975.  
The Kaikohe Car Club became an Incorporated Society on the 7th December 1976. 
During the race season a standard race day can see up to 400 people through our gates, however during a special or invitation meet we see numbers of 4000 plus. 
Visitors come from all over the North Island, this not only creates revenue for the Speedway but filters out to the wider community; Kaikohe, Kerikeri, Kawakawa, Paihia etc. 
Kaikohe Speedway was put on the world map with the recognition of Florian Habichts movie Kaikohe Demolition.',
1393621846, 'kkc.JPG'),

('e', 'nc'	, 'sb'	, 'Smartbar'				, '09 349 5791', '**', 
	'Our stylish modern bar is a popular local venue for a great night out. 
Situated in Pukekohes town centre, Smart bar has a warm, elegant and stylish seating areas that can be enjoyed while catching up with friends over drinks. 
Later in the night Smart Bar transforms into a funky night club attracting some of the best Djs and Artist in the country.',
1393125846, 'sb.jpg'),

('e', 'st'	, 'nhs'	, 'North Harbour Stadium'	, '09 450 6802', '***', 
	'Opened in 1997, our architecturally designed, 25-000 capacity Stadium is purpose built for New Zealands favourite sporting codes of rugby union, rugby league and football, and we are a popular venue for outdoor concerts and entertainment events. 
Our corporate hospitality facilities also offer a relaxed environment for business meetings, seminars, conferences and trade shows, as well as private functions and weddings.',
1244621846, 'nhs.jpg'),

('f', 'mo', 'oac'	, 'Open Air Cinema'					, '09 561 7913', '*'
	, 'Openair Cinema Ltd. is a New Zealand based company founded in 2003 – 100% Kiwi owned and operated. 
It staged the first big screen open air cinema in New Zealand at Auckland’s Viaduct Harbour in January 2004.',
1393625286, 'oap.jpg'),

('f', 'ng', 'kcsg'	, 'Kaipara Coast Sculpture Gardens'	, '09 672 8024', '*'
	, 'Kaipara Coast Sculpture Gardens are a tranquil, peaceful oasis set in gardens on a rural property looking out to the Kaipara Harbour. 
It features selected contemporary sculptures, created by established and emerging New Zealand artists.',
1538221846, 'kcsg.jpg'),

('f', 'tp', 'cap'	, 'Commando Attack Paintball'		, '09 783 9135', '**'
	, 'Paintball is an awesome way to anticipate teamwork & bonding. perfect for sports clubs. 
also a great idea for a Memorable Birthday. The perfect activity for a Stag or Hen party And just the thing for a Corporate event!',
1392055946, 'cap.jpg'),


('s', 'sm', 'rosm'	, 'Royal Oak Shopping Mall'	, '09 894 0246', '****'
	, 'There are over 50 shops, many of which are national brands. 
We are a friendly community based Shopping Mall, with unique and interesting Retailers that offer a diverse range for our customers. 
For a pleasant shopping experience come to the Royal Oak Shopping Mall, it is air-conditioned, has ample free parking and we are open 7 days.',
1295811846, 'rosm.jpg'),

('s', 'df', 'dfsg'	, 'dfs galleria'			, '09 905 1357', '***'
	, 'Asia-Pacific was their frontier, and through the years, DFS expanded quickly. 
Every store reflected the founders’ passions for travel and service. 
Innovative merchandising strategies and the license to sell duty free goods attracted the attention of the world’s leading luxury brands — many of which continue to be our partners today.',
1393622846, 'dfsg.jpg'),

('s', 'ts', 'vpm'	, 'Victoria Park Market'	, '09 538 6802', '*'
	, 'The $20,000,000 refurbishment of Victoria Park Market is now drawing to an end. 
With 85% of the revitalised shops now let to a cross section of Food, Hospitality and Retail tenants. 
The market is now partially open and scheduled to be completed in Febuary 2013. 
The Market is owned by the consortium Victoria Quarter Trust and renovated by CMP Construction Limited, leaders in heritage building refurbishments.'
, 1254079945, 'vpm.jpg'),

('t', 'vo', 'wit'	, 'White Island Tours'	, '09 448 1802', '***'
	, 'White Island Tours offers you the incredible experience of exploring the inner crater of New Zealand’s only active marine volcano – White Island!  
Located 49km off the coast of Whakatane, New Zealand, White Island Tours offers its visitors a 6 hour adventure to this fascinating island volcano.',
1139583769, 'wit.jpg'),

('t', 'bw', 'kwt'	, 'Kiwi Wildlife Tours'	, '09 539 6832', '*'
	, 'Our very experienced leaders have intimate knowledge of the whole country. 
We make frequent trips into the field as guides and tour leaders as well as researching new locations. 
Our excellent network of contacts throughout NZ ensures we have the most up-to-date information about NZs special birds and where to find them. 
Our policy is to make sure visitors enjoy our country, and while birds (and birding) may be the focus, there is a great deal to see and experience besides. ',
1459222481, 'kwt.jpg'),

('t', 'yc', 'tv'	, 'Te Vaka'				, '09 938 7802', '*****'
	, 'Te Vaka is a modern powerful, sloop rigged, high performance off shore cruising yacht based in the Bay of Islands. 
This specially designed 60ft yacht has graceful racing lines offering an unparalleled sailing adventure, whatever level of excitement you require.',
1222621846, 'tv.jpg'),

('w', 'tr', 'ht'	, 'Hillary Trail'						, '09 448 7902', '*'
	, 'The Hillary Trail is a self-guided four day tramp through 77km of native forest and along the wild coast of the Waitakere Ranges Regional Park. 
It connects various park tracks and basic backcountry campgrounds. The trail captures Sir Edmund Hillarys sense of adventure and introduces you to the joys of overnight camping.',
1234621846, 'ht.jpg'),

('w', 'wt', 'wnhwt'	, 'Whangaruru North Head Walking Tracks', '09 432 8812', '*'
	, 'From the popular campsite and amenity area at Puriri Bay are a series of interlinked walks. 
They follow through native forest along ridgelines giving panoramic views of the harbour and open coastlines. 
The tracks drop down into secluded bays, such as Admirals Bay, suitable for swimming and snorkelling.',
1234521846, 'wnhwt.jpg'),

('w', 'cw', 'bhcw'	, 'Bream Head Coast Walks'				, '09 437 9803', '**'
	, 'Situated at Whangarei Heads our boutique walk encompasses private farmland, stunning ocean and harbour beaches, rural roads, recreational reserves and existing public walkways.',
1393621826, 'bhcw.jpg');
	
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





