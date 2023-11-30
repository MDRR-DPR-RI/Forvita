'use strict'


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
// chartId = 1, 2, 3, 4, 5, 6
var optionLine = {
  series: [
    // y axis goes here
  ],
  chart: {
    type: '',
    height: 300,
    zoom: {
      enabled: false
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: '',
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

//------------------------------------------------
// chartId = 7, 9, 11, 13, 14, 15
var optionBarSide = {
  series: [
  ],
  chart: {
    type: 'bar',
    height: 300,
    stacked: false ,
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
  yaxis: {
    // reversed: null
  }
};
//------------------------------------------------
// chartId = 8, 10, 12
var optionBarSideRev = {
  series: [
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
  yaxis: {
    reversed: true
  }
};
//------------------------------------------------
// chartId = 16 & 17 donut and pie
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

function mergeArrays(x, y) {
  // Find the union of all keys in subarrays of x
  const allKeys = [...new Set(x.flat())];

  // Create the new arrays
  const resultX = Array.from({ length: x.length }, () => [...allKeys]);
  const resultY = Array.from({ length: y.length }, () => Array(allKeys.length).fill(0));

  // Fill in the values from the original arrays
  for (let i = 0; i < x.length; i++) {
    for (let j = 0; j < x[i].length; j++) {
      const key = x[i][j];
      const value = y[i][j];
      const index = resultX[i].indexOf(key);
      resultY[i][index] = value;
    }
  }

  return { x: resultX, y: resultY };
}


// Loop through the contents array to find the matching chart_id
  for (var i = 0; i < contents.length; i++) {

    const chartIds = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17,19, 20, 22,23,24,25]

    if (chartIds.includes(contents[i].chart_id)) { //emebed tableau(18) & kartu(21)  doesn't have title and desc

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);
      appendTitleToCard(`#title_card_zoom${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);
      appendDescriptionToCard(`#desc_card_zoom${contents[i].id}`, contents[i].card_description);
      
    }
    

    const result = mergeArrays(JSON.parse(contents[i].x_value), JSON.parse(contents[i].y_value));
    
    const judul = JSON.parse(contents[i].judul)
    let xAxis = result.x[0]
    const yAxis = result.y
    const colors = JSON.parse(contents[i].color)

    if (contents[i].chart_id === 1) { // Line Chart

      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionLine.series.push(newSeries);
      }
      optionLine.xaxis.categories = xAxis;
      optionLine.colors = colors;
      optionLine.chart.type = 'line'; // type line chart
      optionLine.stroke.curve = 'straight'; 
      

      var lineArea = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionLine );
      var lineAreaModal = new ApexCharts(document.querySelector(`#card_content_zoom${contents[i].id}`), optionLine );
      lineArea.render();
      lineAreaModal.render();
      optionLine.series = [];
      
    } 
    else if (contents[i].chart_id === 2) { // Line Chart (smooth)
      
      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionLine.series.push(newSeries);
      }
      optionLine.xaxis.categories = xAxis;
      optionLine.colors = colors;
      optionLine.chart.type = 'line'; // type line chart
      optionLine.stroke.curve = 'smooth'; 
      
      var lineArea = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionLine );
      var lineAreaModal = new ApexCharts(document.querySelector(`#card_content_zoom${contents[i].id}`), optionLine );
      lineArea.render();
      lineAreaModal.render();
      optionLine.series = [];
      
    } 
    else if (contents[i].chart_id === 3) { // Line Chart (stepline)
      
      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionLine.series.push(newSeries);
      }
      optionLine.xaxis.categories = xAxis;
      optionLine.colors = colors;
      optionLine.chart.type = 'line'; // type area chart
      optionLine.stroke.curve = 'stepline'; 
      
      var lineArea = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionLine );
      var lineAreaModal = new ApexCharts(document.querySelector(`#card_content_zoom${contents[i].id}`), optionLine );
      lineArea.render();
      lineAreaModal.render();
      optionLine.series = [];
      
    } 
    else if (contents[i].chart_id === 4) { // Line Area Chart
      
      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionLine.series.push(newSeries);
      }
      optionLine.xaxis.categories = xAxis;
      optionLine.colors = colors;
      optionLine.chart.type = 'area'; // type area chart
      optionLine.stroke.curve = 'straight'; 
      
      var lineArea = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionLine );
      var lineAreaModal = new ApexCharts(document.querySelector(`#card_content_zoom${contents[i].id}`), optionLine );
      lineArea.render();
      lineAreaModal.render();
      optionLine.series = [];
      
    } 
    else if (contents[i].chart_id === 5) { // Line Area Chart (smooth)
      
      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionLine.series.push(newSeries);
      }
      optionLine.xaxis.categories = xAxis;
      optionLine.colors = colors;
      optionLine.chart.type = 'area'; // type area chart
      optionLine.stroke.curve = 'smooth'; 
      

      var lineArea = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionLine );
      var lineAreaModal = new ApexCharts(document.querySelector(`#card_content_zoom${contents[i].id}`), optionLine );
      lineArea.render();
      lineAreaModal.render();
      optionLine.series = [];
      
    }
    else if (contents[i].chart_id === 6) { // Line Area Chart (stepline)

      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionLine.series.push(newSeries);
      }
      optionLine.xaxis.categories = xAxis;
      optionLine.colors = colors;
      optionLine.chart.type = 'area'; // type area chart
      optionLine.stroke.curve = 'stepline'; 
      
      var lineArea = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionLine );
      var lineAreaModal = new ApexCharts(document.querySelector(`#card_content_zoom${contents[i].id}`), optionLine );
      lineArea.render();
      lineAreaModal.render();
      optionLine.series = [];
      
    } 
    else if (contents[i].chart_id === 7) { // Bar Chart
      
      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionBarSide.series.push(newSeries);
      }
      optionBarSide.xaxis.categories = xAxis;
      optionBarSide.colors = colors;

      var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSide);
      var chartBarModal = new ApexCharts(document.querySelector(`#card_content_zoom${contents[i].id}`), optionBarSide);
      chartBar.render();
      chartBarModal.render();
      optionBarSide.series = [];
      
    } 
    else if (contents[i].chart_id === 8) { // Bar Chart (reversed)
      
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionBarSideRev.series.push(newSeries);
      }
      optionBarSideRev.xaxis.categories = xAxis;
      optionBarSideRev.colors = colors;
      // optionBarSideRev.chart.stacked = true;

      var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSideRev);
      var chartBarModal = new ApexCharts(document.querySelector(`#card_content_zoom${contents[i].id}`), optionBarSideRev);
      chartBar.render();
      chartBarModal.render();
      optionBarSideRev.series = [];
      
    } 
    else if (contents[i].chart_id === 9) { // bar chart with border radius
      
      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionBarSide.series.push(newSeries);
      }

      // asign the value to the chart configuration
      optionBarSide.xaxis.categories = xAxis;
      optionBarSide.colors = colors;
      optionBarSide.plotOptions.bar.borderRadius = 15;

      var barRadius = new ApexCharts(document.querySelector('#content' + contents[i].id), optionBarSide);
      var barRadiusModal = new ApexCharts(document.querySelector('#card_content_zoom' + contents[i].id), optionBarSide);
      barRadius.render();
      barRadiusModal.render();

      optionBarSide.plotOptions.bar.borderRadius = 0;
      optionBarSide.series = [];
    }
    else if (contents[i].chart_id === 10) { // bar chart with border radius (reversed)

     // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionBarSideRev.series.push(newSeries);
      }
      optionBarSideRev.xaxis.categories = xAxis;
      optionBarSideRev.colors = colors;
      optionBarSideRev.plotOptions.bar.borderRadius = 15;

      var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSideRev);
      var chartBarModal = new ApexCharts(document.querySelector(`#card_content_zoom${contents[i].id}`), optionBarSideRev);
      chartBar.render();
      chartBarModal.render();
      optionBarSideRev.series = [];
      optionBarSideRev.plotOptions.bar.borderRadius = 0;
      
    } 
    else if (contents[i].chart_id === 11) { // Stacked Bar Chart

      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionBarSide.series.push(newSeries);
      }
      optionBarSide.xaxis.categories = xAxis;
      optionBarSide.colors = colors;
      optionBarSide.chart.stacked = true;

      var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSide);
      var chartBarModal = new ApexCharts(document.querySelector(`#card_content_zoom${contents[i].id}`), optionBarSide);
      chartBar.render();
      chartBarModal.render();

      optionBarSide.series = [];
      optionBarSide.chart.stacked = false;
      
    } 
    else if (contents[i].chart_id === 12) { // Stacked bar chart  (reversed)
      
     // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionBarSideRev.series.push(newSeries);
      }
      optionBarSideRev.xaxis.categories = xAxis;
      optionBarSideRev.colors = colors;
      optionBarSideRev.chart.stacked = true;

      var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSideRev);
      var chartBarModal = new ApexCharts(document.querySelector(`#card_content_zoom${contents[i].id}`), optionBarSideRev);
      chartBar.render();
      chartBarModal.render();

      optionBarSideRev.series = [];
      optionBarSideRev.chart.stacked = false;

      
    } 
    else if (contents[i].chart_id === 13) { // Column Chart

      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionBarSide.series.push(newSeries);
      }
      optionBarSide.xaxis.categories = xAxis;
      optionBarSide.colors = colors;
      optionBarSide.plotOptions.bar.horizontal = false;

      var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSide);
      var chartBarModal = new ApexCharts(document.querySelector(`#card_content_zoom${contents[i].id}`), optionBarSide);
      chartBar.render();
      chartBarModal.render();

      optionBarSide.series = [];
      optionBarSide.plotOptions.bar.horizontal = true;

    } 
    else if (contents[i].chart_id === 14) { // Column chart with border radius
      
     // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionBarSide.series.push(newSeries);
      }
      optionBarSide.xaxis.categories = xAxis;
      optionBarSide.colors = colors;
      optionBarSide.plotOptions.bar.borderRadius = 15;
      optionBarSide.plotOptions.bar.horizontal = false;

      var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSide);
      var chartBarModal = new ApexCharts(document.querySelector(`#card_content_zoom${contents[i].id}`), optionBarSide);
      chartBar.render();
      chartBarModal.render();

      optionBarSide.series = [];
      optionBarSide.plotOptions.bar.borderRadius = 0;
      optionBarSide.plotOptions.bar.horizontal = true;

    } 
    else if (contents[i].chart_id === 15) { // Stacked Column Chart
      
      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionBarSide.series.push(newSeries);
      }
      optionBarSide.xaxis.categories = xAxis;
      optionBarSide.colors = colors;
      optionBarSide.plotOptions.bar.horizontal = false;
      optionBarSide.chart.stacked = true;

      var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSide);
      var chartBarModal = new ApexCharts(document.querySelector(`#card_content_zoom${contents[i].id}`), optionBarSide);
      chartBar.render();
      chartBarModal.render();

      optionBarSide.series = [];
      optionBarSide.plotOptions.bar.horizontal = true;
      optionBarSide.chart.stacked = false;

    } 
    else if (contents[i].chart_id === 16) { // Donut chart
      
      // asign the value to the chart configuration
      optionDonut.labels = xAxis;
      optionDonut.series = yAxis[0];
      optionDonut.chart.type = 'donut';
      optionDonut.colors = colors;

      var chartDonut = new ApexCharts(document.querySelector('#content' + contents[i].id), optionDonut);
      var chartDonutModal = new ApexCharts(document.querySelector('#card_content_zoom' + contents[i].id), optionDonut);
      chartDonut.render();
      chartDonutModal.render();
    } 
    else if (contents[i].chart_id === 17) { // Pie Chart

      // asign the value to the chart configuration
      optionDonut.labels = xAxis;
      optionDonut.series = yAxis[0];
      optionDonut.chart.type = 'pie';
      optionDonut.colors = colors;

      var chartPie = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionDonut);
      var chartPieModal = new ApexCharts(document.querySelector(`#card_content_zoom${contents[i].id}`), optionDonut);
      chartPie.render();
      chartPieModal.render();
      
    } 
    else if (contents[i].chart_id === 18) { // Tableau

      const tabContainer = document.querySelector(`#content${contents[i].id}`);

      // Clear any previous content
      tabContainer.innerHTML = '';

      // Create an iframe element
      const newElement = document.createElement('tableau-viz');
      newElement.id = `tableauViz${contents[i].id}`;

      tabContainer.appendChild(newElement); // Assign the element to the content

    } 
    else if (contents[i].chart_id === 19) { // Indonesia Map
      
      var mapColor = {}
      for (var code in possible_map_indonesia_input) {
        for (let index = 0; index < xAxis.length; index++) {
          const province = xAxis[index] ? xAxis[index].replace(/\s/g, '').toLowerCase() : ''; 
          if (possible_map_indonesia_input[code].includes(province)) {
            var newObj = {
              [code]: colors[index],
            };
            Object.assign(mapColor, newObj);
            index++
          }
        }
      }
      // console.log(possible_map_indonesia_input['path01']); // Output: ['aceh', 'ac']
      $(`#content${contents[i].id}`).vectorMap({
          map: 'indonesia_id',
          backgroundColor: 'transparent',
          borderColor: '#000',
          borderOpacity: 0.75,
          borderWidth: 1,
          color: '#4a4949',
          enableZoom: true,
          hoverColor: '#00F',
          hoverOpacity: 0.3,
          selectedColor: '#00F',
          selectedRegion: 'ID', 
          scaleColors: ['#C8EEFF', '#006491'],
          onRegionOver: function(event, code, region)
          {
            console.log(code);
            // console.log(region);
          },
          onLabelShow: function(event, label, code)
          {
              for (let index = 0; index < xAxis.length; index++) {
                const province = xAxis[index].replace(/\s/g, '').toLowerCase();
                if (possible_map_indonesia_input[code].includes(province)) {
                  label.text(judul[0] + '. -' + xAxis[index] + " : " + yAxis[0][index]) 
                }
              }
          },
          onLoad: function (event, map) {
              jQuery(`#content${contents[i].id}`).vectorMap('set', 'colors', mapColor);
          },
          
      });

      $(`#card_content_zoom${contents[i].id}`).vectorMap({
          map: 'indonesia_id',
          backgroundColor: 'transparent',
          borderColor: '#000',
          borderOpacity: 0.75,
          borderWidth: 1,
          color: '#4a4949',
          enableZoom: true,
          hoverColor: '#00F',
          hoverOpacity: 0.3,
          selectedColor: '#00F',
          selectedRegion: 'ID', 
          scaleColors: ['#C8EEFF', '#006491'],
          onRegionOver: function(event, code, region)
          {
            console.log(code);
            // console.log(region);
          },
          onLabelShow: function(event, label, code)
          {

              for (let index = 0; index < xAxis.length; index++) {
                const province = xAxis[index].replace(/\s/g, '').toLowerCase();
                if (possible_map_indonesia_input[code].includes(province)) {
                  label.text(judul[0] + '. -' + xAxis[index] + " : " + yAxis[0][index]) 
                }
              }
          },
          onLoad: function (event, map) {
              jQuery(`#card_content_zoom${contents[i].id}`).vectorMap('set', 'colors', mapColor);
          },
          
      });

    } 
    else if (contents[i].chart_id === 20) { // AI Analyst

      // ai analyst  req an api when create content

    } 
    else if (contents[i].chart_id === 21) { // card

      // reference to the card container element
      const cardContainer = document.querySelector(`#content${contents[i].id}`);

      // Clear any previous content
      cardContainer.innerHTML = '';

      // Iterate over the elements based on yAxis[0].length
      for (let j = 0; j < yAxis[0].length; j++) {
        const newElement = document.createElement('div');
        newElement.className = 'col-6 col-sm';
        newElement.innerHTML = `
          <div class="card card-one">
            <div class="card-body p-3">
              <h1 class="card-value mb-0 ls--1 fs-32" id="card-val">${xAxis[j]}</h1>
              <label class="d-block mb-1 fw-medium text-dark">${yAxis[0][j]}</label>
            </div>
          </div>
        `;

        cardContainer.appendChild(newElement); // asign element to the content
      }
    }
     else if (contents[i].chart_id === 22) { // table
      
      // reference to the card container element
      const tableDataContainer = document.querySelector(`#content${contents[i].id}`);
      // const tableDataContainerModal = document.querySelector(`#card_content_zoom${contents[i].id}`);

      // Clear any previous content
      tableDataContainer.innerHTML = '';
      // tableDataContainerModal.innerHTML = '';

      // Iterate over the elements based on y_value.length
      for (let j = 0; j < xAxis.length; j++) {
        const newElement = document.createElement('tr');
        newElement.className = 'table-row';
        newElement.innerHTML = `
        <td scope="row">${j+1}</td>
        <td>${xAxis[j]}</td>
        <td>${yAxis[0][j]}</td>
        `;
        tableDataContainer.appendChild(newElement); // asign the element to the content
        // tableDataContainerModal.appendChild(newElement); // asign the element to the content
      }
    }
    else if (contents[i].chart_id === 23) { // Group of Circle
      
      let max = Math.max(...yAxis[0]);
      // reference to the card container element
      const contentContainer = document.querySelector(`#content${contents[i].id}`);

      // Clear any previous content
      contentContainer.innerHTML = '';

      // Iterate over the elements based on y_value.length
      for (let j = 0; j < yAxis[0].length; j++) {
        let gray = max == yAxis[0][j] // find if max or not, if then make the circle = bg-gray 
        const newElement = document.createElement('div');
        newElement.className = 'col-6 col-sm-4 col-md';
        newElement.innerHTML = `
          <div class="finance-item">
            <div class="finance-item-circle ${gray ? 'bg-gray-400' : ''}">
              <h1>${yAxis[0][j]}</h1>
              <label class="text-center">${xAxis[j]}</label>
            </div><!-- finance-item-circle -->
          </div><!-- finance-item --> `;
        contentContainer.appendChild(newElement); // asign the element to the content
      }
      // $(`#contentTable`).Grid({
      //   className: {
      //     table: 'table table-hover'
      //   },
      //   pagination: {
      //     limit: 5,
      //   },
      //   sort: true,
      //   resizable: true
      // });
    } 
    else if (contents[i].chart_id === 24) { // Option radial (%)
      
      // asign the value to the chart configuration
      optionRadial.series = yAxis[0];
      optionRadial.labels = xAxis;
      optionRadial.colors = colors;

      var radialBar = new ApexCharts(document.querySelector('#content' + contents[i].id), optionRadial);
      var radialBarModal = new ApexCharts(document.querySelector('#card_content_zoom' + contents[i].id), optionRadial);
      radialBar.render();
      radialBarModal.render();

    }
    else if (contents[i].chart_id === 25) { // World Map
      
      var mapColor = {}
      for (var code in possible_map_world_input) {
        for (let index = 0; index < xAxis.length; index++) {
          const country = xAxis[index] ? xAxis[index].replace(/\s/g, '').toLowerCase() : ''; 
          if (possible_map_world_input[code].includes(country)) {
            var newObj = {
              [code]: colors[index],
            };
            Object.assign(mapColor, newObj);
            index++
          }
        }
      }
      $(`#content${contents[i].id}`).vectorMap({
          map: 'world_en',
          backgroundColor: 'transparent',
          borderColor: '#000',
          borderOpacity: 0.75,
          borderWidth: 1,
          color: '#4a4949',
          enableZoom: true,
          hoverColor: '#00F',
          hoverOpacity: 0.3,
          selectedColor: '#00F',
          scaleColors: ['#C8EEFF', '#006491'],
          onRegionOver: function(event, code, region)
          {
            console.log(code);
            // console.log(region);
          },
          onLabelShow: function(event, label, code)
          {
              for (let index = 0; index < xAxis.length; index++) {
                const country = xAxis[index].replace(/\s/g, '').toLowerCase();
                if (possible_map_world_input[code].includes(country)) {
                  label.text(judul[0] + '. -' + xAxis[index] + " : " + yAxis[0][index]) 
                }
              }
          },
          onLoad: function (event, map) {
              jQuery(`#content${contents[i].id}`).vectorMap('set', 'colors', mapColor);
          },
          
      });

      $(`#card_content_zoom${contents[i].id}`).vectorMap({
          map: 'world_en',
          backgroundColor: 'transparent',
          borderColor: '#000',
          borderOpacity: 0.75,
          borderWidth: 1,
          color: '#4a4949',
          enableZoom: true,
          hoverColor: '#00F',
          hoverOpacity: 0.3,
          selectedColor: '#00F',
          scaleColors: ['#C8EEFF', '#006491'],
          onRegionOver: function(event, code, region)
          {
            console.log(code);
            // console.log(region);
          },
          onLabelShow: function(event, label, code)
          {
           // Assuming you have a reference to your HTML element (e.g., elementId)
              for (let index = 0; index < xAxis.length; index++) {
                const country = xAxis[index].replace(/\s/g, '').toLowerCase();
                if (possible_map_world_input[code].includes(country)) {
                  label.text(judul[0] + '. -' + xAxis[index] + " : " + yAxis[0][index]) 
                }
              }
          },
          onLoad: function (event, map) {
              jQuery(`#card_content_zoom${contents[i].id}`).vectorMap('set', 'colors', mapColor);
          },
          
      });
    
    } 
  }
