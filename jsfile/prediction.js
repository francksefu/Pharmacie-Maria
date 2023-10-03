
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
if (checker == 'prediction-periode)') {
    const input_arr = document.querySelector('#data_in').value.split(',')
    const out_arr = document.querySelector('#data_out').value.split(',')

    let long_table = input_arr.length;
    if(long_table > 10 ) {
        // 80% pour le training et 20% pour le test
        let length_training = Math.ceil(long_table * (7 / 10))
        //take the first date and the last date for training
        let first_elt = Number(new Date(input_arr[0]))
        let last_elt = Number(new Date(input_arr[length_training]))
        //new dataset with good elt
        const new_arr_input = []
        //const new_arr_out = []
        //take all dates , meme pour ceux dont il n y pas eu de ventes
       let current = first_elt
        while(current < last_elt) {
            new_arr_input.push(current);
            current = current + 86400000; // qui est l interval d un jour
        }

        length_training = new_arr_input.length
        //convert elt of  input arr in number 
        const convert_input_arr = [];
        for (let j = 0; j < input_arr.length; j ++) {
            convert_input_arr.push(Number(new Date(input_arr[j])))
        }
        const trainingData = [];
        for(let i = 0; i < length_training; i++) {
            if (convert_input_arr.includes(new_arr_input[i])) {
                
                trainingData.push(
                    [new_arr_input[i], out_arr[convert_input_arr.indexOf(new_arr_input[i])] * 1]
                );
            } else {
                trainingData.push(
                    [new_arr_input[i], 1]
                );
            }
            
        }
       
        const result = regression.linear(trainingData);

        // Make predictions
        const inputToPredict = [ Number(new Date('2023-12-27'))];//1614800000; // Timestamp for a new date
        const predictedQuantity = result.predict(inputToPredict);
        document.getElementById("result").value = ('Predicted quantity sold:', predictedQuantity );
    }
}




