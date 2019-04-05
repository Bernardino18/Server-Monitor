$( "#cpu_value" ).value = 0;
$( "#ram_value" ).value = 0;

$( "#cpu_submit" ).click(function() {

  if($( "#cpu_command" ).value != "" && ip != ""){
    $.ajax({
      url: 'connect.php',
      type: 'post', //php          
      data: {
        ip:ip,
        action:1,
        command:'ACTION:CPU\\' + $( "#cpu_action-operation option:selected" ).val() + '\\' + $( "#cpu_value" ).val() + '\\CMD\\'+ $( "#cpu_command" ).val() + '.'
      },
      dataType: 'text', //data format   
      success: function(data) //on receive of reply
      {
        alert("The command was sent sucessfully");
      }});
  }

});

$( "#ram_submit" ).click(function() {


  if($( "#ram_command" ).value != "" && ip != ""){
    $.ajax({
      url: 'connect.php',
      type: 'post', //php          
      data: {
        ip:ip,
        command:'ACTION:RAM\\' + $( "#ram_action-operation option:selected" ).val() + '\\' + $( "#ram_value" ).val() + '\\CMD\\'+ $( "#ram_command" ).val() + '.'
      },
      dataType: 'text', //data format   
      success: function(data) //on receive of reply
      {
        alert("The command was sent sucessfully");
      }});
  }
  
});


$('#ada0').hide();
$('#ada1').hide();
$('#ada2').hide();
$('#ada3').hide();
$('#ada4').hide();
$('#ada5').hide();
$('#divpie_cpu').hide();
$('#div_cpuram_progress').hide();
$('#divpie_ram').hide();
$('#error').hide();
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var myPieChart = new Chart(document.getElementById("pie_cpu"), {
  type: 'doughnut',
  data: {
      labels: ["Used", "Available"],
      datasets: [{
          data: [50, 50],
          backgroundColor: ['#4e73df', '#1cc88a'],
          hoverBackgroundColor: ['#2e59d9', '#17a673'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

var myPieChart2 = new Chart(document.getElementById("pie_ram"), {
    type: 'doughnut',
    data: {
        labels: ["Used", "Available"],
        datasets: [{
            data: [50, 50],
            backgroundColor: ['#4e73df', '#1cc88a'],
            hoverBackgroundColor: ['#2e59d9', '#17a673'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: false
        },
        cutoutPercentage: 80,
    },
});

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';
function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}
//Criar os graficos
var myLineChart = [];

for(var a = 0; a < 6;a++) {
myLineChart[a] = new Chart(document.getElementById("myAreaChart"+a), {
    type: 'line',
    data: {
      labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"],
      datasets: [{
        label: "Usage",
        lineTension: 0.3,
        backgroundColor: "rgba(92, 184, 92, 0.05)",
        //backgroundColor: "rgba(78, 115, 223, 0.05)",
        borderColor: "rgba(78, 115, 223, 1)",
        pointRadius: 3,
        pointBackgroundColor: "rgba(78, 115, 223, 1)",
        pointBorderColor: "rgba(78, 115, 223, 1)",
        pointHoverRadius: 3,
        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
        pointHitRadius: 10,
        pointBorderWidth: 2,
        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          time: {
            unit: 'date'
          },
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 2
          }
        }],
        yAxes: [{
          display: true,
          ticks: {
            maxTicksLimit: 5,
            padding: 10,
            beginAtZero:true,
            steps: 100,
            StepValue:10000,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
              return number_format(value) + ' B';
            }
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        intersect: false,
        mode: 'index',
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' B';
          }
        }
      }
    }
  });
}




//Added variables for HTML Modification
var maxcpudiv = document.getElementById("cpumax");
var maxramdiv = document.getElementById("rammax");
var maxcpuh4 = document.getElementById("cpumaxt");
var maxramh4 = document.getElementById("rammaxt");
var datalist = document.getElementById("hostlist");
var dropdown = document.getElementById("droplist");


//memory variables
var maxcpu = 0;
var maxram = 0;
var ip = "";
var list = "";


$(document).keyup(function (e) {
  if ($("#droplist:focus") && (e.keyCode === 13)) {
     list.forEach(element => {
       if(element[0] == dropdown.value){
         ip = element[1];
       }
     });
     dropdown.value = "";
     for(var a = 0; a < myLineChart.length;a++) {
       //resetar valores do grafico
      myLineChart[a].data.datasets[0].data = [0,0,0,0,0,0,0,0,0,0];
      myLineChart[a].update();
     }
     myPieChart.data.datasets[0].data = [50,50];
     myPieChart2.data.datasets[0].data = [50,50];
     
     myPieChart.update();
     myPieChart2.update();
     maxcpu = 0;
     maxram = 0;
     maxcpu = parseInt(details[0][0]);
     maxcpudiv.style.width = maxcpu+"%";
     maxcpuh4.innerHTML=maxcpu+"%";
     maxram = rampercent;
     maxramdiv.style.width = maxram+"%";
     maxramh4.innerHTML=maxram+"%";

  }
});

function hidenetworkgraphs(length) {
  for(var i = 0; i < 6;i++) {
    $('#ada'+i).hide();
  }
}
carregar();
function carregar() {
  $.ajax({
    url: 'connect_server.php', //php          
    data: "", //the data "caller=name1&&callee=name2"
    dataType: 'text', //data format   
    success: function(data) //on receive of reply
        {
          var options = '';
          var iphlist = data.split(":");
          for(var i = 0; i < iphlist.length;i++){
            iphlist[i] = iphlist[i].split("\\");
            options += '<option value="'+iphlist[i][0]+'" />';
          }
          datalist.innerHTML = options;
          if(ip=="" || ip == undefined){
            ip=iphlist[0][1];
            $('#divpie_cpu').hide();
            $('#div_cpuram_progress').hide();
            $('#divpie_ram').hide();
            $('#error').show();
            hidenetworkgraphs();
          }
          list = iphlist;
          
          $(function() {
              $.ajax({
                  url: 'connect.php',
                  type: 'post', //php          
                  data: {
                    ip:ip
                  }, 
                  dataType: 'text', //data format   
                  success: function(response) //on receive of reply
                      {
                        console.log(response);
                        if(response == "") {
                          $('#error').show();
                          $('#divpie_cpu').hide();
                          $('#div_cpuram_progress').hide();
                          $('#divpie_ram').hide();
                          $('#pcn').html('Unable to connect to server'); 
                          hidenetworkgraphs();

                        } else {
                          $('#pcn').html(iphlist[0][0]); 
                          var details = response.split(":");
                          if(details.length > 1) {
                            for(var i = 0; i < details.length;i++) {
                              details[i] = details[i].split("*");
                            }
                            $('#error').hide();
                            $('#divpie_cpu').show();
                            $('#div_cpuram_progress').show();
                            $('#divpie_ram').show();
                            
                            myPieChart.data.datasets[0].data = [parseInt(details[0][0]),100-parseInt(details[0][0])];
                            myPieChart.update();
                            myPieChart2.data.datasets[0].data = [parseInt(details[0][2])-parseInt(details[0][1]),parseInt(details[0][1])];
                            myPieChart2.update();
                            
                            //alterar valores do grafico
                            var d;
                            for(var x=0; x < details.length-1;x++) {
                              $('#ethdesc'+x).html(details[x+1][1]); //output to html  
                              $('#ada'+x).show();
                              for(var i=0; i<9; i++){
                                myLineChart[x].data.datasets[0].data[i] = myLineChart[x].data.datasets[0].data[i+1];
                                myLineChart[x].data.labels[i] = myLineChart[x].data.labels[i+1];
                              }
                              myLineChart[x].data.datasets[0].data[9] = parseInt(details[x+1][3]);
                              d = new Date();
                              myLineChart[x].data.labels[9] = d.getHours() + ":" + d.getMinutes();
                              myLineChart[x].update();
                            }
                            
                            if(parseInt(details[0][0])> maxcpu){
                              maxcpu = parseInt(details[0][0]);
                              maxcpudiv.style.width = maxcpu+"%";
                              maxcpuh4.innerHTML=maxcpu+"%";
                            }
                            rampercent = 100-parseInt(parseInt(details[0][1])*100/parseInt(details[0][2]));
                            if(rampercent > maxram){
                              maxram = rampercent;
                              maxramdiv.style.width = maxram+"%";
                              maxramh4.innerHTML=maxram+"%";
                            }
                          }
                                      
                        }
                        
                      }
              });
          });
        }
});
}
setInterval(carregar, 3000); 

 //every 5 secs
