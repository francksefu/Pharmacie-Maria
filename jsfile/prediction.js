const regression = require('regression');
/*
const checker = document.querySelector('#checker').value;

if(checker == 'prediction-periode') {
    const input_arr = document.querySelector('#data_in').value.split(',').pop();
    const out_arr = document.querySelector('#data_out').value.split(',').pop();
    long_table = input_arr.length;
    if(long_table > 10) {
        length_training = Math.ceil(long_table * (7 / 10))
        const trainingData = [];
        for(let i = 0; i < length_training; i++) {
            trainingData.push(
                [Number(new Date(input_arr[i])), out_arr[i]]
            );
        }
        const result = regression.linear(trainingData);

        // Make predictions
        const inputToPredict = Number(new Date('2023-08-1'));//1614800000; // Timestamp for a new date
        const predictedQuantity = result.predict(inputToPredict);

        console.log('Predicted quantity sold:', predictedQuantity);
    }
    

}
*/

// Define your training data (period and quantitySold)
const trainingData = [
  [Number(new Date('2023-04-10')), 1], // Timestamp for 01/03/2021, quantitySold: 25
  [Number(new Date('2023-04-17')), 2], // Timestamp for 02/03/2021, quantitySold: 30
  [Number(new Date('2023-04-20')), 8], // Timestamp for 03/03/2021, quantitySold: 28
  [Number(new Date('2023-05-12')), 2],
  [Number(new Date('2023-05-13')), 1],
  [Number(new Date('2023-05-13')), 3],
  [Number(new Date('2023-04-16')), 2],
  // Add more training data here...
];

// Perform linear regression
const result = regression.linear(trainingData);

        // Make predictions
        const inputToPredict = Number(new Date('2023-08-1'));//1614800000; // Timestamp for a new date
        const predictedQuantity = result.predict(inputToPredict);

        console.log('Predicted quantity sold:', predictedQuantity);

