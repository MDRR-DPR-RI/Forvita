'use strict'

var optionOne = {
  series: [{
    name: 'series1',
    data: dp3
  },
  {
    name: 'series2',
    data: dp3
  }
  ],
  chart: {
    height: 430,
    parentHeightOffset: 0,
    type: 'area',
    toolbar: {
      show: false
    },
    stacked: true
  },
  colors: ['#4f6fd9', '#506fd9'],
  grid: {
    borderColor: 'rgba(72,94,144, 0.08)',
    padding: {
      top: -20
    },
    yaxis: {
      lines: {
        show: false
      }
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'straight',
    width: [2,0]
  },
  xaxis: {
    type: 'numeric',
    tickAmount: 13,
    axisBorder: {
      show: false
    },
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '11px'
      }
    },
  },
  yaxis: {
    min: 0,
    max: 100,
    show: false
  },
  fill: {
    type: 'gradient',
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0,
    }
  },
  legend: {
    show: false
  },
  tooltip: {
    enabled: false
  }
};

// var chartOne = new ApexCharts(document.querySelector('#apexChart1'), optionOne);
// chartOne.render();

//--------------------------------------------

var optionTwo = {
  series: [{
    type: 'column',
    data: [[0,10],[1,20],[2,35],[3,30],[4,35],[5,50],[6,30],[7,25],[8,15],[9,20],[10,32],[11,40],[12,55],[13,40],[14,30],[15,20],[16,34],[17,45],[18,35],[19,20],[20,40],[21,20],[22,35],[23,30],[24,35],[25,50],[26,30],[27,25],[28,15],[29,20],[30,32],[31,40],[32,55],[33,40],[34,30],[35,20],[36,34],[37,45],[38,35],[39,20],[40,40]]
  }, {
    type: 'area',
    data: [[0,70],[1,71],[2,70],[3,70],[4,78],[5,79],[6,75],[7,70],[8,75],[9,72],[10,74],[11,76],[12,80],[13,81],[14,80],[15,78],[16,80],[17,82],[18,87],[19,80],[20,81],[21,80],[22,70],[23,70],[24,71],[25,75],[26,74],[27,76],[28,80],[29,80],[30,80],[31,76],[32,75],[33,80],[34,81],[35,80],[36,79],[37,78],[38,80],[39,81],[40,80]]
  }],
  chart: {
    height: 100,
    parentHeightOffset: 0,
    type: 'line',
    toolbar: {
      show: false
    }
  },
  states: {
    hover: {
      filter: {
        type: 'none'
      }
    },
    active: {
      filter: {
        type: 'none'
      }
    }
  },
  colors: ['#c1ccf1', '#506fd9'],
  grid: {
    borderColor: 'rgba(72,94,144, 0.07)',
    padding: {
      top: -20,
      bottom: -5
    },
    yaxis: {
      lines: {
        show: false
      }
    }
  },
  fill: {
    type: ['solid', 'gradient'],
    gradient: {
      type: 'vertical',
      opacityFrom: 0.35,
      opacityTo: 0.2,
      gradientToColors: ['#f3f5fc']
    }
  },
  stroke: {
    width: [0, 1.5]
  },
  xaxis: {
    type: 'numeric',
    tickAmount: 8,
    decimalsInFloat: 0,
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '9px'
      }
    },
    axisBorder: {
      show: false
    }
  },
  yaxis: {
    show: false,
    min: 0,
    max: 100
  },
  legend: {
    show: false
  },
  tooltip: {
    enabled: false
  }
};

// var chartTwo = new ApexCharts(document.querySelector('#apexChart2'), optionTwo);
// chartTwo.render();

//---------------------------------------------------

var optionThree = {
  series: [{
    type: 'column',
    data: [[0,32],[1,40],[2,55],[3,40],[4,30],[5,20],[6,34],[7,45],[8,35],[9,20],[10,40],[11,20],[12,35],[13,30],[14,35],[15,50],[16,30],[17,25],[18,15],[19,20],[20,32],[21,40],[22,55],[23,40],[24,30],[25,20],[26,34],[27,45],[28,35],[29,20],[30,40],[31,20],[32,35],[33,30],[34,35],[35,50],[36,30],[37,25],[38,15],[39,20],[40,32]]
  }, {
    type: 'area',
    data: [[0,82],[1,80],[2,85],[3,80],[4,76],[5,70],[6,74],[7,75],[8,75],[9,70],[10,71],[11,72],[12,75],[13,80],[14,85],[15,80],[16,70],[17,95],[18,95],[19,90],[20,92],[21,90],[22,95],[23,90],[24,90],[25,90],[26,84],[27,85],[28,85],[29,80],[30,70],[31,70],[32,75],[33,70],[34,75],[35,80],[36,75],[37,85],[38,78],[39,70],[40,82]]
  }],
  chart: {
    height: 100,
    parentHeightOffset: 0,
    type: 'line',
    toolbar: {
      show: false
    }
  },
  states: {
    hover: {
      filter: {
        type: 'none'
      }
    },
    active: {
      filter: {
        type: 'none'
      }
    }
  },
  colors: ['#cde1ff', '#85b6ff'],
  grid: {
    borderColor: 'rgba(72,94,144, 0.07)',
    padding: {
      top: -20,
      bottom: -5
    },
    yaxis: {
      lines: {
        show: false
      }
    }
  },
  fill: {
    type: ['solid', 'gradient'],
    gradient: {
      type: 'vertical',
      opacityFrom: 0.35,
      opacityTo: 0.2,
      gradientToColors: ['#f3f5fc']
    }
  },
  stroke: {
    width: [0, 1.5]
  },
  xaxis: {
    type: 'numeric',
    tickAmount: 8,
    decimalsInFloat: 0,
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '9px'
      }
    },
    axisBorder: {
      show: false
    }
  },
  yaxis: {
    show: false,
    min: 0,
    max: 100
  },
  legend: {
    show: false
  },
  tooltip: {
    enabled: false
  }
};

// var chartThree = new ApexCharts(document.querySelector('#apexChart3'), optionThree);
// chartThree.render();

//-------------------------------------------------
// chartId = 4
var optionFour = {
  series: [
  {
    type: 'column',
    data: []
  },
  // {
  //   type: 'column',
  //   data: [[0,9],[1,7],[2,4],[3,8],[4,4],[5,12],[6,4],[7,6],[8,5],[9,10],[10,4],[11,5],[12,10],[13,2],[14,6],[15,16],[16,5],[17,17],[18,14],[19,6],[20,5],[21,2],[22,12],[23,4],[24,7]]
  // }
  ],
  chart: {
    height: 120,
    stacked: true,
    type: 'line',
    sparkline: {
      enabled: true
    }
  },
  states: {
    hover: {
      filter: {
        type: 'none'
      }
    },
    active: {
      filter: {
        type: 'none'
      }
    }
  },
  colors: ['#506fd9', '#e5e9f2'],
  grid: {
    padding: {
      bottom: 10,
      left: -6,
      right: -5
    }
  },
  plotOptions: {
    bar: {
      columnWidth: '40%',
      endingShape: 'rounded'
    },
  },
  stroke: {
    curve: 'straight',
    lineCap: 'square'
  },
  yaxis: {
    min: 0,
    max: 0,
  },
  tooltip: {
    enabled: true
  }
};

//------------------------------------------------

var optionFive = {
  series: [{
    type: 'column',
    data: [[0,2],[1,3],[2,5],[3,7],[4,12],[5,17],[6,10],[7,14],[8,15],[9,12],[10,8],[11,6],[12,9],[13,12],[14,5],[15,10],[16,12],[17,16],[18,13],[19,7],[20,4],[21,2],[22,2],[23,2],[24,5]]
  }, {
    type: 'column',
    data: [[0,12],[1,7],[2,4],[3,5],[4,8],[5,10],[6,4],[7,7],[8,11],[9,9],[10,5],[11,3],[12,4],[13,6],[14,6],[15,10],[16,5],[17,7],[18,4],[19,16],[20,15],[21,11],[22,12],[23,4],[24,7]]
  }],
  chart: {
    height: 120,
    stacked: true,
    type: 'line',
    sparkline: {
      enabled: true
    }
  },
  states: {
    hover: {
      filter: {
        type: 'none'
      }
    },
    active: {
      filter: {
        type: 'none'
      }
    }
  },
  colors: ['#85b6ff', '#e5e9f2'],
  grid: {
    padding: {
      bottom: 10,
      left: -6,
      right: -5
    }
  },
  plotOptions: {
    bar: {
      columnWidth: '40%',
      endingShape: 'rounded'
    },
  },
  stroke: {
    curve: 'straight',
    lineCap: 'square'
  },
  yaxis: {
    min: 0,
    max: 30
  },
  tooltip: {
    enabled: false
  }
};

// var chartFive = new ApexCharts(document.querySelector('#apexChart5'), optionFive);
// chartFive.render();

//----------------------------------------------

var optionSix = {
  series: [{
    name: 'series1',
    data: dp3
  },{
    name: 'series2',
    data: dp3
  }],
  chart: {
    height: '100%',
    parentHeightOffset: 0,
    type: 'area',
    toolbar: {
      show: false
    },
    stacked: true,
    sparkline: {
      enabled: true
    }
  },
  colors: ['#506fd9', '#85b6ff'],
  stroke: {
    curve: 'straight',
    width: [0,0]
  },
  yaxis: {
    min: 0,
    max: 60,
    show: false
  },
  xaxis: {
    min: 20,
    max: 30
  },
  fill: {
    type: 'gradient',
    gradient: {
      opacityFrom: 0.75,
      opacityTo: 0.25,
    }
  },
  legend: {
    show: false
  },
  tooltip: {
    enabled: false
  }
};

// var chartSix = new ApexCharts(document.querySelector('#apexChart6'), optionSix);
// chartSix.render();

//-------------------------------------------------

var optionSeven = {
  series: [{
    data: [10, 12, 18, 25, 15, 30, 40, 10, 20, 12, 16, 60, 20, 15, 10, 60, 50, 40, 80, 100, 30, 40, 10, 20, 12, 16, 60, 20, 15, 60, 20, 15, 10, 60, 50, 40, 30, 40, 10, 20, 16, 60, 20, 15, 60, 20, 15, 10, 60, 50, 40, 30, 40, 10, 20]
  },{
    data: [-10, -12, -18, -25, -15, -30, -40, -10, -20, -12, -16, -60, -20, -15, -10, -60, -50, -40, -80, -40, -30, -40, -10, -20, -12, -16, -60, -20, -15, -60, -20, -15, -10, -60, -50, -40, -30, -40, -10, -20, -40, -10, -20, -12, -16, -60, -20, -15, -60, -20, -15, -10, -60, -50, -40]
  }],
  chart: {
    type: 'bar',
    height: 200,
    parentHeightOffset: 0,
    stacked: true,
    toolbar: {
      show: false
    }
  },
  colors: ['#506fd9', '#85b6ff'],
  grid: {
    borderColor: 'rgba(72,94,144, 0.07)',
    padding: {
      top: -20,
      left: 0,
      bottom: -5
    }
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '60%',
      endingShape: 'rounded'
    },
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent']
  },
  yaxis: {
    max: 130,
    tickAmount: 5,
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '10px'
      }
    }
  },
  xaxis: {
    type: 'numeric',
    tickAmount: 10,
    decimalsInFloat: 0,
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '10px',
        fontWeight: 'bold'
      }
    },
    axisBorder: {
      show: false
    }
  },
  fill: {
    opacity: 1
  },
  legend: {
    show: false
  },
  tooltip: {
    enabled: false
  }
};

// var chartSeven = new ApexCharts(document.querySelector('#apexChart7'), optionSeven);
// chartSeven.render();

//--------------------------------------------------
//default
// var optionEightDefault = {
//   series: [{
//     type: 'column',
//     data: [[0,2],[1,3],[2,5],[3,7],[4,12],[5,17],[6,10],[7,14],[8,15],[9,12],[10,8]]
//   }, {
//     type: 'column',
//     data: [[0,12],[1,7],[2,4],[3,5],[4,8],[5,10],[6,4],[7,7],[8,11],[9,9],[10,5]]
//   }],
//   chart: {
//     height: '100%',
//     parentHeightOffset: 0,
//     stacked: true,
//     type: 'line',
//     toolbar: {
//       show: false
//     }
//   },
//   grid: {
//     borderColor: 'rgba(72,94,144, 0.07)',
//     padding: {
//       top: -20,
//       left: 5,
//       bottom: -15
//     }
//   },
//   states: {
//     hover: {
//       filter: {
//         type: 'none'
//       }
//     },
//     active: {
//       filter: {
//         type: 'none'
//       }
//     }
//   },
//   colors: ['#506fd9', '#e5e9f2'],
//   plotOptions: {
//     bar: {
//       columnWidth: '40%',
//       endingShape: 'rounded'
//     },
//   },
//   stroke: {
//     curve: 'straight',
//     lineCap: 'square',
//     width: 0
//   },
//   yaxis: {
//     min: 0,
//     max: 30,
//     tickAmount: 5
//   },
//   xaxis: {
//     labels: {
//       style: {
//         colors: '#6e7985',
//         fontSize: '10px',
//         fontWeight: '500'
//       }
//     },
//   },
//   tooltip: {
//     enabled: false
//   },
//   legend: {
//     show: false
//   }
// };

//edited
// this chart_id = 8
var optionEight = { 
  series: [
    {
    type: 'column',
    data: []
    }, 
  ],
  chart: {
    height: '100%',
    parentHeightOffset: 0,
    stacked: true,
    type: 'line',
    toolbar: {
      show: false
    }
  },
  grid: {
    borderColor: 'rgba(72,94,144, 0.07)',
    padding: {
      top: -20,
      left: 5,
      bottom: -15
    }
  },
  states: {
    hover: {
      filter: {
        type: 'none'
      }
    },
    active: {
      filter: {
        type: 'none'
      }
    }
  },
  colors: ['#506fd9', '#e5e9f2'],
  plotOptions: {
    bar: {
      columnWidth: '40%',
      endingShape: 'rounded'
    },
  },
  stroke: {
    curve: 'straight',
    lineCap: 'square',
    width: 0
  },
  yaxis: {
    min: 0,
    max: 1000, // change this to the highest jumlah dynamicly (done)
    tickAmount: 5
  },
  xaxis: {
    categories: [],
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '10px',
        fontWeight: '500'
      }
    },
  },
  tooltip: {
    enabled: true
  },
  legend: {
    show: true
  }
};

// Dark skin integration
function switchDark(enabled) {
  if(enabled) {
    $('.btn-white').addClass('btn-outline-primary').removeClass('btn-white');
  } else {
    $('.btn-outline-primary').addClass('btn-white').removeClass('btn-outline-primary');
  }
}

if(skinMode) { switchDark(true); }

// Switch between light and dark
$('#skinMode .nav-link').bind('click', function(e){
  var mode = $(this).text().toLowerCase();
  if(mode == 'dark') {
    switchDark(true);
  } else {
    switchDark(false);
  }
});

//-------------------------------------------------
// chartId = 2
var optionColumn = {
  series: [],
  chart: {
    type: 'bar',
    height: 300
  },
  // colors: ['#506fd9', '#85b6ff', '#a8b5c3'],
  colors: [],
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '55%',
      endingShape: 'rounded'
    },
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent']
  },
  xaxis: {
    categories: [],
  },
  fill: {
    opacity: 1
  },
  // tooltip: {
  //   y: {
  //     formatter: function (val) {
  //       return "$ " + val + " thousands"
  //     }
  //   }
  // }
};
//-------------------------------------------------
// chartId = 3 & 5 bar stacked and barRadius
var optionStacked = {
  series: [
    // {
    // name: 'PRODUCT A',
    // data: [44, 55, 41, 67, 22, 43]
    // }, 
    // {
    //   name: 'PRODUCT B',
    //   data: [13, 23, 20, 8, 13, 27]
    // }, 
    // {
    // name: 'PRODUCT C',
    // data: [11, 17, 15, 15, 21, 14]
    // }, 
    // {
    // name: 'PRODUCT D',
    // data: [21, 7, 25, 13, 22, 8]
    // }
  ],
  chart: {
    type: 'bar',
    height: 300,
    stacked: true,
    toolbar: {
      show: false
    },
    zoom: {
      enabled: true
    }
  },
  // colors: ['#506fd9', '#85b6ff', '#a8b5c3', '#e5e9f2'],
  colors: [],
  responsive: [{
    breakpoint: 480,
    options: {
      legend: {
        position: 'bottom',
        offsetX: -10,
        offsetY: 0
      }
    }
  }],
  plotOptions: {
    bar: {
      horizontal: false,
      dataLabels: {
        total: {
          enabled: true,
          style: {
            fontSize: '13px',
            fontWeight: 900
          }
        }
      },
      borderRadius: 0
    },
  },
  xaxis: {
    // type: 'datetime',
  //   categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT',
  //   '01/05/2011 GMT', '01/06/2011 GMT'
  // ],
  categories: [],
},
legend: {
  show: 'false'
},
fill: {
  opacity: 1
},

};
//-------------------------------------------------
// chartId = 4
var optionArea = {
series: [
  // {
  // name: "STOCK ABC",
  // data: [
  //   8107.85,
  //   8128.0,
  //   8122.9,
  //   8165.5,
  //   8340.7,
  //   8423.7,
  //   8423.5,
  //   8514.3,
  //   8481.85,
  //   8487.7,
  //   8506.9,
  //   8626.2,
  //   8668.95,
  //   8602.3,
  //   8607.55,
  //   8512.9,
  //   8496.25,
  //   8600.65,
  //   8881.1,
  //   9340.85
  // ]
  // }
],
chart: {
  type: 'area',
  height: 300,
  zoom: {
    enabled: false
  }
},
dataLabels: {
  enabled: false
},
stroke: {
  curve: 'straight',
  width: 2
},
labels: [],
xaxis: {
  // type: 'datetime',
},
colors: [],
yaxis: {
  // opposite: true
},
legend: {
  // horizontalAlign: 'left',
  show: true,
      showForSingleSeries: false,
      showForNullSeries: true,
      showForZeroSeries: true,
      position: 'bottom',
      horizontalAlign: 'center', 
      floating: false,
      fontSize: '14px',
      fontFamily: 'Helvetica, Arial',
      fontWeight: 400,
}
};
//-------------------------------------------------
// chartId = 6
var optionRadial = {
  chart: {
    height: 300,
    type: "radialBar",
  },
  series: [],
  plotOptions: {
    radialBar: {
      dataLabels: {
        total: {
          show: true,
          label: 'TOTAL'
        }
      }
    }
  },
  labels: [],
  colors: []
};
//------------------------------------------------
// chartId = 9
var optionLine = {
  series: [
  //  {
  //   name: '',
  //   data: []
  // },
  //  {
  //   name: 'Desktops',
  //   data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
  // }
  ],
  // colors: [],
  chart: {
    height: 300,
    type: 'line',
    zoom: {
      enabled: false
    },
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'straight',
    width: 2,

  },
  grid: {
    row: {
      // colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
      colors: [ 'transparent'], // takes an array which will be repeated on columns
      opacity: 1
    },
  },
  xaxis: {
    categories: []
  },
  colors: [], // Set colors for the lines

};
//------------------------------------------------
// chartId = 10 & 14 donut and pie
var optionDonut = {
  series: [],
  chart: {
    type: '',
    height: 300,
    // height: 'auto',
    parentHeightOffset: 0
  },
  labels: [],
  // colors: ['#506fd9', '#85b6ff','#33d685','#0dcaf0','#1c96e9','#6e7985','#ccd2da'],
  colors: [],
  dataLabels: {
    enabled: true
  },
  grid: {
    padding: {
      top: 0,
      bottom: 0
    }
  },
   legend: {
      show: true,
      showForSingleSeries: false,
      showForNullSeries: true,
      showForZeroSeries: true,
      position: 'bottom',
      horizontalAlign: 'center', 
      floating: false,
      fontSize: '14px',
      fontFamily: 'Helvetica, Arial',
      fontWeight: 400,
    
  },
};
//------------------------------------------------
// chartId = 13
var optionBarSide = {
  series: [
    // {
    //   data: []
    // },
  //     {
  //   name: 'ds',
  //   data: [124, 41, 35, 51, 492, 62, 69, 91, 148]
  // },

  ],
  chart: {
    type: 'bar',
    height: 300,
  },
  colors: [],
  plotOptions: {
    bar: {
      borderRadius: 2,
      columnWidth: '55%',
      horizontal: true,
    }
  },
  dataLabels: {
    enabled: false
  },
  xaxis: {
    categories: [],
  },
  
  
};
// function to append card title to the card
function appendTitleToCard(containerSelector, card_title) {
  const judulContainer = document.querySelector(containerSelector);

  // empty the content if any
  judulContainer.innerHTML = '';

  // apend card_title to the card
  const newElement = document.createElement('h6');
  newElement.className = 'card-title';
  newElement.innerHTML = `${card_title}`;
  judulContainer.appendChild(newElement);// asign the element to the content
}

// function to append card description to the card
function appendDescriptionToCard(containerSelector, card_description) {
  const judulContainer = document.querySelector(containerSelector);

  // empty the content if any
  judulContainer.innerHTML = '';

  // apend card_description to the card
  const newElement = document.createElement('p');
  newElement.className = 'fs-xs text-secondary mb-0 lh-4';
  newElement.innerHTML = `${card_description}`;
  judulContainer.appendChild(newElement);// asign the element to the content
}

// Loop through the contents array to find the matching chart_id
  for (var i = 0; i < contents.length; i++) {
    let maxValue;
    if (contents[i].chart_id === 1) { // Tableau

      const tabContainer = document.querySelector(`#content${contents[i].id}`);

      // Clear any previous content
      tabContainer.innerHTML = '';

      // Create an iframe element
      const newElement = document.createElement('tableau-viz');
      newElement.id = `tableauViz${contents[i].id}`;

      tabContainer.appendChild(newElement); // Assign the element to the content

    } 
    else if (contents[i].chart_id === 2) { // Column bar chart

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      console.log(yAxis);
      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionColumn.series.push(newSeries);
      }
      optionColumn.xaxis.categories = xAxis[0];
      optionColumn.colors = colors;

      var chartColumn = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionColumn);
      chartColumn.render();
      optionColumn.series = [];
      console.log('render content ' + contents[i].id);
    } 
    else if (contents[i].chart_id === 3) { // Stacked bar chart

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)
      console.log(colors);

      console.log(yAxis);
      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionStacked.series.push(newSeries);
      }
      optionStacked.colors = colors;
      optionStacked.xaxis.categories = xAxis[0];

      var stackedBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionStacked );
      stackedBar.render();
      optionStacked.series = [];
      console.log('render content ' + contents[i].id);
    } 
    else if (contents[i].chart_id === 4) { // Line Area Chart

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      console.log(yAxis);
      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionArea.series.push(newSeries);
      }
      optionArea.xaxis.categories = xAxis[0];
      optionArea.colors = colors;

      var lineArea = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionArea );
      lineArea.render();
      optionArea.series = [];
      console.log('render content ' + contents[i].id);
    } 
    else if (contents[i].chart_id === 5) { // bar chart with border radius

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionFour

      let judul = JSON.parse(contents[i].judul)[0]
      let yAxis = JSON.parse(contents[i].y_value)[0]
      let xAxis = JSON.parse(contents[i].x_value)[0]
      let colors = JSON.parse(contents[i].color)

      var newSeries = {
          name: judul, // Set the new name
          data: yAxis    // Set the new data
      };
      optionStacked.series.push(newSeries);
      // asign the value to the chart configuration
      optionStacked.xaxis.categories = xAxis;
      optionStacked.colors = colors;
      optionStacked.plotOptions.bar.borderRadius = 12;

      var barRadius = new ApexCharts(document.querySelector('#content' + contents[i].id), optionStacked);
      barRadius.render();

      optionArea.series = [];
    }
    else if (contents[i].chart_id === 6) { // Option radial (%)

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionFour

      let judul = JSON.parse(contents[i].judul)[0]
      let yAxis = JSON.parse(contents[i].y_value)[0]
      let xAxis = JSON.parse(contents[i].x_value)[0]
      let colors = JSON.parse(contents[i].color)

      // asign the value to the chart configuration
      optionRadial.series = yAxis;
      optionRadial.labels = xAxis;
      optionRadial.colors = colors;

      var radialBar = new ApexCharts(document.querySelector('#content' + contents[i].id), optionRadial);
      radialBar.render();

    }
    else if (contents[i].chart_id === 7) { // Stacked Side Bar Chart

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      console.log(yAxis);
      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionBarSide.series.push(newSeries);
      }
      optionBarSide.xaxis.categories = xAxis[0];
      optionBarSide.colors = colors;
      optionBarSide.chart.stacked = true;

      var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSide);
      chartBar.render();
      optionBarSide.series = [];
      console.log('render content ' + contents[i].id);
    } 
    else if (contents[i].chart_id === 8) { // Bar Chart With AI Analyst
      
      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let xAxis = JSON.parse(contents[i].x_value)[0]
      let yAxis = JSON.parse(contents[i].y_value)[0]

      // transform yAxis form ['800', '200'] --> [[1, 800], [2, 200]]
      let yContainer = []
      if (yAxis) {
        for(let x = 0; x<yAxis.length; x++){
          yContainer.push([x+1, yAxis[x]])
        }
      }
      // SET MAX VALUE TO CHART ID = 8
      for (let i = 0; i < yContainer.length; i++) {
        let secondValue = yContainer[i][1]; // Get the second value in each sub-array
        if (secondValue > maxValue) {
          maxValue = secondValue; // Update the maximum value if a higher one is found
        }
      }
      // asign the value to the chart configuration
      optionEight.xaxis.categories = xAxis;
      optionEight.yaxis.max = maxValue;
      optionEight.series[0].data = yContainer;

      var chartEight = new ApexCharts(document.querySelector('#content' + contents[i].id), optionEight);
      chartEight.render();
    } 
    else if (contents[i].chart_id === 9) { // Line Chart

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);
      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      console.log(yAxis);
      // asign the value to the chart configuration

      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionLine.series.push(newSeries);
      }
      optionLine.xaxis.categories = xAxis[0];
      optionLine.colors = colors;

      var chartLine = new ApexCharts(document.querySelector('#content' + contents[i].id), optionLine);
      chartLine.render();
      optionLine.series = [];
      console.log('render content ' + contents[i].id);
    } 
    else if (contents[i].chart_id === 10) { // Donut chart

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);


      // Assign the value to optionEigt
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      console.log(yAxis);
      // asign the value to the chart configuration
      optionDonut.labels = xAxis[0];
      optionDonut.series = yAxis[0];
      optionDonut.chart.type = 'donut';
      optionDonut.colors = colors;

      var chartDonut = new ApexCharts(document.querySelector('#content' + contents[i].id), optionDonut);
      chartDonut.render();
    } 
    else if (contents[i].chart_id === 11) { // card

      const y_value = JSON.parse(contents[i].y_value)[0];
      const x_value = JSON.parse(contents[i].x_value)[0];

      // reference to the card container element
      const cardContainer = document.querySelector(`#content${contents[i].id}`);

      // Clear any previous content
      cardContainer.innerHTML = '';

      // Iterate over the elements based on y_value.length
      for (let j = 0; j < y_value.length; j++) {
        const newElement = document.createElement('div');
        newElement.className = 'col-6 col-sm';
        newElement.innerHTML = `
          <div class="card card-one">
            <div class="card-body p-3">
              <div class="d-block fs-40 lh-1 text-primary mb-1"><i class="ri-calendar-todo-line"></i></div>
              <h1 class="card-value mb-0 ls--1 fs-32" id="card-val">${y_value[j]}</h1>
              <label class="d-block mb-1 fw-medium text-dark">${x_value[j]}</label>
              <small><span class="d-inline-flex text-danger">0.7% <i class="ri-arrow-down-line"></i></span> than last week</small>
            </div>
          </div>
        `;

        cardContainer.appendChild(newElement); // asign element to the content
      }
    }
    else if (contents[i].chart_id === 12) { // table

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);


      const y_value = JSON.parse(contents[i].y_value)[0];
      const x_value = JSON.parse(contents[i].x_value)[0];

      // reference to the card container element
      const tableDataContainer = document.querySelector(`#content${contents[i].id}`);

      // Clear any previous content
      tableDataContainer.innerHTML = '';

      // Iterate over the elements based on y_value.length
      for (let j = 0; j < y_value.length; j++) {
        const newElement = document.createElement('tr');
        newElement.className = 'table-row';
        newElement.innerHTML = `
        <td scope="row">${j+1}</td>
        <td>${x_value[j]}</td>
        <td>${y_value[j]}</td>
        `;
        tableDataContainer.appendChild(newElement); // asign the element to the content
      }
    }
    else if (contents[i].chart_id === 13) { // Side Bar Chart

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      console.log(yAxis);
      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionBarSide.series.push(newSeries);
      }
      optionBarSide.xaxis.categories = xAxis[0];
      optionBarSide.colors = colors;

      var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSide);
      chartBar.render();

      optionBarSide.series = [];
      console.log('render content ' + contents[i].id);
    } 
    else if (contents[i].chart_id === 14) { // Pie Chart

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)

      console.log(yAxis);
      // asign the value to the chart configuration
      optionDonut.labels = xAxis[0];
      optionDonut.series = yAxis[0];
      optionDonut.chart.type = 'pie';

      var chartPie = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionDonut);
      chartPie.render();
      console.log('render content ' + contents[i].id);
    } 
    else if (contents[i].chart_id === 15) { // Nama 15

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let xAxis = JSON.parse(contents[i].x_value)[0]
      let yAxis = JSON.parse(contents[i].y_value)[0]

      let max = Math.max(...yAxis);
      // reference to the card container element
      const contentContainer = document.querySelector(`#content${contents[i].id}`);

      // Clear any previous content
      contentContainer.innerHTML = '';

      // Iterate over the elements based on y_value.length
      for (let j = 0; j < yAxis.length; j++) {
        let gray = max == yAxis[j] // find if max or not, if then make the circle = bg-gray 
        const newElement = document.createElement('div');
        newElement.className = 'col-6 col-sm-4 col-md';
        newElement.innerHTML = `
          <div class="finance-item">
            <div class="finance-item-circle ${gray ? 'bg-gray-400' : ''}">
              <h1>${yAxis[j]}</h1>
              <label class="text-center">${xAxis[j]}</label>
            </div><!-- finance-item-circle -->
          </div><!-- finance-item --> `;
        contentContainer.appendChild(newElement); // asign the element to the content
      }
    } 

  }