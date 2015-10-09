

CREATE TABLE IF NOT EXISTS `addons` (
  `title` varchar(250) NOT NULL,
  `system_name` varchar(250) NOT NULL,
  `version` varchar(20) NOT NULL,
  `author` varchar(100) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


INSERT INTO `addons` (`title`, `system_name`, `version`, `author`, `id`) VALUES
('Pikolor updater', 'updater', '1.0', 'Pikolor lab', 1);

CREATE TABLE IF NOT EXISTS `config` (
  `site_title` text CHARACTER SET cp1251,
  `lang` varchar(250) CHARACTER SET cp1251 DEFAULT NULL,
  `multilang` int(1) NOT NULL,
  `debugger` int(1) NOT NULL,
  `roles` text NOT NULL,
  `id` int(1) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;



INSERT INTO `config` (`site_title`, `lang`, `multilang`, `debugger`, `roles`, `id`) VALUES
('Pikolor Lab', '', 0, 0, 'ADMIN', 1);


CREATE TABLE IF NOT EXISTS `fields` (
  `title` varchar(250) CHARACTER SET cp1251 DEFAULT NULL,
  `system_name` varchar(250) CHARACTER SET cp1251 DEFAULT NULL,
  `short_desc` text CHARACTER SET cp1251,
  `field_category` int(10) NOT NULL,
  `multilang` int(1) DEFAULT NULL,
  `show_default` int(1) NOT NULL,
  `ord` int(5) NOT NULL,
  `type` varchar(50) NOT NULL,
  `config` text CHARACTER SET cp1251,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


INSERT INTO `fields` (`title`, `system_name`, `short_desc`, `field_category`, `multilang`, `show_default`, `ord`, `type`, `config`, `id`) VALUES
('Content', 'page_content', '', 1, NULL, 0, 0, '3', '{"1":{"maxlen":"100"},"2":{"rows":"5","format":"0"},"3":{"height":"300"},"4":{"options":""},"5":{"options":""},"6":{"options":""},"7":{"path":"upload"},"image_upload":{"path":"upload"}}', 1),
('Hide', 'hide', '', 1, 0, 0, 0, '5', '{"1":{"maxlen":"100"},"2":{"rows":"5","format":"0"},"3":{"height":"300"},"4":{"options":"no\\r\\nyes"},"5":{"options":"no\\r\\nyes"},"6":{"options":""},"7":{"path":"upload"},"image_upload":{"path":"upload"}}', 2);


CREATE TABLE IF NOT EXISTS `fields_category` (
  `title` varchar(250) CHARACTER SET cp1251 DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


INSERT INTO `fields_category` (`title`, `id`) VALUES
('Pages', 1);



CREATE TABLE IF NOT EXISTS `fields_val` (
  `val` text CHARACTER SET utf8,
  `lang` varchar(50) CHARACTER SET cp1251 DEFAULT NULL,
  `field_id` int(10) NOT NULL,
  `system_name` varchar(250) CHARACTER SET cp1251 DEFAULT NULL,
  `node_id` int(10) NOT NULL,
  `id` bigint(15) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;


INSERT INTO `fields_val` (`val`, `lang`, `field_id`, `system_name`, `node_id`, `id`) VALUES
('<p>This is your home page .</p>\r\n<p> </p>\r\n<p>To change template, please access : /theme/site_theme/templates/home.php</p>\r\n<p> </p>\r\n<div id="lipsum">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nunc lacus, volutpat et mollis ac, imperdiet at magna. Sed imperdiet quis ante sit amet imperdiet. Vivamus pulvinar nisl dui, ac tristique eros sagittis id. Cras lacinia, est id tempor mollis, arcu magna dictum ligula, eget imperdiet libero mauris non turpis. Vivamus adipiscing, nisl nec facilisis lacinia, eros metus blandit ipsum, eu bibendum magna lorem sit amet justo. Proin vitae blandit massa. Aenean luctus massa eget enim auctor, ac pharetra ligula iaculis. Sed pulvinar in quam id mattis. Aenean dignissim quis tellus in venenatis. Morbi et leo eget sapien aliquam rutrum. Cras tincidunt diam ac enim consectetur, et elementum est dapibus. Suspendisse in nisl eu felis commodo iaculis. Sed quis viverra massa. Duis in bibendum nisi, ut malesuada nulla. Praesent sed viverra nisi.</p>\r\n<p>Vivamus est elit, volutpat vitae lorem at, elementum tempus mi. Etiam ipsum mauris, feugiat vitae ligula varius, mollis vestibulum arcu. Nulla a ante non nulla consectetur lacinia. Etiam fermentum ut nisi tempor rutrum. Nullam nunc tellus, porta et diam et, feugiat condimentum urna. Duis placerat egestas est a condimentum. Aenean vitae odio sit amet elit rhoncus adipiscing. Phasellus porttitor mi nec nunc imperdiet, nec dignissim urna tempor. Ut in eros mi. Vivamus rhoncus magna ultricies dictum molestie. Aenean et velit suscipit, commodo diam non, fringilla sem.</p>\r\n<p>Donec a congue arcu. Pellentesque et elit sed velit iaculis porttitor at at nisi. Praesent vitae scelerisque tellus, eu hendrerit sem. In eget sapien in felis sollicitudin ornare. In volutpat, lorem quis consequat venenatis, magna mi tempor leo, eget euismod lorem velit sed lacus. Donec sit amet lorem ultrices, rutrum justo at, placerat eros. Suspendisse ut metus posuere, mattis arcu eget, iaculis est. Sed luctus nulla sed tortor consectetur ullamcorper. Fusce est neque, porta id velit eu, luctus faucibus lorem. Suspendisse vitae feugiat urna. Nam quis sodales sem. Nam vitae faucibus velit. Mauris eget quam in sem faucibus sagittis quis eget metus.</p>\r\n</div>', NULL, 1, 'page_content', 1, 1),
('no', NULL, 2, 'hide', 1, 2),
('<div id="lipsum">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur adipiscing tincidunt sollicitudin. Curabitur a tellus elementum, fringilla risus ut, congue magna. Ut adipiscing, felis at scelerisque accumsan, arcu nibh ultrices purus, ut dictum dolor nulla nec libero. Proin sed egestas mauris, in tristique dui. Sed dictum sem ac venenatis egestas. Sed at justo hendrerit, adipiscing nunc at, vulputate ipsum. Quisque scelerisque sodales cursus. Sed nunc urna, venenatis sed massa in, tincidunt bibendum augue.</p>\r\n<p>Mauris congue interdum lacinia. Etiam tristique pretium vulputate. Donec quis congue ligula, quis feugiat metus. Nullam pharetra condimentum nisl, id aliquam lacus feugiat sed. Sed luctus ornare consectetur. Vivamus vel enim cursus, volutpat lorem sit amet, tincidunt velit. Nunc at porttitor magna, at fermentum mauris. In dictum dolor et lorem dapibus vehicula. Nunc tempor lacus sapien, ut mattis metus dignissim in. Nunc id sodales dolor, eu fringilla est. Nulla condimentum augue lectus, in luctus risus congue eget. Suspendisse potenti.</p>\r\n<p>Duis id pellentesque arcu, quis gravida quam. Praesent nec dolor id ipsum dignissim rutrum eu a quam. In malesuada eleifend sodales. Donec orci diam, blandit id porttitor a, auctor eu metus. In dolor diam, laoreet id lorem ac, condimentum egestas dolor. Aenean nec placerat felis. Nullam in metus libero. Nunc aliquet neque eu pellentesque dapibus. Nulla facilisi. Aenean ullamcorper ipsum quis diam tincidunt mollis vitae sit amet nibh. Donec pretium mi sit amet fermentum bibendum. Nunc lectus nisl, cursus et molestie et, porttitor a nulla. Ut nec odio mauris. Cras adipiscing elit vitae ligula auctor tempus.</p>\r\n<p>Donec congue, nisl in ullamcorper tempus, felis elit placerat nunc, non iaculis felis mi et tellus. Phasellus justo sapien, aliquet adipiscing adipiscing at, mattis porttitor velit. Aenean blandit nisl sed ipsum rutrum luctus. Quisque sed dui eu risus auctor faucibus. Aliquam porta pharetra ultricies. Donec non fermentum massa. Integer quam sapien, ullamcorper accumsan luctus ut, vehicula sed nisl. Vestibulum tempor malesuada diam vel consequat. Integer turpis risus, vulputate sed purus vel, malesuada tincidunt libero. Maecenas ligula nulla, iaculis quis consectetur non, condimentum sit amet sapien.</p>\r\n<p>Integer neque nulla, tempus eget gravida at, lacinia non justo. Vivamus vitae ullamcorper augue, ut molestie quam. Etiam pellentesque tempor nisi at pellentesque. Fusce volutpat lorem libero, rhoncus varius eros ultricies id. Nulla nisi ligula, aliquet a risus porttitor, auctor ultricies tellus. Praesent scelerisque libero quis commodo viverra. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent non leo ut justo congue consectetur. Morbi eu facilisis lacus.</p>\r\n</div>', NULL, 1, 'page_content', 2, 3),
('', NULL, 2, 'hide', 2, 4),
('<div id="lipsum">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque cursus erat ipsum, ac feugiat neque fermentum non. Pellentesque faucibus, sapien vitae suscipit suscipit, enim turpis sollicitudin odio, nec luctus risus odio tincidunt orci. In felis felis, gravida vitae eros non, commodo sagittis lectus. In rutrum accumsan est, et feugiat lectus luctus eu. Curabitur posuere laoreet rhoncus. Donec congue hendrerit odio quis facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p>Donec sed tortor aliquam, rhoncus turpis et, ultricies mauris. Pellentesque nec turpis orci. Donec sit amet lorem ut justo sollicitudin ultrices. Donec urna turpis, dapibus mollis leo eu, pharetra pulvinar augue. Quisque eget mauris nulla. Nullam ut molestie sem. Pellentesque sodales mi id risus pellentesque, ut blandit neque suscipit. Suspendisse dictum nulla orci, vel consectetur risus euismod sed. Suspendisse et fringilla eros, vitae fermentum justo. Nullam non enim nec nisi vestibulum cursus. Phasellus congue bibendum vulputate. Nunc ipsum mauris, egestas ut dignissim vitae, rutrum eget neque. Nam adipiscing, diam ut volutpat rutrum, tortor eros blandit tellus, sit amet malesuada arcu metus vel orci. Nunc pharetra risus sed purus aliquet condimentum. Aliquam pharetra augue quis fringilla mollis. Pellentesque elementum feugiat placerat.</p>\r\n<p>Maecenas dignissim justo vitae gravida commodo. In posuere ligula dui, ac aliquam eros pretium molestie. Pellentesque in tellus consequat, cursus erat quis, interdum urna. Nam elit nisi, semper id nibh eu, pharetra varius nibh. Duis id velit ac risus sollicitudin tincidunt ac vitae neque. Morbi rhoncus enim in hendrerit tempor. Quisque ac turpis id nunc consectetur pretium. Curabitur in posuere lectus. Cras sed ipsum urna.</p>\r\n<p>Pellentesque eget metus felis. Donec tristique, massa sit amet ultricies interdum, nisi mi lacinia dui, id porta enim lacus tempus nunc. Sed id ornare enim. Suspendisse viverra nunc ut nisi consectetur, eu consequat magna pharetra. Nunc vel lobortis orci, nec facilisis orci. Pellentesque nec interdum massa. Praesent at lorem laoreet, ultrices purus eu, iaculis libero. Vivamus sed lectus at purus facilisis venenatis. Aenean nec sapien vitae nisl luctus fermentum a sit amet est.</p>\r\n<p>Duis eget sem luctus, laoreet nisl non, ullamcorper leo. Ut ipsum lectus, ornare eu tortor ut, placerat fermentum tortor. Sed posuere porttitor nisl, id fermentum lacus placerat nec. Suspendisse egestas quis dui quis venenatis. Donec porta massa id ligula laoreet, eget posuere tellus pellentesque. Integer bibendum, lorem vel sodales consequat, tortor sem porttitor sem, et auctor nisl ipsum at risus. Nam laoreet, leo eu fermentum molestie, tortor magna vestibulum nisl, ac iaculis enim orci quis nisl. Donec pulvinar, felis in hendrerit consectetur, lorem tellus ultrices nibh, at molestie velit risus hendrerit erat. Sed in posuere ligula. Quisque rutrum suscipit faucibus. Nullam vel neque porta, pellentesque enim sed, rutrum justo. Phasellus hendrerit convallis facilisis. Fusce rutrum orci ut ligula tristique, nec luctus sapien tincidunt.</p>\r\n</div>', NULL, 1, 'page_content', 3, 5),
('', NULL, 2, 'hide', 3, 6);


CREATE TABLE IF NOT EXISTS `lang_vars` (
  `val` text NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `node` (
  `title` text CHARACTER SET utf8,
  `link` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `template` varchar(250) CHARACTER SET cp1251 DEFAULT NULL,
  `type` varchar(250) CHARACTER SET cp1251 DEFAULT NULL,
  `default_node` int(1) DEFAULT NULL,
  `parent` int(10) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


INSERT INTO `node` (`title`, `link`, `template`, `type`, `default_node`, `parent`, `id`) VALUES
('Home', 'Home.html', 'home', 'pages', 1, 0, 1),
('Simple page', 'Simple-page.html', 'page', 'pages', 0, 0, 2),
('Another page', 'Another-page.html', 'page', 'pages', 0, 0, 3);



CREATE TABLE IF NOT EXISTS `node_type` (
  `title` varchar(250) CHARACTER SET cp1251 DEFAULT NULL,
  `system_name` varchar(250) CHARACTER SET cp1251 DEFAULT NULL,
  `short_desc` text CHARACTER SET cp1251,
  `field_category` int(10) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `node_type` (`title`, `system_name`, `short_desc`, `field_category`, `id`) VALUES
('Pages', 'pages', '', 1, 1);


CREATE TABLE IF NOT EXISTS `snippets` (
  `title` varchar(250) NOT NULL,
  `system_name` varchar(250) NOT NULL,
  `multilang` int(1) NOT NULL,
  `val` text NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `roles` text NOT NULL,
  `data` text NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
