-- -------------------------------
-- Inserts para usuario
-- -------------------------------
INSERT INTO `bd_res_manga`.`usuario` 
(`usuario_nome`, `usuario_data_nasc`, `usuario_email`, `usuario_senha`, `usuario_foto`, `usuario_tipo`) VALUES
('Carlos Silva', '1990-05-20', 'carlos.silva@example.com', 'senha123', 'foto_carlos.jpg', 'user'),
('Ana Oliveira', '1995-08-15', 'ana.oliveira@example.com', 'senha123', 'foto_ana.jpg', 'user'),
('Felipe Souza', '1988-12-25', 'felipe.souza@example.com', 'senha123', 'foto_felipe.jpg', 'user'),
('Beatriz Almeida', '1992-03-12', 'beatriz.almeida@example.com', 'senha123', 'foto_beatriz.jpg', 'user'),
('Lucas Pereira', '2000-06-30', 'lucas.pereira@example.com', 'senha123', 'foto_lucas.jpg', 'user'),
('Mariana Costa', '1997-11-11', 'mariana.costa@example.com', 'senha123', 'foto_mariana.jpg', 'user'),
('José Santos', '1985-01-01', 'jose.santos@example.com', 'senha123', 'foto_jose.jpg', 'user'),
('Fernanda Ribeiro', '1993-04-07', 'fernanda.ribeiro@example.com', 'senha123', 'foto_fernanda.jpg', 'user'),
('Ricardo Mendes', '1990-09-18', 'ricardo.mendes@example.com', 'senha123', 'foto_ricardo.jpg', 'user'),
('Carla Rocha', '1998-07-23', 'carla.rocha@example.com', 'senha123', 'foto_carla.jpg', 'user'),
('Paulo Barbosa', '1987-02-05', 'paulo.barbosa@example.com', 'senha123', 'foto_paulo.jpg', 'user'),
('Luana Martins', '1996-09-27', 'luana.martins@example.com', 'senha123', 'foto_luana.jpg', 'user'),
('Gustavo Costa', '2002-01-16', 'gustavo.costa@example.com', 'senha123', 'foto_gustavo.jpg', 'user'),
('Juliana Pereira', '1994-11-02', 'juliana.pereira@example.com', 'senha123', 'foto_juliana.jpg', 'user'),
('Ricardo Lima', '1989-04-13', 'ricardo.lima@example.com', 'senha123', 'foto_ricardo_lima.jpg', 'user'),
('Isabela Silva', '1991-06-09', 'isabela.silva@example.com', 'senha123', 'foto_isabela.jpg', 'user'),
('Felipe Oliveira', '1994-01-18', 'felipe.oliveira@example.com', 'senha123', 'foto_felipe_oliveira.jpg', 'user'),
('Tatiane Sousa', '1983-10-25', 'tatiane.sousa@example.com', 'senha123', 'foto_tatiane.jpg', 'user'),
('Bruno Gomes', '1992-07-30', 'bruno.gomes@example.com', 'senha123', 'foto_bruno.jpg', 'user'),
('Marcos Ferreira', '1980-03-16', 'marcos.ferreira@example.com', 'senha123', 'foto_marcos.jpg', 'user'),
('Vanessa Lima', '1999-02-22', 'vanessa.lima@example.com', 'senha123', 'foto_vanessa.jpg', 'user'),
('Renato Oliveira', '1986-11-14', 'renato.oliveira@example.com', 'senha123', 'foto_renato.jpg', 'user'),
('Lúcia Costa', '1995-07-28', 'lucia.costa@example.com', 'senha123', 'foto_lucia.jpg', 'user'),
('Sérgio Martins', '2001-12-04', 'sergio.martins@example.com', 'senha123', 'foto_sergio.jpg', 'user'),
('Roberta Almeida', '1993-03-17', 'roberta.almeida@example.com', 'senha123', 'foto_roberta.jpg', 'user'),
('Edson Lima', '1987-08-03', 'edson.lima@example.com', 'senha123', 'foto_edson.jpg', 'user'),
('Gabriela Souza', '1999-10-18', 'gabriela.souza@example.com', 'senha123', 'foto_gabriela.jpg', 'user'),
('Simone Rocha', '1990-09-04', 'simone.rocha@example.com', 'senha123', 'foto_simone.jpg', 'user'),
('Gustavo Almeida', '1996-11-01', 'gustavo.almeida@example.com', 'senha123', 'foto_gustavo_almeida.jpg', 'user');

-- -------------------------------
-- Inserts para autor
-- -------------------------------
INSERT INTO `bd_res_manga`.`autor` 
(`autor_nome`, `autor_data_nasc`, `autor_data_morte`, `autor_foto`) VALUES
('Eiichiro Oda', '1975-01-01', NULL, 'oda.jpg'),
('Masashi Kishimoto', '1974-11-08', NULL, 'kishimoto.jpg'),
('Hajime Isayama', '1986-08-29', NULL, 'isayama.jpg'),
('Yoshihiro Togashi', '1966-04-27', NULL, 'togashi.jpg'),
('Tite Kubo', '1977-06-26', NULL, 'kubo.jpg'),
('Takehiko Inoue', '1967-01-12', NULL, 'inoue.jpg'),
('Akira Toriyama', '1955-04-05', NULL, 'toriyama.jpg'),
('Katsuhiro Otomo', '1954-04-14', NULL, 'otomo.jpg'),
('Naoko Takeuchi', '1967-03-15', NULL, 'takeuchi.jpg'),
('Osamu Tezuka', '1928-11-03', '1989-02-09', 'tezuka.jpg'),
('Yūsei Matsui', '1981-06-06', NULL, 'matsui.jpg'),
('Kouji Kumeta', '1975-12-12', NULL, 'kumeta.jpg'),
('Nobuhiro Watsuki', '1970-05-26', NULL, 'watsuki.jpg'),
('Hiro Mashima', '1977-05-03', NULL, 'mashima.jpg'),
('Akiko Higashimura', '1968-07-10', NULL, 'higashimura.jpg'),
('Ken Akamatsu', '1968-12-05', NULL, 'akamatsu.jpg'),
('Kazuki Takahashi', '1961-10-04', '2021-07-04', 'takahashi.jpg'),
('Yuki Tabata', '1987-04-11', NULL, 'tabata.jpg'),
('Tetsuya Tsutsui', '1973-04-15', NULL, 'tsutsui.jpg'),
('Kentarou Miura', '1966-07-11', '2021-05-06', 'miura.jpg'),
('Rumiko Takahashi', '1957-10-10', NULL, 'takahashi_rumiko.jpg'),
('Akira Hiramoto', '1973-11-04', NULL, 'hiramoto.jpg'),
('Yōsuke Matsuoka', '1981-09-04', NULL, 'matsuoka.jpg'),
('Natsuki Takaya', '1973-07-07', NULL, 'takaya.jpg'),
('Mitsuru Adachi', '1951-02-09', NULL, 'adachi.jpg'),
('Hiromu Arakawa', '1973-05-08', NULL, 'arakawa.jpg'),
('Kiyohiko Azuma', '1968-05-04', NULL, 'azuma.jpg');

-- -------------------------------
-- Inserts para obra
-- -------------------------------
INSERT INTO `bd_res_manga`.`obra` 
(`obra_nome`, `obra_data_inicio`, `obra_data_final`, `obra_qtd_capitulos`, `obra_qtd_volumes`, `obra_autor_id`) VALUES
('One Piece', '1997-07-22', NULL, 1054, '102', 1),
('Naruto', '1999-09-21', '2014-11-10', 700, '72', 2),
('Attack on Titan', '2009-09-09', '2021-04-09', 139, '34', 3),
('Hunter x Hunter', '1998-03-03', NULL, 390, '36', 4),
('Bleach', '2001-08-07', '2016-08-22', 686, '74', 5),
('Slam Dunk', '1990-10-01', '1996-06-04', 276, '31', 6),
('Dragon Ball', '1984-12-03', '1995-06-05', 519, '42', 7),
('Akira', '1982-12-01', '1993-06-30', 6, '6', 8),
('Sailor Moon', '1992-02-07', '1997-02-03', 200, '18', 9),
('Black Clover', '2015-02-16', NULL, 315, '31', 10),
('Assassination Classroom', '2012-07-01', '2016-03-25', 180, '21', 11),
('Say I Love You', '2008-02-12', '2017-07-12', 126, '18', 12),
('Great Teacher Onizuka', '1997-04-05', '2002-09-25', 242, '25', 13),
('Rurouni Kenshin', '1994-04-01', '1999-09-04', 255, '28', 14),
('Fairy Tail', '2006-08-02', '2017-07-26', 545, '63', 15),
('Death Note', '2003-12-01', '2006-05-15', 108, '12', 16),
('Yu Yu Hakusho', '1992-12-03', '1994-12-17', 175, '19', 17),
('Fruits Basket', '1998-07-18', '2006-11-13', 136, '23', 18),
('Inuyasha', '1996-11-13', '2008-06-18', 558, '56', 19),
('One Punch Man', '2009-06-14', NULL, 171, '23', 20),
("JoJo's Bizarre Adventure", '1987-01-01', NULL, 800, '133', 21),
('Kaguya-sama: Love is War', '2015-05-19', NULL, 230, '25', 22),
('Tokyo Ghoul', '2011-09-08', '2014-09-18', 144, '14', 23),
('Mob Psycho 100', '2009-04-18', NULL, 101, '16', 24),
('Nana', '2000-05-01', '2009-05-01', 84, '21', 25),
('Fullmetal Alchemist', '2001-07-12', '2010-06-04', 108, '27', 26),
('Kuroko no Basket', '2008-12-08', '2014-09-01', 275, '30', 27),
('Trigun', '1995-10-01', '1997-06-01', 3, '3', 8),
('Hikaru no Go', '1998-11-08', '2003-03-05', 183, '23', 27);

-- -------------------------------
-- Inserts para resenha
-- -------------------------------
INSERT INTO `bd_res_manga`.`resenha`
(`resenha_titulo`, `resenha_data`, `resenha_conteudo`, `resenha_usuario_id`, `resenha_obra_id`) VALUES
('Uma jornada épica', '2025-10-01', 'A obra One Piece é um dos maiores mangás de todos os tempos, com uma narrativa envolvente e personagens memoráveis.', 1, 1),
('O fim de uma era', '2025-10-02', 'Naruto é uma jornada de superação e amizade, com um final emocionante.', 2, 2),
('O drama de titãs', '2025-09-30', 'Attack on Titan entrega uma história cheia de ação e mistério, com reviravoltas incríveis.', 3, 3),
('O caçador imbatível', '2025-09-29', 'Hunter x Hunter é uma obra-prima que mistura ação, estratégia e drama de uma forma única.', 4, 4),
('O poder dos shinigamis', '2025-09-28', 'Bleach é uma combinação perfeita de ação e comédia, com lutas épicas e personagens cativantes.', 5, 5),
('Basquete no sangue', '2025-09-27', 'Slam Dunk traz uma história de superação e amizade dentro do universo do basquete.', 6, 6),
('O dragão que nunca morre', '2025-09-26', 'Dragon Ball é uma das obras mais influentes de todos os tempos, com personagens e batalhas inesquecíveis.', 7, 7),
('Visão futurista', '2025-09-25', 'Akira é um mangá de ficção científica inovador, com um mundo distópico complexo e personagens marcantes.', 8, 8),
('Amor e magia', '2025-09-24', 'Sailor Moon é uma história de amor, magia e amizade, que ainda conquista corações ao redor do mundo.', 9, 9),
('A magia da amizade', '2025-09-23', 'Black Clover traz uma narrativa de superação em um mundo onde a magia é tudo.', 10, 10);

-- -------------------------------
-- Inserts para favorito
-- -------------------------------
INSERT INTO `bd_res_manga`.`favorito`
(`favorito_obra_id`, `favorito_autor_id`, `favorito_resenhista_id`, `favorito_usuario_id`) VALUES
(1, NULL, NULL, 2),
(NULL, NULL, 2, 1),
(3, NULL, NULL, 4),
(NULL, 4, NULL, 5),
(NULL, 24, NULL, 6);

-- -------------------------------
-- Inserts para like
-- -------------------------------
INSERT INTO `bd_res_manga`.`likes`
(`likes_usuario_id`, `likes_resenha_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

