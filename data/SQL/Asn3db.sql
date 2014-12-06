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
DROP TABLE IF EXISTS `attraction`;
CREATE TABLE IF NOT EXISTS `attraction` (
  `attr_id` varchar(32) NOT NULL,
  `attr_name` varchar(32) NOT NULL,
  `main_id` varchar(32) NOT NULL,
  `price_range` varchar(32) NOT NULL,
  `detail` TEXT NOT NULL,
  `tar_aud` varchar(32) NOT NULL,
  PRIMARY KEY (`attr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

-- images in /data folder in webapp
INSERT INTO `attraction` (`attr_id`, `attr_name`, `main_id`, `price_range`,`detail`, `tar_aud`) VALUES
('01', 'Kaikohe Car Club', 'Entertainment', 'Expensive', 
	'<?xml version="1.0" encoding="UTF-8"?>
        <detail id="01" contact="09 238 4680" price="50" date="1393621846">
            <description>
                Kaikohe Speedway started in the Kaikohe District in 1974,
                on a grass track approximately 300 meters along the Ngawha Springs
                Road (7 km from Kaikohe). Kaikohe Car Club moved to its present 
                location along State Highway 12 approximately 4kms SE of in Kaikohe 
                1975.  The Kaikohe Car Club became an Incorporated Society on the 
                7th December 1976. During the race season a standard race day can 
                see up to 400 people through our gates, however during a special or 
                invitation meet we see numbers of 4000 plus. Visitors come from all 
                over the North Island, this not only creates revenue for the 
                Speedway but filters out to the wider community; Kaikohe, Kerikeri,
                Kawakawa, Paihia etc. Kaikohe Speedway was put on the world map with 
                the recognition of Florian Habichts movie Kaikohe Demolition.
            </description>
            <gallery>
                <picture>
                    kkc.JPG
                </picture>
                <picture>
                    kkc-2.JPG
                </picture>
                <picture>
                    kkc-3.JPG
                </picture>
            </gallery>
            <specific>
                <fee>
                    $100
                </fee>
                <admittance>
                    2000
                </admittance>
            </specific>
       </detail>',
'adult'),

('02', 'Smartbar', 'Entertainment', 'Moderate', 
	'<?xml version="1.0" encoding="UTF-8"?>
        <detail id="02" contact="09 349 5791" price="30" date="1393125846">
            <description>
                Our stylish modern bar is a popular local venue for a great 
                night out. Situated in Pukekohes town centre, Smart bar has a warm, 
                elegant and stylish seating areas that can be enjoyed while catching 
                up with friends over drinks. Later in the night Smart Bar transforms 
                into a funky night club attracting some of the best Djs and Artist 
                in the country.
            </description>
            <gallery>
                <picture>
                    sb.JPG
                </picture>
                <picture>
                    sb-2.JPG
                </picture>
                <picture>
                    sb-3.JPG
                </picture>
            </gallery>
            <specific id="Entry Fee" value="$39.99">
            </specific>
            <specific id="Free Wifi" value="No">
            </specific>
        </detail>',
 'teenager'),

('03', 'North Harbour Stadium'	, 'Entertainment', 'Expensive', 
	'<?xml version="1.0" encoding="UTF-8"?>
        <detail id="03" contact="09 450 6802" price="20" date="1244621846">
            <description>
                Opened in 1997, our architecturally designed, 25-000 
                capacity Stadium is purpose built for New Zealands favourite 
                sporting codes of rugby union, rugby league and football, and we 
                are a popular venue for outdoor concerts and entertainment events. 
                Our corporate hospitality facilities also offer a relaxed 
                environment for business meetings, seminars, conferences and trade 
                shows, as well as private functions and weddings.
            </description>
            <gallery>
                <picture>
                    nhs.JPG
                </picture>
                <picture>
                    nhs-2.JPG
                </picture>
                <picture>
                   nhs-3.JPG
                </picture>
            </gallery>
            <specific id="Seating" value="15,000">
            </specific>
            <specific id="Alcoholic Beverages" value="Yes">
            </specific>
        </detail>',
 'kids'),

('04','Open Air Cinema', 'Family-Fun', 'Cheap',
        '<?xml version="1.0" encoding="UTF-8"?>
            <detail id="04" contact="09 561 7913" price="12.99" date="1393625286">
                <description>
                    Openair Cinema Ltd. is a New Zealand based company founded 
                    in 2003 – 100% Kiwi owned and operated. It staged the first big 
                    screen open air cinema in New Zealand at Auckland’s Viaduct Harbour 
                    in January 2004.
                </description>
                <gallery>
                    <picture>
                        oap.JPG
                    </picture>
                    <picture>
                        oap-2.JPG
                    </picture>
                    <picture>
                        oap-3.JPG
                    </picture>
                </gallery>
            </detail>',
 'kids'),

('05', 'Kaipara Coast Sculpture Gardens', 'Family-Fun', 'Cheap',
        '<?xml version="1.0" encoding="UTF-8"?>
        <detail id="05" contact="09 672 8024" price="9.99" date="1538221846">
                <description>
                    Kaipara Coast Sculpture Gardens are a tranquil, peaceful 
                    oasis set in gardens on a rural property looking out to the Kaipara 
                    Harbour. It features selected contemporary sculptures, created by 
                    established and emerging New Zealand artists.
                </description>
                <gallery>
                    <picture>
                        kcsg.JPG
                    </picture>
                    <picture>
                        kcsg-2.JPG
                    </picture>
                    <picture>
                        kcsg-3.JPG
                    </picture>
                </gallery>
        </detail>',
 'adult'),

('06', 'Commando Attack Paintball', 'Family-Fun', 'Moderate', 
        '<?xml version="1.0" encoding="UTF-8"?>
        <detail id="06" contact="09 783 9135" price="49.99" date="1392055946">
                <description>
                    Paintball is an awesome way to anticipate teamwork and bonding. 
                    perfect for sports clubs. also a great idea for a Memorable 
                    Birthday. The perfect activity for a Stag or Hen party And just the 
                    thing for a Corporate event!
                </description>
                <gallery>
                    <picture>
                        cap.JPG
                    </picture>
                    <picture>
                        cap-2.JPG
                    </picture>
                    <picture>
                        cap-3.JPG
                    </picture>
                </gallery>
        </detail>',
 'teenager'),


('07', 'Royal Oak Shopping Mall', 'Shopping', 'Moderate', 
        '<?xml version="1.0" encoding="UTF-8"?>
            <detail id="07" contact="09 894 0246" price="5.99" date="1295811846">
                <description>
                    There are over 50 shops, many of which are national brands. 
                    We are a friendly community based Shopping Mall, with unique and 
                    interesting Retailers that offer a diverse range for our customers. 
                    For a pleasant shopping experience come to the Royal Oak Shopping 
                    Mall, it is air-conditioned, has ample free parking and we are open 
                    7 days.
                </description>
                <gallery>
                    <picture>
                        rosm.JPG
                    </picture>
                    <picture>
                        rosm-2.JPG
                    </picture>
                    <picture>
                        rosm-3.JPG
                    </picture>
                </gallery>
            </detail>',
 'teenager'),

('08', 'dfs Galleria', 'Shopping', 'Expensive', 
        '<?xml version="1.0" encoding="UTF-8"?>
            <detail id="08" contact="09 905 1357" price="11.99" date="1393622846">
                <description>
                    Asia-Pacific was their frontier, and through the years, 
                    DFS expanded quickly. Every store reflected the founders’ passions 
                    for travel and service. Innovative merchandising strategies and the 
                    license to sell duty free goods attracted the attention of the 
                    world’s leading luxury brands — many of which continue to be our 
                    partners today.
                </description>
                <gallery>
                    <picture>
                        dfsg.JPG
                    </picture>
                    <picture>
                        dfsg-2.JPG
                    </picture>
                    <picture>
                        dfsg-3.JPG
                    </picture>
                </gallery>
            </detail>',
 'adult'),

('09', 'Victoria Park Market', 'Shopping', 'Cheap', 
        '<?xml version="1.0" encoding="UTF-8"?>
            <detail id="09" contact="09 538 6802" price="5" date="1254079945">
                <description>
                    The $20,000,000 refurbishment of Victoria Park Market is 
                    now drawing to an end. With 85% of the revitalised shops now let to 
                    a cross section of Food, Hospitality and Retail tenants. The market 
                    is now partially open and scheduled to be completed in Febuary 2013. 
                    The Market is owned by the consortium Victoria Quarter Trust and 
                    renovated by CMP Construction Limited, leaders in heritage building 
                    refurbishments.
                </description>
                <gallery>
                    <picture>
                        vpm.JPG
                    </picture>
                    <picture>
                        vpm-2.JPG
                    </picture>
                    <picture>
                        vpm-3.JPG
                    </picture>
                </gallery>
            </detail>',
'kids'),

('10', 'White Island Tours', 'Eco-Tourism', 'Moderate',
        '<?xml version="1.0" encoding="UTF-8"?>
            <detail id="10" contact="09 448 1802" price="69.99" date="1139583769">
                <description>
                    White Island Tours offers you the incredible experience of 
                    exploring the inner crater of New Zealand’s only active marine 
                    volcano – White Island!  Located 49km off the coast of Whakatane, 
                    New Zealand, White Island Tours offers its visitors a 6 hour a
                    dventure to this fascinating island volcano.
                </description>
                <gallery>
                    <picture>
                        wit.JPG
                    </picture>
                    <picture>
                        wit-2.JPG
                    </picture>
                    <picture>
                        wit-3.JPG
                    </picture>
                </gallery>
           </detail>',
'teenager'),

('11', 'Kiwi Wildlife Tours', 'Eco-Tourism', 'Cheap', 
        '<?xml version="1.0" encoding="UTF-8"?>
            <detail id="11" contact="09 539 6832" price="29.99" date="1459222481">
                <description>
                    Our very experienced leaders have intimate knowledge of the 
                    whole country. We make frequent trips into the field as guides and 
                    tour leaders as well as researching new locations. Our excellent 
                    network of contacts throughout NZ ensures we have the most 
                    up-to-date information about NZs special birds and where to find 
                    them. Our policy is to make sure visitors enjoy our country, and 
                    while birds (and birding) may be the focus, there is a great deal to 
                    see and experience besides.
                </description>   
                <gallery>
                    <picture>
                        kwt.JPG
                    </picture>
                    <picture>
                        kwt-2.JPG
                    </picture>
                    <picture>
                        kwt-3.JPG
                    </picture>
                </gallery>
            </detail>',
'kids'),

('12', 'Te Vaka', 'Eco-Tourism', 'Expensive', 
        '<?xml version="1.0" encoding="UTF-8"?>
            <detail id="12" contact="09 938 7802" price="10" date="1222621846">
                <description>
                    Te Vaka is a modern powerful, sloop rigged, high 
                    performance off shore cruising yacht based in the Bay of Islands. 
                    This specially designed 60ft yacht has graceful racing lines 
                    offering an unparalleled sailing adventure, whatever level of 
                    excitement you require.
                </description>
                <gallery>
                    <picture>
                        tv.JPG
                    </picture>
                    <picture>
                        tv-2.JPG
                    </picture>
                    <picture>
                        tv-3.JPG
                    </picture>
                </gallery>
            </detail>',
'adult'),

('13', 'Hillary Trail', 'Sight-Seeing', 'Cheap', 
        '<?xml version="1.0" encoding="UTF-8"?>
            <detail id="13" contact="09 448 7902" price="3" date="1234621846">
                <description>
                    The Hillary Trail is a self-guided four day tramp through 
                    77km of native forest and along the wild coast of the Waitakere 
                    Ranges Regional Park. It connects various park tracks and basic 
                    backcountry campgrounds. The trail captures Sir Edmund Hillarys 
                    sense of adventure and introduces you to the joys of overnight 
                    camping.
                </description>
                <gallery>
                    <picture>
                        ht.JPG
                    </picture>
                    <picture>
                        ht-2.JPG
                    </picture>
                    <picture>
                        ht-3.JPG
                    </picture>
                </gallery>
            </detail>',
'kids'),

('14', 'Whangaruru North Head Walking Tracks', 'Sight-Seeing', 'Cheap', 
        '<?xml version="1.0" encoding="UTF-8"?>
            <detail id="14" contact="09 432 8812" price="2" date="1234521846">
                <description>
                    From the popular campsite and amenity area at Puriri Bay 
                    are a series of interlinked walks. They follow through native forest 
                    along ridgelines giving panoramic views of the harbour and open 
                    coastlines. The tracks drop down into secluded bays, such as 
                    Admirals Bay, suitable for swimming and snorkelling.
                </description>
                <gallery>
                    <picture>
                        wnhwt.JPG
                    </picture>
                    <picture>
                        wnhwt-2.JPG
                    </picture>
                    <picture>
                        wnhwt-3.JPG
                    </picture>
                </gallery>
                <specific>
                </specific>
            </detail>',
'adult'),

('15', 'Bream Head Coast Walks', 'Sight-Seeing', 'Moderate', 
        '<?xml version="1.0" encoding="UTF-8"?>
            <detail id="15" contact="09 437 9803" price="2" date="1393621826">
                <description>
                    Situated at Whangarei Heads our boutique walk encompasses 
                    private farmland, stunning ocean and harbour beaches, rural roads, 
                    recreational reserves and existing public walkways.
                </description>
                <gallery>
                    <picture>
                        bhcw.JPG
                    </picture>
                    <picture>
                        bhcw-2.JPG
                    </picture>
                    <picture>
                        bhcw-3.JPG
                    </picture>
                </gallery>
        </detail>',
'teenager');

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users`
(
    `id`       varchar(24) NOT NULL,
    `username` varchar(24) NOT NULL,
    `password` varchar(24) NOT NULL,
    `role`     varchar(24) NOT NULL,
    PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `users`(`id`, `username`, `password`, `role`)VALUES
    ('01', 'Donald', 'Duck', 'admin'),
    ('02', 'Mickey', 'Mouse', 'user');

	
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;






