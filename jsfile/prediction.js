
const checker = document.querySelector('#checker').value;

if(checker == 'prediction-periode') {
    const input_arr = document.querySelector('#data_in').value.split(',')
    const out_arr = document.querySelector('#data_out').value.split(',')

    long_table = input_arr.length;
    if(long_table > 10 ) {
        // 80% pour le training et 20% pour le test
        length_training = Math.ceil(long_table * (8 / 10))
        const trainingData = [];
        for(let i = 0; i < length_training; i++) {
            trainingData.push(
                [Number(new Date(input_arr[i])), out_arr[i] * 1]
            );
        }
       
        const result = regression.linear(trainingData);

        // Make predictions
        const inputToPredict = [ Number(new Date('2023-09-27'))];//1614800000; // Timestamp for a new date
        const predictedQuantity = result.predict(inputToPredict);
        document.getElementById("result").value = ('Predicted quantity sold:', predictedQuantity);

    }
    

}
