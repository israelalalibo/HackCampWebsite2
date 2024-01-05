// Get the current date
var currentDate = new Date();

// Subtract one day from the current date to obtain yesterday's date
var yesterday = new Date(currentDate);
yesterday.setDate(currentDate.getDate() - 1);

// Get the year of the previous day
var yearOfyesterday  = yesterday .getFullYear();

// Below is the file path of the running CSV (See more details below regarding usage of Year)
//const csvFilePath = '../../ccf_monthly_data_backlog/running_CSV_' + yearOfyesterday + '.csv'; // Name of running CSV with year of yesterday (this is imperative to ensure that the data added to the correct running CSV, e.g. December 2023 data is not added to a January 2024 data.
//Hence in January 2024, the data displayed by the JS file will be of all of 2023, until 1st Feb when the new data will arrive and the 2024 running CSV will start with a single data point (for January's usage).

const csvFilePath = 'Graph Data/yearly_running_CSV.csv' //Putting in the correct file name produces no graph, but putting the wonr file path shows a graph. Why?
//const csvFilePath = 'running_CSV_'+yearOfyesterday
// Load CSV data using d3.csv
d3.csv(csvFilePath).then(function(data) {
    // Extract timestamps and cloud service usage values
    const timestamps = data.map(entry => entry.Timestamp);
    const awsData = data.map(entry => entry.AWS);
    const azureData = data.map(entry => entry.AZURE);
    const totalData = data.map(entry => entry.TOTALDATA);



    // The code below creates the plot for the data in the running CSV and provides the two requested trendlines.
    const plotData = [
        { x: timestamps, y: awsData, type: 'scatter', mode: 'lines', name: 'AWS' },
        { x: timestamps, y: azureData, type: 'scatter', mode: 'lines', name: 'Azure' },
        { x: timestamps, y: totalData, type: 'scatter', mode: 'lines', name: 'Total (AWS + Azure)' },
    ];

    const layout = {
        title: 'Cloud Carbon Service Usage Over Time (MTCO2e)',
        xaxis: { title: 'Month' },
        yaxis: { title: 'Carbon Usage' },
    };

    Plotly.newPlot('plotly-chart', plotData, layout);
}).catch(function(error) {
    console.error('Error loading CSV file:', error);
});
