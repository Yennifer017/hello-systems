/*POSIBLE PAYERS*/
INSERT INTO Animals(cost, atk_base, ps_base, link_img, def_name) VALUES (100, 20, 50, "../img/players/rabbit.jpg", "rabbit");
INSERT INTO Animals(cost, atk_base, ps_base, link_img, def_name) VALUES (100, 20, 50, "../img/players/fish.jpg", "fish");
INSERT INTO Animals(cost, atk_base, ps_base, link_img, def_name) VALUES (150, 30, 70, "../img/players/sheep.jpg", "sheep");
INSERT INTO Animals(cost, atk_base, ps_base, link_img, def_name) VALUES (200, 40, 75, "../img/players/deer.jpg", "deer");
INSERT INTO Animals(cost, atk_base, ps_base, link_img, def_name) VALUES (250, 45, 90, "../img/players/girafe.jpg", "giraffe");

/*DEPRETATORS*/
INSERT INTO Depretator(atk_base, ps_base, link_img, def_name, difficult) VALUES (30, 70, "../img/depretators/lion.jpg", "lion", 'EASY');
INSERT INTO Depretator(atk_base, ps_base, link_img, def_name, difficult) VALUES (30, 70, "../img/depretators/shark.jpg", "shark", 'EASY');
INSERT INTO Depretator(atk_base, ps_base, link_img, def_name, difficult) VALUES (30, 70, "../img/depretators/octopus.jpg", "octopus", 'EASY');
INSERT INTO Depretator(atk_base, ps_base, link_img, def_name, difficult) VALUES (40, 80, "../img/depretators/vulture.jpg", "vulture", 'MEDIUM');
INSERT INTO Depretator(atk_base, ps_base, link_img, def_name, difficult) VALUES (40, 80, "../img/depretators/hyena.jpg", "hyena", 'MEDIUM');
INSERT INTO Depretator(atk_base, ps_base, link_img, def_name, difficult) VALUES (50, 75, "../img/depretators/fungus1.jpg", "fungus.exe", 'HARD');
INSERT INTO Depretator(atk_base, ps_base, link_img, def_name, difficult) VALUES (50, 75, "../img/depretators/fungus2.jpg", "FunGu55", 'HARD');

/*plants*/
INSERT INTO Plant_potentiator(cost, exp, ps, atk, name, link_img) VALUES (110, 50, 10, 10, "carrot", "../img/plants/carrot.jpg");
INSERT INTO Plant_potentiator(cost, exp, ps, atk, name, link_img) VALUES (110, 10, 50, 10, "flower", "../img/plants/flower.jpg");
INSERT INTO Plant_potentiator(cost, exp, ps, atk, name, link_img) VALUES (110, 10, 10, 30, "plant", "../img/plants/plant.jpg");
