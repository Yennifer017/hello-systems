/*QUERY PARA REPORTES*/

--1. estadisticas de partida
SELECT state, COUNT(*) FROM Statistics WHERE id_user = 1 GROUP BY state;

--2. mascotas que mas oro han ganado
SELECT Players_animals.alias, SUM(Statistics.gold_gained) AS total_gold
FROM Statistics
JOIN Players_animals ON Statistics.id_player = Players_animals.id
WHERE id_user = 1
GROUP BY id_player
ORDER BY total_gold DESC
LIMIT 5;

--3. mascotas que mas puntos han ganado
SELECT Players_animals.alias, SUM(Statistics.points) AS total_points
FROM Statistics
JOIN Players_animals ON Statistics.id_player = Players_animals.id
WHERE id_user = 1
GROUP BY id_player
ORDER BY total_points DESC
LIMIT 5;

--4. mascotas mas usadas
SELECT Players_animals.alias, COUNT(*) AS total_uses
FROM Statistics
JOIN Players_animals ON Statistics.id_player = Players_animals.id
WHERE id_user = 1
GROUP BY id_player
ORDER BY total_uses DESC
LIMIT 5;

--5. Oro ganado en un rango de tiempo
SELECT SUM(gold_gained) AS total
FROM Statistics
WHERE id_user = ?
AND date BETWEEN ? AND ?;

--6. top 5 mascotas con un nivel mas alto
SELECT alias, level, exp
FROM Players_animals
WHERE id_owner = 1
ORDER BY level DESC, exp DESC
LIMIT 5;

--7. top 5 depredadores mas encontrados
SELECT Depretator.def_name, COUNT(*) AS count
FROM Statistics
JOIN Depretator ON Statistics.id_depretator = Depretator.id
WHERE id_user = 1
GROUP BY Statistics.id_depretator
ORDER BY count DESC
LIMIT 5;

--8. top 5 depredadores mas letales
SELECT Depretator.def_name, COUNT(*) AS count
FROM Statistics
JOIN Depretator ON Statistics.id_depretator = Depretator.id
WHERE id_user = 1 AND Statistics.state = 'LOSER'
GROUP BY Statistics.id_depretator
ORDER BY count DESC
LIMIT 5;


