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

// Loop through the contents array to find the matching chart_id
  for (var i = 0; i < contents.length; i++) {
    let maxValue;
    if (contents[i].chart_id === 1) { // Line Chart

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      
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
      optionLine.chart.type = 'line'; // type line chart
      optionLine.stroke.curve = 'straight'; 
      

      var lineArea = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionLine );
      lineArea.render();
      optionLine.series = [];
      
    } 
    else if (contents[i].chart_id === 2) { // Line Chart (smooth)

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      
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
      optionLine.chart.type = 'line'; // type line chart
      optionLine.stroke.curve = 'smooth'; 
      

      var lineArea = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionLine );
      lineArea.render();
      optionLine.series = [];
      
    } 
    else if (contents[i].chart_id === 3) { // Line Chart (stepline)

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      
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
      optionLine.chart.type = 'line'; // type area chart
      optionLine.stroke.curve = 'stepline'; 
      

      var lineArea = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionLine );
      lineArea.render();
      optionLine.series = [];
      
    } 
    else if (contents[i].chart_id === 4) { // Line Area Chart

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      
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
      optionLine.chart.type = 'area'; // type area chart
      optionLine.stroke.curve = 'straight'; 
      

      var lineArea = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionLine );
      lineArea.render();
      optionLine.series = [];
      
    } 
    else if (contents[i].chart_id === 5) { // Line Area Chart (smooth)

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      
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
      optionLine.chart.type = 'area'; // type area chart
      optionLine.stroke.curve = 'smooth'; 
      

      var lineArea = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionLine );
      lineArea.render();
      optionLine.series = [];
      
    }
    else if (contents[i].chart_id === 6) { // Line Area Chart (stepline)

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      
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
      optionLine.chart.type = 'area'; // type area chart
      optionLine.stroke.curve = 'stepline'; 
      

      var lineArea = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionLine );
      lineArea.render();
      optionLine.series = [];
      
    } 
    else if (contents[i].chart_id === 7) { // Bar Chart

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      
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
      
    } 
    else if (contents[i].chart_id === 8) { // Bar Chart (reversed)

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      
      // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionBarSideRev.series.push(newSeries);
      }
      optionBarSideRev.xaxis.categories = xAxis[0];
      optionBarSideRev.colors = colors;
      // optionBarSideRev.chart.stacked = true;

      var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSideRev);
      chartBar.render();
      optionBarSideRev.series = [];
      
    } 
    else if (contents[i].chart_id === 9) { // bar chart with border radius

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionFour

      let judul = JSON.parse(contents[i].judul)
      let yAxis = JSON.parse(contents[i].y_value)
      let xAxis = JSON.parse(contents[i].x_value)
      let colors = JSON.parse(contents[i].color)

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
      optionBarSide.xaxis.categories = xAxis[0];
      optionBarSide.colors = colors;
      optionBarSide.plotOptions.bar.borderRadius = 15;

      var barRadius = new ApexCharts(document.querySelector('#content' + contents[i].id), optionBarSide);
      barRadius.render();

      optionBarSide.plotOptions.bar.borderRadius = 0;
      optionBarSide.series = [];
    }
    else if (contents[i].chart_id === 10) { // bar chart with border radius (reversed)

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      
     // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionBarSideRev.series.push(newSeries);
      }
      optionBarSideRev.xaxis.categories = xAxis[0];
      optionBarSideRev.colors = colors;
      optionBarSideRev.plotOptions.bar.borderRadius = 15;

      var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSideRev);
      chartBar.render();
      optionBarSideRev.series = [];
      optionBarSideRev.plotOptions.bar.borderRadius = 0;
      
    } 
    else if (contents[i].chart_id === 11) { // Stacked Bar Chart

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      
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
      optionBarSide.chart.stacked = false;
      
    } 
    else if (contents[i].chart_id === 12) { // Stacked bar chart  (reversed)

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      
     // asign the value to the chart configuration
      for (let index = 0; index < judul.length; index++) {
        // Create a new series object
        var newSeries = {
          name: judul[index], // Set the new name
          data: yAxis[index]    // Set the new data
        };
        optionBarSideRev.series.push(newSeries);
      }
      optionBarSideRev.xaxis.categories = xAxis[0];
      optionBarSideRev.colors = colors;
      optionBarSideRev.chart.stacked = true;

      var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSideRev);
      chartBar.render();

      optionBarSideRev.series = [];
      optionBarSideRev.chart.stacked = false;

      
    } 
    else if (contents[i].chart_id === 13) { // Column Chart

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      
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
      optionBarSide.plotOptions.bar.horizontal = false;

      var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSide);
      chartBar.render();

      optionBarSide.series = [];
      optionBarSide.plotOptions.bar.horizontal = true;

      
    } 
    else if (contents[i].chart_id === 14) { // Column chart with border radius

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      
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
      optionBarSide.plotOptions.bar.borderRadius = 15;
      optionBarSide.plotOptions.bar.horizontal = false;

      var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSide);
      chartBar.render();

      optionBarSide.series = [];
      optionBarSide.plotOptions.bar.borderRadius = 0;
      optionBarSide.plotOptions.bar.horizontal = true;

      
    } 
    else if (contents[i].chart_id === 15) { // Stacked Column Chart

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      
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
      optionBarSide.plotOptions.bar.horizontal = false;
      optionBarSide.chart.stacked = true;


      var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSide);
      chartBar.render();

      optionBarSide.series = [];
      optionBarSide.plotOptions.bar.horizontal = true;
      optionBarSide.chart.stacked = false;

      
    } 
    else if (contents[i].chart_id === 16) { // Donut chart

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);


      // Assign the value to optionEigt
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)
      let colors = JSON.parse(contents[i].color)

      
      // asign the value to the chart configuration
      optionDonut.labels = xAxis[0];
      optionDonut.series = yAxis[0];
      optionDonut.chart.type = 'donut';
      optionDonut.colors = colors;

      var chartDonut = new ApexCharts(document.querySelector('#content' + contents[i].id), optionDonut);
      chartDonut.render();
    } 
    else if (contents[i].chart_id === 17) { // Pie Chart

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let xAxis = JSON.parse(contents[i].x_value)
      let yAxis = JSON.parse(contents[i].y_value)

      
      // asign the value to the chart configuration
      optionDonut.labels = xAxis[0];
      optionDonut.series = yAxis[0];
      optionDonut.chart.type = 'pie';

      var chartPie = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionDonut);
      chartPie.render();
      
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

      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

      appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

      // Assign the value to optionEigt
      let judul = JSON.parse(contents[i].judul)[0]
      let xAxis = JSON.parse(contents[i].x_value)[0]
      let yAxis = JSON.parse(contents[i].y_value)[0]
      let colors = JSON.parse(contents[i].color)
      
      var mapColor = {}
      var index = 0
      for (var code in possible_map_input) {
        const province = xAxis[index] ? xAxis[index].replace(/\s/g, '').toLowerCase() : '';;
        if (possible_map_input[code].includes(province)) {
          var newObj = {
            [code]: colors[index],
          };
          Object.assign(mapColor, newObj);
          index++
        }
      }
      // console.log(possible_map_input['path01']); // Output: ['aceh', 'ac']
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
            // console.log(code);
            // console.log(region);
          },
          onLabelShow: function(event, label, code)
          {
              for (let index = 0; index < xAxis.length; index++) {
                const province = xAxis[index].replace(/\s/g, '').toLowerCase();
                if (possible_map_input[code].includes(province)) {
                  label.text(judul + '. -' + xAxis[index] + " : " + yAxis[index]) 
                }
              }
          },
          onLoad: function (event, map) {
              jQuery(`#content${contents[i].id}`).vectorMap('set', 'colors', mapColor);
          },
          
      });
    
    } 
    else if (contents[i].chart_id === 20) { // AI Analyst
      
      appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

    } 
    else if (contents[i].chart_id === 21) { // card

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
              <h1 class="card-value mb-0 ls--1 fs-32" id="card-val">${y_value[j]}</h1>
              <label class="d-block mb-1 fw-medium text-dark">${x_value[j]}</label>
            </div>
          </div>
        `;

        cardContainer.appendChild(newElement); // asign element to the content
      }
    }
     else if (contents[i].chart_id === 22) { // table

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
    else if (contents[i].chart_id === 23) { // Group of Circle

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

    // else if (contents[i].chart_id === 2) { // Column bar chart

    //   appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

    //   appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

    //   // Assign the value to optionEigt
    //   let judul = JSON.parse(contents[i].judul)
    //   let xAxis = JSON.parse(contents[i].x_value)
    //   let yAxis = JSON.parse(contents[i].y_value)
    //   let colors = JSON.parse(contents[i].color)

    //   
    //   // asign the value to the chart configuration
    //   for (let index = 0; index < judul.length; index++) {
    //     // Create a new series object
    //     var newSeries = {
    //       name: judul[index], // Set the new name
    //       data: yAxis[index]    // Set the new data
    //     };
    //     optionColumn.series.push(newSeries);
    //   }
    //   optionColumn.xaxis.categories = xAxis[0];
    //   optionColumn.colors = colors;

    //   var chartColumn = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionColumn);
    //   chartColumn.render();
    //   optionColumn.series = [];
    //   
    // } 
    // else if (contents[i].chart_id === 3) { // Stacked bar chart

    //   appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

    //   appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

    //   // Assign the value to optionEigt
    //   let judul = JSON.parse(contents[i].judul)
    //   let xAxis = JSON.parse(contents[i].x_value)
    //   let yAxis = JSON.parse(contents[i].y_value)
    //   let colors = JSON.parse(contents[i].color)
    //   console.log(colors);

    //   
    //   // asign the value to the chart configuration
    //   for (let index = 0; index < judul.length; index++) {
    //     // Create a new series object
    //     var newSeries = {
    //       name: judul[index], // Set the new name
    //       data: yAxis[index]    // Set the new data
    //     };
    //     optionStacked.series.push(newSeries);
    //   }
    //   optionStacked.colors = colors;
    //   optionStacked.xaxis.categories = xAxis[0];

    //   var stackedBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionStacked );
    //   stackedBar.render();
    //   optionStacked.series = [];
    //   
    // } 
    // else if (contents[i].chart_id === 5) { // bar chart with border radius

    //   appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

    //   appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

    //   // Assign the value to optionFour

    //   let judul = JSON.parse(contents[i].judul)[0]
    //   let yAxis = JSON.parse(contents[i].y_value)[0]
    //   let xAxis = JSON.parse(contents[i].x_value)[0]
    //   let colors = JSON.parse(contents[i].color)

    //   var newSeries = {
    //       name: judul, // Set the new name
    //       data: yAxis    // Set the new data
    //   };
    //   optionStacked.series.push(newSeries);
    //   // asign the value to the chart configuration
    //   optionStacked.xaxis.categories = xAxis;
    //   optionStacked.colors = colors;
    //   optionStacked.plotOptions.bar.borderRadius = 12;

    //   var barRadius = new ApexCharts(document.querySelector('#content' + contents[i].id), optionStacked);
    //   barRadius.render();

    //   optionLine.series = [];
    // }
   
    // else if (contents[i].chart_id === 7) { // Stacked Side Bar Chart

    //   appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

    //   appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

    //   // Assign the value to optionEigt
    //   let judul = JSON.parse(contents[i].judul)
    //   let xAxis = JSON.parse(contents[i].x_value)
    //   let yAxis = JSON.parse(contents[i].y_value)
    //   let colors = JSON.parse(contents[i].color)

    //   
    //   // asign the value to the chart configuration
    //   for (let index = 0; index < judul.length; index++) {
    //     // Create a new series object
    //     var newSeries = {
    //       name: judul[index], // Set the new name
    //       data: yAxis[index]    // Set the new data
    //     };
    //     optionBarSide.series.push(newSeries);
    //   }
    //   optionBarSide.xaxis.categories = xAxis[0];
    //   optionBarSide.colors = colors;
    //   optionBarSide.chart.stacked = true;

    //   var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSide);
    //   chartBar.render();
    //   optionBarSide.series = [];
    //   
    // } 
   
    // else if (contents[i].chart_id === 9) { // Line Chart

    //   appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

    //   appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);
    //   // Assign the value to optionEigt
    //   let judul = JSON.parse(contents[i].judul)
    //   let xAxis = JSON.parse(contents[i].x_value)
    //   let yAxis = JSON.parse(contents[i].y_value)
    //   let colors = JSON.parse(contents[i].color)

    //   
    //   // asign the value to the chart configuration

    //   for (let index = 0; index < judul.length; index++) {
    //     // Create a new series object
    //     var newSeries = {
    //       name: judul[index], // Set the new name
    //       data: yAxis[index]    // Set the new data
    //     };
    //     optionLine.series.push(newSeries);
    //   }
    //   optionLine.xaxis.categories = xAxis[0];
    //   optionLine.colors = colors;
    //   optionLine.chart.type = 'line'; // type line chart
    //   optionLine.stroke.curve = 'straight'; 

    //   var chartLine = new ApexCharts(document.querySelector('#content' + contents[i].id), optionLine);
    //   chartLine.render();
    //   optionLine.series = [];
    //   
    // } 
    // else if (contents[i].chart_id === 10) { // Donut chart

    //   appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

    //   appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);


    //   // Assign the value to optionEigt
    //   let xAxis = JSON.parse(contents[i].x_value)
    //   let yAxis = JSON.parse(contents[i].y_value)
    //   let colors = JSON.parse(contents[i].color)

    //   
    //   // asign the value to the chart configuration
    //   optionDonut.labels = xAxis[0];
    //   optionDonut.series = yAxis[0];
    //   optionDonut.chart.type = 'donut';
    //   optionDonut.colors = colors;

    //   var chartDonut = new ApexCharts(document.querySelector('#content' + contents[i].id), optionDonut);
    //   chartDonut.render();
    // } 
    
   
    // else if (contents[i].chart_id === 13) { // Side Bar Chart

    //   appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

    //   appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

    //   // Assign the value to optionEigt
    //   let judul = JSON.parse(contents[i].judul)
    //   let xAxis = JSON.parse(contents[i].x_value)
    //   let yAxis = JSON.parse(contents[i].y_value)
    //   let colors = JSON.parse(contents[i].color)

    //   
    //   // asign the value to the chart configuration
    //   for (let index = 0; index < judul.length; index++) {
    //     // Create a new series object
    //     var newSeries = {
    //       name: judul[index], // Set the new name
    //       data: yAxis[index]    // Set the new data
    //     };
    //     optionBarSide.series.push(newSeries);
    //   }
    //   optionBarSide.xaxis.categories = xAxis[0];
    //   optionBarSide.colors = colors;

    //   var chartBar = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionBarSide);
    //   chartBar.render();

    //   optionBarSide.series = [];
    //   
    // } 
    // else if (contents[i].chart_id === 14) { // Pie Chart

    //   appendTitleToCard(`#judulcontent${contents[i].id}`, contents[i].card_title);

    //   appendDescriptionToCard(`#descriptioncontent${contents[i].id}`, contents[i].card_description);

    //   // Assign the value to optionEigt
    //   let xAxis = JSON.parse(contents[i].x_value)
    //   let yAxis = JSON.parse(contents[i].y_value)

    //   
    //   // asign the value to the chart configuration
    //   optionDonut.labels = xAxis[0];
    //   optionDonut.series = yAxis[0];
    //   optionDonut.chart.type = 'pie';

    //   var chartPie = new ApexCharts(document.querySelector(`#content${contents[i].id}`), optionDonut);
    //   chartPie.render();
    //   
    // } 
    
  


  }
