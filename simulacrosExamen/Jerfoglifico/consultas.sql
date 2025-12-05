UPDATE jugador j SET puntos = puntos + 1 where login in 
( SELECT login FROM respuestas r, solucion where respuesta = solucion 
AND r.fecha = CURDATE() );