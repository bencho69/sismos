select encuestas.intensidad, encuestas.created_at, 
  dayofmonth(encuestas.created_at) + ((hour(encuestas.created_at) /24) * 0.6) + (minute(encuestas.created_at) / 60 ) + second(encuestas.created_at)/3600 as dia, 
  dayofmonth(encuestas.created_at) as dia2,
  (hour(encuestas.created_at) /24) as hora2,
  (minute(encuestas.created_at) / 60 *.1 ) as minuto,
  second(encuestas.created_at)  as segundo
  from encuestas 
  where encuestas.sismo_id=4 
  order by created_at