$(document).ready(function() {

var sphg = [
  {"period": "2017-01-01", "course": 22.5, "course2": 35, "course3": 75},
  {"period": "2017-01-02", "course": 23, "course2": 38, "course3": 80.5},
  {"period": "2017-01-03", "course": 22.5, "course2": 41, "course3": 84},
  {"period": "2017-01-04", "course": 24, "course2": 44, "course3": 89},
  {"period": "2017-01-05", "course": 23.5, "course2": 48.5, "course3": 93},
  {"period": "2017-01-06", "course": 25, "course2": 50, "course3": 100}
];
Morris.Line({
  element: 'graph',
  data: sphg,
  xkey: 'period',
  ykeys: ['course','course2','course3'],
  labels: ['Рост bhp, руб.','Рост gph, руб.','Рост rph, руб.'],
  lineColors: ['#009ee6','#42ca4b','#cd2927']
});

var goldphg = [
  {"period": "2017-01-01", "course4": 500},
  {"period": "2017-01-02", "course4": 610},
  {"period": "2017-01-03", "course4": 790},
  {"period": "2017-01-04", "course4": 840},
  {"period": "2017-01-05", "course4": 990},
  {"period": "2017-01-06", "course4": 1000}
];
Morris.Line({
  element: 'graph2',
  data: goldphg,
  xkey: 'period',
  ykeys: ['course4'],
  labels: ['Рост Gph, руб.'],
  lineColors: ['#d2bb1f']
});

});