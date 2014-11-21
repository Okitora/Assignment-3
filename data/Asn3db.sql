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
  `attr_code` varchar(32) NOT NULL,
  `attr_name` varchar(32) NOT NULL,
  `cate_code` varchar(32) NOT NULL,
  `category` varchar(32) NOT NULL,
  `price` varchar(32) NOT NULL,
  `xml_desc` varchar(1000) NOT NULL,
  `target` varchar(32) NOT NULL,
  PRIMARY KEY (`attr_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

-- images in /data folder in webapp
INSERT INTO `attraction` (`attr_code`, `attr_name`, `cate_code`, `category`, `price`,`xml_desc`, `target`) VALUES
('01', 'Kaikohe Car Club', 'e', 'entertainment', '***', 
	'Kaikohe Speedway started in the Kaikohe District in 1974, on a grass track approximately 300 meters along the Ngawha Springs Road (7 km from Kaikohe). 
Kaikohe Car Club moved to its present location along State Highway 12 approximately 4kms SE of in Kaikohe 1975.  
The Kaikohe Car Club became an Incorporated Society on the 7th December 1976. 
During the race season a standard race day can see up to 400 people through our gates, however during a special or invitation meet we see numbers of 4000 plus. 
Visitors come from all over the North Island, this not only creates revenue for the Speedway but filters out to the wider community; Kaikohe, Kerikeri, Kawakawa, Paihia etc. 
Kaikohe Speedway was put on the world map with the recognition of Florian Habichts movie Kaikohe Demolition.',
'Adult'),

('02', 'Smartbar', 'e', 'entertainment', '**', 
	'Our stylish modern bar is a popular local venue for a great night out. 
Situated in Pukekohes town centre, Smart bar has a warm, elegant and stylish seating areas that can be enjoyed while catching up with friends over drinks. 
Later in the night Smart Bar transforms into a funky night club attracting some of the best Djs and Artist in the country.',
 'teenager'),

('03', 'North Harbour Stadium'	, 'e', 'entertainment', '***', 
	'Opened in 1997, our architecturally designed, 25-000 capacity Stadium is purpose built for New Zealands favourite sporting codes of rugby union, rugby league and football, and we are a popular venue for outdoor concerts and entertainment events. 
Our corporate hospitality facilities also offer a relaxed environment for business meetings, seminars, conferences and trade shows, as well as private functions and weddings.',
 'kids'),

('04', , 'Open Air Cinema', 'f', 'family fun', '*'
	, 'Openair Cinema Ltd. is a New Zealand based company founded in 2003 – 100% Kiwi owned and operated. 
It staged the first big screen open air cinema in New Zealand at Auckland’s Viaduct Harbour in January 2004.',
 'kids'),

('05', 'Kaipara Coast Sculpture Gardens', 'f', 'family fun', '*'
	, 'Kaipara Coast Sculpture Gardens are a tranquil, peaceful oasis set in gardens on a rural property looking out to the Kaipara Harbour. 
It features selected contemporary sculptures, created by established and emerging New Zealand artists.',
 'adult'),

('06', 'Commando Attack Paintball', 'f', 'family fun', '**'
	, 'Paintball is an awesome way to anticipate teamwork & bonding. perfect for sports clubs. 
also a great idea for a Memorable Birthday. The perfect activity for a Stag or Hen party And just the thing for a Corporate event!',
 'teenager'),


('07', 'Royal Oak Shopping Mall', 's', 'shopping', '****'
	, 'There are over 50 shops, many of which are national brands. 
We are a friendly community based Shopping Mall, with unique and interesting Retailers that offer a diverse range for our customers. 
For a pleasant shopping experience come to the Royal Oak Shopping Mall, it is air-conditioned, has ample free parking and we are open 7 days.',
 'teenager'),

('08'	, 'dfs galleria', 's', 'shopping', '***'
	, 'Asia-Pacific was their frontier, and through the years, DFS expanded quickly. 
Every store reflected the founders’ passions for travel and service. 
Innovative merchandising strategies and the license to sell duty free goods attracted the attention of the world’s leading luxury brands — many of which continue to be our partners today.',
 'adult'),

('09'	, 'Victoria Park Market', 's', 'shopping', '*'
	, 'The $20,000,000 refurbishment of Victoria Park Market is now drawing to an end. 
With 85% of the revitalised shops now let to a cross section of Food, Hospitality and Retail tenants. 
The market is now partially open and scheduled to be completed in Febuary 2013. 
The Market is owned by the consortium Victoria Quarter Trust and renovated by CMP Construction Limited, leaders in heritage building refurbishments.'
'kids'),

('10'	, 'White Island Tours'	, 't', 'eco tourism', '***'
	, 'White Island Tours offers you the incredible experience of exploring the inner crater of New Zealand’s only active marine volcano – White Island!  
Located 49km off the coast of Whakatane, New Zealand, White Island Tours offers its visitors a 6 hour adventure to this fascinating island volcano.',
'teenager'),

('11'	, 'Kiwi Wildlife Tours'	, 't', 'eco tourism', '*'
	, 'Our very experienced leaders have intimate knowledge of the whole country. 
We make frequent trips into the field as guides and tour leaders as well as researching new locations. 
Our excellent network of contacts throughout NZ ensures we have the most up-to-date information about NZs special birds and where to find them. 
Our policy is to make sure visitors enjoy our country, and while birds (and birding) may be the focus, there is a great deal to see and experience besides. ',
'kids'),

('12'	, 'Te Vaka', 't', 'eco tourism', '*****'
	, 'Te Vaka is a modern powerful, sloop rigged, high performance off shore cruising yacht based in the Bay of Islands. 
This specially designed 60ft yacht has graceful racing lines offering an unparalleled sailing adventure, whatever level of excitement you require.',
'adult'),

('13'	, 'Hillary Trail', 'w', 'sight seeing', '*'
	, 'The Hillary Trail is a self-guided four day tramp through 77km of native forest and along the wild coast of the Waitakere Ranges Regional Park. 
It connects various park tracks and basic backcountry campgrounds. The trail captures Sir Edmund Hillarys sense of adventure and introduces you to the joys of overnight camping.',
'kids'),

('14'	, 'Whangaruru North Head Walking Tracks', 'w', 'sight seeing', '*'
	, 'From the popular campsite and amenity area at Puriri Bay are a series of interlinked walks. 
They follow through native forest along ridgelines giving panoramic views of the harbour and open coastlines. 
The tracks drop down into secluded bays, such as Admirals Bay, suitable for swimming and snorkelling.',
'adults'),

('15'	, 'Bream Head Coast Walks', 'w', 'sightseeing', '**'
	, 'Situated at Whangarei Heads our boutique walk encompasses private farmland, stunning ocean and harbour beaches, rural roads, recreational reserves and existing public walkways.',
'teenagers');
	
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;






