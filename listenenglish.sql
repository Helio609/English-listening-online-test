-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-01-31 07:56:43
-- 服务器版本： 10.1.36-MariaDB
-- PHP 版本： 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `listenenglish`
--

-- --------------------------------------------------------

--
-- 表的结构 `exercise`
--

CREATE TABLE `exercise` (
  `id` int(11) NOT NULL,
  `num` int(100) NOT NULL,
  `text` varchar(4096) NOT NULL COMMENT '题目',
  `title` varchar(4096) NOT NULL COMMENT '原文',
  `answer` varchar(512) NOT NULL,
  `name` varchar(512) NOT NULL,
  `remark` varchar(512) NOT NULL,
  `refer` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `exercise`
--

INSERT INTO `exercise` (`id`, `num`, `text`, `title`, `answer`, `name`, `remark`, `refer`) VALUES
(1, 5, '1.我帅不帅?A.帅B.不帅C.不知道|2.上一题你答对了吗?A.嗯B.没有C.不知道|3.我帅不帅?A.帅B.不帅C.不知道|4.上一题你答对了吗?A.嗯B.好像吧C.应该是的|5.上一题你答对了吗?A.哈哈B.嗯C.不知道', '没有原文哦，因为没什么可以说的！', 'AAAAB', '这只是一个测试用的网页', '2019年1月29日竣工', '还没有mp3被refer'),
(2, 20, '1.How long is the man\'s holiday?A.Six days.B.Seven days.C.Thirteen days.|2.What does the man do?A.A doctor.B.A teacher.C.A student.|3.Where does the conversation take place?A.In an office.B.In a bank.C.In a street.|4.What does the man mean?A.He didn\'t see the paintings.B.He didn\'t understand paintings.C.He didn\'t show his paintings at the exhibition.|5.What are the two speakers mainly taking about?A.A new apartment.B.A high buliding.C.Lifts|6.In what does the man care about the electric heater?A.The brand.B.The priece.C.The model.|7.What can we learn from the conversation?A.The man will pay $250.B.The man won\'t buy the electric heater.C.The man won\'t get an addition discount at last.|8.What did the man do on Saturday?A.He had a picnic.B.He finished a paper.C.He visited some friends.|9.What was the weather like on Sunday?A.Sunny and warm.B.Cloudy and cool.C.Rainy and cold.|10.What do storm hunters do?A.They follow tornadoes and study them.B.They save people in stormy weather.C.They collect pintures about tonadoes.|11.What does Dr.Robert usually do to study tornadoes?A.Read magazines about tornadoes.B.Measure tornadoes closely in his car.C.Invent instruments to forecast tornadoes.|12.What does Mr.Roberts plan to do  in the future?A.Publish an article on the tornadoes in a magazine.B.Get more people interested in tornadoes.C.Record the inside of a tornadoes.|13.Why doesn\'t the woman want to join a photography club?A.She doesn\'t have a camera.B.She thinks it too expensive.C.She prefers to take photos alone.|14.What does the woman like doing?A.Running.B.Walking.C.Cycing.|15.What does the man say about the yoga club?A.The number of the members is small.B.More and more people joining it.C.Its members stop going within a week.|16.Which club does the woman choose in the end?A.The yoga club.B.The filn club.C.The street dance club.|17.Where did Gandhi study law?A.In Bombay.B.In Porbandar.C.In London.|18.What was Gandhi\'s dream before 1947?A.Living in South Africa.B.Gaining India\'s independence.C.Becoming the leader of a political party.|19.What can we learn about Gandhi?A.He once fought for black people\'s rights in South Africa.B.He never followed ordinary politicians\'s methods in his fight.C.He didn\'t fight for Indian people\'s rights until returning to India.|20.What makes Gandhi remain an inspiration to people?A.His strong beliefs.B.His political power.C.His dream of freedom.', '不想写不想写不想写啊啊啊啊啊啊啊啊啊啊啊', 'BCCAABCBCABCCBAACBBA', '维克多英语听力测试，实战第39篇', '因为还没有写后端，所以纯手打的，累死我了，后端准备一下.....', '1.mp3');

--
-- 转储表的索引
--

--
-- 表的索引 `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `exercise`
--
ALTER TABLE `exercise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
